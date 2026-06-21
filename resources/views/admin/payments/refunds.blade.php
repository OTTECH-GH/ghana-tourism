@extends('layouts.admin')
@section('page-title', 'Refunds')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">User</th>
            <th class="text-left px-4 py-3 text-gray-600">Amount</th>
            <th class="text-left px-4 py-3 text-gray-600">Reason</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
            <th class="text-left px-4 py-3 text-gray-600">Date</th>
        </tr></thead>
        <tbody class="divide-y">
            @forelse($refunds as $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $r->user->name }}</td>
                    <td class="px-4 py-3 font-bold">GHS {{ number_format($r->amount, 2) }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ Str::limit($r->reason, 50) }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">{{ ucfirst($r->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $r->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No refunds yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $refunds->links() }}</div>
@endsection
