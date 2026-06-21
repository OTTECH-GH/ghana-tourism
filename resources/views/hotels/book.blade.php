@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Book Room</h1>
    <p class="text-gray-500 mb-8">{{ $room->room_type }} at {{ $room->hotel->name }}</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <form action="{{ route('hotels.store-booking', $room) }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                        <input type="date" name="check_in_date" required min="{{ date('Y-m-d') }}" value="{{ old('check_in_date') }}" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                        @error('check_in_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                        <input type="date" name="check_out_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out_date') }}" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                        @error('check_out_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                        <input type="number" name="guests" min="1" max="{{ $room->max_guests }}" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rooms</label>
                        <input type="number" name="rooms_booked" min="1" max="{{ $room->available_rooms }}" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                    <textarea name="special_requests" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500" placeholder="Any special requests...">{{ old('special_requests') }}</textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 font-semibold text-lg">Confirm Booking</button>
            </form>
        </div>
        <div>
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-3">Booking Summary</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Hotel</dt><dd class="font-medium">{{ $room->hotel->name }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Room Type</dt><dd class="font-medium">{{ $room->room_type }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Price/Night</dt><dd class="font-bold text-emerald-600">GHS {{ number_format($room->price_per_night, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Max Guests</dt><dd>{{ $room->max_guests }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Available</dt><dd>{{ $room->available_rooms }} rooms</dd></div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
