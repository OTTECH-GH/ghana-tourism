@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Driver Dashboard</h1>
            <p class="text-gray-500">Status: <span class="font-medium {{ $driver->status === 'approved' ? 'text-emerald-600' : 'text-yellow-600' }}">{{ ucfirst($driver->status) }}</span></p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('driver.available-trips') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 text-sm">Available Trips</a>
            <a href="{{ route('driver.earnings') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Earnings</a>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @foreach([
            ['Total Trips', $stats['total_trips']],
            ['Pending', $stats['pending_requests']],
            ['Active', $stats['active_trips']],
            ['Completed', $stats['completed_trips']],
            ['Rating', $stats['rating'] ? number_format($stats['rating'], 1) . '/5' : 'N/A'],
            ['Earnings', 'GHS ' . number_format($stats['earnings'], 2)],
        ] as [$label, $value])
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <div class="text-xs text-gray-500">{{ $label }}</div>
                <div class="text-xl font-bold text-gray-800 mt-1">{{ $value }}</div>
            </div>
        @endforeach
    </div>

    @if($activeTrip)
        <div class="bg-emerald-50 border-2 border-emerald-200 rounded-xl p-6 mb-8">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-lg font-semibold text-emerald-800 mb-2">Active Trip</h2>
                    <p class="text-gray-700">Passenger: {{ $activeTrip->user->name }}</p>
                    <p class="text-gray-600 text-sm">From: {{ $activeTrip->pickup_location }}</p>
                    <div class="mt-2">
                        @foreach($activeTrip->destinations as $d)
                            <span class="bg-white text-gray-700 px-2 py-1 rounded text-xs mr-1">{{ $d->stop_order }}. {{ $d->destination_name }}</span>
                        @endforeach
                    </div>
                </div>
                <form action="{{ route('driver.end-trip', $activeTrip) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">End Trip</button>
                </form>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Trips</h2>
        @forelse($recentTrips as $trip)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $trip->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $trip->booking_reference }} &middot; {{ $trip->trip_date->format('M d, Y') }}</div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold text-emerald-600">GHS {{ number_format($trip->final_amount ?? $trip->estimated_amount, 2) }}</span>
                    <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700 capitalize">{{ str_replace('_', ' ', $trip->status) }}</span>
                    @if($trip->status === 'accepted')
                        <form action="{{ route('driver.start-trip', $trip) }}" method="POST">@csrf @method('PATCH')<button class="text-emerald-600 text-sm hover:text-emerald-800">Start</button></form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">No trips yet.</p>
        @endforelse
    </div>
</div>
@endsection
