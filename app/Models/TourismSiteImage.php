<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourismSiteImage extends Model
{
    use HasFactory;

    protected $fillable = ['tourism_site_id', 'image_path', 'caption', 'sort_order'];

    public function tourismSite(): BelongsTo
    {
        return $this->belongsTo(TourismSite::class);
    }
}
