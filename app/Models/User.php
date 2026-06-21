<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'avatar',
        'bio',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isHotelAdmin(): bool
    {
        return $this->role === 'hotel_admin';
    }

    public function isDriver(): bool
    {
        return $this->role === 'driver';
    }

    public function isTourGuide(): bool
    {
        return $this->role === 'tour_guide';
    }

    public function isTransportCompany(): bool
    {
        return $this->role === 'transport_company';
    }

    public function isTourist(): bool
    {
        return $this->role === 'tourist';
    }

    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class);
    }

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function tourGuide(): HasOne
    {
        return $this->hasOne(TourGuide::class);
    }

    public function transportCompany(): HasOne
    {
        return $this->hasOne(TransportCompany::class);
    }

    public function hotelBookings(): HasMany
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function transportBookings(): HasMany
    {
        return $this->hasMany(TransportBooking::class);
    }

    public function guideBookings(): HasMany
    {
        return $this->hasMany(GuideBooking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
