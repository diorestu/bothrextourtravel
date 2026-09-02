<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Destination;

#[Layout('layouts.app')]
class DestinationsPage extends Component
{
    public $search = '';

    public function render()
    {
        $query = Destination::where('is_active', true)->with(['packages' => function($q) {
            $q->where('is_active', true);
        }]);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });
        }

        $destinations = $query->get();

        return view('livewire.destinations-page', [
            'destinations' => $destinations,
        ])->layout('layouts.app', [
            'title' => 'Destinasi & Tempat Wisata Populer di Bali 2026 | Bothrex Bali Tour',
            'metaDescription' => 'Panduan lengkap destinasi wisata favorit di Bali: Nusa Penida, Ubud, Kintamani, Bedugul, Uluwatu & Benoa. Nikmati paket private tour dengan supir lokal ramah.',
            'metaKeywords' => 'destinasi wisata bali 2026, tempat liburan favorit di bali, tempat wisata nusa penida, spot foto ubud bali, objek wisata kintamani batur, wisata bedugul bali, pantai uluwatu, bothrex bali tour',
            'ogImage' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
            'ogType' => 'website',
            'canonical' => url('/destinasi'),
        ]);
    }
}
