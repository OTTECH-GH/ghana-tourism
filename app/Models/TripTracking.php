<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripTracking extends Model
{
    use HasFactory;

    protected $table = 'trip_tracking';

    protected $fillable = [
        'transport_booking_id', 'latitude', 'longitude',
        'speed_kmh', 'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function transportBooking(): BelongsTo
    {
        return $this->belongsTo(TransportBooking::class);
    }
}
