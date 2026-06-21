@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Available Trips</h1>
        <a href="{{ route('driver.dashboard') }}" class="text-emerald-600 hover:text-emerald-700">Back to Dashboard</a>
    </div>

    @forelse($trips as $trip)
        <div class="bg-white rounded-xl p-6 shadow-sm mb-4">
            <div class="flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-gray-800">{{ $trip->booking_reference }}</h3>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs capitalize">{{ str_replace('_', ' ', $trip->vehicle_type) }}</span>
                    </div>
                    <p class="text-gray-600 mt-1">From: {{ $trip->pickup_location }}</p>
                    <div class="mt-2">
                        @foreach($trip->destinations as $d)
                            <span class="bg-emerald-50 text-emerald-700 px-2 py-1 rounded text-xs mr-1">{{ $d->destination_name }}</span>
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-500 mt-2">{{ $trip->trip_date->format('M d, Y') }} at {{ $trip->trip_time }} &middot; {{ $trip->passengers }} passengers</p>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-emerald-600">GHS {{ number_format($trip->estimated_amount, 2) }}</div>
                    <form action="{{ route('driver.accept-trip', $trip) }}" method="POST" class="mt-2">
                        @csrf @method('PATCH')
                        <button class="bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700">Accept Trip</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 bg-white rounded-xl shadow-sm">
            <p class="text-gray-500">No available trips at this time.</p>
        </div>
    @endforelse
    <div class="mt-4">{{ $trips->links() }}</div>
</div>
@endsection
