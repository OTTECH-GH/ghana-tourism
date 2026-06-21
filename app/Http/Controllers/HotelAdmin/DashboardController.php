<?php

namespace App\Http\Controllers\HotelAdmin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\HotelRoom;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $hotel = auth()->user()->hotel;

        if (!$hotel) {
            return redirect()->route('hotel-admin.create');
        }

        $stats = [
            'total_rooms' => $hotel->rooms()->sum('total_rooms'),
            'available_rooms' => $hotel->rooms()->sum('available_rooms'),
            'total_bookings' => $hotel->bookings()->count(),
            'pending_bookings' => $hotel->bookings()->where('status', 'pending')->count(),
            'confirmed_bookings' => $hotel->bookings()->where('status', 'confirmed')->count(),
            'revenue' => $hotel->bookings()->where('status', 'completed')->sum('total_amount'),
        ];

        $recentBookings = $hotel->bookings()
            ->with(['user', 'room'])
            ->latest()
            ->take(10)
            ->get();

        return view('hotel-admin.dashboard', compact('hotel', 'stats', 'recentBookings'));
    }

    public function create()
    {
        if (auth()->user()->hotel) {
            return redirect()->route('hotel-admin.dashboard');
        }
        $regions = Region::all();
        return view('hotel-admin.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'star_rating' => 'required|integer|min:1|max:5',
            'check_in_time' => 'nullable',
            'check_out_time' => 'nullable',
            'cancellation_policy' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = 'pending';
        $validated['facilities'] = $request->input('facilities', []);

        Hotel::create($validated);

        return redirect()->route('hotel-admin.dashboard')->with('success', 'Hotel registered! Awaiting admin approval.');
    }

    public function rooms()
    {
        $hotel = auth()->user()->hotel;
        if (!$hotel) {
            return redirect()->route('hotel-admin.create');
        }

        $rooms = $hotel->rooms;
        return view('hotel-admin.rooms.index', compact('hotel', 'rooms'));
    }

    public function createRoom()
    {
        $hotel = auth()->user()->hotel;
        return view('hotel-admin.rooms.create', compact('hotel'));
    }

    public function storeRoom(Request $request)
    {
        $hotel = auth()->user()->hotel;

        $validated = $request->validate([
            'room_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1',
            'total_rooms' => 'required|integer|min:1',
            'breakfast_included' => 'boolean',
        ]);

        $validated['hotel_id'] = $hotel->id;
        $validated['available_rooms'] = $validated['total_rooms'];
        $validated['facilities'] = $request->input('facilities', []);

        HotelRoom::create($validated);

        return redirect()->route('hotel-admin.rooms')->with('success', 'Room added successfully.');
    }

    public function bookings(Request $request)
    {
        $hotel = auth()->user()->hotel;
        if (!$hotel) {
            return redirect()->route('hotel-admin.create');
        }

        $query = $hotel->bookings()->with(['user', 'room']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15);
        return view('hotel-admin.bookings', compact('hotel', 'bookings'));
    }

    public function confirmBooking(HotelBooking $booking)
    {
        $hotel = auth()->user()->hotel;
        if ($booking->hotel_id !== $hotel->id) {
            abort(403);
        }

        $booking->update(['status' => 'confirmed']);
        return back()->with('success', 'Booking confirmed.');
    }

    public function rejectBooking(HotelBooking $booking)
    {
        $hotel = auth()->user()->hotel;
        if ($booking->hotel_id !== $hotel->id) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        $booking->room->increment('available_rooms', $booking->rooms_booked);
        return back()->with('success', 'Booking rejected.');
    }
}
