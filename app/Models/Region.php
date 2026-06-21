<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'capital', 'description', 'image'];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function tourismSites(): HasMany
    {
        return $this->hasMany(TourismSite::class);
    }

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }
}
