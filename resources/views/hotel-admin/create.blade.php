@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Register Your Hotel</h1>
    <form action="{{ route('hotel-admin.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Hotel Name</label><input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Region</label><select name="region_id" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@foreach($regions as $r)<option value="{{ $r->id }}">{{ $r->name }}</option>@endforeach</select></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Address</label><input type="text" name="address" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Phone</label><input type="text" name="phone" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Star Rating</label><select name="star_rating" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@for($i=1;$i<=5;$i++)<option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>@endfor</select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Check-in Time</label><input type="time" name="check_in_time" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label><textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Cancellation Policy</label><textarea name="cancellation_policy" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></textarea></div>
        </div>
        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 font-semibold">Register Hotel</button>
    </form>
</div>
@endsection
