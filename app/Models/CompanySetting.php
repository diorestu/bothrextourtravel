<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    public const OFFICIAL_WHATSAPP_NUMBER = '6285156432635';

    public const OFFICIAL_PHONE = '0851-5643-2635';

    protected $fillable = [
        'company_name',
        'tagline',
        'phone',
        'whatsapp_number',
        'whatsapp_number_2',
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

    /**
     * Always guarantee official WhatsApp number even if database contains old/dummy numbers.
     */
    public function getWhatsappNumberAttribute(?string $value): string
    {
        if (empty($value) || in_array($value, [
            '6281234567890',
            '6281338374254',
            '6281246376329',
            '+62 812-3456-7890',
            '081234567890',
            '081338374254',
            '081246376329',
        ])) {
            return self::OFFICIAL_WHATSAPP_NUMBER;
        }

        $clean = preg_replace('/[^0-9]/', '', $value);

        return $clean ?: self::OFFICIAL_WHATSAPP_NUMBER;
    }

    /**
     * Always guarantee official phone number formatting.
     */
    public function getPhoneAttribute(?string $value): string
    {
        if (empty($value) || str_contains($value, '812-3456') || str_contains($value, '813-3837') || str_contains($value, '812-4637')) {
            return self::OFFICIAL_PHONE;
        }

        return $value;
    }

    public static function getSettings()
    {
        $settings = static::first();

        if (! $settings) {
            return static::create([
                'company_name' => 'Bothrex Bali Tour & Travel',
                'tagline' => 'Agen Tour & Travel Resmi Bali #1',
                'phone' => self::OFFICIAL_PHONE,
                'whatsapp_number' => self::OFFICIAL_WHATSAPP_NUMBER,
                'whatsapp_number_2' => null,
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

        // Auto self-heal: if production database still has legacy/dummy contact number, force update it
        $rawWa = $settings->getRawOriginal('whatsapp_number');
        if (in_array($rawWa, ['6281234567890', '6281338374254', '6281246376329', '+62 812-3456-7890', null])
            || $settings->getRawOriginal('whatsapp_number_2') !== null) {
            $settings->update([
                'phone' => self::OFFICIAL_PHONE,
                'whatsapp_number' => self::OFFICIAL_WHATSAPP_NUMBER,
                'whatsapp_number_2' => null,
            ]);
        }

        return $settings;
    }
}
