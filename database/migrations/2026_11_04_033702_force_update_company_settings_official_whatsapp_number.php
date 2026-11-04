<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('company_settings')) {
            DB::table('company_settings')->update([
                'phone' => '0851-5643-2635',
                'whatsapp_number' => '6285156432635',
                'whatsapp_number_2' => null,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed as official number is persistent
    }
};
