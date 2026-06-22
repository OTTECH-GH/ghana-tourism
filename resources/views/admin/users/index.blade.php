@extends('layouts.admin')
@section('page-title', 'Users')

@section('content')
<div class="mb-6">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search users..." class="rounded-lg border-gray-300 focus:ring-ghana-green">
        <select name="role" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:ring-ghana-green">
            <option value="">All Roles</option>
            @foreach(['tourist','hotel_admin','driver','transport_company','tour_guide','support_staff','super_admin'] as $role)
                <option value="{{ $role }}" {{ request('role') === $role ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
            @endforeach
        </select>
        <select name="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:ring-ghana-green">
            <option value="">All Statuses</option>
            @foreach(['active','suspended','pending'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-ghana-green text-white px-4 py-2 rounded-lg hover:bg-primary-700">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr>
            <th class="text-left px-4 py-3 text-gray-600">Name</th>
            <th class="text-left px-4 py-3 text-gray-600">Email</th>
            <th class="text-left px-4 py-3 text-gray-600">Role</th>
            <th class="text-left px-4 py-3 text-gray-600">Status</th>
            <th class="text-left px-4 py-3 text-gray-600">Joined</th>
            <th class="text-left px-4 py-3 text-gray-600">Actions</th>
        </tr></thead>
        <tbody class="divide-y">
            @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs capitalize">{{ str_replace('_', ' ', $user->role) }}</span></td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $user->status === 'active' ? 'bg-green-50 text-ghana-green' : ($user->status === 'suspended' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($user->status) }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            @if($user->status === 'active')
                                <form action="{{ route('admin.users.update-status', $user) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="suspended"><button class="text-red-600 text-xs hover:text-red-800">Suspend</button></form>
                            @else
                                <form action="{{ route('admin.users.update-status', $user) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="active"><button class="text-ghana-green text-xs hover:text-primary-700">Activate</button></form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->withQueryString()->links() }}</div>
@endsection
