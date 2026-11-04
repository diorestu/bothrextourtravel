<div class="min-h-screen bg-slate-50 py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner Section -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest bg-emerald-100 text-emerald-800 mb-4 border border-emerald-200">
                <i class="fa-solid fa-compass text-emerald-600"></i> Bali Travel Insights & Guides
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Panduan Wisata & Inspirasi Liburan Bali
            </h1>
            <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                Temukan tips praktis, rekomendasi itinerary harian, hidden gem eksotis, dan panduan lengkap dari tim lokal Bothrex Bali Tour untuk perjalanan liburan tanpa ribet.
            </p>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-4 sm:p-5 mb-10">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Category Pills -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none">
                    @foreach($categories as $key => $label)
                        <button type="button" 
                                wire:click="selectCategory('{{ $key }}')" 
                                class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-200 cursor-pointer {{ $category === $key ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                <!-- Search Input -->
                <div class="w-full md:w-72 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Cari artikel / destinasi..." 
                           class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                </div>
            </div>
        </div>

        <!-- Featured Article Hero (When no specific search/filter is active) -->
        @if(!$search && $category === 'all' && $featuredArticle)
        <div class="relative bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-200/80 mb-12 group hover:shadow-xl transition-all duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
                <div class="lg:col-span-7 h-64 sm:h-80 lg:h-96 overflow-hidden relative">
                    <img src="{{ $featuredArticle->image_url }}" 
                         alt="{{ $featuredArticle->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-amber-500 text-white text-[11px] font-extrabold uppercase px-3 py-1 rounded-full shadow-md flex items-center gap-1">
                            <i class="fa-solid fa-star"></i> Featured Guide
                        </span>
                    </div>
                </div>
                <div class="lg:col-span-5 p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 text-xs text-slate-500 font-medium mb-3">
                            <span class="text-emerald-700 font-bold bg-emerald-50 px-2.5 py-0.5 rounded-md">{{ $featuredArticle->category }}</span>
                            <span>&bull;</span>
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $featuredArticle->reading_time }}</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 group-hover:text-emerald-700 transition leading-snug mb-3">
                            <a href="/blog/{{ $featuredArticle->slug }}">{{ $featuredArticle->title }}</a>
                        </h2>
                        <p class="text-slate-600 text-xs sm:text-sm line-clamp-3 leading-relaxed mb-6">
                            {{ $featuredArticle->excerpt }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">
                                B
                            </div>
                            <span class="text-xs font-semibold text-slate-700">{{ $featuredArticle->author_name }}</span>
                        </div>
                        <a href="/blog/{{ $featuredArticle->slug }}" 
                           class="inline-flex items-center gap-2 text-xs font-extrabold text-emerald-700 hover:text-emerald-800 transition">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Articles Grid -->
        @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $post)
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 flex flex-col group">
                <!-- Thumbnail Image -->
                <a href="/blog/{{ $post->slug }}" class="block relative aspect-[16/10] overflow-hidden bg-slate-100">
                    <img src="{{ $post->image_url }}" 
                         alt="{{ $post->title }}" 
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 left-3 bg-white/95 backdrop-blur-sm text-emerald-800 text-[11px] font-bold px-3 py-1 rounded-lg shadow-sm">
                        {{ $post->category }}
                    </span>
                </a>

                <!-- Content Area -->
                <div class="p-6 flex flex-col flex-grow justify-between">
                    <div>
                        <!-- Meta Info -->
                        <div class="flex items-center gap-2 text-[11px] text-slate-400 font-medium mb-2.5">
                            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $post->formatted_published_at }}</span>
                            <span>&bull;</span>
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $post->reading_time }}</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-600 transition leading-snug mb-2.5 line-clamp-2">
                            <a href="/blog/{{ $post->slug }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4">
                            {{ $post->excerpt }}
                        </p>
                    </div>

                    <!-- Footer Details & Link -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                        <span class="text-[11px] text-slate-500 font-medium">
                            Oleh: <strong class="text-slate-700 font-semibold">{{ $post->author_name }}</strong>
                        </span>
                        <a href="/blog/{{ $post->slug }}" 
                           class="text-xs font-bold text-emerald-600 group-hover:text-emerald-700 flex items-center gap-1.5 transition">
                            Baca <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>

        @else
        <!-- Empty State -->
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-lg mx-auto my-8">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Artikel Tidak Ditemukan</h3>
            <p class="text-xs text-slate-500 mb-6">
                Tidak ada artikel atau panduan wisata yang cocok dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
            </p>
            <button wire:click="$set('search', ''); $set('category', 'all')" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition shadow-md">
                Reset Pencarian
            </button>
        </div>
        @endif

        <!-- Bottom Newsletter / Contact Banner -->
        <div class="mt-16 bg-gradient-to-br from-slate-900 to-emerald-950 rounded-3xl p-8 sm:p-12 text-white relative overflow-hidden shadow-xl border border-slate-800">
            <div class="max-w-2xl relative z-10">
                <span class="text-emerald-400 font-bold uppercase text-xs tracking-wider mb-2 block">Butuh Itinerary Custom?</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold mb-3">Mau Rencana Liburan Bali yang Sesuai Budget & Keinginan?</h3>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
                    Konsultasikan langsung secara gratis bersama tour planner lokal Bothrex Bali Tour. Kami siap membuatkan susunan rute terbaik beserta mobil privat ber-AC dan supir ramah.
                </p>
                <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}?text=Halo%20Admin%20Bothrex%20Bali%20Tour,%20saya%20baca%20blog%20dan%20ingin%20konsultasi%20itinerary%20custom" 
                   target="_blank" 
                   onclick="window.trackWhatsAppLead('blog_catalog_bottom_banner');" 
                   data-tracked="true"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold px-6 py-3.5 rounded-xl shadow-lg transition hover:scale-105 text-sm">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Chat WhatsApp</span>
                </a>
            </div>
        </div>

    </div>
</div>

@push('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}type": "CollectionPage",
  "name": "Panduan Wisata & Blog Liburan Bali - Bothrex Bali Tour",
  "description": "Kumpulan panduan wisata Bali terlengkap, rekomendasi itinerary, tips liburan hemat, dan tempat wisata tersembunyi di Bali.",
  "url": "{{ url('/blog') }}",
  "publisher": {
    "{{ '@' }}type": "TravelAgency",
    "name": "{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}",
    "url": "{{ url('/') }}",
    "logo": "{{ url('/images/logo.png') }}"
  }
}
</script>
@endpush
