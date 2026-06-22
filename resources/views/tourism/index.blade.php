@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-ghana-gold font-medium text-sm tracking-wide uppercase mb-2">Discover Ghana</p>
        <h1 class="text-4xl font-display font-bold mb-4">Tourism Sites</h1>
        <p class="text-green-200 text-lg">Explore castles, waterfalls, parks, beaches and more across all 16 regions.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Filters -->
    <form action="{{ route('tourism.index') }}" method="GET" class="bg-white rounded-xl p-4 shadow-sm mb-8 flex flex-wrap gap-4">
        <select name="category" class="rounded-lg border-gray-300 focus:ring-ghana-green" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="region" class="rounded-lg border-gray-300 focus:ring-ghana-green" onchange="this.form.submit()">
            <option value="">All Regions</option>
            @foreach($regions as $reg)
                <option value="{{ $reg->id }}" {{ request('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
            @endforeach
        </select>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($sites as $site)
            <a href="{{ route('tourism.show', $site) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-48 bg-gradient-to-br from-ghana-green to-primary-700 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <div class="p-4">
                    <span class="text-xs font-medium text-ghana-green bg-ghana-green/5 px-2 py-1 rounded">{{ $site->category->name }}</span>
                    <h3 class="font-bold text-gray-800 mt-2 group-hover:text-ghana-green">{{ $site->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $site->region->name }}</p>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit($site->description, 80) }}</p>
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-ghana-green font-bold">GHS {{ number_format($site->entry_fee, 2) }}</span>
                        @if($site->avg_rating > 0)
                            <span class="text-ghana-gold text-sm">&#9733; {{ number_format($site->avg_rating, 1) }}</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $sites->withQueryString()->links() }}</div>
</div>
@endsection
