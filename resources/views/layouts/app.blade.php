<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Ghana Tourism' }} - Discover Ghana</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xl font-bold text-emerald-700">Ghana Tourism</span>
                    </a>
                    <div class="hidden md:flex items-center ml-10 space-x-6">
                        <a href="{{ route('tourism.index') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Tourism Sites</a>
                        <a href="{{ route('hotels.index') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Hotels</a>
                        <a href="{{ route('transport.index') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Transport</a>
                        <a href="{{ route('transport.planner') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Trip Planner</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Dashboard</a>
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 text-gray-600 hover:text-emerald-600">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="profileOpen" @click.outside="profileOpen = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50">Profile</a>
                                @if(Auth::user()->isTourist())
                                    <a href="{{ route('tourist.bookings') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50">My Bookings</a>
                                    <a href="{{ route('tourist.trips') }}" class="block px-4 py-2 text-gray-700 hover:bg-emerald-50">My Trips</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-emerald-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-emerald-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Register</a>
                    @endauth
                </div>
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div x-show="open" x-cloak class="md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('tourism.index') }}" class="block text-gray-600 py-2">Tourism Sites</a>
                <a href="{{ route('hotels.index') }}" class="block text-gray-600 py-2">Hotels</a>
                <a href="{{ route('transport.index') }}" class="block text-gray-600 py-2">Transport</a>
                <a href="{{ route('transport.planner') }}" class="block text-gray-600 py-2">Trip Planner</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-gray-600 py-2">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-gray-600 py-2">Logout</button></form>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-600 py-2">Login</a>
                    <a href="{{ route('register') }}" class="block text-emerald-600 font-medium py-2">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show">
                {{ session('success') }}
                <button @click="show = false" class="float-right">&times;</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show">
                {{ session('error') }}
                <button @click="show = false" class="float-right">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Ghana Tourism</h3>
                    <p class="text-sm">Discover the beauty of Ghana. Book hotels, transport, and tour guides all in one place.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('tourism.index') }}" class="hover:text-emerald-400">Tourism Sites</a></li>
                        <li><a href="{{ route('hotels.index') }}" class="hover:text-emerald-400">Hotels</a></li>
                        <li><a href="{{ route('transport.index') }}" class="hover:text-emerald-400">Transport</a></li>
                        <li><a href="{{ route('transport.planner') }}" class="hover:text-emerald-400">Trip Planner</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">For Partners</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400">Register Hotel</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400">Become a Driver</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400">Become a Tour Guide</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Email: info@ghanatourism.com</li>
                        <li>Phone: +233 20 000 0000</li>
                        <li>Accra, Ghana</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Ghana Tourism Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
