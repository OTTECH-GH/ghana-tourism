@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Reviews</h1>

    @if($reviews->count() > 0)
        <div class="space-y-4">
            @foreach($reviews as $review)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-yellow-500">@for($i = 0; $i < $review->rating; $i++)&#9733;@endfor</div>
                            <p class="text-gray-600 mt-1">{{ $review->comment }}</p>
                            <p class="text-sm text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $reviews->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-xl shadow-sm">
            <p class="text-gray-500">You haven't written any reviews yet.</p>
        </div>
    @endif
</div>
@endsection
