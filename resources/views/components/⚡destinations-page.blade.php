<?php

use Livewire\Component;
use App\Models\Destination;

new class extends Component
{
    public $search = '';

    public function render()
    {
        $query = Destination::with('packages');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
        }

        $destinations = $query->get();

        return view('components.⚡destinations-page', [
            'destinations' => $destinations,
        ]);
    }
};
?>

<div>
    <!-- Banner Header -->
    <div class="bg-slate-900 text-white py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Jelajahi Pulau Bali</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-serif-heading mt-1">Tujuan & Spot Wisata Populer</h1>
            <p class="text-slate-300 max-w-2xl mx-auto mt-3 text-sm sm:text-base">
                Temukan pesona alam pantai eksotis, gunung purba, pura terapung, dan kebudayaan seni Bali yang memesona.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Bar -->
        <div class="max-w-md mx-auto mb-12">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari destinasi (Ubud, Nusa Penida, Kintamani)..." 
                       class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-xs sm:text-sm shadow-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>
        </div>

        <!-- Grid Destinasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($destinations as $dest)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            {{ $dest->category }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <span class="text-xs text-amber-600 font-semibold block mb-1">
                            <i class="fa-solid fa-location-dot mr-1"></i> {{ $dest->location }}
                        </span>
                        <h3 class="text-2xl font-bold font-serif-heading text-slate-900 group-hover:text-emerald-600 transition-colors">
                            {{ $dest->name }}
                        </h3>
                        <p class="text-slate-600 text-xs mt-3 line-clamp-3 leading-relaxed">
                            {{ $dest->description }}
                        </p>

                        <!-- Highlights tags -->
                        <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap gap-1.5">
                            @foreach($dest->highlights ?? [] as $hl)
                            <span class="bg-slate-100 text-slate-700 text-[10px] font-semibold px-2.5 py-1 rounded-lg">
                                • {{ $hl }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">
                            {{ $dest->packages->count() }} Paket Tour Tersedia
                        </span>
                        <a href="/destinasi/{{ $dest->slug }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all shadow">
                            Eksplor <i class="fa-solid fa-arrow-right text-[10px] ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-dashed border-slate-300">
                <p class="text-slate-500">Destinasi tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>