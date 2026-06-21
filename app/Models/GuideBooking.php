<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class GuideBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference', 'user_id', 'tour_guide_id',
        'transport_booking_id', 'booking_date', 'start_time',
        'duration_hours', 'total_amount', 'currency', 'status', 'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tourGuide(): BelongsTo
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function transportBooking(): BelongsTo
    {
        return $this->belongsTo(TransportBooking::class);
    }

    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    public static function generateReference(): string
    {
        return 'GDE-' . strtoupper(uniqid());
    }
}
