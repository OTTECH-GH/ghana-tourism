@extends('layouts.admin')
@section('page-title', 'Edit Tourism Site')

@section('content')
<form action="{{ route('admin.tourism-sites.update', $tourismSite) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
    @csrf @method('PUT')
    <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label><input type="text" name="name" required value="{{ old('name', $tourismSite->name) }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label><select name="category_id" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ $tourismSite->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Region</label><select name="region_id" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">@foreach($regions as $reg)<option value="{{ $reg->id }}" {{ $tourismSite->region_id == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Entry Fee (GHS)</label><input type="number" name="entry_fee" step="0.01" min="0" required value="{{ old('entry_fee', $tourismSite->entry_fee) }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label><textarea name="description" rows="4" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">{{ old('description', $tourismSite->description) }}</textarea></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">History</label><textarea name="history" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green">{{ old('history', $tourismSite->history) }}</textarea></div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">Details</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Opening Time</label><input type="time" name="opening_time" value="{{ $tourismSite->opening_time }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Closing Time</label><input type="time" name="closing_time" value="{{ $tourismSite->closing_time }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label><input type="number" name="latitude" step="0.0000001" value="{{ $tourismSite->latitude }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label><input type="number" name="longitude" step="0.0000001" value="{{ $tourismSite->longitude }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Address</label><input type="text" name="address" value="{{ $tourismSite->address }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label><input type="file" name="featured_image" accept="image/*" class="w-full"></div>
        <div class="flex gap-6">
            <label class="flex items-center"><input type="checkbox" name="is_featured" value="1" {{ $tourismSite->is_featured ? 'checked' : '' }} class="rounded text-ghana-green mr-2"> Featured</label>
            <label class="flex items-center"><input type="checkbox" name="is_active" value="1" {{ $tourismSite->is_active ? 'checked' : '' }} class="rounded text-ghana-green mr-2"> Active</label>
        </div>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-ghana-green text-white px-8 py-3 rounded-lg hover:bg-primary-700 font-semibold">Update Site</button>
        <a href="{{ route('admin.tourism-sites.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300">Cancel</a>
    </div>
</form>
@endsection
