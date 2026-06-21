<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'experience', 'experience_years', 'languages',
        'specializations', 'price_per_hour', 'price_per_day',
        'currency', 'photo', 'id_document',
        'is_available', 'status', 'avg_rating',
        'total_reviews', 'total_bookings', 'region_id',
    ];

    protected $casts = [
        'languages' => 'array',
        'specializations' => 'array',
        'is_available' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(GuideBooking::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function updateRating(): void
    {
        $this->avg_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
}
