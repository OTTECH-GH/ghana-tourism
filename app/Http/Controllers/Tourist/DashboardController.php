<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use App\Models\GuideBooking;
use App\Models\HotelBooking;
use App\Models\Review;
use App\Models\TransportBooking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function bookings()
    {
        $hotelBookings = HotelBooking::where('user_id', auth()->id())
            ->with(['hotel', 'room'])
            ->latest()
            ->paginate(10);

        return view('tourist.bookings', compact('hotelBookings'));
    }

    public function trips()
    {
        $transportBookings = TransportBooking::where('user_id', auth()->id())
            ->with(['driver.user', 'vehicle', 'destinations'])
            ->latest()
            ->paginate(10);

        return view('tourist.trips', compact('transportBookings'));
    }

    public function reviews()
    {
        $reviews = Review::where('user_id', auth()->id())
            ->with('reviewable')
            ->latest()
            ->paginate(10);

        return view('tourist.reviews', compact('reviews'));
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'reviewable_type' => 'required|string',
            'reviewable_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $typeMap = [
            'tourism_site' => \App\Models\TourismSite::class,
            'hotel' => \App\Models\Hotel::class,
            'driver' => \App\Models\Driver::class,
            'tour_guide' => \App\Models\TourGuide::class,
        ];

        $modelClass = $typeMap[$validated['reviewable_type']] ?? null;
        if (!$modelClass) {
            return back()->with('error', 'Invalid review type.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'reviewable_type' => $modelClass,
            'reviewable_id' => $validated['reviewable_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $model = $modelClass::find($validated['reviewable_id']);
        if ($model && method_exists($model, 'updateRating')) {
            $model->updateRating();
        }

        return back()->with('success', 'Review submitted successfully!');
    }

    public function cancelBooking(HotelBooking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        $booking->room->increment('available_rooms', $booking->rooms_booked);

        return back()->with('success', 'Booking cancelled.');
    }

    public function cancelTrip(TransportBooking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Trip cancelled.');
    }
}
