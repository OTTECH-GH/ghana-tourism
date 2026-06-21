<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Driver;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Region;
use App\Models\Setting;
use App\Models\TourGuide;
use App\Models\TourismCategory;
use App\Models\TourismSite;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ghanatourism.com',
            'phone' => '+233200000000',
            'role' => 'super_admin',
            'status' => 'active',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Test Tourist
        User::create([
            'name' => 'Kwame Asante',
            'email' => 'tourist@ghanatourism.com',
            'phone' => '+233240000001',
            'role' => 'tourist',
            'status' => 'active',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Regions of Ghana
        $regionsData = [
            ['name' => 'Greater Accra', 'capital' => 'Accra', 'description' => 'The smallest but most densely populated region of Ghana, home to the national capital Accra.'],
            ['name' => 'Ashanti', 'capital' => 'Kumasi', 'description' => 'The most populous region of Ghana, known for its rich Ashanti cultural heritage.'],
            ['name' => 'Central', 'capital' => 'Cape Coast', 'description' => 'Known for its coastal castles and historical significance in the transatlantic slave trade.'],
            ['name' => 'Eastern', 'capital' => 'Koforidua', 'description' => 'Home to beautiful waterfalls, mountains, and the Aburi Botanical Gardens.'],
            ['name' => 'Western', 'capital' => 'Sekondi-Takoradi', 'description' => 'Known for its beaches, oil industry, and the Nzulezo stilt village.'],
            ['name' => 'Volta', 'capital' => 'Ho', 'description' => 'Features the highest mountain in Ghana (Mount Afadjato) and the stunning Wli Waterfalls.'],
            ['name' => 'Northern', 'capital' => 'Tamale', 'description' => 'The largest region by area, known for its savannas and the Mole National Park.'],
            ['name' => 'Upper East', 'capital' => 'Bolgatanga', 'description' => 'Famous for its basket weaving, Paga crocodile pond, and Tongo Hills.'],
            ['name' => 'Upper West', 'capital' => 'Wa', 'description' => 'Known for the Wechiau Hippo Sanctuary and traditional architecture.'],
            ['name' => 'Bono', 'capital' => 'Sunyani', 'description' => 'Known for the Bui National Park and rich cultural heritage.'],
            ['name' => 'Bono East', 'capital' => 'Techiman', 'description' => 'Home to the Techiman market, one of the largest in West Africa.'],
            ['name' => 'Ahafo', 'capital' => 'Goaso', 'description' => 'Known for its cocoa farming and forest reserves.'],
            ['name' => 'Western North', 'capital' => 'Sefwi Wiawso', 'description' => 'Rich in mineral resources and lush rainforests.'],
            ['name' => 'Oti', 'capital' => 'Dambai', 'description' => 'Features the Oti River and diverse ethnic groups.'],
            ['name' => 'North East', 'capital' => 'Nalerigu', 'description' => 'Known for the Gambaga escarpment and traditional festivals.'],
            ['name' => 'Savannah', 'capital' => 'Damongo', 'description' => 'Home to the famous Mole National Park and Larabanga Mosque.'],
        ];

        $regions = [];
        foreach ($regionsData as $r) {
            $regions[$r['name']] = Region::create([
                'name' => $r['name'],
                'slug' => Str::slug($r['name']),
                'capital' => $r['capital'],
                'description' => $r['description'],
            ]);
        }

        // Key districts
        $districtsData = [
            'Greater Accra' => ['Accra Metropolitan', 'Tema Metropolitan', 'Ga West', 'Ga East', 'La Dade Kotopon'],
            'Ashanti' => ['Kumasi Metropolitan', 'Obuasi Municipal', 'Ejisu Municipal', 'Bosomtwe'],
            'Central' => ['Cape Coast Metropolitan', 'Elmina', 'Komenda-Edina-Eguafo-Abirem'],
            'Eastern' => ['New Juaben', 'Akuapem South', 'Akim Oda'],
            'Volta' => ['Ho Municipal', 'Hohoe Municipal', 'Keta Municipal'],
            'Northern' => ['Tamale Metropolitan', 'West Gonja'],
            'Western' => ['Sekondi-Takoradi Metropolitan', 'Jomoro', 'Ellembelle'],
            'Upper East' => ['Bolgatanga Municipal', 'Kassena-Nankana'],
        ];

        foreach ($districtsData as $regionName => $districts) {
            if (isset($regions[$regionName])) {
                foreach ($districts as $d) {
                    District::create([
                        'region_id' => $regions[$regionName]->id,
                        'name' => $d,
                        'slug' => Str::slug($d),
                    ]);
                }
            }
        }

        // Tourism Categories
        $categories = [];
        $categoriesData = [
            ['name' => 'Castle & Fort', 'icon' => 'castle', 'description' => 'Historical castles and forts from the colonial era'],
            ['name' => 'Beach', 'icon' => 'beach', 'description' => 'Beautiful beaches along the coast of Ghana'],
            ['name' => 'Waterfall', 'icon' => 'waterfall', 'description' => 'Stunning waterfalls across the country'],
            ['name' => 'Museum', 'icon' => 'museum', 'description' => 'Museums preserving Ghana\'s cultural heritage'],
            ['name' => 'Park & Garden', 'icon' => 'park', 'description' => 'National parks, gardens, and nature reserves'],
            ['name' => 'Zoo & Wildlife', 'icon' => 'zoo', 'description' => 'Zoos and wildlife sanctuaries'],
            ['name' => 'Lake', 'icon' => 'lake', 'description' => 'Natural and man-made lakes'],
            ['name' => 'Mountain', 'icon' => 'mountain', 'description' => 'Mountains and hills for hiking'],
            ['name' => 'Cultural Site', 'icon' => 'culture', 'description' => 'Sites of cultural significance'],
            ['name' => 'Historical Site', 'icon' => 'history', 'description' => 'Sites of historical importance'],
            ['name' => 'Festival Site', 'icon' => 'festival', 'description' => 'Venues for traditional festivals'],
            ['name' => 'Religious Site', 'icon' => 'religious', 'description' => 'Mosques, churches, and shrines of significance'],
            ['name' => 'Wildlife Reserve', 'icon' => 'wildlife', 'description' => 'Wildlife reserves and sanctuaries'],
        ];

        foreach ($categoriesData as $c) {
            $categories[$c['name']] = TourismCategory::create([
                'name' => $c['name'],
                'slug' => Str::slug($c['name']),
                'icon' => $c['icon'],
                'description' => $c['description'],
            ]);
        }

        // Tourism Sites
        $sites = [
            [
                'name' => 'Cape Coast Castle',
                'category' => 'Castle & Fort',
                'region' => 'Central',
                'description' => 'Cape Coast Castle is one of about forty slave castles built on the Gold Coast of West Africa. It was originally a Portuguese trading post, then later used in the transatlantic slave trade.',
                'history' => 'Originally built by the Swedish Africa Company in 1653, it was later captured by the British. It served as the seat of the British colonial government until 1877.',
                'entry_fee' => 40.00,
                'latitude' => 5.1036,
                'longitude' => -1.2416,
                'is_featured' => true,
            ],
            [
                'name' => 'Elmina Castle',
                'category' => 'Castle & Fort',
                'region' => 'Central',
                'description' => 'Elmina Castle was erected by the Portuguese in 1482. It is the oldest European building in existence below the Sahara and a UNESCO World Heritage Site.',
                'history' => 'Built by the Portuguese in 1482, it is the earliest known European structure in tropical Africa.',
                'entry_fee' => 40.00,
                'latitude' => 5.0838,
                'longitude' => -1.3485,
                'is_featured' => true,
            ],
            [
                'name' => 'Kakum National Park',
                'category' => 'Park & Garden',
                'region' => 'Central',
                'description' => 'Kakum National Park features a canopy walkway suspended 30 meters above the ground, offering stunning views of the rainforest. It covers 375 square kilometers of tropical forest.',
                'history' => 'Established in 1931 as a forest reserve and upgraded to national park status in 1992.',
                'entry_fee' => 60.00,
                'latitude' => 5.3500,
                'longitude' => -1.3833,
                'is_featured' => true,
            ],
            [
                'name' => 'Kwame Nkrumah Memorial Park',
                'category' => 'Museum',
                'region' => 'Greater Accra',
                'description' => 'A national park and memorial dedicated to Dr. Kwame Nkrumah, the first President of Ghana. It contains his mausoleum and a museum.',
                'history' => 'Built on the site where Ghana\'s independence was declared on March 6, 1957.',
                'entry_fee' => 20.00,
                'latitude' => 5.5471,
                'longitude' => -0.2069,
                'is_featured' => true,
            ],
            [
                'name' => 'Kumasi Zoo',
                'category' => 'Zoo & Wildlife',
                'region' => 'Ashanti',
                'description' => 'The Kumasi Zoological Gardens is one of the major tourist attractions in Kumasi, housing various species of animals including lions, monkeys, snakes, and birds.',
                'entry_fee' => 10.00,
                'latitude' => 6.6885,
                'longitude' => -1.6244,
                'is_featured' => true,
            ],
            [
                'name' => 'Manhyia Palace Museum',
                'category' => 'Museum',
                'region' => 'Ashanti',
                'description' => 'The former residence of the Asantehene (King of the Ashanti), now a museum showcasing the rich history and culture of the Ashanti Kingdom.',
                'history' => 'Built in 1925 by the British as a residence for the Asantehene Prempeh I upon his return from exile.',
                'entry_fee' => 15.00,
                'latitude' => 6.6970,
                'longitude' => -1.6139,
                'is_featured' => true,
            ],
            [
                'name' => 'Lake Bosomtwe',
                'category' => 'Lake',
                'region' => 'Ashanti',
                'description' => 'Lake Bosomtwe is a natural lake formed in a meteorite impact crater. It is the only natural lake in Ghana and is sacred to the Ashanti people.',
                'history' => 'Formed about 1.07 million years ago by a meteorite impact. It is considered sacred by the Ashanti people.',
                'entry_fee' => 5.00,
                'latitude' => 6.5042,
                'longitude' => -1.4125,
                'is_featured' => true,
            ],
            [
                'name' => 'Aburi Botanical Gardens',
                'category' => 'Park & Garden',
                'region' => 'Eastern',
                'description' => 'Aburi Botanical Gardens is a 64.8-hectare botanical garden situated on the Akuapem Ridge, offering cool mountain air and stunning views.',
                'history' => 'Established in March 1890 by the British colonial government for agricultural research.',
                'entry_fee' => 15.00,
                'latitude' => 5.8500,
                'longitude' => -0.1667,
            ],
            [
                'name' => 'Wli Waterfalls',
                'category' => 'Waterfall',
                'region' => 'Volta',
                'description' => 'Wli Waterfalls (also known as Agumatsa Falls) is the highest waterfall in Ghana and one of the tallest in West Africa, standing at about 80 meters.',
                'entry_fee' => 20.00,
                'latitude' => 7.0943,
                'longitude' => 0.5842,
            ],
            [
                'name' => 'Mole National Park',
                'category' => 'Wildlife Reserve',
                'region' => 'Savannah',
                'description' => 'Mole National Park is the largest wildlife refuge in Ghana, covering 4,577 square kilometers. It is home to elephants, antelopes, baboons, and over 300 bird species.',
                'history' => 'Established as a game reserve in 1958 and upgraded to national park status in 1971.',
                'entry_fee' => 50.00,
                'latitude' => 9.2833,
                'longitude' => -1.8333,
                'is_featured' => true,
            ],
            [
                'name' => 'Labadi Beach',
                'category' => 'Beach',
                'region' => 'Greater Accra',
                'description' => 'Labadi Beach (also known as La Pleasure Beach) is the most popular beach in Accra, known for its vibrant atmosphere, live music, and weekend entertainment.',
                'entry_fee' => 10.00,
                'latitude' => 5.5550,
                'longitude' => -0.1470,
            ],
            [
                'name' => 'Boti Falls',
                'category' => 'Waterfall',
                'region' => 'Eastern',
                'description' => 'Boti Falls is a twin waterfall located in the Boti Forest Reserve. During the rainy season, both the male and female falls flow together.',
                'entry_fee' => 10.00,
                'latitude' => 6.2500,
                'longitude' => -0.1833,
            ],
            [
                'name' => 'Larabanga Mosque',
                'category' => 'Religious Site',
                'region' => 'Savannah',
                'description' => 'The Larabanga Mosque is one of the oldest mosques in West Africa, built in the Sudanese architectural style. It is believed to have been founded in 1421.',
                'entry_fee' => 5.00,
                'latitude' => 9.2167,
                'longitude' => -1.8500,
            ],
            [
                'name' => 'Paga Crocodile Pond',
                'category' => 'Zoo & Wildlife',
                'region' => 'Upper East',
                'description' => 'The Paga Crocodile Pond is famous for its friendly crocodiles that are considered sacred by the local community. Visitors can safely touch and take photos with them.',
                'entry_fee' => 10.00,
                'latitude' => 10.9833,
                'longitude' => -1.1167,
            ],
            [
                'name' => 'Mount Afadjato',
                'category' => 'Mountain',
                'region' => 'Volta',
                'description' => 'Mount Afadjato is the highest point in Ghana at 885 meters above sea level. It offers breathtaking hiking trails through lush forests.',
                'entry_fee' => 15.00,
                'latitude' => 7.0833,
                'longitude' => 0.5667,
            ],
            [
                'name' => 'Nzulezo Stilt Village',
                'category' => 'Cultural Site',
                'region' => 'Western',
                'description' => 'Nzulezo is a unique village built entirely on stilts over Lake Tadane. It is one of the most fascinating cultural sites in Ghana.',
                'entry_fee' => 25.00,
                'latitude' => 4.9833,
                'longitude' => -2.3833,
            ],
            [
                'name' => 'Fort St. Jago',
                'category' => 'Castle & Fort',
                'region' => 'Central',
                'description' => 'Fort St. Jago (also known as Fort Coenraadsburg) sits on the hill overlooking Elmina Castle and the Atlantic Ocean.',
                'entry_fee' => 15.00,
                'latitude' => 5.0847,
                'longitude' => -1.3472,
            ],
            [
                'name' => 'National Museum of Ghana',
                'category' => 'Museum',
                'region' => 'Greater Accra',
                'description' => 'The National Museum of Ghana in Accra houses collections of artifacts about Ghana\'s archaeological, ethnographic, and artistic heritage.',
                'entry_fee' => 15.00,
                'latitude' => 5.5600,
                'longitude' => -0.2060,
            ],
            [
                'name' => 'Kintampo Waterfalls',
                'category' => 'Waterfall',
                'region' => 'Bono East',
                'description' => 'Kintampo Waterfalls is one of the highest waterfalls in Ghana, cascading down three stages through a lush tropical forest setting.',
                'entry_fee' => 10.00,
                'latitude' => 8.0667,
                'longitude' => -1.7167,
            ],
            [
                'name' => 'Tafi Atome Monkey Sanctuary',
                'category' => 'Wildlife Reserve',
                'region' => 'Volta',
                'description' => 'Tafi Atome Monkey Sanctuary is a community-based ecotourism project that protects mona monkeys considered sacred by the local people.',
                'entry_fee' => 10.00,
                'latitude' => 7.0333,
                'longitude' => 0.4333,
            ],
        ];

        foreach ($sites as $siteData) {
            TourismSite::create([
                'name' => $siteData['name'],
                'slug' => Str::slug($siteData['name']),
                'category_id' => $categories[$siteData['category']]->id,
                'region_id' => $regions[$siteData['region']]->id,
                'description' => $siteData['description'],
                'history' => $siteData['history'] ?? null,
                'entry_fee' => $siteData['entry_fee'],
                'currency' => 'GHS',
                'opening_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opening_time' => '08:00',
                'closing_time' => '17:00',
                'latitude' => $siteData['latitude'],
                'longitude' => $siteData['longitude'],
                'is_featured' => $siteData['is_featured'] ?? false,
                'is_active' => true,
            ]);
        }

        // Hotel Admin Users and Hotels
        $hotelsData = [
            [
                'user' => ['name' => 'Golden Tulip Manager', 'email' => 'golden@hotel.com'],
                'hotel' => [
                    'name' => 'Golden Tulip Accra',
                    'region' => 'Greater Accra',
                    'address' => 'Liberation Road, Accra',
                    'description' => 'A premier 4-star hotel in the heart of Accra offering luxury accommodation, fine dining, and world-class amenities.',
                    'star_rating' => 4,
                    'facilities' => ['WiFi', 'Pool', 'Restaurant', 'Bar', 'Gym', 'Spa', 'Conference Room', 'Parking'],
                    'check_in' => '14:00', 'check_out' => '12:00',
                ],
                'rooms' => [
                    ['type' => 'Standard Room', 'price' => 450.00, 'guests' => 2, 'total' => 20, 'facilities' => ['AC', 'TV', 'WiFi', 'Minibar']],
                    ['type' => 'Deluxe Room', 'price' => 650.00, 'guests' => 2, 'total' => 15, 'facilities' => ['AC', 'TV', 'WiFi', 'Minibar', 'Balcony']],
                    ['type' => 'Executive Suite', 'price' => 1200.00, 'guests' => 3, 'total' => 5, 'facilities' => ['AC', 'TV', 'WiFi', 'Minibar', 'Living Room', 'Jacuzzi']],
                ],
            ],
            [
                'user' => ['name' => 'Cape Coast Hotel Manager', 'email' => 'ridge@hotel.com'],
                'hotel' => [
                    'name' => 'Ridge Royal Hotel',
                    'region' => 'Central',
                    'address' => 'Victoria Road, Cape Coast',
                    'description' => 'A charming hotel near Cape Coast Castle, perfect for history lovers and beach enthusiasts.',
                    'star_rating' => 3,
                    'facilities' => ['WiFi', 'Restaurant', 'Bar', 'Parking', 'Garden'],
                    'check_in' => '14:00', 'check_out' => '11:00',
                ],
                'rooms' => [
                    ['type' => 'Standard Room', 'price' => 200.00, 'guests' => 2, 'total' => 15, 'facilities' => ['AC', 'TV', 'WiFi']],
                    ['type' => 'Family Room', 'price' => 350.00, 'guests' => 4, 'total' => 8, 'facilities' => ['AC', 'TV', 'WiFi', 'Extra Bed']],
                ],
            ],
            [
                'user' => ['name' => 'Kumasi Royal Manager', 'email' => 'kumasi@hotel.com'],
                'hotel' => [
                    'name' => 'Royal Kumasi Hotel',
                    'region' => 'Ashanti',
                    'address' => 'Harper Road, Kumasi',
                    'description' => 'A luxurious hotel in the heart of Kumasi, close to Manhyia Palace and Kumasi Zoo.',
                    'star_rating' => 4,
                    'facilities' => ['WiFi', 'Pool', 'Restaurant', 'Bar', 'Gym', 'Parking', 'Shuttle Service'],
                    'check_in' => '14:00', 'check_out' => '12:00',
                ],
                'rooms' => [
                    ['type' => 'Standard Room', 'price' => 300.00, 'guests' => 2, 'total' => 25, 'facilities' => ['AC', 'TV', 'WiFi']],
                    ['type' => 'Deluxe Room', 'price' => 500.00, 'guests' => 2, 'total' => 10, 'facilities' => ['AC', 'TV', 'WiFi', 'Minibar', 'City View']],
                    ['type' => 'Presidential Suite', 'price' => 1500.00, 'guests' => 4, 'total' => 2, 'facilities' => ['AC', 'TV', 'WiFi', 'Minibar', 'Living Room', 'Kitchen']],
                ],
            ],
            [
                'user' => ['name' => 'Volta Hotel Manager', 'email' => 'volta@hotel.com'],
                'hotel' => [
                    'name' => 'Volta Serene Hotel',
                    'region' => 'Volta',
                    'address' => 'Ho-Aflao Road, Ho',
                    'description' => 'A peaceful retreat in the Volta Region, ideal for exploring waterfalls and mountains.',
                    'star_rating' => 3,
                    'facilities' => ['WiFi', 'Restaurant', 'Bar', 'Garden', 'Tour Desk'],
                    'check_in' => '13:00', 'check_out' => '11:00',
                ],
                'rooms' => [
                    ['type' => 'Standard Room', 'price' => 180.00, 'guests' => 2, 'total' => 12, 'facilities' => ['AC', 'TV', 'WiFi']],
                    ['type' => 'Cottage', 'price' => 280.00, 'guests' => 3, 'total' => 6, 'facilities' => ['AC', 'TV', 'WiFi', 'Private Patio']],
                ],
            ],
            [
                'user' => ['name' => 'Mole Lodge Manager', 'email' => 'mole@hotel.com'],
                'hotel' => [
                    'name' => 'Mole Safari Lodge',
                    'region' => 'Savannah',
                    'address' => 'Mole National Park, Damongo',
                    'description' => 'The only accommodation within Mole National Park, offering unforgettable wildlife viewing from the poolside.',
                    'star_rating' => 3,
                    'facilities' => ['WiFi', 'Pool', 'Restaurant', 'Bar', 'Safari Tours', 'Bird Watching'],
                    'check_in' => '14:00', 'check_out' => '10:00',
                ],
                'rooms' => [
                    ['type' => 'Standard Room', 'price' => 250.00, 'guests' => 2, 'total' => 20, 'facilities' => ['AC', 'TV']],
                    ['type' => 'Safari Chalet', 'price' => 400.00, 'guests' => 2, 'total' => 8, 'facilities' => ['AC', 'TV', 'Private Balcony', 'Wildlife View']],
                ],
            ],
        ];

        foreach ($hotelsData as $h) {
            $hotelUser = User::create([
                'name' => $h['user']['name'],
                'email' => $h['user']['email'],
                'phone' => '+23324' . rand(1000000, 9999999),
                'role' => 'hotel_admin',
                'status' => 'active',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            $hotel = Hotel::create([
                'user_id' => $hotelUser->id,
                'name' => $h['hotel']['name'],
                'slug' => Str::slug($h['hotel']['name']),
                'region_id' => $regions[$h['hotel']['region']]->id,
                'description' => $h['hotel']['description'],
                'address' => $h['hotel']['address'],
                'phone' => $hotelUser->phone,
                'email' => $h['user']['email'],
                'facilities' => $h['hotel']['facilities'],
                'star_rating' => $h['hotel']['star_rating'],
                'check_in_time' => $h['hotel']['check_in'],
                'check_out_time' => $h['hotel']['check_out'],
                'status' => 'approved',
            ]);

            foreach ($h['rooms'] as $r) {
                HotelRoom::create([
                    'hotel_id' => $hotel->id,
                    'room_type' => $r['type'],
                    'price_per_night' => $r['price'],
                    'max_guests' => $r['guests'],
                    'total_rooms' => $r['total'],
                    'available_rooms' => $r['total'],
                    'facilities' => $r['facilities'],
                    'is_active' => true,
                ]);
            }
        }

        // Driver Users
        $driversData = [
            ['name' => 'Kofi Mensah', 'email' => 'kofi@driver.com', 'licence' => 'DL-GH-001', 'vehicle' => ['make' => 'Toyota', 'model' => 'Hiace', 'type' => 'van', 'plate' => 'GR-1234-21', 'capacity' => 12, 'price_km' => 5.00, 'base' => 100.00]],
            ['name' => 'Ama Serwaa', 'email' => 'ama@driver.com', 'licence' => 'DL-GH-002', 'vehicle' => ['make' => 'Toyota', 'model' => 'Land Cruiser', 'type' => 'suv', 'plate' => 'AS-5678-22', 'capacity' => 7, 'price_km' => 8.00, 'base' => 150.00]],
            ['name' => 'Yaw Boateng', 'email' => 'yaw@driver.com', 'licence' => 'DL-GH-003', 'vehicle' => ['make' => 'Hyundai', 'model' => 'Accent', 'type' => 'small_car', 'plate' => 'CR-9012-23', 'capacity' => 4, 'price_km' => 3.50, 'base' => 50.00]],
        ];

        foreach ($driversData as $d) {
            $driverUser = User::create([
                'name' => $d['name'],
                'email' => $d['email'],
                'phone' => '+23324' . rand(1000000, 9999999),
                'role' => 'driver',
                'status' => 'active',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            $vehicle = Vehicle::create([
                'user_id' => $driverUser->id,
                'make' => $d['vehicle']['make'],
                'model' => $d['vehicle']['model'],
                'vehicle_type' => $d['vehicle']['type'],
                'plate_number' => $d['vehicle']['plate'],
                'capacity' => $d['vehicle']['capacity'],
                'price_per_km' => $d['vehicle']['price_km'],
                'base_price' => $d['vehicle']['base'],
                'is_available' => true,
                'status' => 'approved',
                'air_conditioned' => true,
            ]);

            Driver::create([
                'user_id' => $driverUser->id,
                'vehicle_id' => $vehicle->id,
                'licence_number' => $d['licence'],
                'experience_years' => rand(2, 15),
                'languages' => ['English', 'Twi'],
                'is_available' => true,
                'status' => 'approved',
            ]);
        }

        // Tour Guide Users
        $guidesData = [
            ['name' => 'Akua Mansa', 'email' => 'akua@guide.com', 'region' => 'Central', 'specializations' => ['Historical Tours', 'Castle Tours'], 'price_hour' => 50.00, 'price_day' => 300.00],
            ['name' => 'Kwesi Appiah', 'email' => 'kwesi@guide.com', 'region' => 'Ashanti', 'specializations' => ['Cultural Tours', 'City Tours'], 'price_hour' => 40.00, 'price_day' => 250.00],
        ];

        foreach ($guidesData as $g) {
            $guideUser = User::create([
                'name' => $g['name'],
                'email' => $g['email'],
                'phone' => '+23324' . rand(1000000, 9999999),
                'role' => 'tour_guide',
                'status' => 'active',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            TourGuide::create([
                'user_id' => $guideUser->id,
                'experience' => 'Professional tour guide with extensive knowledge of local culture and history.',
                'experience_years' => rand(3, 10),
                'languages' => ['English', 'Twi', 'French'],
                'specializations' => $g['specializations'],
                'price_per_hour' => $g['price_hour'],
                'price_per_day' => $g['price_day'],
                'is_available' => true,
                'status' => 'approved',
                'region_id' => $regions[$g['region']]->id,
            ]);
        }

        // Settings
        $settings = [
            ['key' => 'platform_name', 'value' => 'Ghana Tourism', 'group' => 'general'],
            ['key' => 'platform_email', 'value' => 'info@ghanatourism.com', 'group' => 'general'],
            ['key' => 'platform_phone', 'value' => '+233200000000', 'group' => 'general'],
            ['key' => 'default_currency', 'value' => 'GHS', 'group' => 'general'],
            ['key' => 'hotel_commission_percentage', 'value' => '10', 'group' => 'commission'],
            ['key' => 'transport_commission_percentage', 'value' => '15', 'group' => 'commission'],
            ['key' => 'guide_commission_percentage', 'value' => '10', 'group' => 'commission'],
            ['key' => 'sms_provider', 'value' => 'hubtel', 'group' => 'notifications'],
            ['key' => 'payment_gateway', 'value' => 'paystack', 'group' => 'payments'],
        ];

        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
