@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="relative bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-20">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-ghana-gold font-medium tracking-wide mb-2">THE GATEWAY TO AFRICA</p>
        <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">About Ghana</h1>
        <p class="text-xl text-green-200 max-w-3xl mx-auto">A land of rich history, vibrant culture, warm hospitality, and breathtaking natural beauty.</p>
    </div>
</section>

<!-- Quick Facts -->
<section class="bg-white py-16 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl font-bold text-ghana-green">31M+</div>
                <p class="text-gray-500 mt-1">Population</p>
            </div>
            <div>
                <div class="text-3xl font-bold text-ghana-green">238,535</div>
                <p class="text-gray-500 mt-1">Sq. Km Area</p>
            </div>
            <div>
                <div class="text-3xl font-bold text-ghana-green">16</div>
                <p class="text-gray-500 mt-1">Regions</p>
            </div>
            <div>
                <div class="text-3xl font-bold text-ghana-green">1957</div>
                <p class="text-gray-500 mt-1">Year of Independence</p>
            </div>
        </div>
    </div>
</section>

<!-- History & Culture -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-2 gap-12">
        <div>
            <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Our History</p>
            <h2 class="text-3xl font-display font-bold text-gray-800 mb-4">The Gold Coast to Ghana</h2>
            <div class="prose text-gray-600 space-y-4">
                <p>Ghana, formerly known as the Gold Coast, was the first sub-Saharan African country to gain independence from colonial rule on March 6, 1957, under the leadership of Dr. Kwame Nkrumah.</p>
                <p>The name "Ghana" was chosen to reflect the ancient Ghana Empire, a powerful West African kingdom that thrived between the 4th and 13th centuries. Today, Ghana stands as a beacon of democracy, peace, and stability in Africa.</p>
                <p>The country's coastline is dotted with over 30 European-built forts and castles, with Cape Coast Castle and Elmina Castle designated as UNESCO World Heritage Sites. These historic structures serve as powerful reminders of the transatlantic slave trade.</p>
            </div>
        </div>
        <div>
            <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Our Culture</p>
            <h2 class="text-3xl font-display font-bold text-gray-800 mb-4">Rich Heritage & Traditions</h2>
            <div class="prose text-gray-600 space-y-4">
                <p>Ghana is home to over 100 ethnic groups, each with unique languages, customs, and traditions. The Akan, Mole-Dagbon, Ewe, and Ga-Dangme are among the largest groups, contributing to a diverse cultural tapestry.</p>
                <p><strong>Kente Cloth</strong> — Ghana's most famous textile, handwoven by the Ashanti and Ewe people, is recognized worldwide as a symbol of African heritage and pride. Each pattern tells a story.</p>
                <p><strong>Adinkra Symbols</strong> — These visual symbols created by the Ashanti represent concepts and aphorisms. "Sankofa" (return and get it), "Gye Nyame" (except God), and "Dwennimmen" (ram's horns) are among the most well-known.</p>
            </div>
        </div>
    </div>
</section>

<!-- Festivals -->
<section class="bg-gradient-to-b from-gray-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Celebrations</p>
            <h2 class="text-3xl font-display font-bold text-gray-800">Major Festivals</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Homowo', 'people' => 'Ga People, Accra', 'month' => 'August', 'desc' => 'A harvest festival meaning "hooting at hunger." The Ga people celebrate with traditional foods like kpokpoi and palm nut soup, accompanied by drumming and dancing through the streets.'],
                ['name' => 'Aboakyir', 'people' => 'Effutu People, Winneba', 'month' => 'May', 'desc' => 'The "Deer Hunt Festival" where two Asafo companies compete to catch a live deer for the Paramount Chief. A unique celebration of bravery, teamwork, and cultural identity.'],
                ['name' => 'Adae Kese', 'people' => 'Ashanti Kingdom, Kumasi', 'month' => 'Various', 'desc' => 'The grand Ashanti durbar celebrating the power and unity of the kingdom. The Asantehene sits in state surrounded by golden regalia, with chiefs paying homage.'],
                ['name' => 'Hogbetsotso', 'people' => 'Anlo Ewe, Volta Region', 'month' => 'November', 'desc' => 'The migration festival of the Anlo Ewe people, commemorating their exodus from Notsie in present-day Togo. Features spectacular drumming, dance, and traditional warfare displays.'],
                ['name' => 'Kundum', 'people' => 'Nzema & Ahanta People', 'month' => 'August-October', 'desc' => 'A post-harvest festival celebrated with music, dancing, and rituals to drive away evil spirits and thank the gods for a bountiful harvest.'],
                ['name' => 'Panafest', 'people' => 'Cape Coast', 'month' => 'July-August', 'desc' => 'The Pan-African Historical Theatre Festival, a biennial event that brings together Africans from the continent and diaspora to celebrate shared heritage and history.'],
            ] as $festival)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-lg text-gray-800">{{ $festival['name'] }}</h3>
                        <span class="text-xs bg-ghana-gold/10 text-ghana-gold px-2 py-1 rounded font-medium">{{ $festival['month'] }}</span>
                    </div>
                    <p class="text-sm text-ghana-green font-medium mb-2">{{ $festival['people'] }}</p>
                    <p class="text-gray-600 text-sm">{{ $festival['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Ghana Cuisine -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <p class="text-ghana-green font-medium text-sm tracking-wide uppercase mb-2">Cuisine</p>
        <h2 class="text-3xl font-display font-bold text-gray-800">Taste of Ghana</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
            ['name' => 'Jollof Rice', 'desc' => 'Ghana\'s famous one-pot rice dish cooked in tomato sauce with spices', 'emoji' => '🍚'],
            ['name' => 'Fufu & Soup', 'desc' => 'Pounded cassava and plantain served with light soup or groundnut soup', 'emoji' => '🍲'],
            ['name' => 'Banku & Tilapia', 'desc' => 'Fermented corn and cassava dough with grilled tilapia and pepper', 'emoji' => '🐟'],
            ['name' => 'Kelewele', 'desc' => 'Spiced fried plantain cubes — a beloved Ghanaian street food', 'emoji' => '🍌'],
            ['name' => 'Waakye', 'desc' => 'Rice and beans cooked with millet leaves, served with shito and protein', 'emoji' => '🫘'],
            ['name' => 'Red Red', 'desc' => 'Black-eyed bean stew with fried ripe plantain and palm oil', 'emoji' => '🫕'],
            ['name' => 'Kenkey & Fish', 'desc' => 'Fermented corn dough wrapped in corn husks, served with fried fish', 'emoji' => '🌽'],
            ['name' => 'Chinchinga', 'desc' => 'Ghanaian kebab — spiced grilled meat served with onions and pepper', 'emoji' => '🥩'],
        ] as $food)
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                <span class="text-3xl">{{ $food['emoji'] }}</span>
                <h3 class="font-bold text-gray-800 mt-2">{{ $food['name'] }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $food['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<!-- Travel Tips -->
<section class="bg-ghana-green text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-ghana-gold font-medium text-sm tracking-wide uppercase mb-2">Plan Your Trip</p>
            <h2 class="text-3xl font-display font-bold">Travel Tips for Ghana</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['title' => 'Best Time to Visit', 'icon' => '🌤️', 'tips' => ['Dry season: November to March (best)', 'Harmattan (Dec-Feb): dusty but cool', 'Rainy season: April to October', 'Festival months vary — plan around events']],
                ['title' => 'Getting Around', 'icon' => '🚗', 'tips' => ['Uber and Bolt available in Accra & Kumasi', 'Tro-tros (minibuses) for local transport', 'STC and VIP buses for intercity travel', 'Domestic flights via Africa World Airlines']],
                ['title' => 'Essential Info', 'icon' => '📋', 'tips' => ['Currency: Ghana Cedi (GHS)', 'Language: English (official) + local languages', 'Visa: Required for most — apply online via e-visa', 'Mobile Money widely accepted (MTN, Vodafone)']],
            ] as $tip)
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                    <span class="text-3xl">{{ $tip['icon'] }}</span>
                    <h3 class="font-bold text-lg mt-3 mb-4">{{ $tip['title'] }}</h3>
                    <ul class="space-y-2">
                        @foreach($tip['tips'] as $item)
                            <li class="flex items-start space-x-2 text-green-100 text-sm">
                                <svg class="w-4 h-4 text-ghana-gold mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="bg-gradient-to-r from-ghana-gold to-accent-300 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-display font-bold text-ghana-black mb-4">Start Your Ghana Adventure Today</h2>
        <p class="text-gray-800 text-lg mb-8">Browse tourism sites, book hotels, and plan your perfect Ghanaian experience.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('tourism.index') }}" class="bg-ghana-green text-white px-8 py-3.5 rounded-lg font-bold hover:bg-primary-700 transition shadow-lg">Explore Tourism Sites</a>
            <a href="{{ route('register') }}" class="bg-white text-ghana-green px-8 py-3.5 rounded-lg font-semibold hover:bg-gray-50 transition border border-ghana-green">Create Account</a>
        </div>
    </div>
</section>
@endsection
