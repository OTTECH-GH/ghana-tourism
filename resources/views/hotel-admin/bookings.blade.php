@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Bookings - {{ $hotel->name }}</h1>
        <a href="{{ route('hotel-admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-700">Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="text-left px-4 py-3 text-gray-600">Reference</th>
                <th class="text-left px-4 py-3 text-gray-600">Guest</th>
                <th class="text-left px-4 py-3 text-gray-600">Room</th>
                <th class="text-left px-4 py-3 text-gray-600">Dates</th>
                <th class="text-left px-4 py-3 text-gray-600">Amount</th>
                <th class="text-left px-4 py-3 text-gray-600">Status</th>
                <th class="text-left px-4 py-3 text-gray-600">Actions</th>
            </tr></thead>
            <tbody class="divide-y">
                @foreach($bookings as $b)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono text-xs">{{ $b->booking_reference }}</td>
                        <td class="px-4 py-3">{{ $b->user->name }}</td>
                        <td class="px-4 py-3">{{ $b->room->room_type }}</td>
                        <td class="px-4 py-3">{{ $b->check_in_date->format('M d') }} - {{ $b->check_out_date->format('M d') }}</td>
                        <td class="px-4 py-3 font-bold text-emerald-600">GHS {{ number_format($b->total_amount, 2) }}</td>
                        <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs {{ $b->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : ($b->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($b->status) }}</span></td>
                        <td class="px-4 py-3">
                            @if($b->status === 'pending')
                                <div class="flex gap-2">
                                    <form action="{{ route('hotel-admin.bookings.confirm', $b) }}" method="POST">@csrf @method('PATCH')<button class="text-emerald-600 text-sm">Confirm</button></form>
                                    <form action="{{ route('hotel-admin.bookings.reject', $b) }}" method="POST">@csrf @method('PATCH')<button class="text-red-600 text-sm">Reject</button></form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $bookings->withQueryString()->links() }}</div>
</div>
@endsection
