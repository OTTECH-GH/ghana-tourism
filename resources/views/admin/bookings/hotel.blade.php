@extends('layouts.admin')
@section('page-title', 'Hotel Bookings')

@section('content')
<div class="mb-4">
    <form class="flex gap-3">
        <select name="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:ring-emerald-500">
            <option value="">All Statuses</option>
            @foreach(['pending','confirmed','cancelled','completed'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">Reference</th>
            <th class="text-left px-4 py-3 text-gray-600">Tourist</th>
            <th class="text-left px-4 py-3 text-gray-600">Hotel</th>
            <th class="text-left px-4 py-3 text-gray-600">Room</th>
            <th class="text-left px-4 py-3 text-gray-600">Dates</th>
            <th class="text-left px-4 py-3 text-gray-600">Amount</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
        </tr></thead>
        <tbody class="divide-y">
            @foreach($bookings as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $b->booking_reference }}</td>
                    <td class="px-4 py-3">{{ $b->user->name }}</td>
                    <td class="px-4 py-3">{{ $b->hotel->name }}</td>
                    <td class="px-4 py-3">{{ $b->room->room_type }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $b->check_in_date->format('M d') }} - {{ $b->check_out_date->format('M d, Y') }}</td>
                    <td class="px-4 py-3 font-bold text-emerald-600">GHS {{ number_format($b->total_amount, 2) }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs {{ $b->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : ($b->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($b->status) }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $bookings->withQueryString()->links() }}</div>
@endsection
