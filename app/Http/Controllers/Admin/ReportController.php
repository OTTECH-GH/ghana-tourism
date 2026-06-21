<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use App\Models\Payment;
use App\Models\TourismSite;
use App\Models\TransportBooking;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $monthlyRevenue = Payment::where('status', 'completed')
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $topSites = TourismSite::orderByDesc('total_reviews')->take(10)->get();

        $bookingsByMonth = HotelBooking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $usersByRole = User::selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->get();

        return view('admin.reports.index', compact('monthlyRevenue', 'topSites', 'bookingsByMonth', 'usersByRole'));
    }
}
