<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }
}
