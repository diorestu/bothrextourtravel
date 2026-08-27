<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TourPackage;
use App\Models\Booking;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class TourPackageDetailPage extends Component
{
    public $slug;
    public $package;

    // Form fields
    public $customer_name = '';
    public $customer_email = '';
    public $customer_phone = '';
    public $travel_date = '';
    public $number_of_guests = 2;
    public $pickup_location = '';
    public $special_notes = '';

    // Success modal state
    public $createdBooking = null;
    public $showSuccessModal = false;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->package = TourPackage::with('destination')->where('slug', $slug)->firstOrFail();
        $this->travel_date = date('Y-m-d', strtotime('+2 days'));
    }

    public function calculateTotal()
    {
        $guests = max(1, (int)$this->number_of_guests);
        return $guests * $this->package->price;
    }

    public function submitBooking()
    {
        $this->validate([
            'customer_name' => 'required|string|min:3|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|min:8|max:20',
            'travel_date' => 'required|date|after_or_equal:today',
            'number_of_guests' => 'required|integer|min:1|max:50',
            'pickup_location' => 'nullable|string|max:255',
            'special_notes' => 'nullable|string|max:500',
        ], [
            'customer_name.required' => 'Nama pemesan wajib diisi.',
            'customer_email.required' => 'Email pemesan wajib diisi.',
            'customer_phone.required' => 'Nomor WhatsApp wajib diisi.',
            'travel_date.required' => 'Tanggal tour wajib dipilih.',
            'number_of_guests.min' => 'Jumlah peserta minimal 1 orang.',
        ]);

        $bookingCode = 'BALI-' . date('Ym') . '-' . strtoupper(Str::random(4));
        $totalPrice = $this->calculateTotal();

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'tour_package_id' => $this->package->id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'travel_date' => $this->travel_date,
            'number_of_guests' => $this->number_of_guests,
            'total_price' => $totalPrice,
            'pickup_location' => $this->pickup_location,
            'special_notes' => $this->special_notes,
            'status' => 'pending',
        ]);

        $this->createdBooking = $booking;
        $this->showSuccessModal = true;
    }

    public function render()
    {
        return view('livewire.tour-package-detail-page');
    }
}
