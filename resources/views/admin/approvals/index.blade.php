@extends('layouts.admin')
@section('page-title', 'Pending Approvals')

@section('content')
@if($pendingHotels->count() > 0)
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pending Hotels ({{ $pendingHotels->count() }})</h2>
        <div class="space-y-3">
            @foreach($pendingHotels as $hotel)
                <div class="bg-white rounded-xl p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <div class="font-medium text-gray-800">{{ $hotel->name }}</div>
                        <div class="text-sm text-gray-500">By {{ $hotel->user->name }} &middot; {{ $hotel->user->email }}</div>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('admin.approvals.approve-hotel', $hotel) }}" method="POST">@csrf @method('PATCH')<button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700">Approve</button></form>
                        <form action="{{ route('admin.approvals.reject-hotel', $hotel) }}" method="POST">@csrf @method('PATCH')<button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">Reject</button></form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($pendingDrivers->count() > 0)
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pending Drivers ({{ $pendingDrivers->count() }})</h2>
        <div class="space-y-3">
            @foreach($pendingDrivers as $driver)
                <div class="bg-white rounded-xl p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <div class="font-medium text-gray-800">{{ $driver->user->name }}</div>
                        <div class="text-sm text-gray-500">Licence: {{ $driver->licence_number }} &middot; {{ $driver->experience_years }} years exp.</div>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('admin.approvals.approve-driver', $driver) }}" method="POST">@csrf @method('PATCH')<button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700">Approve</button></form>
                        <form action="{{ route('admin.approvals.reject-driver', $driver) }}" method="POST">@csrf @method('PATCH')<button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">Reject</button></form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($pendingGuides->count() > 0)
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pending Tour Guides ({{ $pendingGuides->count() }})</h2>
        <div class="space-y-3">
            @foreach($pendingGuides as $guide)
                <div class="bg-white rounded-xl p-4 shadow-sm flex justify-between items-center">
                    <div>
                        <div class="font-medium text-gray-800">{{ $guide->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $guide->experience_years }} years exp. &middot; GHS {{ number_format($guide->price_per_day, 2) }}/day</div>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('admin.approvals.approve-guide', $guide) }}" method="POST">@csrf @method('PATCH')<button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700">Approve</button></form>
                        <form action="{{ route('admin.approvals.reject-guide', $guide) }}" method="POST">@csrf @method('PATCH')<button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">Reject</button></form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($pendingHotels->count() === 0 && $pendingDrivers->count() === 0 && $pendingGuides->count() === 0 && $pendingCompanies->count() === 0)
    <div class="text-center py-16 bg-white rounded-xl shadow-sm">
        <p class="text-gray-500 text-lg">No pending approvals at this time.</p>
    </div>
@endif
@endsection
