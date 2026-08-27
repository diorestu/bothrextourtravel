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
        Schema::table('destinations', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_popular');
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
