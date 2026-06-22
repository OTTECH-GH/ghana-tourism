@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="bg-gradient-to-br from-ghana-red via-red-700 to-red-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-display font-bold mb-3">Emergency Contacts</h1>
        <p class="text-red-200 text-lg">Important numbers and resources for your safety while in Ghana.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Emergency Numbers -->
    <div class="bg-ghana-red/5 border border-ghana-red/20 rounded-xl p-6 mb-10">
        <h2 class="text-xl font-bold text-ghana-red mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            Emergency Numbers (Dial Free)
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['name' => 'Police', 'number' => '191', 'alt' => '18555'],
                ['name' => 'Fire Service', 'number' => '192', 'alt' => null],
                ['name' => 'Ambulance', 'number' => '193', 'alt' => null],
                ['name' => 'National Emergency', 'number' => '112', 'alt' => null],
            ] as $em)
                <div class="bg-white rounded-lg p-4 text-center border border-ghana-red/10 shadow-sm">
                    <p class="font-medium text-gray-600 text-sm">{{ $em['name'] }}</p>
                    <p class="text-2xl font-bold text-ghana-red mt-1">{{ $em['number'] }}</p>
                    @if($em['alt'])
                        <p class="text-xs text-gray-500 mt-1">Alt: {{ $em['alt'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Hospitals -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-ghana-red/10 rounded-lg flex items-center justify-center mr-2">
                    <svg class="w-4 h-4 text-ghana-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </span>
                Major Hospitals
            </h2>
            <div class="space-y-3">
                @foreach([
                    ['name' => 'Korle Bu Teaching Hospital', 'city' => 'Accra', 'phone' => '+233 30 266 5401', 'note' => 'Largest hospital in Ghana'],
                    ['name' => '37 Military Hospital', 'city' => 'Accra', 'phone' => '+233 30 277 6111', 'note' => 'Major emergency center'],
                    ['name' => 'Ridge Hospital', 'city' => 'Accra', 'phone' => '+233 30 222 8315', 'note' => 'Greater Accra Regional Hospital'],
                    ['name' => 'Komfo Anokye Teaching Hospital', 'city' => 'Kumasi', 'phone' => '+233 32 202 2301', 'note' => 'Leading hospital in Ashanti Region'],
                    ['name' => 'Cape Coast Teaching Hospital', 'city' => 'Cape Coast', 'phone' => '+233 33 213 2040', 'note' => 'Central Region referral center'],
                    ['name' => 'Tamale Teaching Hospital', 'city' => 'Tamale', 'phone' => '+233 37 202 2455', 'note' => 'Northern Ghana referral center'],
                ] as $hospital)
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $hospital['name'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $hospital['city'] }} — {{ $hospital['note'] }}</p>
                            </div>
                            <a href="tel:{{ str_replace(' ', '', $hospital['phone']) }}" class="text-ghana-green font-medium text-sm whitespace-nowrap">{{ $hospital['phone'] }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Embassies & Consulates -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-ghana-green/10 rounded-lg flex items-center justify-center mr-2">
                    <svg class="w-4 h-4 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                </span>
                Embassies in Accra
            </h2>
            <div class="space-y-3">
                @foreach([
                    ['country' => 'United States', 'address' => 'No. 24, Fourth Circular Rd, Cantonments', 'phone' => '+233 30 274 1000', 'flag' => '🇺🇸'],
                    ['country' => 'United Kingdom', 'address' => 'Osu Link, Off Gamel Abdul Nasser Ave', 'phone' => '+233 30 221 3250', 'flag' => '🇬🇧'],
                    ['country' => 'Germany', 'address' => 'No. 6, Kenneth Kaunda Rd, North Ridge', 'phone' => '+233 30 221 1000', 'flag' => '🇩🇪'],
                    ['country' => 'France', 'address' => '12th Road, Off Liberation Ave', 'phone' => '+233 30 221 4566', 'flag' => '🇫🇷'],
                    ['country' => 'Canada', 'address' => '42 Independence Ave, Sankara Overpass', 'phone' => '+233 30 221 1521', 'flag' => '🇨🇦'],
                    ['country' => 'Nigeria', 'address' => 'No. 7 Josif Broz Tito Ave, Cantonments', 'phone' => '+233 30 277 6158', 'flag' => '🇳🇬'],
                    ['country' => 'South Africa', 'address' => 'No. 4, Volta St, Airport Residential', 'phone' => '+233 30 276 4500', 'flag' => '🇿🇦'],
                    ['country' => 'China', 'address' => 'No. 6, Agostinho Neto Rd, Airport Residential', 'phone' => '+233 30 277 3573', 'flag' => '🇨🇳'],
                ] as $embassy)
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $embassy['flag'] }} {{ $embassy['country'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $embassy['address'] }}</p>
                            </div>
                            <a href="tel:{{ str_replace(' ', '', $embassy['phone']) }}" class="text-ghana-green font-medium text-sm whitespace-nowrap">{{ $embassy['phone'] }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Other Useful Contacts -->
    <div class="mt-12">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Other Useful Contacts</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach([
                ['name' => 'Ghana Tourism Authority', 'phone' => '+233 30 268 2601', 'desc' => 'Official tourism body'],
                ['name' => 'Ghana Immigration Service', 'phone' => '+233 30 225 8250', 'desc' => 'Visa & passport issues'],
                ['name' => 'Kotoka International Airport', 'phone' => '+233 30 277 6171', 'desc' => 'Flight information'],
                ['name' => 'Ghana Police Service (HQ)', 'phone' => '+233 30 277 3906', 'desc' => 'Non-emergency police'],
                ['name' => 'NADMO (Disaster Management)', 'phone' => '+233 30 268 0092', 'desc' => 'Natural disaster response'],
                ['name' => 'Tourist Police Unit', 'phone' => '+233 30 266 4646', 'desc' => 'Tourist-specific assistance'],
            ] as $contact)
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <h3 class="font-semibold text-gray-800">{{ $contact['name'] }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $contact['desc'] }}</p>
                    <a href="tel:{{ str_replace(' ', '', $contact['phone']) }}" class="text-ghana-green font-medium text-sm">{{ $contact['phone'] }}</a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
