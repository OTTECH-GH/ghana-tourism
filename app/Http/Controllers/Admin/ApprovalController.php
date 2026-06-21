<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Hotel;
use App\Models\TourGuide;
use App\Models\TransportCompany;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingHotels = Hotel::where('status', 'pending')->with('user')->get();
        $pendingDrivers = Driver::where('status', 'pending')->with('user')->get();
        $pendingGuides = TourGuide::where('status', 'pending')->with('user')->get();
        $pendingCompanies = TransportCompany::where('status', 'pending')->with('user')->get();

        return view('admin.approvals.index', compact('pendingHotels', 'pendingDrivers', 'pendingGuides', 'pendingCompanies'));
    }

    public function approveHotel(Hotel $hotel)
    {
        $hotel->update(['status' => 'approved']);
        return back()->with('success', 'Hotel approved.');
    }

    public function rejectHotel(Hotel $hotel)
    {
        $hotel->update(['status' => 'rejected']);
        return back()->with('success', 'Hotel rejected.');
    }

    public function approveDriver(Driver $driver)
    {
        $driver->update(['status' => 'approved']);
        return back()->with('success', 'Driver approved.');
    }

    public function rejectDriver(Driver $driver)
    {
        $driver->update(['status' => 'rejected']);
        return back()->with('success', 'Driver rejected.');
    }

    public function approveGuide(TourGuide $tourGuide)
    {
        $tourGuide->update(['status' => 'approved']);
        return back()->with('success', 'Tour guide approved.');
    }

    public function rejectGuide(TourGuide $tourGuide)
    {
        $tourGuide->update(['status' => 'rejected']);
        return back()->with('success', 'Tour guide rejected.');
    }
}
