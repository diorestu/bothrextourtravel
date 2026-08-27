<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Destination;

#[Layout('layouts.app')]
class DestinationDetailPage extends Component
{
    public $slug;
    public $destination;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->destination = Destination::with('packages')->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.destination-detail-page');
    }
}
