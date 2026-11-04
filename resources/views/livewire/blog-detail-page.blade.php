<div class="min-h-screen bg-slate-50 py-8 sm:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 flex-wrap" aria-label="Breadcrumb">
            <a href="/" class="hover:text-emerald-600 transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <a href="/blog" class="hover:text-emerald-600 transition">Blog & Panduan</a>
            <span>/</span>
            <span class="text-slate-400">{{ $article->category }}</span>
            <span>/</span>
            <span class="text-slate-700 font-semibold truncate max-w-xs">{{ $article->title }}</span>
        </nav>

        <!-- Article Card Container -->
        <article class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80">
            
            <!-- Category & Meta Info Header -->
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase px-3 py-1 rounded-full border border-emerald-200">
                    {{ $article->category }}
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs text-slate-500 font-medium">
                    <i class="fa-regular fa-calendar mr-1"></i> {{ $article->formatted_published_at }}
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs text-slate-500 font-medium">
                    <i class="fa-regular fa-clock mr-1"></i> {{ $article->reading_time }}
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs text-slate-500 font-medium">
                    <i class="fa-regular fa-eye mr-1"></i> {{ number_format($article->views_count) }} dibaca
                </span>
            </div>

            <!-- Article Title -->
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-6">
                {{ $article->title }}
            </h1>

            <!-- Author & Share Quick Bar -->
            <div class="flex flex-wrap items-center justify-between gap-4 py-4 border-y border-slate-100 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ strtoupper(substr($article->author_name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-900">{{ $article->author_name }}</div>
                        <div class="text-[11px] text-slate-500">Penulis & Bali Destination Specialist</div>
                    </div>
                </div>

                <!-- Social Share Buttons -->
                <div class="flex items-center gap-2" x-data="{ copied: false }">
                    <span class="text-xs text-slate-400 font-medium mr-1">Bagikan:</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                       target="_blank" 
                       onclick="window.trackWhatsAppLead('blog_share_whatsapp', '{{ addslashes($article->title) }}');"
                       title="Share to WhatsApp" 
                       class="w-8 h-8 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center text-xs transition shadow-sm">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       title="Share to Facebook" 
                       class="w-8 h-8 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center text-xs transition shadow-sm">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       title="Share to Twitter / X" 
                       class="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-900 text-white flex items-center justify-center text-xs transition shadow-sm">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <button type="button" 
                            @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" 
                            title="Salin Link" 
                            class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs transition shadow-sm cursor-pointer">
                        <i :class="copied ? 'fa-solid fa-check text-emerald-600' : 'fa-solid fa-link'"></i>
                    </button>
                </div>
            </div>

            <!-- Featured Image -->
            @if($article->image_url)
            <div class="rounded-2xl overflow-hidden mb-8 shadow-md aspect-[16/9] relative bg-slate-100">
                <img src="{{ $article->image_url }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Article Excerpt Highlight -->
            @if($article->excerpt)
            <div class="p-5 bg-emerald-50/70 border-l-4 border-emerald-500 rounded-r-2xl mb-8 text-sm text-slate-700 font-medium italic leading-relaxed">
                {{ $article->excerpt }}
            </div>
            @endif

            <!-- Article Body Content -->
            <div class="article-content text-slate-700 leading-relaxed text-sm sm:text-base space-y-4">
                {!! $article->content !!}
            </div>

            <!-- In-Article Direct WhatsApp CTA Card -->
            <div class="mt-10 p-6 sm:p-8 bg-gradient-to-br from-emerald-600 to-teal-700 text-white rounded-3xl shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-[11px] font-extrabold uppercase px-3 py-1 rounded-full mb-2">
                        Pesan Paket Wisata Bali
                    </span>
                    <h3 class="text-xl sm:text-2xl font-extrabold leading-snug">
                        Tertarik Mengunjungi Tempat Wisata Ini?
                    </h3>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-1 max-w-lg leading-relaxed">
                        Kami menyediakan mobil ber-AC privat dengan supir lokal ramah, BBM, dan jadwal yang fleksibel sesuai permintaan Anda.
                    </p>
                </div>
                <div class="shrink-0 w-full md:w-auto">
                    <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}?text=Halo%20Admin%20Bothrex%20Bali%20Tour,%20saya%20tertarik%20dengan%20artikel%20{{ urlencode($article->title) }}%20dan%20ingin%20sewa%20mobil%20atau%20paket%20tour" 
                       target="_blank" 
                       onclick="window.trackWhatsAppLead('blog_post_inline_cta', '{{ addslashes($article->title) }}');"
                       data-tracked="true"
                       class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-emerald-50 text-emerald-800 font-extrabold px-6 py-3.5 rounded-2xl shadow-lg transition hover:scale-105 active:scale-95 text-sm cursor-pointer">
                        <i class="fa-brands fa-whatsapp text-xl text-emerald-600"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>
            </div>

        </article>

        <!-- Recommended Tour Packages -->
        @if($recommendedPackages->count() > 0)
        <div class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900">Rekomendasi Paket Wisata Terkait</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pilihan paket hemat favorit traveler untuk menjelajahi Bali</p>
                </div>
                <a href="/paket" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                    Lihat Semua <i class="fa-solid fa-angle-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($recommendedPackages as $pkg)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition p-4 flex gap-4 items-center">
                    <img src="{{ $pkg->image_url }}" alt="{{ $pkg->title }}" class="w-24 h-24 rounded-xl object-cover shrink-0">
                    <div class="flex-grow min-w-0">
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">{{ $pkg->category }}</span>
                        <h4 class="text-sm font-bold text-slate-900 truncate mt-1">
                            <a href="/paket/{{ $pkg->slug }}" class="hover:text-emerald-600">{{ $pkg->title }}</a>
                        </h4>
                        <div class="mt-1">
                            <span class="text-sm font-extrabold text-emerald-700" x-text="$store.currency ? $store.currency.format({{ (int)$pkg->published_price }}) : '$ {{ number_format($pkg->usd_price, 0) }}'">
                                $ {{ number_format($pkg->usd_price, 0) }}
                            </span>
                        </div>
                        <a href="/paket/{{ $pkg->slug }}" class="text-[11px] font-bold text-emerald-600 hover:underline mt-1 inline-block">
                            Detail Paket &rarr;
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related Articles Section -->
        @if($relatedArticles->count() > 0)
        <div class="mt-14 pt-10 border-t border-slate-200">
            <h3 class="text-xl font-extrabold text-slate-900 mb-6">Artikel & Panduan Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $rel)
                <a href="/blog/{{ $rel->slug }}" class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition group flex flex-col">
                    <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-emerald-700 uppercase">{{ $rel->category }}</span>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition line-clamp-2 mt-1">
                                {{ $rel->title }}
                            </h4>
                        </div>
                        <span class="text-[10px] text-slate-400 mt-3 block">
                            <i class="fa-regular fa-clock mr-1"></i> {{ $rel->reading_time }}
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<style>
/* Custom typography styling for article body */
.article-content h2 {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0f172a;
    margin-top: 1.75rem;
    margin-bottom: 0.75rem;
}
.article-content h3 {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1e293b;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
}
.article-content h4 {
    font-size: 1rem;
    font-weight: 700;
    color: #334155;
    margin-top: 1rem;
    margin-bottom: 0.25rem;
}
.article-content p {
    margin-bottom: 1rem;
    line-height: 1.75;
}
.article-content ul, .article-content ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
    list-style-type: disc;
}
.article-content li {
    margin-bottom: 0.5rem;
}
.article-content strong {
    font-weight: 700;
    color: #0f172a;
}
</style>

@push('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}type": "BlogPosting",
  "mainEntityOfPage": {
    "{{ '@' }}type": "WebPage",
    "{{ '@' }}id": "{{ url('/blog/' . $article->slug) }}"
  },
  "headline": "{{ addslashes($article->title) }}",
  "description": "{{ addslashes($article->excerpt) }}",
  "image": "{{ $article->image_url }}",
  "author": {
    "{{ '@' }}type": "Organization",
    "name": "{{ $article->author_name }}"
  },
  "publisher": {
    "{{ '@' }}type": "TravelAgency",
    "name": "{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}",
    "logo": {
      "{{ '@' }}type": "ImageObject",
      "url": "{{ url('/images/logo.png') }}"
    }
  },
  "datePublished": "{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}"
}
</script>

<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}type": "BreadcrumbList",
  "itemListElement": [
    {
      "{{ '@' }}type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "{{ url('/') }}"
    },
    {
      "{{ '@' }}type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "{{ url('/blog') }}"
    },
    {
      "{{ '@' }}type": "ListItem",
      "position": 3,
      "name": "{{ addslashes($article->title) }}",
      "item": "{{ url('/blog/' . $article->slug) }}"
    }
  ]
}
</script>
@endpush
