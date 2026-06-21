@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manage Rooms - {{ $hotel->name }}</h1>
        <a href="{{ route('hotel-admin.rooms.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Add Room</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 text-lg">{{ $room->room_type }}</h3>
                <div class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Price/Night</span><span class="font-bold text-emerald-600">GHS {{ number_format($room->price_per_night, 2) }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Max Guests</span><span>{{ $room->max_guests }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Total Rooms</span><span>{{ $room->total_rooms }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Available</span><span class="font-medium {{ $room->available_rooms > 0 ? 'text-emerald-600' : 'text-red-600' }}">{{ $room->available_rooms }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Breakfast</span><span>{{ $room->breakfast_included ? 'Included' : 'Not included' }}</span></div>
                </div>
                @if($room->facilities)
                    <div class="mt-3 flex flex-wrap gap-1">
                        @foreach($room->facilities as $f)
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $f }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
