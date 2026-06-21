<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'room_type', 'description', 'price_per_night',
        'currency', 'max_guests', 'total_rooms', 'available_rooms',
        'facilities', 'breakfast_included', 'image', 'is_active',
    ];

    protected $casts = [
        'facilities' => 'array',
        'breakfast_included' => 'boolean',
        'is_active' => 'boolean',
        'price_per_night' => 'decimal:2',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(HotelBooking::class);
    }
}
