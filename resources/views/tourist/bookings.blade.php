@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-display font-bold">My Hotel Bookings</h1>
        <p class="text-green-200 mt-1">View and manage your accommodation reservations.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-end gap-3 mb-6">
        <a href="{{ route('tourist.trips') }}" class="text-ghana-green hover:text-primary-700 font-medium text-sm">My Trips</a>
        <a href="{{ route('tourist.reviews') }}" class="text-ghana-green hover:text-primary-700 font-medium text-sm">My Reviews</a>
    </div>

    @if($hotelBookings->count() > 0)
        <div class="space-y-4">
            @foreach($hotelBookings as $booking)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $booking->hotel->name }}</h3>
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $booking->status === 'confirmed' ? 'bg-green-50 text-ghana-green' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $booking->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                ">{{ ucfirst($booking->status) }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-1">Ref: <span class="font-mono font-medium text-gray-700">{{ $booking->booking_reference }}</span></p>
                            <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-600">
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> {{ $booking->room->room_type }}</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> {{ $booking->check_in_date->format('M d') }} - {{ $booking->check_out_date->format('M d, Y') }}</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> {{ $booking->guests }} guests</span>
                            </div>
                        </div>
                        <div class="text-right space-y-2">
                            <div class="text-2xl font-bold text-ghana-green">GHS {{ number_format($booking->total_amount, 2) }}</div>
                            <div class="flex gap-2 justify-end">
                                <button onclick="window.print()" class="text-gray-500 hover:text-ghana-green text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    Print
                                </button>
                                @if($booking->status === 'pending')
                                    <form action="{{ route('tourist.cancel-booking', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" onclick="return confirm('Cancel this booking?')" class="text-ghana-red hover:text-red-700 text-sm">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $hotelBookings->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <p class="text-gray-500 text-lg mb-4">You haven't made any hotel bookings yet.</p>
            <a href="{{ route('hotels.index') }}" class="bg-ghana-green text-white px-6 py-3 rounded-lg hover:bg-primary-700 font-semibold">Browse Hotels</a>
        </div>
    @endif
</div>
@endsection
