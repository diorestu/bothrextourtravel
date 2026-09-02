<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Destination;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DestinationDetailPage extends Component
{
    public $slug;
    public $destination;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->destination = Destination::where('is_active', true)->with(['packages' => function($q) {
            $q->where('is_active', true);
        }])->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $highlightsList = implode(', ', array_slice($this->destination->highlights ?? [], 0, 3));
        $title = "Wisata {$this->destination->name} - Spot Favorit & Paket Liburan | Bothrex Bali Tour";
        $metaDescription = "Panduan wisata {$this->destination->name} Bali. Kunjungi spot ikonik {$highlightsList} dengan paket private tour hemat & mobil AC. Booking via WA!";
        $metaKeywords = "wisata {$this->destination->name}, paket tour {$this->destination->name}, spot foto {$this->destination->name}, tempat liburan {$this->destination->name}, liburan bali murah, private tour {$this->destination->name}, bothrex bali tour";

        return view('livewire.destination-detail-page')->layout('layouts.app', [
            'title' => $title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'ogImage' => $this->destination->image_url,
            'ogType' => 'place',
            'canonical' => url('/destinasi/' . $this->destination->slug),
        ]);
    }
}
