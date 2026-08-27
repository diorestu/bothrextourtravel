<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'tagline',
        'phone',
        'whatsapp_number',
        'email',
        'address',
        'operating_hours',
        'about_text',
        'instagram_url',
        'facebook_url',
        'tiktok_url',
        'youtube_url',
        'bank_info',
    ];

    public static function getSettings()
    {
        return static::firstOrCreate([], [
            'company_name' => 'Bothrex Bali Tour',
            'tagline' => 'Agen Tour & Travel Resmi Bali #1',
            'phone' => '+62 812-3456-7890',
            'whatsapp_number' => '6281234567890',
            'email' => 'info@bothrexbalitour.com',
            'address' => 'Jl. Raya Kuta No. 88, Badung, Bali',
            'operating_hours' => 'Senin - Minggu: 07:00 - 22:00 WITA',
            'about_text' => 'Agen Tour & Travel resmi spesialis liburan Pulau Bali. Kami siap memberikan pengalaman liburan tak terlupakan dengan layanan kendaraan privat, supir lokal berpengalaman, dan harga transparan terbaik.',
            'instagram_url' => 'https://instagram.com',
            'facebook_url' => 'https://facebook.com',
            'tiktok_url' => 'https://tiktok.com',
            'youtube_url' => 'https://youtube.com',
            'bank_info' => "BCA: 123-456-7890 a/n Bothrex Bali Tour\nMandiri: 987-654-3210 a/n Bothrex Bali Tour",
        ]);
    }
}
