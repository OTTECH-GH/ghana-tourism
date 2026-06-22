@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Earnings</h1>
        <a href="{{ route('driver.dashboard') }}" class="text-ghana-green hover:text-ghana-green">Back to Dashboard</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm"><div class="text-sm text-gray-500">Total Earnings</div><div class="text-3xl font-bold text-ghana-green mt-1">GHS {{ number_format($totalEarnings, 2) }}</div></div>
        <div class="bg-white rounded-xl p-6 shadow-sm"><div class="text-sm text-gray-500">Platform Commission</div><div class="text-3xl font-bold text-red-500 mt-1">GHS {{ number_format($totalCommissions, 2) }}</div></div>
        <div class="bg-white rounded-xl p-6 shadow-sm"><div class="text-sm text-gray-500">Net Earnings</div><div class="text-3xl font-bold text-blue-600 mt-1">GHS {{ number_format($totalEarnings - $totalCommissions, 2) }}</div></div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="text-left px-4 py-3 text-gray-600">Reference</th>
                <th class="text-left px-4 py-3 text-gray-600">Passenger</th>
                <th class="text-left px-4 py-3 text-gray-600">Date</th>
                <th class="text-left px-4 py-3 text-gray-600">Amount</th>
                <th class="text-left px-4 py-3 text-gray-600">Commission</th>
                <th class="text-left px-4 py-3 text-gray-600">Net</th>
            </tr></thead>
            <tbody class="divide-y">
                @foreach($earnings as $e)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono text-xs">{{ $e->booking_reference }}</td>
                        <td class="px-4 py-3">{{ $e->user->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $e->trip_date->format('M d, Y') }}</td>
                        <td class="px-4 py-3 font-bold">GHS {{ number_format($e->final_amount, 2) }}</td>
                        <td class="px-4 py-3 text-red-500">GHS {{ number_format($e->platform_commission, 2) }}</td>
                        <td class="px-4 py-3 font-bold text-ghana-green">GHS {{ number_format($e->final_amount - $e->platform_commission, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $earnings->links() }}</div>
</div>
@endsection
