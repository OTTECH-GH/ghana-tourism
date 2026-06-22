<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Ghana Tourism' }} - Discover Ghana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Ghana Flag Stripe -->
    <div class="h-1 flex">
        <div class="flex-1 bg-ghana-red"></div>
        <div class="flex-1 bg-ghana-gold"></div>
        <div class="flex-1 bg-ghana-green"></div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-9 h-9 bg-ghana-green rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-ghana-gold" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-ghana-green">Ghana</span>
                            <span class="text-xl font-bold text-ghana-gold">Tourism</span>
                        </div>
                    </a>
                    <div class="hidden md:flex items-center ml-10 space-x-6">
                        <a href="{{ route('tourism.index') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Tourism Sites</a>
                        <a href="{{ route('hotels.index') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Hotels</a>
                        <a href="{{ route('transport.index') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Transport</a>
                        <a href="{{ route('transport.planner') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Trip Planner</a>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">About Ghana</a>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Contact</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Dashboard</a>
                        <!-- Notification Bell -->
                        <div class="relative" x-data="{ notifOpen: false }">
                            <button @click="notifOpen = !notifOpen" class="relative text-gray-500 hover:text-ghana-green transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                @php $unreadCount = Auth::user()->notifications()->where('is_read', false)->count(); @endphp
                                @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-ghana-red text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $unreadCount }}</span>
                                @endif
                            </button>
                            <div x-show="notifOpen" @click.outside="notifOpen = false" x-cloak class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border z-50 overflow-hidden">
                                <div class="px-4 py-3 bg-ghana-green text-white flex justify-between items-center">
                                    <span class="font-semibold text-sm">Notifications</span>
                                </div>
                                <div class="max-h-72 overflow-y-auto divide-y">
                                    @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notification)
                                        <div class="px-4 py-3 hover:bg-gray-50 {{ $notification->is_read ? '' : 'bg-ghana-gold/5' }}">
                                            <p class="text-sm text-gray-700">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    @empty
                                        <div class="px-4 py-8 text-center">
                                            <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                            <p class="text-sm text-gray-400">No notifications yet</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 text-gray-600 hover:text-ghana-green">
                                <div class="w-8 h-8 bg-ghana-green/10 rounded-full flex items-center justify-center">
                                    <span class="text-ghana-green font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="profileOpen" @click.outside="profileOpen = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-700/5 hover:text-ghana-green">Profile</a>
                                @if(Auth::user()->isTourist())
                                    <a href="{{ route('tourist.bookings') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-700/5 hover:text-ghana-green">My Bookings</a>
                                    <a href="{{ route('tourist.trips') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-700/5 hover:text-ghana-green">My Trips</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-ghana-red/5 hover:text-ghana-red">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-ghana-green font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-ghana-green text-white px-5 py-2 rounded-lg hover:bg-primary-700 font-medium transition shadow-sm">Register</a>
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
                <a href="{{ route('tourism.index') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Tourism Sites</a>
                <a href="{{ route('hotels.index') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Hotels</a>
                <a href="{{ route('transport.index') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Transport</a>
                <a href="{{ route('transport.planner') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Trip Planner</a>
                <a href="{{ route('about') }}" class="block text-gray-600 py-2 hover:text-ghana-green">About Ghana</a>
                <a href="{{ route('contact') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Contact</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-gray-600 py-2 hover:text-ghana-green">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-gray-600 py-2 hover:text-ghana-red">Logout</button></form>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-600 py-2">Login</a>
                    <a href="{{ route('register') }}" class="block text-ghana-green font-medium py-2">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-ghana-green/30 text-ghana-green px-4 py-3 rounded-lg flex items-center" x-data="{ show: true }" x-show="show">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
                <button @click="show = false" class="ml-auto text-ghana-green/60 hover:text-ghana-green">&times;</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-ghana-red/30 text-ghana-red px-4 py-3 rounded-lg flex items-center" x-data="{ show: true }" x-show="show">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
                <button @click="show = false" class="ml-auto text-ghana-red/60 hover:text-ghana-red">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Newsletter -->
    <section class="bg-ghana-green text-white py-12 mt-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-display font-bold mb-2">Stay Updated on Ghana Travel</h2>
            <p class="text-green-200 mb-6">Get travel tips, new destinations, and exclusive deals delivered to your inbox.</p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                <input type="email" placeholder="Enter your email address" class="flex-1 rounded-lg border-0 bg-white/10 text-white placeholder-green-200/60 focus:ring-2 focus:ring-ghana-gold px-4 py-3">
                <button type="submit" class="bg-ghana-gold text-ghana-black px-6 py-3 rounded-lg font-bold hover:bg-accent-300 transition whitespace-nowrap">Subscribe</button>
            </form>
            <p class="text-xs text-green-300/60 mt-3">No spam. Unsubscribe anytime. We respect your privacy.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-9 h-9 bg-ghana-green rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-ghana-gold" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold text-white">Ghana</span>
                            <span class="text-lg font-bold text-ghana-gold">Tourism</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">Your gateway to experiencing the rich culture, breathtaking landscapes, and warm hospitality of Ghana — the Gateway to Africa.</p>
                    <p class="text-xs text-gray-500 italic">"Akwaaba" — Welcome to Ghana</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Explore</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('tourism.index') }}" class="hover:text-ghana-gold transition">Tourism Sites</a></li>
                        <li><a href="{{ route('hotels.index') }}" class="hover:text-ghana-gold transition">Hotels</a></li>
                        <li><a href="{{ route('transport.index') }}" class="hover:text-ghana-gold transition">Transport</a></li>
                        <li><a href="{{ route('transport.planner') }}" class="hover:text-ghana-gold transition">Trip Planner</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-ghana-gold transition">About Ghana</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">For Partners</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-ghana-gold transition">Register Hotel</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-ghana-gold transition">Become a Driver</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-ghana-gold transition">Become a Tour Guide</a></li>
                    </ul>
                    <h4 class="text-white font-semibold mb-4 mt-6">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('faq') }}" class="hover:text-ghana-gold transition">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-ghana-gold transition">Contact Us</a></li>
                        <li><a href="{{ route('emergency') }}" class="hover:text-ghana-gold transition">Emergency Contacts</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 text-ghana-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@ghanatourism.com</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 text-ghana-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+233 20 000 0000</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 text-ghana-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Accra, Ghana</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Ghana Flag Stripe -->
            <div class="h-1 flex rounded-full overflow-hidden mt-8 mb-6">
                <div class="flex-1 bg-ghana-red"></div>
                <div class="flex-1 bg-ghana-gold"></div>
                <div class="flex-1 bg-ghana-green"></div>
            </div>
            <div class="text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Ghana Tourism Platform. Built with pride in Ghana. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
