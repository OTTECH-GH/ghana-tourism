@extends('layouts.admin')
@section('page-title', 'Tourism Sites')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-lg font-semibold text-gray-800">All Tourism Sites ({{ $sites->total() }})</h2>
    <a href="{{ route('admin.tourism-sites.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 text-sm">Add New Site</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">Name</th>
                <th class="text-left px-4 py-3 text-gray-600">Category</th>
                <th class="text-left px-4 py-3 text-gray-600">Region</th>
                <th class="text-left px-4 py-3 text-gray-600">Entry Fee</th>
                <th class="text-left px-4 py-3 text-gray-600">Featured</th>
                <th class="text-left px-4 py-3 text-gray-600">Status</th>
                <th class="text-left px-4 py-3 text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($sites as $site)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $site->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $site->category->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $site->region->name }}</td>
                    <td class="px-4 py-3 text-gray-600">GHS {{ number_format($site->entry_fee, 2) }}</td>
                    <td class="px-4 py-3">
                        @if($site->is_featured) <span class="text-emerald-600 font-bold">Yes</span> @else <span class="text-gray-400">No</span> @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $site->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">{{ $site->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.tourism-sites.edit', $site) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <form action="{{ route('admin.tourism-sites.destroy', $site) }}" method="POST" onsubmit="return confirm('Delete this site?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $sites->links() }}</div>
@endsection
