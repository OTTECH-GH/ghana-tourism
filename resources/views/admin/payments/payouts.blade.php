@extends('layouts.admin')
@section('page-title', 'Payouts')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">User</th>
            <th class="text-left px-4 py-3 text-gray-600">Amount</th>
            <th class="text-left px-4 py-3 text-gray-600">Method</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
            <th class="text-left px-4 py-3 text-gray-600">Date</th>
        </tr></thead>
        <tbody class="divide-y">
            @forelse($payouts as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $p->user->name }}</td>
                    <td class="px-4 py-3 font-bold text-emerald-600">GHS {{ number_format($p->amount, 2) }}</td>
                    <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $p->payment_method) }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">{{ ucfirst($p->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $p->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No payouts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $payouts->links() }}</div>
@endsection
