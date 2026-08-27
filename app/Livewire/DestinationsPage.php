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
        ]);
    }
}
