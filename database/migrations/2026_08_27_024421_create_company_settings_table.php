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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Bothrex Bali Tour');
            $table->string('tagline')->nullable()->default('Agen Tour & Travel Resmi Bali #1');
            $table->string('phone')->nullable()->default('+62 812-3456-7890');
            $table->string('whatsapp_number')->nullable()->default('6281234567890');
            $table->string('email')->nullable()->default('info@bothrexbalitour.com');
            $table->string('address')->nullable()->default('Jl. Raya Kuta No. 88, Badung, Bali');
            $table->string('operating_hours')->nullable()->default('Senin - Minggu: 07:00 - 22:00 WITA');
            $table->text('about_text')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('bank_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
