<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\TourPackage;
use App\Models\Destination;

#[Layout('layouts.app')]
class TourPackagesPage extends Component
{
    #[Url]
    public $search = '';

    #[Url]
    public $destinationId = 'all';

    #[Url]
    public $category = 'all';

    #[Url]
    public $sortBy = 'popular';

    public function render()
    {
        $destinations = Destination::where('is_active', true)->get();

        $query = TourPackage::where('is_active', true)->with('destination');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->destinationId !== 'all') {
            $query->where('destination_id', $this->destinationId);
        }

        if ($this->category !== 'all') {
            $query->where('category', $this->category);
        }

        if ($this->sortBy === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($this->sortBy === 'rating') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->orderBy('is_featured', 'desc')->latest();
        }

        $packages = $query->get();

        $title = 'Daftar Paket Wisata Bali Murah & Lengkap 2026 | Bothrex Bali Tour';
        $metaDescription = 'Katalog lengkap paket liburan Bali murah & hemat 2026. Pilihan tour Nusa Penida, Ubud, Jeep Sunrise Batur, & Uluwatu dengan mobil privat + supir ramah.';

        if ($this->destinationId !== 'all') {
            $selectedDest = $destinations->firstWhere('id', $this->destinationId);
            if ($selectedDest) {
                $title = "Paket Tour Wisata {$selectedDest->name} Bali Murah | Bothrex Bali Tour";
                $metaDescription = "Pilihan paket private tour {$selectedDest->name} Bali terlengkap. Termasuk mobil ber-AC, driver lokal ramah, dan penjemputan hotel. Pesan via WA!";
            }
        } elseif (!empty($this->search)) {
            $title = "Cari Paket Tour: \"{$this->search}\" | Bothrex Bali Tour";
        }

        $metaKeywords = 'katalog paket tour bali, paket wisata bali murah 2026, harga tour bali 1 hari, private tour bali dengan supir, paket liburan bali keluarga, paket tour nusa penida, jeep sunrise batur, tour ubud murah, paket uluwatu kecak';

        return view('livewire.tour-packages-page', [
            'packages' => $packages,
            'destinations' => $destinations,
        ])->layout('layouts.app', [
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'ogImage' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
            'ogType' => 'website',
            'canonical' => url('/paket'),
        ]);
    }
}
