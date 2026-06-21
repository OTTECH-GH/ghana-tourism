<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_booking_id', 'tourism_site_id', 'destination_name',
        'latitude', 'longitude', 'stop_order', 'estimated_wait_minutes',
    ];

    public function transportBooking(): BelongsTo
    {
        return $this->belongsTo(TransportBooking::class);
    }

    public function tourismSite(): BelongsTo
    {
        return $this->belongsTo(TourismSite::class);
    }
}
