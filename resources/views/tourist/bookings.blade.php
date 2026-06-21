@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Hotel Bookings</h1>
        <div class="flex gap-3">
            <a href="{{ route('tourist.trips') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">My Trips</a>
            <a href="{{ route('tourist.reviews') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">My Reviews</a>
        </div>
    </div>

    @if($hotelBookings->count() > 0)
        <div class="space-y-4">
            @foreach($hotelBookings as $booking)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $booking->hotel->name }}</h3>
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                ">{{ ucfirst($booking->status) }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-1">Ref: {{ $booking->booking_reference }}</p>
                            <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-600">
                                <span>Room: {{ $booking->room->room_type }}</span>
                                <span>Check-in: {{ $booking->check_in_date->format('M d, Y') }}</span>
                                <span>Check-out: {{ $booking->check_out_date->format('M d, Y') }}</span>
                                <span>{{ $booking->guests }} guests</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-emerald-600">GHS {{ number_format($booking->total_amount, 2) }}</div>
                            @if($booking->status === 'pending')
                                <form action="{{ route('tourist.cancel-booking', $booking) }}" method="POST" class="mt-2">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('Cancel this booking?')" class="text-red-500 hover:text-red-700 text-sm">Cancel Booking</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $hotelBookings->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-xl shadow-sm">
            <p class="text-gray-500 text-lg mb-4">You haven't made any hotel bookings yet.</p>
            <a href="{{ route('hotels.index') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">Browse Hotels</a>
        </div>
    @endif
</div>
@endsection
