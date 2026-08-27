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

        return view('livewire.tour-packages-page', [
            'packages' => $packages,
            'destinations' => $destinations,
        ]);
    }
}
