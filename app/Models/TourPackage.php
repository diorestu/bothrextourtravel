<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $fillable = [
        'destination_id',
        'title',
        'slug',
        'category',
        'duration',
        'price',
        'original_price',
        'badge',
        'rating',
        'review_count',
        'image_url',
        'gallery',
        'description',
        'itinerary',
        'inclusions',
        'exclusions',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'float',
        'original_price' => 'float',
    ];

    protected $appends = [
        'published_price',
        'published_original_price',
        'usd_price',
        'usd_original_price',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Published price (+10% from database price)
     */
    public function getPublishedPriceAttribute(): float
    {
        return (float) round(($this->price ?? 0) * 1.10);
    }

    /**
     * Published original price (+10% from database original_price)
     */
    public function getPublishedOriginalPriceAttribute(): ?float
    {
        return $this->original_price ? (float) round($this->original_price * 1.10) : null;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        return $this->original_price ? 'Rp '.number_format($this->original_price, 0, ',', '.') : null;
    }

    public function getFormattedPublishedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->published_price, 0, ',', '.');
    }

    public function getFormattedPublishedOriginalPriceAttribute(): ?string
    {
        return $this->published_original_price ? 'Rp '.number_format($this->published_original_price, 0, ',', '.') : null;
    }

    public const USD_EXCHANGE_RATE = 18150;

    /**
     * Estimated USD Price ($1 = Rp 18,150)
     */
    public function getUsdPriceAttribute(): float
    {
        return (float) round($this->published_price / self::USD_EXCHANGE_RATE);
    }

    public function getUsdOriginalPriceAttribute(): ?float
    {
        return $this->published_original_price ? (float) round($this->published_original_price / self::USD_EXCHANGE_RATE) : null;
    }

    public function getFormattedUsdPriceAttribute(): string
    {
        return '$ '.number_format($this->usd_price, 0);
    }

    public function getFormattedUsdOriginalPriceAttribute(): ?string
    {
        return $this->usd_original_price ? '$ '.number_format($this->usd_original_price, 0) : null;
    }
}
