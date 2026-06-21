<?php

namespace App\Http\Controllers;

use App\Models\TourismSite;
use App\Models\TransportBooking;
use App\Models\TripDestination;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('status', 'approved')
            ->where('is_available', true)
            ->get();

        $tourismSites = TourismSite::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('transport.index', compact('vehicles', 'tourismSites'));
    }

    public function book(Request $request)
    {
        $tourismSites = TourismSite::where('is_active', true)->orderBy('name')->get();
        $vehicles = Vehicle::where('status', 'approved')->where('is_available', true)->get();

        return view('transport.book', compact('tourismSites', 'vehicles'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'trip_date' => 'required|date|after_or_equal:today',
            'trip_time' => 'required',
            'passengers' => 'required|integer|min:1|max:50',
            'vehicle_type' => 'required|in:small_car,suv,van,mini_bus,tour_bus,executive_bus',
            'return_trip' => 'boolean',
            'full_day' => 'boolean',
            'destinations' => 'required|array|min:1',
            'destinations.*.tourism_site_id' => 'nullable|exists:tourism_sites,id',
            'destinations.*.name' => 'required|string|max:255',
            'destinations.*.wait_minutes' => 'nullable|integer|min:0',
        ]);

        $basePrice = $this->getBasePrice($validated['vehicle_type']);
        $pricePerKm = $this->getPricePerKm($validated['vehicle_type']);
        $estimatedDistance = count($validated['destinations']) * 25;
        $estimatedDuration = count($validated['destinations']) * 1.5;
        $estimatedAmount = $basePrice + ($pricePerKm * $estimatedDistance);

        if ($request->boolean('return_trip')) {
            $estimatedAmount *= 1.8;
        }
        if ($request->boolean('full_day')) {
            $estimatedAmount = max($estimatedAmount, $basePrice * 3);
        }

        $booking = TransportBooking::create([
            'booking_reference' => TransportBooking::generateReference(),
            'user_id' => auth()->id(),
            'pickup_location' => $validated['pickup_location'],
            'trip_date' => $validated['trip_date'],
            'trip_time' => $validated['trip_time'],
            'passengers' => $validated['passengers'],
            'vehicle_type' => $validated['vehicle_type'],
            'return_trip' => $request->boolean('return_trip'),
            'full_day' => $request->boolean('full_day'),
            'estimated_distance_km' => $estimatedDistance,
            'estimated_duration_hours' => $estimatedDuration,
            'estimated_amount' => $estimatedAmount,
            'status' => 'pending',
        ]);

        foreach ($validated['destinations'] as $index => $dest) {
            TripDestination::create([
                'transport_booking_id' => $booking->id,
                'tourism_site_id' => $dest['tourism_site_id'] ?? null,
                'destination_name' => $dest['name'],
                'stop_order' => $index + 1,
                'estimated_wait_minutes' => $dest['wait_minutes'] ?? 60,
            ]);
        }

        return redirect()->route('tourist.trips')->with('success', 'Transport booking created! Reference: ' . $booking->booking_reference);
    }

    public function tripPlanner()
    {
        $tourismSites = TourismSite::where('is_active', true)
            ->with(['region', 'category'])
            ->orderBy('name')
            ->get();

        return view('transport.planner', compact('tourismSites'));
    }

    private function getBasePrice(string $type): float
    {
        return match ($type) {
            'small_car' => 50,
            'suv' => 100,
            'van' => 150,
            'mini_bus' => 250,
            'tour_bus' => 400,
            'executive_bus' => 600,
            default => 50,
        };
    }

    private function getPricePerKm(string $type): float
    {
        return match ($type) {
            'small_car' => 3.5,
            'suv' => 5.0,
            'van' => 6.0,
            'mini_bus' => 8.0,
            'tour_bus' => 12.0,
            'executive_bus' => 15.0,
            default => 3.5,
        };
    }
}
