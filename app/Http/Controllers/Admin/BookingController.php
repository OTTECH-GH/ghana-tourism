<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use App\Models\TransportBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function hotelBookings(Request $request)
    {
        $query = HotelBooking::with(['user', 'hotel', 'room']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(20);
        return view('admin.bookings.hotel', compact('bookings'));
    }

    public function transportBookings(Request $request)
    {
        $query = TransportBooking::with(['user', 'driver.user', 'vehicle', 'destinations']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(20);
        return view('admin.bookings.transport', compact('bookings'));
    }
}
