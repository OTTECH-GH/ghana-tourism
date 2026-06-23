@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-green-200 text-sm mb-4">
            <a href="{{ route('hotels.index') }}" class="hover:text-white">Hotels</a>
            <span class="mx-2">/</span>
            <span>{{ $hotel->name }}</span>
        </nav>
        <div class="flex justify-between items-start flex-wrap gap-4">
            <div>
                <h1 class="text-4xl font-bold">{{ $hotel->name }}</h1>
                <p class="text-green-200 mt-2">{{ $hotel->address }}, {{ $hotel->region->name }}</p>
                <div class="text-ghana-gold mt-2">@for($i = 0; $i < $hotel->star_rating; $i++)&#9733;@endfor</div>
            </div>
            @if($hotel->rooms->count() > 0)
                <div class="text-right">
                    <div class="text-3xl font-bold">GHS {{ number_format($hotel->rooms->min('price_per_night'), 2) }}</div>
                    <div class="text-green-200 text-sm">per night from</div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">About</h2>
                <p class="text-gray-600">{{ $hotel->description }}</p>
            </div>

            <!-- Facilities -->
            @if($hotel->facilities)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Facilities</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($hotel->facilities as $facility)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 text-ghana-green mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $facility }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Rooms -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Available Rooms</h2>
                @foreach($hotel->rooms->where('is_active', true) as $room)
                    <div class="border rounded-lg p-4 mb-4 last:mb-0">
                        <div class="flex justify-between items-start flex-wrap gap-4">
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $room->room_type }}</h3>
                                <p class="text-sm text-gray-500 mt-1">Max {{ $room->max_guests }} guests &middot; {{ $room->available_rooms }} available</p>
                                @if($room->breakfast_included)
                                    <span class="text-xs text-ghana-green bg-ghana-green/5 px-2 py-1 rounded mt-2 inline-block">Breakfast Included</span>
                                @endif
                                @if($room->facilities)
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach($room->facilities as $f)
                                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $f }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-ghana-green">GHS {{ number_format($room->price_per_night, 2) }}</div>
                                <div class="text-sm text-gray-500">per night</div>
                                @auth
                                    @if($room->available_rooms > 0)
                                        <a href="{{ route('hotels.book', $room) }}" class="mt-2 inline-block bg-ghana-green text-white px-6 py-2 rounded-lg hover:bg-primary-700 text-sm font-semibold">Book Now</a>
                                    @else
                                        <span class="mt-2 inline-block bg-gray-300 text-gray-600 px-6 py-2 rounded-lg text-sm">Sold Out</span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="mt-2 inline-block bg-ghana-green text-white px-6 py-2 rounded-lg hover:bg-primary-700 text-sm font-semibold">Login to Book</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reviews -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Reviews ({{ $hotel->total_reviews }})</h2>
                @forelse($hotel->reviews as $review)
                    <div class="border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                            <span class="text-ghana-gold text-sm">@for($i = 0; $i < $review->rating; $i++)&#9733;@endfor</span>
                        </div>
                        @if($review->comment)
                            <p class="text-gray-600 mt-1">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No reviews yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Hotel Info</h3>
                <dl class="space-y-3">
                    @if($hotel->check_in_time)
                        <div><dt class="text-sm text-gray-500">Check-in</dt><dd class="font-medium">{{ \Carbon\Carbon::parse($hotel->check_in_time)->format('g:i A') }}</dd></div>
                    @endif
                    @if($hotel->check_out_time)
                        <div><dt class="text-sm text-gray-500">Check-out</dt><dd class="font-medium">{{ \Carbon\Carbon::parse($hotel->check_out_time)->format('g:i A') }}</dd></div>
                    @endif
                    @if($hotel->phone)
                        <div><dt class="text-sm text-gray-500">Phone</dt><dd class="font-medium">{{ $hotel->phone }}</dd></div>
                    @endif
                    @if($hotel->email)
                        <div><dt class="text-sm text-gray-500">Email</dt><dd class="font-medium">{{ $hotel->email }}</dd></div>
                    @endif
                </dl>
            </div>

            @if($hotel->cancellation_policy)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-2">Cancellation Policy</h3>
                    <p class="text-gray-600 text-sm">{{ $hotel->cancellation_policy }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
