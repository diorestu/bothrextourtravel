<?php

use Livewire\Component;
use App\Models\Destination;
use App\Models\TourPackage;

new class extends Component
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
        return view('components.⚡destination-detail-page');
    }
};
?>

<div>
    <!-- Hero Banner for Destination -->
    <div class="relative bg-slate-900 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
            <div class="flex items-center gap-2 text-xs text-slate-300 mb-3 justify-center sm:justify-start">
                <a href="/" class="hover:text-emerald-400">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="/destinasi" class="hover:text-emerald-400">Destinasi</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-emerald-400">{{ $destination->name }}</span>
            </div>
            <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $destination->category }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-serif-heading mt-3">
                Wisata {{ $destination->name }}
            </h1>
            <p class="text-slate-200 text-sm sm:text-base max-w-3xl mt-3 font-light leading-relaxed">
                {{ $destination->description }}
            </p>
        </div>
    </div>

    <!-- Highlights and Tour Packages List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 mb-12">
            <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-camera text-emerald-600"></i> Spot Foto & Daya Tarik Utam {{ $destination->name }}
            </h2>
            <div class="flex flex-wrap gap-2">
                @foreach($destination->highlights ?? [] as $hl)
                <span class="bg-emerald-50 text-emerald-800 text-xs font-semibold px-4 py-2 rounded-xl border border-emerald-200">
                    ✨ {{ $hl }}
                </span>
                @endforeach
            </div>
        </div>

        <h2 class="text-2xl font-extrabold text-slate-900 font-serif-heading mb-6">
            Paket Tour Tersedia di {{ $destination->name }} ({{ $destination->packages->count() }})
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($destination->packages as $pkg)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="relative h-60 overflow-hidden">
                    <img src="{{ $pkg->image_url }}" alt="{{ $pkg->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    @if($pkg->badge)
                    <div class="absolute top-4 left-4 bg-gradient-gold text-white text-xs font-extrabold px-3 py-1.5 rounded-full shadow">
                        {{ $pkg->badge }}
                    </div>
                    @endif
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2">
                            {{ $pkg->title }}
                        </h3>
                        <p class="text-slate-600 text-xs mt-2 line-clamp-3">
                            {{ $pkg->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block uppercase font-semibold">Mulai Dari</span>
                            <span class="text-lg font-extrabold text-emerald-700">Rp {{ number_format($pkg->price, 0, ',', '.') }}</span>
                        </div>
                        <a href="/paket/{{ $pkg->slug }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-dashed border-slate-300">
                <p class="text-slate-500">Belum ada paket wisata khusus untuk destinasi ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>