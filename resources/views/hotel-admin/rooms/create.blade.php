@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Add Room - {{ $hotel->name }}</h1>
    <form action="{{ route('hotel-admin.rooms.store') }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Room Type</label><input type="text" name="room_type" required placeholder="e.g., Standard, Deluxe, Suite" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@error('room_type')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Price Per Night (GHS)</label><input type="number" name="price_per_night" step="0.01" min="0" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Max Guests</label><input type="number" name="max_guests" min="1" value="2" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Total Rooms</label><input type="number" name="total_rooms" min="1" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label><textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></textarea></div>
        <label class="flex items-center"><input type="checkbox" name="breakfast_included" value="1" class="rounded text-emerald-600 mr-2"> Breakfast Included</label>
        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 font-semibold">Add Room</button>
    </form>
</div>
@endsection
