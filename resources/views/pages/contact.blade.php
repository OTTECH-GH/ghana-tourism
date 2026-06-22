@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="bg-gradient-to-br from-ghana-green via-primary-700 to-primary-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-display font-bold mb-3">Contact Us</h1>
        <p class="text-green-200 text-lg">Have questions? We're here to help you plan your perfect Ghana experience.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-3 gap-12">
        <!-- Contact Info -->
        <div class="space-y-6">
            <div>
                <h3 class="font-bold text-lg text-gray-800 mb-4">Get in Touch</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-ghana-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Email</p>
                            <p class="text-gray-600 text-sm">info@ghanatourism.com</p>
                            <p class="text-gray-600 text-sm">support@ghanatourism.com</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-ghana-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Phone</p>
                            <p class="text-gray-600 text-sm">+233 20 000 0000</p>
                            <p class="text-gray-600 text-sm">+233 30 200 0000</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-ghana-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Office</p>
                            <p class="text-gray-600 text-sm">Tourism House, Ridge</p>
                            <p class="text-gray-600 text-sm">Accra, Ghana</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-ghana-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-ghana-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Hours</p>
                            <p class="text-gray-600 text-sm">Mon - Fri: 8:00 AM - 5:00 PM</p>
                            <p class="text-gray-600 text-sm">Sat: 9:00 AM - 1:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-ghana-gold/10 rounded-xl p-5 border border-ghana-gold/20">
                <h4 class="font-bold text-gray-800 mb-2">24/7 Tourist Helpline</h4>
                <p class="text-gray-600 text-sm mb-2">For urgent assistance while traveling in Ghana:</p>
                <p class="text-ghana-green font-bold text-lg">+233 30 268 2601</p>
                <p class="text-gray-500 text-xs mt-1">Ghana Tourism Authority</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <h3 class="font-bold text-xl text-gray-800 mb-6">Send Us a Message</h3>
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 focus:border-ghana-green focus:ring-ghana-green">
                            @error('name')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-gray-300 focus:border-ghana-green focus:ring-ghana-green">
                            @error('email')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <select name="subject" required class="w-full rounded-lg border-gray-300 focus:border-ghana-green focus:ring-ghana-green">
                            <option value="">Select a subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Booking Help">Booking Help</option>
                            <option value="Partnership">Partnership Opportunity</option>
                            <option value="Complaint">Complaint</option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Press & Media">Press & Media</option>
                        </select>
                        @error('subject')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="5" required class="w-full rounded-lg border-gray-300 focus:border-ghana-green focus:ring-ghana-green" placeholder="How can we help you?">{{ old('message') }}</textarea>
                        @error('message')<p class="text-ghana-red text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="bg-ghana-green text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition shadow-sm w-full md:w-auto">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
