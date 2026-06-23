@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-display font-bold mb-3">Frequently Asked Questions</h1>
        <p class="text-green-200 text-lg">Everything you need to know about traveling in Ghana.</p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-4">
        @foreach([
            ['q' => 'Do I need a visa to visit Ghana?', 'a' => 'Most nationalities require a visa to enter Ghana. You can apply online through the Ghana e-Visa portal. ECOWAS citizens do not need a visa. US citizens can also obtain a visa on arrival for a fee of $150. Processing typically takes 5-7 business days.'],
            ['q' => 'What is the best time to visit Ghana?', 'a' => 'The dry season from November to March is the best time to visit. The weather is warm and sunny with little rainfall. The harmattan period (December-February) brings dry, dusty winds from the Sahara. The rainy season runs from April to October but short trips are still possible.'],
            ['q' => 'Is Ghana safe for tourists?', 'a' => 'Ghana is one of the safest countries in West Africa and is known as a very welcoming and peaceful nation. Standard precautions apply — avoid walking alone at night in unfamiliar areas, keep valuables secure, and use registered taxis or ride-hailing apps (Uber, Bolt).'],
            ['q' => 'What currency is used in Ghana?', 'a' => 'The Ghana Cedi (GHS) is the local currency. Major hotels and restaurants accept credit cards, but cash is preferred for smaller establishments. Mobile Money (MTN MoMo, Vodafone Cash, AirtelTigo Money) is widely used across the country. ATMs are available in cities.'],
            ['q' => 'How do hotel bookings work on this platform?', 'a' => 'Browse hotels, select your preferred room type, choose your check-in and check-out dates, and submit your booking. You will receive a booking reference number. Payment can be made via Mobile Money, credit/debit card, or at the hotel upon arrival (subject to hotel policy).'],
            ['q' => 'Can I cancel my booking?', 'a' => 'Yes, you can cancel bookings from your dashboard. Cancellation policies vary by hotel — some offer free cancellation up to 24-48 hours before check-in, while others may charge a cancellation fee. Check the specific hotel\'s policy when booking.'],
            ['q' => 'What languages are spoken in Ghana?', 'a' => 'English is the official language and is widely spoken. Other major languages include Akan (Twi, Fante), Ewe, Ga, Dagbani, and Hausa. In tourist areas, English is sufficient for all interactions.'],
            ['q' => 'What should I pack for Ghana?', 'a' => 'Pack lightweight cotton clothing, comfortable walking shoes, sunscreen (SPF 50+), insect repellent, and a hat. If visiting during harmattan, bring moisturizer. Smart casual clothing is appropriate for restaurants and cultural events. Some religious sites may require modest dress.'],
            ['q' => 'How do I get around Ghana?', 'a' => 'Ride-hailing apps (Uber, Bolt) operate in Accra and Kumasi. Tro-tros (minibuses) are the most common local transport. For intercity travel, use STC or VIP bus services. Domestic flights connect Accra to Kumasi, Tamale, and Takoradi via Africa World Airlines.'],
            ['q' => 'Is tap water safe to drink in Ghana?', 'a' => 'It is recommended to drink bottled or filtered water. Bottled water is widely available and inexpensive. Most hotels provide complimentary bottled water. "Pure water" sachets (500ml sealed plastic bags of filtered water) are available everywhere for about GHS 0.50.'],
            ['q' => 'How do I book transport to tourism sites?', 'a' => 'Use our Trip Planner to search for available drivers and vehicles. Enter your pickup location, destination, and travel date. You can request one-way or round trips. Drivers are verified and have approved vehicles suitable for tourism.'],
            ['q' => 'What vaccinations do I need?', 'a' => 'Yellow fever vaccination is mandatory — you must present your yellow card on arrival. Recommended vaccinations include Hepatitis A & B, Typhoid, and Meningitis. Malaria prophylaxis is strongly recommended. Consult your travel clinic at least 6 weeks before travel.'],
        ] as $index => $faq)
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-800">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-ghana-green transform transition" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ $faq['a'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-12 bg-ghana-green/5 rounded-xl p-8 border border-ghana-green/10">
        <h3 class="font-bold text-lg text-gray-800 mb-2">Still have questions?</h3>
        <p class="text-gray-600 mb-4">Our support team is ready to help you plan your trip.</p>
        <a href="{{ route('contact') }}" class="bg-ghana-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition inline-block">Contact Us</a>
    </div>
</section>
@endsection
