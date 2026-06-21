<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'user_id', 'subject', 'message',
        'complaintable_type', 'complaintable_id',
        'status', 'priority', 'assigned_to', 'resolution', 'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function complaintable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function generateReference(): string
    {
        return 'CMP-' . strtoupper(uniqid());
    }
}
