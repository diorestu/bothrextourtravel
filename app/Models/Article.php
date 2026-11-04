<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'image_url',
        'excerpt',
        'content',
        'author_name',
        'reading_time',
        'views_count',
        'is_featured',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory(Builder $query, ?string $category): Builder
    {
        if (! $category || $category === 'Semua') {
            return $query;
        }

        return $query->where('category', $category);
    }

    public function getFormattedPublishedAtAttribute(): string
    {
        return ($this->published_at ?? $this->created_at)->translatedFormat('d M Y');
    }

    /**
     * Increment views count safely.
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Auto calculate reading time based on word count.
     */
    public static function calculateReadingTime(string $content): string
    {
        $words = str_word_count(strip_tags($content));
        $minutes = max(1, (int) ceil($words / 200));

        return $minutes.' min read';
    }
}
