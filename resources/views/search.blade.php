@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Search Results</h1>
        <form action="{{ route('search') }}" method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 shadow-sm focus:ring-ghana-green focus:border-ghana-green">
            <select name="category" class="rounded-lg border-gray-300 shadow-sm focus:ring-ghana-green">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="region" class="rounded-lg border-gray-300 shadow-sm focus:ring-ghana-green">
                <option value="">All Regions</option>
                @foreach($regions as $reg)
                    <option value="{{ $reg->id }}" {{ request('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-ghana-green text-white px-6 py-2 rounded-lg hover:bg-primary-700">Search</button>
        </form>
    </div>

    @if($sites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($sites as $site)
                <a href="{{ route('tourism.show', $site) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    <div class="h-40 bg-gradient-to-br from-ghana-green to-primary-700 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-medium text-ghana-green bg-ghana-green/5 px-2 py-1 rounded">{{ $site->category->name }}</span>
                        <h3 class="font-bold text-gray-800 mt-2 group-hover:text-ghana-green">{{ $site->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $site->region->name }}</p>
                        <span class="text-ghana-green font-bold mt-2 inline-block">GHS {{ number_format($site->entry_fee, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $sites->withQueryString()->links() }}</div>
    @else
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">No tourism sites found matching your search criteria.</p>
            <a href="{{ route('tourism.index') }}" class="text-ghana-green hover:text-ghana-green mt-4 inline-block">Browse all sites &rarr;</a>
        </div>
    @endif
</div>
@endsection
