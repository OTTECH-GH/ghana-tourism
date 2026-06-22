@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-green-200 text-sm mb-3">
            <a href="{{ route('hotels.index') }}" class="hover:text-white">Hotels</a>
            <span class="mx-2">/</span>
            <a href="{{ route('hotels.show', $room->hotel) }}" class="hover:text-white">{{ $room->hotel->name }}</a>
            <span class="mx-2">/</span>
            <span>Book Room</span>
        </nav>
        <h1 class="text-3xl font-display font-bold">Book Your Stay</h1>
        <p class="text-green-200 mt-1">{{ $room->room_type }} at {{ $room->hotel->name }}</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <form action="{{ route('hotels.store-booking', $room) }}" method="POST" class="space-y-6">
                @csrf
                <!-- Dates & Guests -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h2 class="font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-6 h-6 bg-ghana-green text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">1</span>
                        Stay Details
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                            <input type="date" name="check_in_date" required min="{{ date('Y-m-d') }}" value="{{ old('check_in_date') }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                            @error('check_in_date') <span class="text-ghana-red text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                            <input type="date" name="check_out_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out_date') }}" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                            @error('check_out_date') <span class="text-ghana-red text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                            <input type="number" name="guests" min="1" max="{{ $room->max_guests }}" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Number of Rooms</label>
                            <input type="number" name="rooms_booked" min="1" max="{{ $room->available_rooms }}" value="1" required class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100" x-data="{ method: 'momo' }">
                    <h2 class="font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-6 h-6 bg-ghana-green text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">2</span>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="relative cursor-pointer" @click="method = 'momo'">
                            <input type="radio" name="payment_method" value="mobile_money" class="sr-only" checked>
                            <div :class="method === 'momo' ? 'border-ghana-green bg-ghana-green/5 ring-2 ring-ghana-green/20' : 'border-gray-200'" class="border-2 rounded-xl p-4 text-center transition">
                                <span class="text-2xl">📱</span>
                                <p class="font-semibold text-gray-800 mt-1 text-sm">Mobile Money</p>
                                <p class="text-xs text-gray-500">MTN, Vodafone, AirtelTigo</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer" @click="method = 'card'">
                            <input type="radio" name="payment_method" value="card" class="sr-only">
                            <div :class="method === 'card' ? 'border-ghana-green bg-ghana-green/5 ring-2 ring-ghana-green/20' : 'border-gray-200'" class="border-2 rounded-xl p-4 text-center transition">
                                <span class="text-2xl">💳</span>
                                <p class="font-semibold text-gray-800 mt-1 text-sm">Debit/Credit Card</p>
                                <p class="text-xs text-gray-500">Visa, Mastercard</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer" @click="method = 'hotel'">
                            <input type="radio" name="payment_method" value="pay_at_hotel" class="sr-only">
                            <div :class="method === 'hotel' ? 'border-ghana-green bg-ghana-green/5 ring-2 ring-ghana-green/20' : 'border-gray-200'" class="border-2 rounded-xl p-4 text-center transition">
                                <span class="text-2xl">🏨</span>
                                <p class="font-semibold text-gray-800 mt-1 text-sm">Pay at Hotel</p>
                                <p class="text-xs text-gray-500">Cash or card on arrival</p>
                            </div>
                        </label>
                    </div>

                    <!-- Mobile Money Details -->
                    <div x-show="method === 'momo'" x-cloak class="mt-4 p-4 bg-ghana-gold/5 rounded-lg border border-ghana-gold/20">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Network</label>
                                <select name="momo_network" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                                    <option value="mtn">MTN Mobile Money</option>
                                    <option value="vodafone">Vodafone Cash</option>
                                    <option value="airteltigo">AirtelTigo Money</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" name="momo_number" placeholder="024 XXX XXXX" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green">
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">You will receive a payment prompt on your phone. Approve to complete the booking.</p>
                    </div>
                </div>

                <!-- Special Requests -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h2 class="font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-6 h-6 bg-ghana-green text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">3</span>
                        Additional Information
                    </h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Special Requests (Optional)</label>
                        <textarea name="special_requests" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-ghana-green focus:border-ghana-green" placeholder="Any special requests — early check-in, extra bed, dietary needs...">{{ old('special_requests') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="w-full bg-ghana-green text-white py-4 rounded-xl hover:bg-primary-700 font-bold text-lg transition shadow-lg">
                    Confirm Booking
                </button>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 sticky top-20">
                <h3 class="font-bold text-gray-800 mb-4">Booking Summary</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Hotel</dt><dd class="font-medium text-right">{{ $room->hotel->name }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Room Type</dt><dd class="font-medium text-right">{{ $room->room_type }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Price/Night</dt><dd class="font-bold text-ghana-green">GHS {{ number_format($room->price_per_night, 2) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Max Guests</dt><dd>{{ $room->max_guests }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Available</dt><dd>{{ $room->available_rooms }} rooms</dd></div>
                </dl>
                <hr class="my-4">
                <div class="bg-ghana-gold/10 rounded-lg p-3 text-center">
                    <p class="text-xs text-gray-500 mb-1">Estimated Total</p>
                    <p class="text-2xl font-bold text-ghana-green">GHS {{ number_format($room->price_per_night, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">per night per room</p>
                </div>
                <div class="mt-4 text-xs text-gray-500 space-y-1">
                    <p class="flex items-center"><svg class="w-3.5 h-3.5 text-ghana-green mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Free cancellation (24h before)</p>
                    <p class="flex items-center"><svg class="w-3.5 h-3.5 text-ghana-green mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Instant confirmation</p>
                    <p class="flex items-center"><svg class="w-3.5 h-3.5 text-ghana-green mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Secure payment</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
