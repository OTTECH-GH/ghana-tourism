@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Register as Driver</h1>
    <form action="{{ route('driver.store-registration') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Driver Info</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Licence Number</label><input type="text" name="licence_number" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@error('licence_number')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label><input type="number" name="experience_years" min="0" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Vehicle Info</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Make</label><input type="text" name="vehicle_make" required placeholder="e.g., Toyota" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Model</label><input type="text" name="vehicle_model" required placeholder="e.g., Hiace" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label><select name="vehicle_type" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"><option value="small_car">Small Car</option><option value="suv">SUV</option><option value="van">Van</option><option value="mini_bus">Mini Bus</option><option value="tour_bus">Tour Bus</option><option value="executive_bus">Executive Bus</option></select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Plate Number</label><input type="text" name="plate_number" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">@error('plate_number')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror</div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Capacity (passengers)</label><input type="number" name="capacity" min="1" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Base Price (GHS)</label><input type="number" name="base_price" step="0.01" min="0" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Price/KM (GHS)</label><input type="number" name="price_per_km" step="0.01" min="0" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            </div>
            <label class="flex items-center"><input type="checkbox" name="air_conditioned" value="1" class="rounded text-emerald-600 mr-2"> Air Conditioned</label>
        </div>
        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 font-semibold">Submit Registration</button>
    </form>
</div>
@endsection
