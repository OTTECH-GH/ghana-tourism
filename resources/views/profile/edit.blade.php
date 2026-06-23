@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-2xl font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold">{{ Auth::user()->name }}</h1>
                <p class="text-green-200">{{ Auth::user()->email }} &middot; {{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <!-- Profile Information -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Profile Information</h2>
        <p class="text-sm text-gray-500 mb-6">Update your account's profile information and email address.</p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                    @error('name')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                    @error('email')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <p class="text-sm mt-2 text-gray-600">
                            Your email address is unverified.
                            <button form="send-verification" class="underline text-ghana-green hover:text-primary-700">Click here to re-send the verification email.</button>
                        </p>
                    @endif
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" placeholder="+233 XX XXX XXXX" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                </div>
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                    <input id="nationality" name="nationality" type="text" value="{{ old('nationality', $user->nationality ?? '') }}" placeholder="e.g. Ghanaian" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-ghana-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition">Save Changes</button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-ghana-green font-medium">Saved!</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Travel Preferences -->
    @if(Auth::user()->isTourist())
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Travel Preferences</h2>
        <p class="text-sm text-gray-500 mb-6">Help us personalize your Ghana experience.</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Interests</label>
                <div class="space-y-2">
                    @foreach(['History & Heritage', 'Beaches & Coast', 'Wildlife & Nature', 'Adventure & Hiking', 'Culture & Festivals', 'Food & Cuisine', 'Music & Nightlife', 'Arts & Crafts'] as $interest)
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-ghana-green focus:ring-ghana-green mr-2" value="{{ $interest }}">
                            <span class="text-sm text-gray-700">{{ $interest }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget Range (per day)</label>
                    <select class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                        <option value="">Select budget</option>
                        <option>Budget (under GHS 200)</option>
                        <option>Mid-Range (GHS 200-500)</option>
                        <option>Premium (GHS 500-1000)</option>
                        <option>Luxury (GHS 1000+)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Regions</label>
                    <select class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green" multiple>
                        <option>Greater Accra</option>
                        <option>Ashanti</option>
                        <option>Central</option>
                        <option>Western</option>
                        <option>Eastern</option>
                        <option>Volta</option>
                        <option>Northern</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Travel Style</label>
                    <select class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                        <option value="">Select style</option>
                        <option>Solo Traveler</option>
                        <option>Couple</option>
                        <option>Family with Kids</option>
                        <option>Group of Friends</option>
                        <option>Business Traveler</option>
                    </select>
                </div>
            </div>
        </div>
        <button class="mt-6 bg-ghana-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition">Save Preferences</button>
    </div>
    @endif

    <!-- Update Password -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Update Password</h2>
        <p class="text-sm text-gray-500 mb-6">Ensure your account is using a long, random password to stay secure.</p>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input id="current_password" name="current_password" type="password" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                @error('current_password', 'updatePassword')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input id="password" name="password" type="password" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                    @error('password', 'updatePassword')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-ghana-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition">Update Password</button>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-ghana-green font-medium">Password updated!</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Notification Preferences -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Notification Preferences</h2>
        <p class="text-sm text-gray-500 mb-6">Choose what notifications you want to receive.</p>
        <div class="space-y-3">
            @foreach([
                ['label' => 'Booking confirmations and updates', 'checked' => true],
                ['label' => 'Trip reminders (24 hours before)', 'checked' => true],
                ['label' => 'Price drops on saved hotels', 'checked' => false],
                ['label' => 'New tourism sites in your preferred regions', 'checked' => true],
                ['label' => 'Festival and event alerts', 'checked' => true],
                ['label' => 'Newsletter and travel tips', 'checked' => false],
                ['label' => 'Promotional offers and discounts', 'checked' => false],
            ] as $pref)
                <label class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition cursor-pointer">
                    <span class="text-sm text-gray-700">{{ $pref['label'] }}</span>
                    <input type="checkbox" class="rounded text-ghana-green focus:ring-ghana-green" {{ $pref['checked'] ? 'checked' : '' }}>
                </label>
            @endforeach
        </div>
        <button class="mt-4 bg-ghana-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition">Save Notification Settings</button>
    </div>

    <!-- Delete Account -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-ghana-red/20">
        <h2 class="text-lg font-bold text-ghana-red mb-1">Delete Account</h2>
        <p class="text-sm text-gray-500 mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        <form method="post" action="{{ route('profile.destroy') }}" x-data="{ confirmDelete: false }">
            @csrf
            @method('delete')
            <div x-show="!confirmDelete">
                <button type="button" @click="confirmDelete = true" class="bg-ghana-red/10 text-ghana-red px-6 py-2.5 rounded-lg font-semibold hover:bg-ghana-red/20 transition">Delete Account</button>
            </div>
            <div x-show="confirmDelete" x-cloak class="space-y-3">
                <p class="text-sm text-gray-600 font-medium">Please enter your password to confirm you would like to permanently delete your account.</p>
                <input type="password" name="password" placeholder="Your password" class="rounded-lg border-gray-300 focus:ring-ghana-red focus:border-ghana-red">
                @error('password', 'userDeletion')<p class="text-ghana-red text-sm">{{ $message }}</p>@enderror
                <div class="flex gap-3">
                    <button type="submit" class="bg-ghana-red text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition">Permanently Delete</button>
                    <button type="button" @click="confirmDelete = false" class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-200 transition">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
