@extends('layouts.admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-ghana-green to-primary-700 text-white rounded-xl p-6 mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-bold">Akwaaba, {{ Auth::user()->name }}!</h2>
        <p class="text-green-200 text-sm mt-1">Here's your platform overview for {{ now()->format('F d, Y') }}</p>
    </div>
    <div class="hidden md:flex items-center space-x-2">
        <div class="h-1 w-8 bg-ghana-red rounded"></div>
        <div class="h-1 w-8 bg-ghana-gold rounded"></div>
        <div class="h-1 w-8 bg-ghana-green rounded"></div>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-ghana-green">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Total Revenue</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">GHS {{ number_format($stats['total_revenue'], 2) }}</p>
            </div>
            <div class="w-10 h-10 bg-ghana-green/10 rounded-lg flex items-center justify-center">
                <span class="text-ghana-green font-bold">₵</span>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-ghana-gold">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Hotel Bookings</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['hotel_bookings'] }}</p>
            </div>
            <div class="w-10 h-10 bg-ghana-gold/10 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-ghana-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Transport Bookings</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['transport_bookings'] }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-ghana-red">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Pending Approvals</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pending_approvals'] }}</p>
            </div>
            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-ghana-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-2 md:grid-cols-6 gap-3 mb-6">
    @foreach([
        ['label' => 'Tourists', 'value' => $stats['total_tourists'], 'icon' => '👤'],
        ['label' => 'Tourism Sites', 'value' => $stats['total_sites'], 'icon' => '🏛️'],
        ['label' => 'Hotels', 'value' => $stats['total_hotels'], 'icon' => '🏨'],
        ['label' => 'Drivers', 'value' => $stats['total_drivers'], 'icon' => '🚗'],
        ['label' => 'Tour Guides', 'value' => $stats['total_guides'], 'icon' => '🗺️'],
        ['label' => 'Complaints', 'value' => $stats['total_complaints'], 'icon' => '⚠️'],
    ] as $stat)
        <div class="bg-white rounded-lg p-3 shadow-sm text-center">
            <span class="text-xl">{{ $stat['icon'] }}</span>
            <p class="text-lg font-bold text-gray-800 mt-1">{{ $stat['value'] }}</p>
            <p class="text-xs text-gray-500">{{ $stat['label'] }}</p>
        </div>
    @endforeach
</div>

<!-- Booking Charts Placeholder + Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Booking Overview</h2>
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-green-50 rounded-lg p-4 text-center">
                <p class="text-2xl font-bold text-ghana-green">{{ $stats['completed_trips'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Completed Trips</p>
            </div>
            <div class="bg-yellow-50 rounded-lg p-4 text-center">
                <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_approvals'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Pending</p>
            </div>
            <div class="bg-red-50 rounded-lg p-4 text-center">
                <p class="text-2xl font-bold text-ghana-red">{{ $stats['cancelled_trips'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Cancelled</p>
            </div>
        </div>
        <!-- Visual bar chart representation -->
        <div class="space-y-3">
            @php
                $total = max($stats['completed_trips'] + $stats['cancelled_trips'] + $stats['pending_approvals'], 1);
            @endphp
            <div>
                <div class="flex justify-between text-sm mb-1"><span class="text-gray-600">Completed</span><span class="font-medium">{{ round($stats['completed_trips'] / $total * 100) }}%</span></div>
                <div class="h-3 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-ghana-green rounded-full" style="width: {{ $stats['completed_trips'] / $total * 100 }}%"></div></div>
            </div>
            <div>
                <div class="flex justify-between text-sm mb-1"><span class="text-gray-600">Pending</span><span class="font-medium">{{ round($stats['pending_approvals'] / $total * 100) }}%</span></div>
                <div class="h-3 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-ghana-gold rounded-full" style="width: {{ $stats['pending_approvals'] / $total * 100 }}%"></div></div>
            </div>
            <div>
                <div class="flex justify-between text-sm mb-1"><span class="text-gray-600">Cancelled</span><span class="font-medium">{{ round($stats['cancelled_trips'] / $total * 100) }}%</span></div>
                <div class="h-3 bg-gray-100 rounded-full overflow-hidden"><div class="h-full bg-ghana-red rounded-full" style="width: {{ $stats['cancelled_trips'] / $total * 100 }}%"></div></div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="space-y-2">
            <a href="{{ route('admin.tourism-sites.create') }}" class="flex items-center p-3 rounded-lg hover:bg-ghana-green/5 transition group">
                <div class="w-8 h-8 bg-ghana-green/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-ghana-green group-hover:text-white transition">
                    <svg class="w-4 h-4 text-ghana-green group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Add Tourism Site</span>
            </a>
            <a href="{{ route('admin.approvals.index') }}" class="flex items-center p-3 rounded-lg hover:bg-ghana-gold/5 transition group">
                <div class="w-8 h-8 bg-ghana-gold/10 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-ghana-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Review Approvals</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition group">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Manage Users</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition group">
                <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-700">View Reports</span>
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Hotel Bookings -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Hotel Bookings</h2>
            <a href="{{ route('admin.bookings.hotel') }}" class="text-ghana-green text-sm font-medium hover:text-primary-700">View All &rarr;</a>
        </div>
        @forelse($recentBookings as $booking)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $booking->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $booking->hotel->name }} &middot; {{ $booking->booking_reference }}</div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-ghana-green">GHS {{ number_format($booking->total_amount, 2) }}</div>
                    <span class="text-xs px-2 py-1 rounded {{ $booking->status === 'confirmed' ? 'bg-green-50 text-ghana-green' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($booking->status) }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm py-4 text-center">No bookings yet</p>
        @endforelse
    </div>

    <!-- Recent Transport Bookings -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Transport Bookings</h2>
            <a href="{{ route('admin.bookings.transport') }}" class="text-ghana-green text-sm font-medium hover:text-primary-700">View All &rarr;</a>
        </div>
        @forelse($recentTrips as $trip)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <div class="font-medium text-gray-800">{{ $trip->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $trip->booking_reference }} &middot; {{ ucfirst(str_replace('_', ' ', $trip->vehicle_type)) }}</div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-ghana-green">GHS {{ number_format($trip->estimated_amount, 2) }}</div>
                    <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-700">{{ ucfirst(str_replace('_', ' ', $trip->status)) }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm py-4 text-center">No transport bookings yet</p>
        @endforelse
    </div>
</div>
@endsection
