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

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute()
    {
        return $this->original_price ? 'Rp ' . number_format($this->original_price, 0, ',', '.') : null;
    }
}
