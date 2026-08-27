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
        ]);
    }
}
