<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Ghana Tourism') }} - Login</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Flag Stripe -->
        <div class="h-1 flex">
            <div class="flex-1 bg-ghana-red"></div>
            <div class="flex-1 bg-ghana-gold"></div>
            <div class="flex-1 bg-ghana-green"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="mb-6">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-ghana-green rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-ghana-gold" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-ghana-green">Ghana</span>
                        <span class="text-xl font-bold text-ghana-gold">Tourism</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-xl border border-gray-100">
                {{ $slot }}
            </div>

            <p class="text-sm text-gray-400 mt-6">&copy; {{ date('Y') }} Ghana Tourism Platform</p>
        </div>
    </body>
</html>
