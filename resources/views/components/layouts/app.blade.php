<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Default Language Initializer (Default: English) -->
    <script>
        (function() {
            var savedLang = localStorage.getItem('user_lang') || 'en';
            var hasTransCookie = document.cookie.indexOf('googtrans=') !== -1;
            if (!hasTransCookie || !localStorage.getItem('user_lang')) {
                localStorage.setItem('user_lang', savedLang);
                var val = '/id/' + savedLang;
                document.cookie = "googtrans=" + val + "; path=/;";
                var host = window.location.hostname;
                if (host) {
                    document.cookie = "googtrans=" + val + "; path=/; domain=" + host + ";";
                    if (host.includes('.')) {
                        document.cookie = "googtrans=" + val + "; path=/; domain=." + host.replace(/^www\./, '') + ";";
                    }
                }
            }
        })();
    </script>

    <!-- Currency Store Initializer (Default: USD) -->
    <script>
        (function() {
            var defaultCurr = localStorage.getItem('user_currency') || 'USD';
            if (!localStorage.getItem('user_currency')) {
                localStorage.setItem('user_currency', defaultCurr);
            }

            function setupCurrencyStore() {
                if (window.Alpine && !window.Alpine.store('currency')) {
                    window.Alpine.store('currency', {
                        current: localStorage.getItem('user_currency') || 'USD',
                        currencies: [
                            { code: 'USD', name: 'USD ($)', symbol: '$', flag: '🇺🇸', rate: 1 / 18150, prefix: '$', suffix: '', decimals: 0, group: ',', dec: '.' },
                            { code: 'IDR', name: 'IDR (Rp)', symbol: 'Rp', flag: '🇮🇩', rate: 1, prefix: 'Rp ', suffix: '', decimals: 0, group: '.', dec: ',' },
                            { code: 'MYR', name: 'MYR (RM)', symbol: 'RM', flag: '🇲🇾', rate: 1 / 4450, prefix: 'RM ', suffix: '', decimals: 0, group: ',', dec: '.' },
                            { code: 'CNY', name: 'CNY (¥)', symbol: '¥', flag: '🇨🇳', rate: 1 / 2720, prefix: '¥', suffix: '', decimals: 0, group: ',', dec: '.' },
                            { code: 'EUR', name: 'EUR (€)', symbol: '€', flag: '🇪🇺', rate: 1 / 20320, prefix: '€', suffix: '', decimals: 0, group: ',', dec: '.' }
                        ],
                        get active() {
                            var self = this;
                            return this.currencies.find(function(c) { return c.code === self.current; }) || this.currencies[0];
                        },
                        set(code) {
                            this.current = code;
                            localStorage.setItem('user_currency', code);
                            window.dispatchEvent(new CustomEvent('currency-changed', { detail: { currency: code } }));
                        },
                        format(amount) {
                            if (amount === undefined || amount === null || amount === '') return '';
                            var num = Number(amount);
                            if (isNaN(num)) return amount;
                            var curr = this.active;
                            if (curr.code === 'IDR') {
                                return curr.prefix + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + curr.suffix;
                            }
                            var converted = Math.round(num * curr.rate);
                            return curr.prefix + converted.toString().replace(/\B(?=(\d{3})+(?!\d))/g, curr.group) + curr.suffix;
                        },
                        convert(amount) {
                            var num = Number(amount) || 0;
                            var curr = this.active;
                            return curr.code === 'IDR' ? num : Math.round(num * curr.rate);
                        }
                    });
                }
            }

            if (window.Alpine) {
                setupCurrencyStore();
            } else {
                document.addEventListener('alpine:init', setupCurrencyStore);
            }
        })();
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GT-T9WG2WHM"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'GT-T9WG2WHM');
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="apple-touch-icon" href="/images/logo.png">

    <!-- SEO Meta Title & Description -->
    <title>{{ $title ?? (($company->company_name ?? 'Bothrex Bali Tour & Travel') . ' - ' . ($company->tagline ?? 'Paket Wisata Bali Murah & Terpercaya #1')) }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Agen Tour & Travel resmi spesialis liburan Pulau Bali. Menyediakan paket tour Nusa Penida 1 hari, Jeep Kintamani Sunrise, Ubud Swing, Uluwatu Kecak, & Sewa Mobil Privat supir ramah. Pesan mudah via WA!' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'paket tour bali murah, agen travel bali terpercaya, tour nusa penida 1 hari, jeep batur sunrise tour, sewa mobil bali dengan supir, paket liburan bali keluarga, paket honeymoon bali romantis, wisata ubud gianyar, kecak dance uluwatu, bothrex bali tour' }}">
    <meta name="robots" content="{{ $robots ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
    <meta name="author" content="{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}">
    <meta name="theme-color" content="#0060af">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <!-- Local Bali SEO Geo Meta Tags -->
    <meta name="geo.region" content="ID-BA">
    <meta name="geo.placename" content="Bali, Indonesia">
    <meta name="geo.position" content="-8.409518;115.188916">
    <meta name="ICBM" content="-8.409518, 115.188916">

    <!-- Open Graph (OG) Meta Tags for WhatsApp, Facebook & Social Media Preview -->
    <meta property="og:site_name" content="{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:title" content="{{ $title ?? (($company->company_name ?? 'Bothrex Bali Tour & Travel') . ' - Paket Wisata Bali Murah') }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Nikmati liburan seru di Bali dengan mobil privat AC, supir ramah, itinerary hemat, & layanan 24/7. Hubungi WA kami!' }}">
    <meta property="og:image" content="{{ $ogImage ?? url('/images/logo.png') }}">
    <meta property="og:image:alt" content="{{ $title ?? 'Bothrex Bali Tour & Travel' }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? ($company->company_name ?? 'Bothrex Bali Tour & Travel') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Agen Tour & Travel resmi spesialis paket liburan Bali murah & terpercaya.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? url('/images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Global Schema.org JSON-LD (TravelAgency & WebSite SearchAction) -->
    <script type="application/ld+json">
    {
      "{{ '@' }}context": "https://schema.org",
      "{{ '@' }}graph": [
        {
          "{{ '@' }}type": "TravelAgency",
          "{{ '@' }}id": "{{ url('/') }}#agency",
          "name": "{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}",
          "url": "{{ url('/') }}",
          "logo": "{{ url('/images/logo.png') }}",
          "image": "{{ url('/images/logo.png') }}",
          "description": "{{ $company->about_text ?? 'Agen Tour & Travel resmi spesialis liburan Pulau Bali dengan paket all-in mobil privat dan supir ramah.' }}",
          "telephone": "{{ $company->phone ?? '0851-5643-2635' }}",
          "email": "{{ $company->email ?? 'info@bothrexbalitour.com' }}",
          "priceRange": "$25 - $100",
          "currenciesAccepted": "USD, IDR, MYR, CNY, EUR",
          "paymentAccepted": "Cash, Bank Transfer",
          "address": {
            "{{ '@' }}type": "PostalAddress",
            "streetAddress": "{{ $company->address ?? 'Jl. Raya Kuta No. 88' }}",
            "addressLocality": "Badung",
            "addressRegion": "Bali",
            "postalCode": "80361",
            "addressCountry": "ID"
          },
          "geo": {
            "{{ '@' }}type": "GeoCoordinates",
            "latitude": -8.7230,
            "longitude": 115.1768
          },
          "openingHoursSpecification": {
            "{{ '@' }}type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "07:00",
            "closes": "22:00"
          },
          "aggregateRating": {
            "{{ '@' }}type": "AggregateRating",
            "ratingValue": "4.9",
            "bestRating": "5",
            "worstRating": "1",
            "reviewCount": "1520"
          }
        },
        {
          "{{ '@' }}type": "WebSite",
          "{{ '@' }}id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}",
          "description": "{{ $company->tagline ?? 'Paket Wisata Bali Murah & Terpercaya #1' }}",
          "publisher": {
            "{{ '@' }}id": "{{ url('/') }}#agency"
          },
          "potentialAction": {
            "{{ '@' }}type": "SearchAction",
            "target": {
              "{{ '@' }}type": "EntryPoint",
              "urlTemplate": "{{ url('/paket') }}?search={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          },
          "inLanguage": "id-ID"
        }
      ]
    }
    </script>

    <!-- Page Specific Structured Data (Schema Stack) -->
    @stack('schema')

    <!-- Alpine.js & Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif-heading {
            font-family: 'Playfair Display', serif;
        }
        /* Google Translate Styling Cleanup */
        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner-frame,
        #goog-gt-tt,
        .goog-te-balloon-frame {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
        .goog-text-highlight {
            background: none !important;
            box-shadow: none !important;
        }
        .skiptranslate iframe {
            display: none !important;
        }
        font font {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Top Bar Contact Info -->
    <div class="hidden md:block bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span class="flex items-center gap-1.5"><i class="fa-solid fa-phone text-emerald-400"></i> {{ $company->phone ?? '0851-5643-2635' }}</span>
                <span class="flex items-center gap-1.5"><i class="fa-solid fa-envelope text-emerald-400"></i> {{ $company->email ?? 'info@bothrexbalitour.com' }}</span>
                <span class="hidden md:inline-flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400"></i> {{ $company->address ?? 'Jl. Raya Kuta No. 88, Badung, Bali' }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-amber-400 font-semibold flex items-center gap-1"><i class="fa-solid fa-star"></i> 4.9/5 (1.500+ Traveler Satisfied)</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar with Dynamic Scroll Parallax Header Effect -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 60)" 
            :class="scrolled ? 'bg-white shadow-md border-b border-slate-200 text-slate-800' : 'bg-slate-950/60 backdrop-blur-md border-b border-white/10 text-white'" 
            class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand Logo -->
                <a href="/" class="flex items-center group">
                    <img src="/images/logo.png" alt="{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}" class="w-[53px] h-[53px] object-contain group-hover:scale-105 transition-transform duration-300">
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-8 font-medium">
                    <a href="/" 
                       :class="scrolled ? 'text-slate-700 hover:text-emerald-600' : 'text-slate-100 hover:text-emerald-400'" 
                       class="transition-colors py-1">Beranda</a>
                    <a href="/paket" 
                       :class="scrolled ? 'text-slate-700 hover:text-emerald-600' : 'text-slate-100 hover:text-emerald-400'" 
                       class="transition-colors py-1">Paket Wisata</a>
                    <a href="/destinasi" 
                       :class="scrolled ? 'text-slate-700 hover:text-emerald-600' : 'text-slate-100 hover:text-emerald-400'" 
                       class="transition-colors py-1">Tujuan Wisata</a>
                    <a href="/#tentang-kami" 
                       :class="scrolled ? 'text-slate-700 hover:text-emerald-600' : 'text-slate-100 hover:text-emerald-400'" 
                       class="transition-colors py-1">Mengapa Kami</a>
                    <a href="/#testimoni" 
                       :class="scrolled ? 'text-slate-700 hover:text-emerald-600' : 'text-slate-100 hover:text-emerald-400'" 
                       class="transition-colors py-1">Testimoni</a>
                </nav>

                <!-- Desktop Action CTA, Currency & Language Selectors -->
                <div class="hidden md:flex items-center gap-2.5">
                    <!-- Currency Selector Dropdown -->
                    <div x-data="{
                        currOpen: false,
                        get active() {
                            return ($store && $store.currency) ? $store.currency.active : { code: 'USD', symbol: '$', flag: '🇺🇸' };
                        },
                        get list() {
                            return ($store && $store.currency) ? $store.currency.currencies : [];
                        },
                        select(code) {
                            if ($store && $store.currency) $store.currency.set(code);
                            this.currOpen = false;
                        }
                    }" class="relative inline-block text-left">
                        <button @click="currOpen = !currOpen" 
                                type="button" 
                                aria-label="Select Currency"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-full text-xs font-bold transition-all border shadow-sm cursor-pointer"
                                :class="scrolled ? 'bg-slate-100 hover:bg-slate-200 text-slate-800 border-slate-200' : 'bg-white/15 hover:bg-white/25 text-white border-white/20 backdrop-blur-md'">
                            <span x-text="active.flag" class="text-sm leading-none">🇺🇸</span>
                            <span x-text="active.code" class="font-bold tracking-wider leading-none">USD</span>
                            <i class="fa-solid fa-chevron-down text-[9px] opacity-70 transition-transform" :class="currOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="currOpen" 
                             @click.outside="currOpen = false"
                             x-transition:enter="transition ease-out duration-200 transform"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150 transform"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 mt-2 w-48 rounded-2xl bg-white text-slate-800 shadow-2xl ring-1 ring-black/5 p-1.5 z-50 divide-y divide-slate-100 border border-slate-100"
                             style="display: none;">
                            <div class="px-3 py-2 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                Select Currency
                            </div>
                            <div class="py-1">
                                <template x-for="c in list" :key="c.code">
                                    <button @click="select(c.code)" 
                                            type="button" 
                                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition-all hover:bg-slate-100 text-left cursor-pointer"
                                            :class="($store && $store.currency && $store.currency.current === c.code) ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-700'">
                                        <span class="flex items-center gap-2">
                                            <span x-text="c.flag" class="text-base"></span>
                                            <span x-text="c.name"></span>
                                        </span>
                                        <i x-show="$store && $store.currency && $store.currency.current === c.code" class="fa-solid fa-check text-emerald-600 text-xs"></i>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Language Selector Dropdown -->
                    <div x-data="{
                        langOpen: false,
                        currentLang: window.getCurrentLang ? window.getCurrentLang() : 'en',
                        languages: [
                            { code: 'en', name: 'English', short: 'EN', flag: '🇬🇧' },
                            { code: 'id', name: 'Bahasa Indonesia', short: 'ID', flag: '🇮🇩' },
                            { code: 'ms', name: 'Bahasa Melayu', short: 'MY', flag: '🇲🇾' },
                            { code: 'zh-CN', name: '中文 (Mandarin)', short: '中文', flag: '🇨🇳' },
                            { code: 'es', name: 'Español (Spanish)', short: 'ES', flag: '🇪🇸' }
                        ],
                        get active() {
                            return this.languages.find(l => l.code === this.currentLang) || this.languages[0];
                        },
                        selectLang(code) {
                            this.currentLang = code;
                            this.langOpen = false;
                            if (window.changeLanguage) {
                                window.changeLanguage(code);
                            }
                        }
                    }" class="relative inline-block text-left">
                        <button @click="langOpen = !langOpen" 
                                type="button" 
                                aria-label="Select Language"
                                class="inline-flex items-center gap-2 px-3 py-2 rounded-full text-xs font-bold transition-all border shadow-sm cursor-pointer"
                                :class="scrolled ? 'bg-slate-100 hover:bg-slate-200 text-slate-800 border-slate-200' : 'bg-white/15 hover:bg-white/25 text-white border-white/20 backdrop-blur-md'">
                            <span x-text="active.flag" class="text-sm leading-none">🇬🇧</span>
                            <span x-text="active.short" class="font-bold tracking-wider leading-none">EN</span>
                            <i class="fa-solid fa-chevron-down text-[9px] opacity-70 transition-transform" :class="langOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="langOpen" 
                             @click.outside="langOpen = false"
                             x-transition:enter="transition ease-out duration-200 transform"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150 transform"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 mt-2 w-52 rounded-2xl bg-white text-slate-800 shadow-2xl ring-1 ring-black/5 p-1.5 z-50 divide-y divide-slate-100 border border-slate-100"
                             style="display: none;">
                            <div class="px-3 py-2 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                Select Language
                            </div>
                            <div class="py-1">
                                <template x-for="lang in languages" :key="lang.code">
                                    <button @click="selectLang(lang.code)" 
                                            type="button" 
                                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all hover:bg-slate-100 text-left cursor-pointer"
                                            :class="currentLang === lang.code ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-700'">
                                        <span class="flex items-center gap-2.5">
                                            <span x-text="lang.flag" class="text-base"></span>
                                            <span x-text="lang.name"></span>
                                        </span>
                                        <i x-show="currentLang === lang.code" class="fa-solid fa-check text-emerald-600 text-xs"></i>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}?text=Halo%20Admin%20{{ urlencode($company->company_name ?? 'Bothrex Bali Tour') }},%20saya%20ingin%20tanya%20informasi%20paket%20wisata%20Bali" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-full shadow-lg shadow-emerald-600/30 transition-all hover:scale-105 active:scale-95 text-sm">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>

                <!-- Mobile Header Right Actions (Language & Hamburger) -->
                <div class="flex md:hidden items-center gap-2">
                    <button @click="open = !open" 
                            type="button" 
                            aria-label="Toggle navigation menu"
                            :class="scrolled ? 'bg-slate-100 text-slate-700 hover:bg-emerald-50 hover:text-emerald-600' : 'bg-white/20 text-white hover:bg-white/30 backdrop-blur-md'"
                            class="relative w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-300 focus:outline-none">
                        <div class="w-6 h-5 relative flex flex-col justify-between">
                            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300 origin-left" :class="open ? 'rotate-45 translate-x-1 -translate-y-0.5' : ''"></span>
                            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300" :class="open ? 'opacity-0 scale-x-0' : 'opacity-100'"></span>
                            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300 origin-left" :class="open ? '-rotate-45 translate-x-1 translate-y-0.5' : ''"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Animated Dropdown Navigation -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             class="md:hidden bg-white/95 backdrop-blur-lg border-b border-slate-200 shadow-xl px-4 pt-3 pb-6 space-y-3">
            
            <!-- Mobile Currency & Language Selectors Section -->
            <div class="space-y-2.5">
                <!-- Mobile Currency Selector -->
                <div x-data="{
                    get list() {
                        return ($store && $store.currency) ? $store.currency.currencies : [];
                    },
                    select(code) {
                        if ($store && $store.currency) $store.currency.set(code);
                    }
                }" class="p-3 bg-slate-50 rounded-2xl border border-slate-200">
                    <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                        <i class="fa-solid fa-coins text-emerald-600"></i> Select Currency:
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        <template x-for="c in list" :key="c.code">
                            <button @click="select(c.code)" 
                                    type="button" 
                                    class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition-all border text-left cursor-pointer"
                                    :class="($store && $store.currency && $store.currency.current === c.code) ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'">
                                <span class="flex items-center gap-1.5">
                                    <span x-text="c.flag"></span>
                                    <span x-text="c.name"></span>
                                </span>
                                <i x-show="$store && $store.currency && $store.currency.current === c.code" class="fa-solid fa-check text-xs"></i>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Mobile Language Selector Section -->
                <div x-data="{
                    currentLang: window.getCurrentLang ? window.getCurrentLang() : 'en',
                    languages: [
                        { code: 'en', name: 'English', short: '🇬🇧 EN' },
                        { code: 'id', name: 'Bahasa Indonesia', short: '🇮🇩 ID' },
                        { code: 'ms', name: 'Bahasa Melayu', short: '🇲🇾 MY' },
                        { code: 'zh-CN', name: '中文 Mandarin', short: '🇨🇳 中文' },
                        { code: 'es', name: 'Español Spanish', short: '🇪🇸 ES' }
                    ],
                    selectLang(code) {
                        this.currentLang = code;
                        if (window.changeLanguage) {
                            window.changeLanguage(code);
                        }
                    }
                }" class="p-3 bg-slate-50 rounded-2xl border border-slate-200">
                    <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                        <i class="fa-solid fa-globe text-emerald-600"></i> Select Language:
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        <template x-for="lang in languages" :key="lang.code">
                            <button @click="selectLang(lang.code)" 
                                    type="button" 
                                    class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition-all border text-left cursor-pointer"
                                    :class="currentLang === lang.code ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'">
                                <span x-text="lang.short"></span>
                                <i x-show="currentLang === lang.code" class="fa-solid fa-check text-xs"></i>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="/" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-800 font-semibold hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-house text-emerald-500 w-5"></i>
                    <span>Beranda</span>
                </a>
                <a href="/paket" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-800 font-semibold hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-compass text-emerald-500 w-5"></i>
                    <span>Paket Wisata</span>
                </a>
                <a href="/destinasi" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-800 font-semibold hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-map-location-dot text-emerald-500 w-5"></i>
                    <span>Tujuan Wisata</span>
                </a>
                <a href="/#tentang-kami" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-800 font-semibold hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-award text-emerald-500 w-5"></i>
                    <span>Mengapa Kami</span>
                </a>
                <a href="/#testimoni" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-800 font-semibold hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-comments text-emerald-500 w-5"></i>
                    <span>Testimoni</span>
                </a>
            </div>

            <div class="pt-2 border-t border-slate-100">
                <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}?text=Halo%20Admin%20{{ urlencode($company->company_name ?? 'Bothrex Bali Tour') }}" 
                   target="_blank" 
                   class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-3 rounded-xl shadow-md text-sm text-center">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                    <span>Chat WhatsApp</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Floating WhatsApp Widget -->
    <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}?text=Halo%20Admin%20{{ urlencode($company->company_name ?? 'Bothrex Bali Tour') }},%20saya%20tertarik%20dengan%20paket%20liburan%20di%20Bali" 
       target="_blank" 
       title="Chat WhatsApp {{ $company->company_name ?? 'Bothrex Bali Tour' }}"
       class="fixed bottom-6 right-6 z-50 bg-emerald-500 hover:bg-emerald-600 text-white p-4 rounded-full shadow-2xl shadow-emerald-600/50 flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 group cursor-pointer">
        <i class="fa-brands fa-whatsapp text-3xl animate-bounce"></i>
        <span class="max-w-0 overflow-hidden whitespace-nowrap group-hover:max-w-xs transition-all duration-500 ease-in-out font-bold text-sm ml-0 group-hover:ml-2">
            Konsultasi Tour Gratis!
        </span>
    </a>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <!-- Column 1: Agency Brand & About -->
                <div class="space-y-4">
                    <div class="flex items-center">
                        <img src="/images/logo.png" alt="{{ $company->company_name ?? 'Bothrex Bali Tour' }}" class="w-12 h-12 object-contain">
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $company->about_text ?? 'Agen Tour & Travel resmi spesialis liburan Pulau Bali. Kami siap memberikan pengalaman liburan tak terlupakan dengan layanan kendaraan privat, supir lokal berpengalaman, dan harga transparan terbaik.' }}
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        @if(!empty($company->instagram_url))
                        <a href="{{ $company->instagram_url }}" target="_blank" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(!empty($company->facebook_url))
                        <a href="{{ $company->facebook_url }}" target="_blank" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($company->tiktok_url))
                        <a href="{{ $company->tiktok_url }}" target="_blank" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-tiktok"></i></a>
                        @endif
                        @if(!empty($company->youtube_url))
                        <a href="{{ $company->youtube_url }}" target="_blank" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide uppercase text-xs">Pilihan Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="/" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-angle-right text-emerald-500 mr-2 text-xs"></i> Beranda Utama</a></li>
                        <li><a href="/paket" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-angle-right text-emerald-500 mr-2 text-xs"></i> Semua Paket Tour Bali</a></li>
                        <li><a href="/destinasi" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-angle-right text-emerald-500 mr-2 text-xs"></i> Destinasi Wisata Populer</a></li>
                        <li><a href="/#tentang-kami" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-angle-right text-emerald-500 mr-2 text-xs"></i> Mengapa Memilih Kami</a></li>
                    </ul>
                </div>

                <!-- Column 3: Top Destinasi Bali -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide uppercase text-xs">Destinasi Populer</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="/destinasi/nusa-penida" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-location-dot text-amber-500 mr-2 text-xs"></i> Nusa Penida West & East</a></li>
                        <li><a href="/destinasi/ubud-gianyar" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-location-dot text-amber-500 mr-2 text-xs"></i> Ubud Culture & Swing</a></li>
                        <li><a href="/destinasi/kintamani-batur" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-location-dot text-amber-500 mr-2 text-xs"></i> Kintamani Jeep Sunrise</a></li>
                        <li><a href="/destinasi/uluwatu-bali-selatan" class="hover:text-emerald-400 transition-colors"><i class="fa-solid fa-location-dot text-amber-500 mr-2 text-xs"></i> Uluwatu & Kecak Sunset</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact & Location -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 tracking-wide uppercase text-xs">Kontak & Operasional</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-map-pin text-emerald-400 mt-1"></i>
                            <span>{{ $company->address ?? 'Jl. Raya Kuta No. 88, Kuta, Kabupaten Badung, Bali 80361' }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-brands fa-whatsapp text-emerald-400 mt-1"></i>
                            <div>
                                <a href="https://wa.me/{{ $company->whatsapp_number ?? '6285156432635' }}" target="_blank" class="text-white hover:text-emerald-400 transition-colors font-medium">0851-5643-2635</a>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-emerald-400"></i>
                            <span>{{ $company->operating_hours ?? 'Senin - Minggu: 07:00 - 22:00 WITA' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Bar (No payment methods section) -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} {{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <!-- Google Translate Hidden Element & Custom Switcher Logic -->
    <div id="google_translate_element" style="display:none;"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ms,zh-CN,es',
                autoDisplay: false
            }, 'google_translate_element');
        }

        window.changeLanguage = function(langCode) {
            if (langCode === 'id') {
                var host = window.location.hostname;
                var domainList = ['', '.' + host, host, '.' + host.replace(/^www\./, '')];
                domainList.forEach(function(d) {
                    document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;" + (d ? " domain=" + d + ";" : "");
                });
                localStorage.setItem('user_lang', 'id');
                window.location.reload();
                return;
            }

            var val = '/id/' + langCode;
            var host = window.location.hostname;
            document.cookie = "googtrans=" + val + "; path=/;";
            document.cookie = "googtrans=" + val + "; path=/; domain=" + host + ";";
            if (host.includes('.')) {
                document.cookie = "googtrans=" + val + "; path=/; domain=." + host.replace(/^www\./, '') + ";";
            }
            localStorage.setItem('user_lang', langCode);

            var select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = langCode;
                select.dispatchEvent(new Event('change'));
            } else {
                window.location.reload();
            }
        };

        window.getCurrentLang = function() {
            var match = document.cookie.match(/googtrans=\/id\/([a-zA-Z\-]+)/);
            if (match && match[1]) {
                return match[1];
            }
            return localStorage.getItem('user_lang') || 'en';
        };
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @livewireScripts
</body>
</html>
