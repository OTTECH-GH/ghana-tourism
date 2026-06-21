<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Driver;
use App\Models\GuideBooking;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\Payment;
use App\Models\TourGuide;
use App\Models\TourismSite;
use App\Models\TransportBooking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tourists' => User::where('role', 'tourist')->count(),
            'total_sites' => TourismSite::count(),
            'total_hotels' => Hotel::where('status', 'approved')->count(),
            'total_drivers' => Driver::where('status', 'approved')->count(),
            'total_guides' => TourGuide::where('status', 'approved')->count(),
            'hotel_bookings' => HotelBooking::count(),
            'transport_bookings' => TransportBooking::count(),
            'completed_trips' => TransportBooking::where('status', 'completed')->count(),
            'cancelled_trips' => TransportBooking::where('status', 'cancelled')->count(),
            'pending_approvals' => Hotel::where('status', 'pending')->count()
                + Driver::where('status', 'pending')->count()
                + TourGuide::where('status', 'pending')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'total_complaints' => Complaint::where('status', 'open')->count(),
        ];

        $recentBookings = HotelBooking::with(['user', 'hotel'])
            ->latest()
            ->take(5)
            ->get();

        $recentTrips = TransportBooking::with(['user', 'driver.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentTrips'));
    }
}
