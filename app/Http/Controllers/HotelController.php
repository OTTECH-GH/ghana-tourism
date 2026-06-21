<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\HotelRoom;
use App\Models\Region;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::where('status', 'approved')->with(['region', 'rooms']);

        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }
        if ($request->filled('q')) {
            $query->where('name', 'like', "%{$request->q}%");
        }
        if ($request->filled('stars')) {
            $query->where('star_rating', '>=', $request->stars);
        }

        $hotels = $query->orderBy('is_featured', 'desc')->paginate(12);
        $regions = Region::all();

        return view('hotels.index', compact('hotels', 'regions'));
    }

    public function show(Hotel $hotel)
    {
        $hotel->load(['region', 'rooms', 'images', 'reviews.user', 'tourismSites']);

        return view('hotels.show', compact('hotel'));
    }

    public function bookRoom(Request $request, HotelRoom $room)
    {
        $room->load('hotel');
        return view('hotels.book', compact('room'));
    }

    public function storeBooking(Request $request, HotelRoom $room)
    {
        $validated = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1|max:' . $room->max_guests,
            'rooms_booked' => 'required|integer|min:1|max:' . $room->available_rooms,
            'special_requests' => 'nullable|string|max:500',
        ]);

        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalAmount = $room->price_per_night * $nights * $validated['rooms_booked'];

        $booking = HotelBooking::create([
            'booking_reference' => HotelBooking::generateReference(),
            'user_id' => auth()->id(),
            'hotel_id' => $room->hotel_id,
            'hotel_room_id' => $room->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guests' => $validated['guests'],
            'rooms_booked' => $validated['rooms_booked'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'special_requests' => $validated['special_requests'] ?? null,
        ]);

        $room->decrement('available_rooms', $validated['rooms_booked']);

        return redirect()->route('tourist.bookings')->with('success', 'Hotel booking created successfully! Reference: ' . $booking->booking_reference);
    }
}
