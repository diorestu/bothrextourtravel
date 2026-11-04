<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'category' => fake()->randomElement(['Travel Guide', 'Itinerary', 'Tips & Trik', 'Hidden Gem']),
            'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
            'excerpt' => fake()->paragraph(2),
            'content' => fake()->paragraphs(5, true),
            'author_name' => 'Bothrex Bali Tour Team',
            'reading_time' => '5 min read',
            'views_count' => fake()->numberBetween(50, 1500),
            'is_featured' => fake()->boolean(20),
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
