<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'tour_package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'travel_date',
        'duration_days',
        'number_of_guests',
        'total_price',
        'pickup_location',
        'special_notes',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'duration_days' => 'integer',
        'total_price' => 'float',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getWhatsappMessageAttribute()
    {
        $packageTitle = $this->tourPackage ? $this->tourPackage->title : 'Paket Tour Bali';
        $formattedDate = $this->travel_date ? $this->travel_date->format('d M Y') : '-';
        $totalFormatted = $this->formatted_total_price;
        $days = $this->duration_days ?: 1;

        $packageTag = '[WEB-TOUR]';
        if (preg_match('/\[(WEB-TOUR-[A-Z0-9\-]+?)(?:-[0-9]+-[0-9]+)?\]/', $this->booking_code, $matches)) {
            $packageTag = '[' . $matches[1] . ']';
        } elseif ($this->tourPackage) {
            $titleLower = strtolower($this->tourPackage->title . ' ' . $this->tourPackage->slug);
            if (str_contains($titleLower, 'kintamani') || str_contains($titleLower, 'batur')) {
                $packageTag = '[WEB-TOUR-KINTAMANI]';
            } elseif (str_contains($titleLower, 'ubud')) {
                $packageTag = '[WEB-TOUR-UBUD]';
            } elseif (str_contains($titleLower, 'bedugul')) {
                $packageTag = '[WEB-TOUR-BEDUGUL]';
            } elseif (str_contains($titleLower, 'uluwatu')) {
                $packageTag = '[WEB-TOUR-ULUWATU]';
            } elseif (str_contains($titleLower, 'nusa')) {
                $packageTag = '[WEB-TOUR-NUSA-PENIDA]';
            } else {
                $packageTag = '[WEB-TOUR-' . strtoupper(\Illuminate\Support\Str::slug($this->tourPackage->title)) . ']';
            }
        }

        $message = "{$packageTag}\n\n";
        $message .= "Halo Admin Bothrex Bali Tour! 👋\n\n";
        $message .= "Saya ingin konfirmasi reservasi tour dengan rincian berikut:\n\n";
        $message .= "📌 *Kode Booking:* {$this->booking_code}\n";
        $message .= "🌴 *Paket Tour:* {$packageTitle}\n";
        $message .= "👤 *Nama Pemesan:* {$this->customer_name}\n";
        $message .= "📞 *No. WhatsApp:* {$this->customer_phone}\n";
        $message .= "📅 *Tanggal Mulai Tour:* {$formattedDate}\n";
        $message .= "⏱️ *Durasi Tour:* {$days} Hari\n";
        $message .= "👥 *Jumlah Peserta:* {$this->number_of_guests} Orang\n";
        $message .= "📍 *Lokasi Penjemputan:* " . ($this->pickup_location ?: 'Diinfokan kemudian') . "\n";
        $message .= "💰 *Estimasi Total Biaya:* {$totalFormatted} ({$this->number_of_guests} org x {$days} hari)\n\n";
        if ($this->special_notes) {
            $message .= "📝 *Catatan:* {$this->special_notes}\n\n";
        }
        $message .= "Mohon informasi instruksi rekening pembayaran. Terima kasih!";

        return $message;
    }

    public function getWhatsappLinkAttribute()
    {
        $settings = CompanySetting::getSettings();
        $adminPhone = $settings->whatsapp_number ?: '6281338374254';

        return "https://wa.me/{$adminPhone}?text=" . urlencode($this->whatsapp_message);
    }

    public function getWhatsappLink2Attribute()
    {
        $settings = CompanySetting::getSettings();
        $adminPhone2 = $settings->whatsapp_number_2 ?: '6281246376329';

        return "https://wa.me/{$adminPhone2}?text=" . urlencode($this->whatsapp_message);
    }
}
