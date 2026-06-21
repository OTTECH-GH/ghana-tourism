<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TourismSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category_id', 'region_id', 'district_id',
        'description', 'history', 'entry_fee', 'currency',
        'opening_days', 'opening_time', 'closing_time',
        'contact_phone', 'contact_email', 'website',
        'latitude', 'longitude', 'address',
        'rules', 'safety_info', 'featured_image',
        'is_featured', 'is_active', 'avg_rating', 'total_reviews',
    ];

    protected $casts = [
        'opening_days' => 'array',
        'entry_fee' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TourismCategory::class, 'category_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(TourismSiteImage::class);
    }

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_tourism_site')
            ->withPivot('distance_km')
            ->withTimestamps();
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
