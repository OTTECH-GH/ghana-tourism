<?php

namespace App\Http\Controllers\DriverPanel;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\TransportBooking;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $driver = auth()->user()->driver;

        if (!$driver) {
            return redirect()->route('driver.register');
        }

        $stats = [
            'total_trips' => $driver->total_trips,
            'pending_requests' => TransportBooking::where('status', 'pending')
                ->where('vehicle_type', $driver->vehicle?->vehicle_type)
                ->whereNull('driver_id')
                ->count(),
            'active_trips' => $driver->bookings()->where('status', 'in_progress')->count(),
            'completed_trips' => $driver->bookings()->where('status', 'completed')->count(),
            'earnings' => $driver->bookings()->where('status', 'completed')->sum('final_amount'),
            'rating' => $driver->avg_rating,
        ];

        $activeTrip = $driver->bookings()
            ->where('status', 'in_progress')
            ->with(['user', 'destinations'])
            ->first();

        $recentTrips = $driver->bookings()
            ->with(['user', 'destinations'])
            ->latest()
            ->take(5)
            ->get();

        return view('driver.dashboard', compact('driver', 'stats', 'activeTrip', 'recentTrips'));
    }

    public function register()
    {
        if (auth()->user()->driver) {
            return redirect()->route('driver.dashboard');
        }
        return view('driver.register');
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'licence_number' => 'required|string|unique:drivers',
            'experience_years' => 'required|integer|min:0',
            'vehicle_make' => 'required|string|max:255',
            'vehicle_model' => 'required|string|max:255',
            'vehicle_type' => 'required|in:small_car,suv,van,mini_bus,tour_bus,executive_bus',
            'plate_number' => 'required|string|unique:vehicles',
            'capacity' => 'required|integer|min:1',
            'price_per_km' => 'required|numeric|min:0',
            'base_price' => 'required|numeric|min:0',
            'air_conditioned' => 'boolean',
        ]);

        $vehicle = Vehicle::create([
            'user_id' => auth()->id(),
            'make' => $validated['vehicle_make'],
            'model' => $validated['vehicle_model'],
            'vehicle_type' => $validated['vehicle_type'],
            'plate_number' => $validated['plate_number'],
            'capacity' => $validated['capacity'],
            'price_per_km' => $validated['price_per_km'],
            'base_price' => $validated['base_price'],
            'air_conditioned' => $request->boolean('air_conditioned'),
            'is_available' => true,
            'status' => 'pending',
        ]);

        Driver::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'licence_number' => $validated['licence_number'],
            'experience_years' => $validated['experience_years'],
            'languages' => $request->input('languages', ['English']),
            'is_available' => true,
            'status' => 'pending',
        ]);

        return redirect()->route('driver.dashboard')->with('success', 'Registration submitted! Awaiting admin approval.');
    }

    public function availableTrips()
    {
        $driver = auth()->user()->driver;

        $trips = TransportBooking::where('status', 'pending')
            ->whereNull('driver_id')
            ->with(['user', 'destinations'])
            ->latest()
            ->paginate(15);

        return view('driver.available-trips', compact('trips', 'driver'));
    }

    public function acceptTrip(TransportBooking $booking)
    {
        $driver = auth()->user()->driver;

        $booking->update([
            'driver_id' => $driver->id,
            'vehicle_id' => $driver->vehicle_id,
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Trip accepted!');
    }

    public function startTrip(TransportBooking $booking)
    {
        $driver = auth()->user()->driver;
        if ($booking->driver_id !== $driver->id) {
            abort(403);
        }

        $booking->update([
            'status' => 'in_progress',
            'trip_started_at' => now(),
        ]);

        return back()->with('success', 'Trip started!');
    }

    public function endTrip(TransportBooking $booking)
    {
        $driver = auth()->user()->driver;
        if ($booking->driver_id !== $driver->id) {
            abort(403);
        }

        $commissionRate = 0.15;
        $finalAmount = $booking->estimated_amount;
        $commission = $finalAmount * $commissionRate;

        $booking->update([
            'status' => 'completed',
            'trip_ended_at' => now(),
            'final_amount' => $finalAmount,
            'platform_commission' => $commission,
        ]);

        $driver->increment('total_trips');

        return back()->with('success', 'Trip completed! Earning: GHS ' . number_format($finalAmount - $commission, 2));
    }

    public function earnings()
    {
        $driver = auth()->user()->driver;

        $earnings = $driver->bookings()
            ->where('status', 'completed')
            ->latest()
            ->paginate(15);

        $totalEarnings = $driver->bookings()
            ->where('status', 'completed')
            ->sum('final_amount');

        $totalCommissions = $driver->bookings()
            ->where('status', 'completed')
            ->sum('platform_commission');

        return view('driver.earnings', compact('earnings', 'totalEarnings', 'totalCommissions', 'driver'));
    }
}
