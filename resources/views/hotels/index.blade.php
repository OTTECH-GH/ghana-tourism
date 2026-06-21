@extends('layouts.app')

@section('content')
<div class="bg-emerald-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Hotels in Ghana</h1>
        <p class="text-emerald-100 mt-2">Find and book the best hotels near your favorite tourism sites.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <form action="{{ route('hotels.index') }}" method="GET" class="bg-white rounded-xl p-4 shadow-sm mb-8 flex flex-wrap gap-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search hotels..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 focus:ring-emerald-500">
        <select name="region" class="rounded-lg border-gray-300 focus:ring-emerald-500" onchange="this.form.submit()">
            <option value="">All Regions</option>
            @foreach($regions as $reg)
                <option value="{{ $reg->id }}" {{ request('region') == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
            @endforeach
        </select>
        <select name="stars" class="rounded-lg border-gray-300 focus:ring-emerald-500" onchange="this.form.submit()">
            <option value="">All Ratings</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ request('stars') == $i ? 'selected' : '' }}>{{ $i }}+ Stars</option>
            @endfor
        </select>
        <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($hotels as $hotel)
            <a href="{{ route('hotels.show', $hotel) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-800 group-hover:text-emerald-600">{{ $hotel->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $hotel->region->name }}</p>
                        </div>
                        <div class="text-yellow-500 text-sm">
                            @for($i = 0; $i < $hotel->star_rating; $i++)&#9733;@endfor
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit($hotel->description, 100) }}</p>
                    @if($hotel->rooms->count() > 0)
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-emerald-600 font-bold">From GHS {{ number_format($hotel->rooms->min('price_per_night'), 2) }}/night</span>
                            <span class="text-gray-400 text-sm">{{ $hotel->rooms->count() }} room types</span>
                        </div>
                    @endif
                    @if($hotel->facilities)
                        <div class="mt-3 flex flex-wrap gap-1">
                            @foreach(array_slice($hotel->facilities, 0, 4) as $facility)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $facility }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $hotels->withQueryString()->links() }}</div>
</div>
@endsection
