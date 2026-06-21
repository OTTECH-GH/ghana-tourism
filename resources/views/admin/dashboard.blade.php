@extends('layouts.admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Tourists', 'value' => $stats['total_tourists'], 'color' => 'emerald'],
        ['label' => 'Tourism Sites', 'value' => $stats['total_sites'], 'color' => 'blue'],
        ['label' => 'Hotels', 'value' => $stats['total_hotels'], 'color' => 'purple'],
        ['label' => 'Drivers', 'value' => $stats['total_drivers'], 'color' => 'orange'],
        ['label' => 'Tour Guides', 'value' => $stats['total_guides'], 'color' => 'teal'],
        ['label' => 'Hotel Bookings', 'value' => $stats['hotel_bookings'], 'color' => 'indigo'],
        ['label' => 'Transport Bookings', 'value' => $stats['transport_bookings'], 'color' => 'pink'],
        ['label' => 'Pending Approvals', 'value' => $stats['pending_approvals'], 'color' => 'yellow'],
        ['label' => 'Completed Trips', 'value' => $stats['completed_trips'], 'color' => 'green'],
        ['label' => 'Cancelled Trips', 'value' => $stats['cancelled_trips'], 'color' => 'red'],
        ['label' => 'Total Revenue', 'value' => 'GHS ' . number_format($stats['total_revenue'], 2), 'color' => 'emerald'],
        ['label' => 'Open Complaints', 'value' => $stats['total_complaints'], 'color' => 'red'],
    ] as $stat)
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="text-sm text-gray-500">{{ $stat['label'] }}</div>
            <div class="text-2xl font-bold text-gray-800 mt-1">{{ $stat['value'] }}</div>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Hotel Bookings -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Hotel Bookings</h2>
            <a href="{{ route('admin.bookings.hotel') }}" class="text-emerald-600 text-sm">View All</a>
        </div>
        @foreach($recentBookings as $booking)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $booking->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $booking->hotel->name }} &middot; {{ $booking->booking_reference }}</div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-emerald-600">GHS {{ number_format($booking->total_amount, 2) }}</div>
                    <span class="text-xs px-2 py-1 rounded {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($booking->status) }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Transport Bookings -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Transport Bookings</h2>
            <a href="{{ route('admin.bookings.transport') }}" class="text-emerald-600 text-sm">View All</a>
        </div>
        @foreach($recentTrips as $trip)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $trip->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $trip->booking_reference }} &middot; {{ ucfirst(str_replace('_', ' ', $trip->vehicle_type)) }}</div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-emerald-600">GHS {{ number_format($trip->estimated_amount, 2) }}</div>
                    <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-700">{{ ucfirst(str_replace('_', ' ', $trip->status)) }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
