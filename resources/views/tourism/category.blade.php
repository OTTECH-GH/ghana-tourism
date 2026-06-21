@extends('layouts.app')

@section('content')
<div class="bg-emerald-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-emerald-100 mt-2">{{ $category->description }}</p>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if($sites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($sites as $site)
                <a href="{{ route('tourism.show', $site) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    <div class="h-40 bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 group-hover:text-emerald-600">{{ $site->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $site->region->name }}</p>
                        <span class="text-emerald-600 font-bold text-sm mt-2 inline-block">GHS {{ number_format($site->entry_fee, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $sites->links() }}</div>
    @else
        <p class="text-center text-gray-500 py-16">No tourism sites found in this category.</p>
    @endif
</div>
@endsection
