@extends('layouts.admin')
@section('page-title', 'User Details')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
                <p class="text-gray-500">{{ $user->phone }}</p>
                <span class="mt-2 inline-block px-3 py-1 rounded text-sm capitalize bg-gray-100 text-gray-700">{{ str_replace('_', ' ', $user->role) }}</span>
            </div>
            <span class="px-3 py-1 rounded text-sm {{ $user->status === 'active' ? 'bg-green-50 text-ghana-green' : 'bg-red-100 text-red-700' }}">{{ ucfirst($user->status) }}</span>
        </div>
    </div>
</div>
@endsection
