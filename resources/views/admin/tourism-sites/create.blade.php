@extends('layouts.admin')
@section('page-title', 'Add Tourism Site')

@section('content')
<form action="{{ route('admin.tourism-sites.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
    @csrf
    <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                <input type="text" name="name" required value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                <select name="region_id" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
                    @foreach($regions as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entry Fee (GHS)</label>
                <input type="number" name="entry_fee" step="0.01" min="0" required value="{{ old('entry_fee', 0) }}" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4" required class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">History</label>
            <textarea name="history" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500">{{ old('history') }}</textarea>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">Details</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Opening Time</label><input type="time" name="opening_time" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Closing Time</label><input type="time" name="closing_time" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label><input type="number" name="latitude" step="0.0000001" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label><input type="number" name="longitude" step="0.0000001" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label><input type="text" name="contact_phone" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label><input type="email" name="contact_email" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Address</label><input type="text" name="address" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Rules</label><textarea name="rules" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></textarea></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Safety Information</label><textarea name="safety_info" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-emerald-500"></textarea></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label><input type="file" name="featured_image" accept="image/*" class="w-full"></div>
        <label class="flex items-center"><input type="checkbox" name="is_featured" value="1" class="rounded text-emerald-600 mr-2"> Featured Site</label>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-emerald-600 text-white px-8 py-3 rounded-lg hover:bg-emerald-700 font-semibold">Create Tourism Site</button>
        <a href="{{ route('admin.tourism-sites.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300">Cancel</a>
    </div>
</form>
@endsection
