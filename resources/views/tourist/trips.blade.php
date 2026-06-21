@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Trips</h1>
        <div class="flex gap-3">
            <a href="{{ route('tourist.bookings') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">My Bookings</a>
            <a href="{{ route('transport.book') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 text-sm">Book New Trip</a>
        </div>
    </div>

    @if($transportBookings->count() > 0)
        <div class="space-y-4">
            @foreach($transportBookings as $booking)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="font-bold text-gray-800 text-lg">Trip {{ $booking->booking_reference }}</h3>
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $booking->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking->status === 'accepted' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $booking->status === 'in_progress' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                ">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-1">From: {{ $booking->pickup_location }}</p>
                            <div class="mt-2">
                                @foreach($booking->destinations as $dest)
                                    <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs mr-1 mb-1">{{ $dest->stop_order }}. {{ $dest->destination_name }}</span>
                                @endforeach
                            </div>
                            <div class="mt-2 text-sm text-gray-600">
                                <span>{{ $booking->trip_date->format('M d, Y') }} at {{ $booking->trip_time }}</span>
                                <span class="mx-2">&middot;</span>
                                <span class="capitalize">{{ str_replace('_', ' ', $booking->vehicle_type) }}</span>
                                @if($booking->driver)
                                    <span class="mx-2">&middot;</span>
                                    <span>Driver: {{ $booking->driver->user->name }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-emerald-600">GHS {{ number_format($booking->final_amount ?? $booking->estimated_amount, 2) }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->final_amount ? 'Final' : 'Estimated' }}</div>
                            @if($booking->status === 'pending')
                                <form action="{{ route('tourist.cancel-trip', $booking) }}" method="POST" class="mt-2">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('Cancel this trip?')" class="text-red-500 hover:text-red-700 text-sm">Cancel Trip</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $transportBookings->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-xl shadow-sm">
            <p class="text-gray-500 text-lg mb-4">You haven't booked any trips yet.</p>
            <a href="{{ route('transport.book') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">Book a Trip</a>
        </div>
    @endif
</div>
@endsection
