<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_reference', 'user_id', 'payable_type', 'payable_id',
        'amount', 'currency', 'payment_method', 'provider',
        'provider_reference', 'status', 'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commission(): HasOne
    {
        return $this->hasOne(Commission::class);
    }

    public function refund(): HasOne
    {
        return $this->hasOne(Refund::class);
    }

    public static function generateReference(): string
    {
        return 'PAY-' . strtoupper(uniqid());
    }
}
