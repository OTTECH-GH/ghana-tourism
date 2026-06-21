<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TransportBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference', 'user_id', 'driver_id', 'vehicle_id',
        'pickup_location', 'pickup_latitude', 'pickup_longitude',
        'trip_date', 'trip_time', 'passengers', 'vehicle_type',
        'return_trip', 'full_day',
        'estimated_distance_km', 'estimated_duration_hours',
        'estimated_amount', 'final_amount', 'currency',
        'status', 'trip_started_at', 'trip_ended_at',
        'platform_commission', 'notes',
    ];

    protected $casts = [
        'trip_date' => 'date',
        'return_trip' => 'boolean',
        'full_day' => 'boolean',
        'trip_started_at' => 'datetime',
        'trip_ended_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function destinations(): HasMany
    {
        return $this->hasMany(TripDestination::class)->orderBy('stop_order');
    }

    public function tracking(): HasMany
    {
        return $this->hasMany(TripTracking::class);
    }

    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function complaints(): MorphMany
    {
        return $this->morphMany(Complaint::class, 'complaintable');
    }

    public static function generateReference(): string
    {
        return 'TRP-' . strtoupper(uniqid());
    }
}
