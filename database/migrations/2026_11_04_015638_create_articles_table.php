<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('category')->default('Travel Guide')->index();
            $table->string('image_url')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('author_name')->default('Bothrex Bali Tour Team');
            $table->string('reading_time')->default('5 min read');
            $table->unsignedInteger('views_count')->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
