<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = [
        'destination_id',
        'attraction_category_id',
        'name',
        'slug',
        'location',
        'image_url',
        'description',
        'ticket_price_info',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function category()
    {
        return $this->belongsTo(AttractionCategory::class, 'attraction_category_id');
    }
}
