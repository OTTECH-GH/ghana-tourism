@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $hotel->name }}</h1>
            <p class="text-gray-500">Hotel Dashboard &middot; Status: <span class="font-medium {{ $hotel->status === 'approved' ? 'text-emerald-600' : 'text-yellow-600' }}">{{ ucfirst($hotel->status) }}</span></p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('hotel-admin.rooms') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Manage Rooms</a>
            <a href="{{ route('hotel-admin.bookings') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 text-sm">View Bookings</a>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @foreach([
            ['Total Rooms', $stats['total_rooms']],
            ['Available', $stats['available_rooms']],
            ['All Bookings', $stats['total_bookings']],
            ['Pending', $stats['pending_bookings']],
            ['Confirmed', $stats['confirmed_bookings']],
            ['Revenue', 'GHS ' . number_format($stats['revenue'], 2)],
        ] as [$label, $value])
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <div class="text-xs text-gray-500">{{ $label }}</div>
                <div class="text-xl font-bold text-gray-800 mt-1">{{ $value }}</div>
            </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Bookings</h2>
        @forelse($recentBookings as $b)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $b->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $b->room->room_type }} &middot; {{ $b->check_in_date->format('M d') }} - {{ $b->check_out_date->format('M d') }}</div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold text-emerald-600">GHS {{ number_format($b->total_amount, 2) }}</span>
                    @if($b->status === 'pending')
                        <form action="{{ route('hotel-admin.bookings.confirm', $b) }}" method="POST" class="inline">@csrf @method('PATCH')<button class="text-emerald-600 text-sm hover:text-emerald-800">Confirm</button></form>
                    @endif
                    <span class="px-2 py-1 rounded text-xs {{ $b->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($b->status) }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No bookings yet.</p>
        @endforelse
    </div>
</div>
@endsection
