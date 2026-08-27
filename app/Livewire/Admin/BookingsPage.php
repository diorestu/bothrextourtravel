<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;

#[Layout('layouts.app')]
class BookingsPage extends Component
{
    public $search = '';
    public $statusFilter = 'all';

    public $selectedBooking = null;
    public $showDetailModal = false;

    public function updateStatus($bookingId, $newStatus)
    {
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->status = $newStatus;
            $booking->save();
            session()->flash('message', "Status booking {$booking->booking_code} berhasil diperbarui ke '{$newStatus}'.");
        }
    }

    public function viewDetails($bookingId)
    {
        $this->selectedBooking = Booking::with('tourPackage')->find($bookingId);
        $this->showDetailModal = true;
    }

    public function render()
    {
        $query = Booking::with('tourPackage');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('booking_code', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $bookings = $query->latest()->get();

        // Statistics
        $totalBookings = Booking::count();
        $pendingCount = Booking::where('status', 'pending')->count();
        $confirmedCount = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        return view('livewire.admin.bookings-page', [
            'bookings' => $bookings,
            'totalBookings' => $totalBookings,
            'pendingCount' => $pendingCount,
            'confirmedCount' => $confirmedCount,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
