@extends('layouts.admin')
@section('page-title', 'Payments')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl p-4 shadow-sm"><div class="text-sm text-gray-500">Total Revenue</div><div class="text-2xl font-bold text-ghana-green">GHS {{ number_format($totalRevenue, 2) }}</div></div>
    <div class="bg-white rounded-xl p-4 shadow-sm"><div class="text-sm text-gray-500">Total Commissions</div><div class="text-2xl font-bold text-blue-600">GHS {{ number_format($totalCommissions, 2) }}</div></div>
    <div class="bg-white rounded-xl p-4 shadow-sm"><div class="text-sm text-gray-500">Total Transactions</div><div class="text-2xl font-bold text-gray-800">{{ $payments->total() }}</div></div>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">Reference</th>
            <th class="text-left px-4 py-3 text-gray-600">User</th>
            <th class="text-left px-4 py-3 text-gray-600">Amount</th>
            <th class="text-left px-4 py-3 text-gray-600">Method</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
            <th class="text-left px-4 py-3 text-gray-600">Date</th>
        </tr></thead>
        <tbody class="divide-y">
            @foreach($payments as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $p->payment_reference }}</td>
                    <td class="px-4 py-3">{{ $p->user->name }}</td>
                    <td class="px-4 py-3 font-bold text-ghana-green">GHS {{ number_format($p->amount, 2) }}</td>
                    <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $p->payment_method) }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs {{ $p->status === 'completed' ? 'bg-green-50 text-ghana-green' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($p->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $p->created_at->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $payments->withQueryString()->links() }}</div>
@endsection
