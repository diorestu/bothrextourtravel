<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Destination;
use App\Models\TourPackage;

#[Layout('layouts.app')]
class HomePage extends Component
{
    public $search = '';
    public $selectedCategory = 'all';

    public function performSearch()
    {
        return redirect()->route('packages.index', [
            'search' => $this->search,
        ]);
    }

    public function render()
    {
        $destinations = Destination::where('is_active', true)->where('is_popular', true)->get();

        $query = TourPackage::where('is_active', true)->with('destination');

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $featuredPackages = $query->latest()->get();

        return view('livewire.home-page', [
            'destinations' => $destinations,
            'featuredPackages' => $featuredPackages,
        ])->layout('layouts.app', [
            'title' => 'Paket Tour Bali Murah 2026 - Agen Travel Resmi & Terpercaya | Bothrex Bali Tour',
            'metaDescription' => 'Agen resmi paket liburan Bali murah & terpercaya. Nikmati private tour Nusa Penida, Jeep Sunrise Batur, Ubud, & Uluwatu dengan mobil AC + supir ramah. Pesan via WA!',
            'metaKeywords' => 'paket tour bali murah, paket liburan bali 2026, agen tour travel bali resmi, sewa mobil bali dengan supir, tour nusa penida 1 hari, jeep batur sunrise tour, paket honeymoon bali, paket wisata bali keluarga, private tour bali all in, itinerary liburan bali, bothrex bali tour',
            'ogImage' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
            'ogType' => 'website',
            'canonical' => url('/'),
        ]);
    }
}
