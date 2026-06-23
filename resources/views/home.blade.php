@extends('layouts.app')

@section('content')
<!-- Hero Section with Ghana Cultural Theme -->
<section class="relative bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-ghana-gold/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-ghana-red/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 md:py-36">
        <div class="text-center">
            <p class="text-ghana-gold font-medium text-lg mb-3 tracking-wide">AKWAABA — WELCOME TO GHANA</p>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-display font-bold mb-6 leading-tight">Discover the<br><span class="text-ghana-gold">Gateway to Africa</span></h1>
            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-3xl mx-auto">Experience rich culture, breathtaking landscapes, historic castles, vibrant festivals, and the warmest hospitality on earth.</p>
            <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto mb-8">
                <div class="flex bg-white rounded-xl overflow-hidden shadow-2xl">
                    <input type="text" name="q" placeholder="Search tourism sites, hotels, regions..." class="flex-1 px-6 py-4 text-gray-700 focus:outline-none text-lg border-0">
                    <button type="submit" class="bg-ghana-green px-8 py-4 text-white font-semibold hover:bg-primary-700 transition">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Search
                    </button>
                </div>
            </form>
            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-300">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-ghana-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    <span>{{ $categories->sum('tourism_sites_count') }} Tourism Sites</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-ghana-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>{{ $featuredHotels->count() > 0 ? \App\Models\Hotel::where('status','approved')->count() : 5 }} Hotels</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-ghana-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>16 Regions</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cultural Highlights - Adinkra-Inspired -->
<section class="bg-white py-16 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="w-16 h-16 mx-auto mb-3 bg-ghana-gold/10 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">🏰</span>
                </div>
                <h3 class="font-bold text-gray-800">Historic Castles</h3>
                <p class="text-sm text-gray-500 mt-1">UNESCO World Heritage forts & castles</p>
            </div>
            <div>
                <div class="w-16 h-16 mx-auto mb-3 bg-ghana-green/10 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">🌿</span>
                </div>
                <h3 class="font-bold text-gray-800">National Parks</h3>
                <p class="text-sm text-gray-500 mt-1">Rainforests, savannahs & wildlife</p>
            </div>
            <div>
                <div class="w-16 h-16 mx-auto mb-3 bg-ghana-red/10 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">🥁</span>
                </div>
                <h3 class="font-bold text-gray-800">Vibrant Culture</h3>
                <p class="text-sm text-gray-500 mt-1">Festivals, music, dance & kente</p>
            </div>
            <div>
                <div class="w-16 h-16 mx-auto mb-3 bg-blue-50 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">🏖️</span>
                </div>
                <h3 class="font-bold text-gray-800">Beautiful Beaches</h3>
                <p class="text-sm text-gray-500 mt-1">Pristine coastlines along the Gulf</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Categories</p>
        <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">Explore by Category</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('tourism.category', $category) }}" class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition group border border-gray-100 hover:border-ghana-gold/30">
                <div class="w-12 h-12 mx-auto mb-3 bg-ghana-green/10 rounded-full flex items-center justify-center group-hover:bg-ghana-gold/20 transition">
                    <svg class="w-6 h-6 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-700 group-hover:text-ghana-green transition">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $category->tourism_sites_count }} sites</p>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured Tourism Sites -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Top Destinations</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">Featured Tourism Sites</h2>
            </div>
            <a href="{{ route('tourism.index') }}" class="text-ghana-green hover:text-primary-700 font-medium hidden md:block">View All &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredSites as $site)
                <a href="{{ route('tourism.show', $site) }}" class="bg-gray-50 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition group border border-gray-100">
                    <div class="h-48 bg-gradient-to-br from-ghana-green to-primary-700 flex items-center justify-center relative">
                        @if($site->featured_image)
                            <img src="{{ Storage::url($site->featured_image) }}" alt="{{ $site->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="bg-ghana-gold text-ghana-black text-xs font-bold px-2 py-1 rounded">{{ $site->category->name }}</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 group-hover:text-ghana-green transition">{{ $site->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $site->region->name }}
                        </p>
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-ghana-green font-bold">GHS {{ number_format($site->entry_fee, 2) }}</span>
                            @if($site->avg_rating > 0)
                                <span class="text-ghana-gold text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    {{ number_format($site->avg_rating, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('tourism.index') }}" class="text-ghana-green font-medium">View All Sites &rarr;</a>
        </div>
    </div>
</section>

<!-- Regions -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Regions</p>
        <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">Explore All 16 Regions</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($regions->take(8) as $region)
            <a href="{{ route('tourism.region', $region) }}" class="relative bg-gradient-to-br from-ghana-green to-primary-800 rounded-xl p-6 text-white hover:from-primary-700 hover:to-primary-900 transition shadow-md group overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-ghana-gold/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-ghana-gold/20 transition"></div>
                <h3 class="font-bold text-lg relative">{{ $region->name }}</h3>
                <p class="text-green-200 text-sm mt-1 relative">{{ $region->capital }}</p>
                <span class="text-ghana-gold text-sm mt-2 inline-block relative font-medium">{{ $region->tourism_sites_count }} sites &rarr;</span>
            </a>
        @endforeach
    </div>
</section>

<!-- How It Works -->
<section class="bg-gradient-to-b from-gray-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Simple Process</p>
            <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-800">How It Works</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['step' => '1', 'title' => 'Discover', 'desc' => 'Browse tourism sites across all 16 regions of Ghana', 'color' => 'bg-ghana-green'],
                ['step' => '2', 'title' => 'Book', 'desc' => 'Book hotels and transport near your chosen destinations', 'color' => 'bg-ghana-gold'],
                ['step' => '3', 'title' => 'Pay', 'desc' => 'Pay securely via Mobile Money (MTN, Vodafone, AirtelTigo)', 'color' => 'bg-ghana-red'],
                ['step' => '4', 'title' => 'Enjoy', 'desc' => 'Experience the warmth and beauty of Ghana — Akwaaba!', 'color' => 'bg-ghana-black'],
            ] as $item)
                <div class="text-center group">
                    <div class="w-16 h-16 mx-auto {{ $item['color'] }} text-white rounded-2xl flex items-center justify-center text-2xl font-bold mb-4 shadow-lg group-hover:scale-110 transition">{{ $item['step'] }}</div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Ghana Cultural Quote -->
<section class="bg-ghana-green text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <blockquote class="text-2xl md:text-3xl font-display italic mb-4">"Sankofa — It is not wrong to go back for that which you have forgotten."</blockquote>
        <p class="text-ghana-gold font-medium">Traditional Akan Proverb</p>
        <p class="text-green-200 text-sm mt-2">Ghana's rich heritage invites you to explore the past, embrace the present, and shape the future.</p>
    </div>
</section>

<!-- Quick Tools -->
<section class="bg-white py-16 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Currency Converter -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200" x-data="{ amount: 100, currency: 'USD', rates: { USD: 0.065, EUR: 0.060, GBP: 0.052 } }">
                <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center">
                    <span class="w-8 h-8 bg-ghana-gold/10 rounded-lg flex items-center justify-center mr-2 text-ghana-gold text-sm font-bold">₵</span>
                    Currency Converter
                </h3>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="text-xs text-gray-500 mb-1 block">Ghana Cedis (GHS)</label>
                        <input type="number" x-model="amount" min="0" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green text-lg font-bold">
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 mb-1 block">Convert to</label>
                        <select x-model="currency" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                            <option value="USD">US Dollar (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                            <option value="GBP">British Pound (GBP)</option>
                        </select>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4 border text-center">
                    <p class="text-sm text-gray-500">Estimated Amount</p>
                    <p class="text-2xl font-bold text-ghana-green" x-text="(amount * rates[currency]).toFixed(2) + ' ' + currency"></p>
                    <p class="text-xs text-gray-400 mt-1">Approximate rate. Check current rates before transactions.</p>
                </div>
            </div>

            <!-- Travel Advisory -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center">
                    <span class="w-8 h-8 bg-ghana-green/10 rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-4 h-4 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    Travel Advisory
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3 bg-white rounded-lg p-3 border">
                        <span class="w-2 h-2 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Safety Level: Low Risk</p>
                            <p class="text-xs text-gray-500">Ghana is one of the safest countries in West Africa</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 bg-white rounded-lg p-3 border">
                        <span class="w-2 h-2 bg-ghana-gold rounded-full mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Weather: Tropical Climate</p>
                            <p class="text-xs text-gray-500">Warm year-round. Dry season: Nov-Mar (best for tourism)</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 bg-white rounded-lg p-3 border">
                        <span class="w-2 h-2 bg-ghana-green rounded-full mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-medium text-gray-800 text-sm">Health: Yellow Fever Vaccination Required</p>
                            <p class="text-xs text-gray-500">Present yellow card on arrival. Malaria prophylaxis recommended.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('emergency') }}" class="text-ghana-green text-sm font-medium mt-3 inline-block hover:text-primary-700">View Emergency Contacts &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="bg-gradient-to-b from-gray-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">What Travelers Say</p>
            <h2 class="text-3xl font-display font-bold text-gray-800">Loved by Tourists Worldwide</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Sarah Johnson', 'from' => 'United States', 'text' => 'Cape Coast Castle was an incredibly moving experience. The platform made booking hotels nearby so easy. Ghana is a must-visit destination!', 'rating' => 5],
                ['name' => 'Kwame Asante', 'from' => 'United Kingdom', 'text' => 'Coming back to Ghana was emotional. This platform helped me plan my entire trip — from Kakum National Park to the Ashanti Kingdom. Brilliant service!', 'rating' => 5],
                ['name' => 'Marie Dupont', 'from' => 'France', 'text' => 'The Jollof Rice alone was worth the trip! But seriously, Mole National Park was breathtaking. The transport booking made getting there stress-free.', 'rating' => 4],
            ] as $testimonial)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="text-ghana-gold mb-3">@for($i = 0; $i < $testimonial['rating']; $i++)&#9733;@endfor</div>
                    <p class="text-gray-600 mb-4 italic">"{{ $testimonial['text'] }}"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-ghana-green/10 rounded-full flex items-center justify-center mr-3">
                            <span class="text-ghana-green font-bold text-sm">{{ substr($testimonial['name'], 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $testimonial['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $testimonial['from'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-gradient-to-r from-ghana-green via-primary-700 to-primary-900 text-white py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Ready to Explore Ghana?</h2>
        <p class="text-green-200 text-lg mb-8 max-w-2xl mx-auto">Join thousands of tourists discovering the beauty, culture, and history of the Gold Coast. Your adventure starts here.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-ghana-gold text-ghana-black px-8 py-3.5 rounded-lg font-bold hover:bg-accent-300 transition shadow-lg">Get Started Free</a>
            <a href="{{ route('tourism.index') }}" class="border-2 border-white text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-white/10 transition">Browse All Sites</a>
        </div>
    </div>
</section>
@endsection
