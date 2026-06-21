@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-emerald-700 to-teal-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-emerald-200 text-sm mb-4">
            <a href="{{ route('tourism.index') }}" class="hover:text-white">Tourism Sites</a>
            <span class="mx-2">/</span>
            <a href="{{ route('tourism.region', $tourismSite->region) }}" class="hover:text-white">{{ $tourismSite->region->name }}</a>
            <span class="mx-2">/</span>
            <span>{{ $tourismSite->name }}</span>
        </nav>
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ $tourismSite->category->name }}</span>
                <h1 class="text-4xl font-bold mt-3">{{ $tourismSite->name }}</h1>
                <p class="text-emerald-100 mt-2">{{ $tourismSite->region->name }}{{ $tourismSite->district ? ', ' . $tourismSite->district->name : '' }}</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">GHS {{ number_format($tourismSite->entry_fee, 2) }}</div>
                <div class="text-emerald-200 text-sm">Entry Fee</div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Description -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">About This Site</h2>
                <p class="text-gray-600 leading-relaxed">{{ $tourismSite->description }}</p>
                @if($tourismSite->history)
                    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">History</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $tourismSite->history }}</p>
                @endif
            </div>

            <!-- Details -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    @if($tourismSite->opening_time)
                        <div>
                            <span class="text-gray-500 text-sm">Opening Hours</span>
                            <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($tourismSite->opening_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($tourismSite->closing_time)->format('g:i A') }}</p>
                        </div>
                    @endif
                    @if($tourismSite->opening_days)
                        <div>
                            <span class="text-gray-500 text-sm">Open Days</span>
                            <p class="font-medium text-gray-800">{{ implode(', ', array_slice($tourismSite->opening_days, 0, 3)) }}{{ count($tourismSite->opening_days) > 3 ? '...' : '' }}</p>
                        </div>
                    @endif
                    @if($tourismSite->contact_phone)
                        <div>
                            <span class="text-gray-500 text-sm">Phone</span>
                            <p class="font-medium text-gray-800">{{ $tourismSite->contact_phone }}</p>
                        </div>
                    @endif
                    @if($tourismSite->contact_email)
                        <div>
                            <span class="text-gray-500 text-sm">Email</span>
                            <p class="font-medium text-gray-800">{{ $tourismSite->contact_email }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($tourismSite->rules || $tourismSite->safety_info)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    @if($tourismSite->rules)
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Rules</h2>
                        <p class="text-gray-600 mb-4">{{ $tourismSite->rules }}</p>
                    @endif
                    @if($tourismSite->safety_info)
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Safety Information</h2>
                        <p class="text-gray-600">{{ $tourismSite->safety_info }}</p>
                    @endif
                </div>
            @endif

            <!-- Reviews -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Reviews ({{ $tourismSite->total_reviews }})</h2>
                @forelse($tourismSite->reviews as $review)
                    <div class="border-b pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                                <div class="text-yellow-500 text-sm">@for($i = 0; $i < $review->rating; $i++)&#9733;@endfor</div>
                            </div>
                            <span class="text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @if($review->comment)
                            <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No reviews yet.</p>
                @endforelse

                @auth
                    <div class="mt-6 border-t pt-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Write a Review</h3>
                        <form action="{{ route('tourist.store-review') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reviewable_type" value="tourism_site">
                            <input type="hidden" name="reviewable_id" value="{{ $tourismSite->id }}">
                            <div class="mb-3">
                                <select name="rating" class="rounded-lg border-gray-300 focus:ring-emerald-500" required>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                            <textarea name="comment" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500" placeholder="Share your experience..."></textarea>
                            <button type="submit" class="mt-2 bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700">Submit Review</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Plan Your Visit</h3>
                <div class="space-y-3">
                    <a href="{{ route('hotels.index', ['region' => $tourismSite->region_id]) }}" class="block w-full bg-emerald-600 text-white text-center py-3 rounded-lg hover:bg-emerald-700 transition">Find Hotels Nearby</a>
                    <a href="{{ route('transport.book') }}" class="block w-full border-2 border-emerald-600 text-emerald-600 text-center py-3 rounded-lg hover:bg-emerald-50 transition">Book Transport</a>
                </div>
            </div>

            <!-- Nearby Hotels -->
            @if($nearbyHotels->count() > 0)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4">Hotels in {{ $tourismSite->region->name }}</h3>
                    @foreach($nearbyHotels as $hotel)
                        <a href="{{ route('hotels.show', $hotel) }}" class="block mb-3 last:mb-0 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="font-medium text-gray-800">{{ $hotel->name }}</div>
                            <div class="text-sm text-gray-500">{{ $hotel->star_rating }} Stars</div>
                            @if($hotel->rooms->count() > 0)
                                <div class="text-emerald-600 font-bold text-sm mt-1">From GHS {{ number_format($hotel->rooms->min('price_per_night'), 2) }}/night</div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Related Sites -->
            @if($relatedSites->count() > 0)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4">Related Sites</h3>
                    @foreach($relatedSites as $related)
                        <a href="{{ route('tourism.show', $related) }}" class="block mb-3 last:mb-0 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="font-medium text-gray-800">{{ $related->name }}</div>
                            <div class="text-sm text-gray-500">{{ $related->region->name }}</div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
