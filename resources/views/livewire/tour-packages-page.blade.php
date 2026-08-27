<div>
    <!-- Header Banner -->
    <div class="bg-slate-900 text-white py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Katalog Lengkap</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-serif-heading mt-1">Paket Wisata & Tour Bali</h1>
            <p class="text-slate-300 max-w-2xl mx-auto mt-3 text-sm sm:text-base">
                Temukan berbagai pilihan paket tour Bali favorit mulai dari Nusa Penida, Ubud, Kintamani, Bedugul, Uluwatu hingga Water Sports.
            </p>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Cari Kata Kunci</label>
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Nama paket tour..." 
                               class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>

                <!-- Destination Filter -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tujuan / Destinasi</label>
                    <select wire:model.live="destinationId" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="all">Semua Destinasi</option>
                        @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Tour</label>
                    <select wire:model.live="category" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="all">Semua Kategori</option>
                        <option value="Full Day Tour">Full Day Tour</option>
                        <option value="Adventure Tour">Adventure & Jeep</option>
                        <option value="Sunset Tour">Sunset & Culture</option>
                    </select>
                </div>

                <!-- Sort Filter -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Urutkan Berdasarkan</label>
                    <select wire:model.live="sortBy" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="popular">Paling Populer</option>
                        <option value="price_asc">Harga: Termurah ke Termahal</option>
                        <option value="price_desc">Harga: Termahal ke Termurah</option>
                        <option value="rating">Rating Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Package Count Bar -->
        <div class="flex items-center justify-between mb-6 text-sm text-slate-600">
            <span>Menampilkan <strong class="text-slate-900">{{ $packages->count() }}</strong> Paket Tour Bali</span>
            @if($search || $destinationId !== 'all' || $category !== 'all')
            <button wire:click="$set('search', ''); $set('destinationId', 'all'); $set('category', 'all'); $set('sortBy', 'popular')" class="text-xs text-emerald-600 font-bold hover:underline">
                <i class="fa-solid fa-rotate-left mr-1"></i> Reset Filter
            </button>
            @endif
        </div>

        <!-- Packages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $pkg)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <!-- Image & Badges -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $pkg->image_url }}" alt="{{ $pkg->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    @if($pkg->badge)
                    <div class="absolute top-4 left-4 bg-gradient-gold text-white text-xs font-extrabold px-3 py-1.5 rounded-full shadow-md">
                        {{ $pkg->badge }}
                    </div>
                    @endif
                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center text-white text-xs font-medium">
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-full"><i class="fa-solid fa-clock mr-1 text-emerald-400"></i> {{ $pkg->duration }}</span>
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-full text-amber-400 font-bold"><i class="fa-solid fa-star mr-1"></i> {{ $pkg->rating }} ({{ $pkg->review_count }})</span>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full border border-emerald-200">
                                {{ $pkg->destination->name ?? 'Bali' }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase">
                                {{ $pkg->category }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug">
                            {{ $pkg->title }}
                        </h3>
                        <p class="text-slate-600 text-xs mt-3 line-clamp-3 leading-relaxed">
                            {{ $pkg->description }}
                        </p>

                        <!-- Highlights / Inclusions -->
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Fasilitas Termasuk:</span>
                            <ul class="space-y-1 text-xs text-slate-600">
                                @foreach(array_slice($pkg->inclusions ?? [], 0, 3) as $inc)
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check-circle text-emerald-500 text-xs"></i>
                                    <span class="truncate">{{ $inc }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Footer Pricing & CTA -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Harga per Orang</span>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-xl font-extrabold text-emerald-700">Rp {{ number_format($pkg->price, 0, ',', '.') }}</span>
                                @if($pkg->original_price)
                                <span class="text-xs text-slate-400 line-through">Rp {{ number_format($pkg->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                        <a href="/paket/{{ $pkg->slug }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/30 flex items-center gap-1.5">
                            Lihat Detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-slate-300">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Paket Wisata Tidak Ditemukan</h3>
                <p class="text-slate-500 text-xs mt-1">Coba ubah filter pencarian atau kata kunci Anda.</p>
                <button wire:click="$set('search', ''); $set('destinationId', 'all'); $set('category', 'all')" class="mt-4 bg-emerald-600 text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow">
                    Tampilkan Semua Paket
                </button>
            </div>
            @endforelse
        </div>
    </div>
</div>
