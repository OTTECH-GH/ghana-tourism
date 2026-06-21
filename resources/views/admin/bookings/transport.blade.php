@extends('layouts.admin')
@section('page-title', 'Transport Bookings')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">Reference</th>
            <th class="text-left px-4 py-3 text-gray-600">Tourist</th>
            <th class="text-left px-4 py-3 text-gray-600">Vehicle Type</th>
            <th class="text-left px-4 py-3 text-gray-600">Driver</th>
            <th class="text-left px-4 py-3 text-gray-600">Date</th>
            <th class="text-left px-4 py-3 text-gray-600">Amount</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
        </tr></thead>
        <tbody class="divide-y">
            @foreach($bookings as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $b->booking_reference }}</td>
                    <td class="px-4 py-3">{{ $b->user->name }}</td>
                    <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $b->vehicle_type) }}</td>
                    <td class="px-4 py-3">{{ $b->driver?->user->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $b->trip_date->format('M d, Y') }}</td>
                    <td class="px-4 py-3 font-bold text-emerald-600">GHS {{ number_format($b->final_amount ?? $b->estimated_amount, 2) }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700 capitalize">{{ str_replace('_', ' ', $b->status) }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $bookings->withQueryString()->links() }}</div>
@endsection
