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
        'number_of_guests',
        'total_price',
        'pickup_location',
        'special_notes',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
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

    public function getWhatsappLinkAttribute()
    {
        $adminPhone = '6281234567890'; // Destination WhatsApp number
        $packageTitle = $this->tourPackage ? $this->tourPackage->title : 'Paket Tour Bali';
        $formattedDate = $this->travel_date ? $this->travel_date->format('d M Y') : '-';
        $totalFormatted = $this->formatted_total_price;

        $message = "Halo Admin Bothrex Bali Tour! 👋\n\n";
        $message .= "Saya ingin konfirmasi pembayaran & reservasi tour dengan rincian berikut:\n\n";
        $message .= "📌 *Kode Booking:* {$this->booking_code}\n";
        $message .= "🌴 *Paket Tour:* {$packageTitle}\n";
        $message .= "👤 *Nama Pemesan:* {$this->customer_name}\n";
        $message .= "📞 *No. WhatsApp:* {$this->customer_phone}\n";
        $message .= "📅 *Tanggal Tour:* {$formattedDate}\n";
        $message .= "👥 *Jumlah Peserta:* {$this->number_of_guests} Orang\n";
        $message .= "📍 *Lokasi Penjemputan:* " . ($this->pickup_location ?: 'Diinfokan kemudian') . "\n";
        $message .= "💰 *Total Pembayaran:* {$totalFormatted}\n\n";
        if ($this->special_notes) {
            $message .= "📝 *Catatan:* {$this->special_notes}\n\n";
        }
        $message .= "Mohon informasi instruksi rekening pembayaran. Terima kasih!";

        return "https://wa.me/{$adminPhone}?text=" . urlencode($message);
    }
}
