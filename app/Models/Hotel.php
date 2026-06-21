<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug', 'region_id', 'district_id',
        'description', 'address', 'latitude', 'longitude',
        'phone', 'email', 'website', 'facilities', 'featured_image',
        'star_rating', 'check_in_time', 'check_out_time',
        'cancellation_policy', 'status', 'business_document',
        'avg_rating', 'total_reviews', 'is_featured',
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_featured' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(HotelRoom::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(HotelImage::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function tourismSites(): BelongsToMany
    {
        return $this->belongsToMany(TourismSite::class, 'hotel_tourism_site')
            ->withPivot('distance_km')
            ->withTimestamps();
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function cheapestRoom()
    {
        return $this->rooms()->where('is_active', true)->orderBy('price_per_night')->first();
    }

    public function updateRating(): void
    {
        $this->avg_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
}
