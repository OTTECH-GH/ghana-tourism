@extends('layouts.admin')
@section('page-title', 'Reports')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Users by Role</h2>
        <div class="space-y-3">
            @foreach($usersByRole as $u)
                <div class="flex justify-between items-center">
                    <span class="capitalize text-gray-700">{{ str_replace('_', ' ', $u->role) }}</span>
                    <span class="font-bold text-gray-800 bg-gray-100 px-3 py-1 rounded">{{ $u->total }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top Tourism Sites</h2>
        <div class="space-y-3">
            @foreach($topSites as $i => $site)
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">{{ $i + 1 }}. {{ $site->name }}</span>
                    <span class="text-sm text-gray-500">{{ $site->total_reviews }} reviews</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Revenue</h2>
        @if($monthlyRevenue->count() > 0)
            <div class="space-y-2">
                @foreach($monthlyRevenue as $m)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Month {{ $m->month }}</span>
                        <span class="font-bold text-ghana-green">GHS {{ number_format($m->total, 2) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No revenue data yet.</p>
        @endif
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Bookings</h2>
        @if($bookingsByMonth->count() > 0)
            <div class="space-y-2">
                @foreach($bookingsByMonth as $b)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Month {{ $b->month }}</span>
                        <span class="font-bold text-gray-800">{{ $b->total }} bookings</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No booking data yet.</p>
        @endif
    </div>
</div>
@endsection
