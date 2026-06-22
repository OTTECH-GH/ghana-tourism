@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-ghana-gold font-medium text-sm tracking-wide uppercase mb-2">Transport</p>
        <h1 class="text-3xl font-display font-bold">Book Your Ride</h1>
        <p class="text-green-200 mt-1">Comfortable transport to tourism sites across Ghana.</p>
    </div>
</div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <form action="{{ route('transport.store-booking') }}" method="POST" class="space-y-6" x-data="{ destinations: [{ name: '', tourism_site_id: '', wait_minutes: 60 }] }">
        @csrf
        <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Trip Details</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pick-up Location</label>
                <input type="text" name="pickup_location" required placeholder="e.g., Kotoka International Airport, Accra" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trip Date</label>
                    <input type="date" name="trip_date" required min="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trip Time</label>
                    <input type="time" name="trip_time" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passengers</label>
                    <input type="number" name="passengers" min="1" max="50" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label>
                    <select name="vehicle_type" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">
                        <option value="small_car">Small Car</option>
                        <option value="suv">SUV</option>
                        <option value="van">Van</option>
                        <option value="mini_bus">Mini Bus</option>
                        <option value="tour_bus">Tour Bus</option>
                        <option value="executive_bus">Executive Bus</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-6">
                <label class="flex items-center"><input type="checkbox" name="return_trip" value="1" class="rounded text-ghana-green mr-2">Return Trip</label>
                <label class="flex items-center"><input type="checkbox" name="full_day" value="1" class="rounded text-ghana-green mr-2">Full Day Booking</label>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Destinations</h2>
                <button type="button" @click="destinations.push({ name: '', tourism_site_id: '', wait_minutes: 60 })" class="text-ghana-green hover:text-ghana-green text-sm font-medium">+ Add Destination</button>
            </div>
            <template x-for="(dest, index) in destinations" :key="index">
                <div class="border rounded-lg p-4">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-gray-500" x-text="'Stop ' + (index + 1)"></span>
                        <button type="button" x-show="destinations.length > 1" @click="destinations.splice(index, 1)" class="text-red-500 text-sm">Remove</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-600 mb-1">Destination / Tourism Site</label>
                            <select :name="'destinations[' + index + '][tourism_site_id]'" x-model="dest.tourism_site_id" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green text-sm" @change="if(dest.tourism_site_id) { dest.name = $event.target.options[$event.target.selectedIndex].text; }">
                                <option value="">Select a tourism site or type below</option>
                                @foreach($tourismSites as $site)
                                    <option value="{{ $site->id }}">{{ $site->name }} ({{ $site->region->name }})</option>
                                @endforeach
                            </select>
                            <input type="text" :name="'destinations[' + index + '][name]'" x-model="dest.name" required placeholder="Or type destination name" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green mt-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Wait Time (mins)</label>
                            <input type="number" :name="'destinations[' + index + '][wait_minutes]'" x-model="dest.wait_minutes" min="0" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green text-sm">
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <button type="submit" class="w-full bg-ghana-green text-white py-3 rounded-lg hover:bg-primary-700 font-semibold text-lg">Submit Booking Request</button>
    </form>
</div>
@endsection
