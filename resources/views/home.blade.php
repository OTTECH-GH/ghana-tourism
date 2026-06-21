@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-500 text-white">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Discover the Beauty of Ghana</h1>
            <p class="text-xl md:text-2xl mb-10 text-emerald-100 max-w-3xl mx-auto">Explore tourism sites, book hotels, arrange transport, and plan unforgettable trips across Ghana.</p>
            <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="flex bg-white rounded-xl overflow-hidden shadow-xl">
                    <input type="text" name="q" placeholder="Search tourism sites, hotels, regions..." class="flex-1 px-6 py-4 text-gray-700 focus:outline-none text-lg">
                    <button type="submit" class="bg-emerald-600 px-8 py-4 text-white font-semibold hover:bg-emerald-700 transition">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Explore by Category</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('tourism.category', $category) }}" class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition group">
                <div class="w-12 h-12 mx-auto mb-3 bg-emerald-100 rounded-full flex items-center justify-center group-hover:bg-emerald-200 transition">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-700">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $category->tourism_sites_count }} sites</p>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured Tourism Sites -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Featured Tourism Sites</h2>
            <a href="{{ route('tourism.index') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">View All &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredSites as $site)
                <a href="{{ route('tourism.show', $site) }}" class="bg-gray-50 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    <div class="h-48 bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                        @if($site->featured_image)
                            <img src="{{ Storage::url($site->featured_image) }}" alt="{{ $site->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded">{{ $site->category->name }}</span>
                        <h3 class="font-bold text-gray-800 mt-2 group-hover:text-emerald-600 transition">{{ $site->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $site->region->name }}</p>
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-emerald-600 font-bold">GHS {{ number_format($site->entry_fee, 2) }}</span>
                            @if($site->avg_rating > 0)
                                <span class="text-yellow-500 text-sm">&#9733; {{ number_format($site->avg_rating, 1) }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Regions -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Explore by Region</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($regions->take(8) as $region)
            <a href="{{ route('tourism.region', $region) }}" class="relative bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl p-6 text-white hover:from-emerald-700 hover:to-teal-700 transition shadow-md">
                <h3 class="font-bold text-lg">{{ $region->name }}</h3>
                <p class="text-emerald-100 text-sm mt-1">{{ $region->capital }}</p>
                <span class="text-emerald-200 text-sm mt-2 inline-block">{{ $region->tourism_sites_count }} sites &rarr;</span>
            </a>
        @endforeach
    </div>
</section>

<!-- How It Works -->
<section class="bg-emerald-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['step' => '1', 'title' => 'Discover', 'desc' => 'Browse tourism sites across all 16 regions of Ghana'],
                ['step' => '2', 'title' => 'Book', 'desc' => 'Book hotels and transport near your chosen destinations'],
                ['step' => '3', 'title' => 'Pay', 'desc' => 'Pay securely via Mobile Money, card, or wallet'],
                ['step' => '4', 'title' => 'Enjoy', 'desc' => 'Enjoy your trip with reliable services and support'],
            ] as $item)
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-emerald-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4">{{ $item['step'] }}</div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Explore Ghana?</h2>
        <p class="text-emerald-100 text-lg mb-8">Join thousands of tourists discovering the beauty, culture, and history of Ghana.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-white text-emerald-700 px-8 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition">Get Started</a>
            <a href="{{ route('tourism.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition">Browse Sites</a>
        </div>
    </div>
</section>
@endsection
