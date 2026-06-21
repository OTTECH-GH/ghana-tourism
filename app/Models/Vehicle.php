<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'transport_company_id', 'make', 'model', 'year',
        'color', 'plate_number', 'vehicle_type', 'capacity',
        'description', 'image', 'insurance_document', 'roadworthy_document',
        'air_conditioned', 'price_per_km', 'base_price',
        'is_available', 'status',
    ];

    protected $casts = [
        'air_conditioned' => 'boolean',
        'is_available' => 'boolean',
        'price_per_km' => 'decimal:2',
        'base_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transportCompany(): BelongsTo
    {
        return $this->belongsTo(TransportCompany::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(TransportBooking::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
