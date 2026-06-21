<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DriverPanel;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelAdmin;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourismSiteController;
use App\Http\Controllers\Tourist;
use App\Http\Controllers\TransportController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Tourism Sites
Route::get('/tourism-sites', [TourismSiteController::class, 'index'])->name('tourism.index');
Route::get('/tourism-sites/{tourismSite:slug}', [TourismSiteController::class, 'show'])->name('tourism.show');
Route::get('/regions/{region:slug}', [TourismSiteController::class, 'byRegion'])->name('tourism.region');
Route::get('/categories/{category:slug}', [TourismSiteController::class, 'byCategory'])->name('tourism.category');

// Hotels (public browsing)
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel:slug}', [HotelController::class, 'show'])->name('hotels.show');

// Transport (public browsing)
Route::get('/transport', [TransportController::class, 'index'])->name('transport.index');
Route::get('/trip-planner', [TransportController::class, 'tripPlanner'])->name('transport.planner');

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'super_admin' => redirect()->route('admin.dashboard'),
        'hotel_admin' => redirect()->route('hotel-admin.dashboard'),
        'driver' => redirect()->route('driver.dashboard'),
        'tour_guide' => redirect()->route('tourist.bookings'),
        default => redirect()->route('tourist.bookings'),
    };
})->middleware(['auth'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Hotel booking (auth required)
    Route::get('/hotels/rooms/{room}/book', [HotelController::class, 'bookRoom'])->name('hotels.book');
    Route::post('/hotels/rooms/{room}/book', [HotelController::class, 'storeBooking'])->name('hotels.store-booking');

    // Transport booking (auth required)
    Route::get('/transport/book', [TransportController::class, 'book'])->name('transport.book');
    Route::post('/transport/book', [TransportController::class, 'storeBooking'])->name('transport.store-booking');

    // Tourist routes
    Route::prefix('my')->group(function () {
        Route::get('/bookings', [Tourist\DashboardController::class, 'bookings'])->name('tourist.bookings');
        Route::get('/trips', [Tourist\DashboardController::class, 'trips'])->name('tourist.trips');
        Route::get('/reviews', [Tourist\DashboardController::class, 'reviews'])->name('tourist.reviews');
        Route::post('/reviews', [Tourist\DashboardController::class, 'storeReview'])->name('tourist.store-review');
        Route::patch('/bookings/{booking}/cancel', [Tourist\DashboardController::class, 'cancelBooking'])->name('tourist.cancel-booking');
        Route::patch('/trips/{booking}/cancel', [Tourist\DashboardController::class, 'cancelTrip'])->name('tourist.cancel-trip');
    });
});

// Admin Routes
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Tourism Sites Management
    Route::resource('tourism-sites', Admin\TourismSiteController::class)->names('tourism-sites');

    // Users Management
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [Admin\UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/status', [Admin\UserController::class, 'updateStatus'])->name('users.update-status');

    // Approvals
    Route::get('/approvals', [Admin\ApprovalController::class, 'index'])->name('approvals.index');
    Route::patch('/approvals/hotels/{hotel}/approve', [Admin\ApprovalController::class, 'approveHotel'])->name('approvals.approve-hotel');
    Route::patch('/approvals/hotels/{hotel}/reject', [Admin\ApprovalController::class, 'rejectHotel'])->name('approvals.reject-hotel');
    Route::patch('/approvals/drivers/{driver}/approve', [Admin\ApprovalController::class, 'approveDriver'])->name('approvals.approve-driver');
    Route::patch('/approvals/drivers/{driver}/reject', [Admin\ApprovalController::class, 'rejectDriver'])->name('approvals.reject-driver');
    Route::patch('/approvals/guides/{tourGuide}/approve', [Admin\ApprovalController::class, 'approveGuide'])->name('approvals.approve-guide');
    Route::patch('/approvals/guides/{tourGuide}/reject', [Admin\ApprovalController::class, 'rejectGuide'])->name('approvals.reject-guide');

    // Bookings
    Route::get('/bookings/hotel', [Admin\BookingController::class, 'hotelBookings'])->name('bookings.hotel');
    Route::get('/bookings/transport', [Admin\BookingController::class, 'transportBookings'])->name('bookings.transport');

    // Payments
    Route::get('/payments', [Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/refunds', [Admin\PaymentController::class, 'refunds'])->name('payments.refunds');
    Route::get('/payments/payouts', [Admin\PaymentController::class, 'payouts'])->name('payments.payouts');

    // Reports
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
});

// Hotel Admin Routes
Route::middleware(['auth', 'role:hotel_admin'])->prefix('hotel-admin')->name('hotel-admin.')->group(function () {
    Route::get('/dashboard', [HotelAdmin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/register-hotel', [HotelAdmin\DashboardController::class, 'create'])->name('create');
    Route::post('/register-hotel', [HotelAdmin\DashboardController::class, 'store'])->name('store');
    Route::get('/rooms', [HotelAdmin\DashboardController::class, 'rooms'])->name('rooms');
    Route::get('/rooms/create', [HotelAdmin\DashboardController::class, 'createRoom'])->name('rooms.create');
    Route::post('/rooms', [HotelAdmin\DashboardController::class, 'storeRoom'])->name('rooms.store');
    Route::get('/bookings', [HotelAdmin\DashboardController::class, 'bookings'])->name('bookings');
    Route::patch('/bookings/{booking}/confirm', [HotelAdmin\DashboardController::class, 'confirmBooking'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/reject', [HotelAdmin\DashboardController::class, 'rejectBooking'])->name('bookings.reject');
});

// Driver Routes
Route::middleware(['auth', 'role:driver'])->prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', [DriverPanel\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/register', [DriverPanel\DashboardController::class, 'register'])->name('register');
    Route::post('/register', [DriverPanel\DashboardController::class, 'storeRegistration'])->name('store-registration');
    Route::get('/available-trips', [DriverPanel\DashboardController::class, 'availableTrips'])->name('available-trips');
    Route::patch('/trips/{booking}/accept', [DriverPanel\DashboardController::class, 'acceptTrip'])->name('accept-trip');
    Route::patch('/trips/{booking}/start', [DriverPanel\DashboardController::class, 'startTrip'])->name('start-trip');
    Route::patch('/trips/{booking}/end', [DriverPanel\DashboardController::class, 'endTrip'])->name('end-trip');
    Route::get('/earnings', [DriverPanel\DashboardController::class, 'earnings'])->name('earnings');
});

require __DIR__.'/auth.php';
