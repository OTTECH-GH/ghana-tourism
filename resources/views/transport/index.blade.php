@extends('layouts.app')

@section('content')
<div class="bg-emerald-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Transport Services</h1>
        <p class="text-emerald-100 mt-2">Book reliable transport for your tourism trips across Ghana.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl p-8 shadow-sm text-center">
            <svg class="w-16 h-16 mx-auto text-emerald-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Single Trip</h2>
            <p class="text-gray-600 mb-6">Book transport to one or more tourism sites with a professional driver.</p>
            <a href="{{ route('transport.book') }}" class="bg-emerald-600 text-white px-8 py-3 rounded-lg hover:bg-emerald-700 inline-block">Book Transport</a>
        </div>
        <div class="bg-white rounded-xl p-8 shadow-sm text-center">
            <svg class="w-16 h-16 mx-auto text-emerald-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Trip Planner</h2>
            <p class="text-gray-600 mb-6">Plan a multi-destination trip and get instant cost estimates.</p>
            <a href="{{ route('transport.planner') }}" class="bg-emerald-600 text-white px-8 py-3 rounded-lg hover:bg-emerald-700 inline-block">Plan Trip</a>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Available Vehicles</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($vehicles as $vehicle)
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $vehicle->make }} {{ $vehicle->model }}</h3>
                        <span class="text-xs bg-emerald-50 text-emerald-600 px-2 py-1 rounded capitalize">{{ str_replace('_', ' ', $vehicle->vehicle_type) }}</span>
                    </div>
                    @if($vehicle->air_conditioned)
                        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">AC</span>
                    @endif
                </div>
                <dl class="space-y-1 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Capacity</dt><dd>{{ $vehicle->capacity }} passengers</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Base Price</dt><dd class="font-bold text-emerald-600">GHS {{ number_format($vehicle->base_price, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Per KM</dt><dd>GHS {{ number_format($vehicle->price_per_km, 2) }}</dd></div>
                </dl>
            </div>
        @endforeach
    </div>
</div>
@endsection
