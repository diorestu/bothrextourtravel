<div>
    <!-- Hero Banner Section (Parallax Background) -->
    <section class="relative bg-fixed bg-cover bg-center text-white overflow-hidden pt-36 pb-24 lg:pt-44 lg:pb-36 -mt-20"
             style="background-image: url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=2000&q=80');">
        <!-- Dark Overlay Filter for Maximum Readability -->
        <div class="absolute inset-0 bg-slate-950/65 backdrop-blur-[1px] z-0"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/40 z-0"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 bg-emerald-500/20 backdrop-blur-md text-emerald-300 text-xs sm:text-sm font-semibold px-4 py-1.5 rounded-full border border-emerald-400/30 mb-6">
                    <i class="fa-solid fa-car-side text-amber-400"></i> Bothrex Driver — Sahabat Liburan Anda di Bali
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight font-serif-heading leading-tight mb-6">
                    Layanan Liburan & Private Tour <span class="text-emerald-400 underline decoration-amber-400 underline-offset-8">Terbaik di Bali</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-200 mb-8 leading-relaxed font-light">
                    Bothrex Driver melayani segala kebutuhan holiday Anda di Bali. Mobil privat bersih ber-AC, supir ramah & berpengalaman, jadwal fleksibel santai, serta siap mengantar Anda ke destinasi favorit Ubud, Kintamani, Bedugul, dan Uluwatu.
                </p>

                <!-- Quick Search Bar -->
                <form wire:submit.prevent="performSearch" class="bg-white p-3 rounded-2xl shadow-2xl shadow-black/40 flex flex-col md:flex-row gap-3 items-center border border-white/20 backdrop-blur-md">
                    <div class="flex-grow w-full relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" 
                               wire:model="search" 
                               placeholder="Cari rute tour (cth: Ubud, Kintamani, Bedugul, Uluwatu, Watersport)..." 
                               class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-lg transition-all hover:scale-105 active:scale-95 text-sm whitespace-nowrap">
                            <i class="fa-solid fa-compass"></i> Temukan Paket
                        </button>
                    </div>
                </form>

                <!-- Trust Badges -->
                <div class="mt-8 flex flex-wrap gap-6 text-xs sm:text-sm text-slate-300 font-medium">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-400"></i> Mobil Privat (Bukan Gabungan)</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-clock-rotate-left text-emerald-400"></i> Waktu Fleksibel Tanpa Buru-Buru</span>
                    <span class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-400"></i> Reservasi Cepat via WhatsApp</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Main Trip Tours Showcase -->
    <section class="py-16 bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">Rute Liburan Terpopuler</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif-heading mt-1">4 Pilihan Tour Utama Bothrex</h2>
                    <p class="text-slate-600 text-sm mt-2">Pilihan rute wisata paling diminati wisatawan domestik maupun mancanegara dengan supir privat berpengalaman.</p>
                </div>
                <a href="/destinasi" class="mt-4 md:mt-0 inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700">
                    Lihat Semua Destinasi <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($destinations as $dest)
                <a href="/destinasi/{{ $dest->slug }}" class="group relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block h-96 bg-slate-900">
                    <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/50 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-emerald-600/90 backdrop-blur-md text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            {{ $dest->category }}
                        </span>
                    </div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <span class="text-xs text-amber-300 font-semibold block mb-1"><i class="fa-solid fa-location-dot mr-1"></i> {{ $dest->location }}</span>
                        <h3 class="text-xl font-bold font-serif-heading group-hover:text-emerald-400 transition-colors">{{ $dest->name }}</h3>
                        <p class="text-xs text-slate-300 line-clamp-2 mt-1.5 font-light">{{ $dest->description }}</p>
                        
                        <div class="mt-3 flex items-center justify-between text-xs font-semibold pt-2 border-t border-white/20">
                            <span>{{ $dest->packages->count() }} Paket Tersedia</span>
                            <span class="text-emerald-400 group-hover:translate-x-1 transition-transform">Lihat Rute <i class="fa-solid fa-chevron-right ml-1 text-[10px]"></i></span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Tour Packages Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">Pilihan Paket Wisata Lengkap</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif-heading mt-1">Daftar Paket Tour & Itinerary</h2>
                <p class="text-slate-600 mt-3 text-sm sm:text-base">Seluruh paket sudah termasuk mobil privat ber-AC, bahan bakar, supir ramah yang siap memandu & membantu foto, serta tiket objek wisata.</p>
            </div>

            <!-- Package Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @forelse($featuredPackages as $pkg)
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <!-- Image & Badge -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $pkg->image_url }}" alt="{{ $pkg->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        @if($pkg->badge)
                        <div class="absolute top-4 left-4 bg-emerald-600 text-white text-xs font-extrabold px-3.5 py-1.5 rounded-full shadow-md">
                            {{ $pkg->badge }}
                        </div>
                        @endif
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center text-white text-xs font-medium">
                            <span class="bg-black/50 backdrop-blur-md px-3 py-1 rounded-full"><i class="fa-solid fa-clock mr-1 text-emerald-400"></i> {{ $pkg->duration }}</span>
                            <span class="bg-black/50 backdrop-blur-md px-3 py-1 rounded-full text-amber-400 font-bold"><i class="fa-solid fa-star mr-1"></i> {{ $pkg->rating }} ({{ $pkg->review_count }} ulasan)</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 sm:p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 block mb-1">
                                {{ $pkg->destination->name ?? 'Bali' }}
                            </span>
                            <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors leading-snug">
                                {{ $pkg->title }}
                            </h3>
                            <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed">
                                {{ $pkg->description }}
                            </p>

                            <!-- Itinerary Step Preview -->
                            <div class="mt-5 pt-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2.5">Destinasi & Rute Wisata:</span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                                    @foreach(array_slice($pkg->itinerary ?? [], 0, 4) as $idx => $step)
                                    <div class="flex items-start gap-2 bg-slate-50 p-2 rounded-xl border border-slate-100">
                                        <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold flex items-center justify-center shrink-0 mt-0.5">
                                            {{ $idx + 1 }}
                                        </span>
                                        <span class="font-medium text-slate-800 line-clamp-1">{{ $step['title'] }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-semibold block">Harga All-In Mulai Dari</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-extrabold text-emerald-700">Rp {{ number_format($pkg->price, 0, ',', '.') }}</span>
                                    @if($pkg->original_price)
                                    <span class="text-xs text-slate-400 line-through">Rp {{ number_format($pkg->original_price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <span class="text-[11px] text-slate-500">/ orang (Private Tour AC)</span>
                            </div>
                            <a href="/paket/{{ $pkg->slug }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-6 py-3 rounded-xl transition-all shadow-md hover:shadow-emerald-600/30 flex items-center justify-center gap-2">
                                Lihat Rute & Booking <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 bg-slate-50 rounded-3xl border border-dashed border-slate-300">
                    <i class="fa-solid fa-compass text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600 font-semibold">Tidak ditemukan paket wisata yang sesuai.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Special Highlights: Adventure Activities & Bali Shopping Places -->
    <section class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                
                <!-- Left Column: Aktivitas Adventure Favorit -->
                <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl font-bold">
                            <i class="fa-solid fa-person-snowboarding"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Aktivitas Seru & Adventure</span>
                            <h3 class="text-2xl font-extrabold text-slate-900 font-serif-heading">Wahana Petualangan di Bali</h3>
                        </div>
                    </div>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                        Lengkapi liburan Anda dengan berbagai pilihan aktivitas seru yang dapat digabungkan langsung dengan paket tour kami:
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-motorcycle text-emerald-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">ATV Ride Adventure</h4>
                                <span class="text-[10px] text-slate-500">Trek hutan, sungai & goa Ubud</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-water text-blue-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Ayung Water Rafting</h4>
                                <span class="text-[10px] text-slate-500">Arung jeram seru jeram kelas II-III</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-truck-monster text-rose-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Sunrise Jeep 4WD Batur</h4>
                                <span class="text-[10px] text-slate-500">Sunrise & lautan pasir Black Lava</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-mask-snorkel text-cyan-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Tanjung Benoa Watersport</h4>
                                <span class="text-[10px] text-slate-500">Parasailing, Jet Ski, Diving, Sea Walker</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-child-reaching text-amber-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Ubud Jungle Swing</h4>
                                <span class="text-[10px] text-slate-500">Ayunan ekstrem & spot foto sarang burung</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-300 transition">
                            <i class="fa-solid fa-car text-purple-600 text-lg"></i>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Buggy Car Offroad</h4>
                                <span class="text-[10px] text-slate-500">Menyusuri trek alam pedesaan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Pusat Oleh-Oleh Khas Bali -->
                <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl font-bold">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Shopping & Souvenir</span>
                            <h3 class="text-2xl font-extrabold text-slate-900 font-serif-heading">Pusat Oleh-Oleh Khas Bali</h3>
                        </div>
                    </div>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                        Driver kami siap mengantar Anda berbelanja pie susu, pakaian pantai, kopi, dan cinderamata di pusat oleh-oleh terlengkap dengan harga pasti:
                    </p>

                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-bold flex items-center justify-center text-sm shrink-0 mt-0.5">
                                <i class="fa-solid fa-store"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Krisna Oleh-Oleh Khas Bali</h4>
                                <p class="text-xs text-slate-500 mt-1">Pusat oleh-oleh terbesar dan terlengkap di Bali dengan harga pas, varian camilan khas, pie susu, dan baju barong.</p>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-bold flex items-center justify-center text-sm shrink-0 mt-0.5">
                                <i class="fa-solid fa-gift"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Agung Bali Oleh-Oleh</h4>
                                <p class="text-xs text-slate-500 mt-1">Menyediakan aneka pakaian santai khas Bali, kerajinan kayu, lukisan, dan kain pantai berkualitas tinggi.</p>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-bold flex items-center justify-center text-sm shrink-0 mt-0.5">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">The Keranjang Bali</h4>
                                <p class="text-xs text-slate-500 mt-1">Konsep wisata belanja dan edukasi budaya "Bali dalam Satu Keranjang" dengan arsitektur unik dan spot foto menarik.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Choose Bothrex Bali Tour -->
    <section id="tentang-kami" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Keunggulan Layanan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-serif-heading mt-1">Mengapa Memilih Bothrex Bali Tour?</h2>
                <p class="text-slate-400 text-sm mt-3">Komitmen kami adalah menghadirkan senyum dan kebahagiaan di setiap moment liburan Anda di Pulau Bali.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/60 hover:border-emerald-500/50 transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Mobil Privat & Nyaman</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Unit armada bersih, harum, ber-AC dingin, dan khusus untuk rombongan Anda tanpa digabung dengan tamu lain.</p>
                </div>

                <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/60 hover:border-emerald-500/50 transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Supir + Photographer</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Driver berpengalaman, ramah, jujur, serta siap membantu mengambil foto & video estetik di setiap spot wisata.</p>
                </div>

                <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/60 hover:border-emerald-500/50 transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Itinerary Fleksibel</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Anda bisa menyesuaikan rute perjalanan dan jam keberangkatan secara kustom sesuai keinginan kelurga.</p>
                </div>

                <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/60 hover:border-emerald-500/50 transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Harga Transparan</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Jaminan harga all-inclusive transparan tanpa ada hidden fees atau paksaan belanja di pusat oleh-oleh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimoni" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">Pengalaman Wisatawan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif-heading mt-1">Apa Kata Mereka?</h2>
                <p class="text-slate-600 text-sm mt-3">Ribuan wisatawan telah mempercayakan momen liburan Bali bersama kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 text-sm space-x-1 mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-slate-700 text-sm italic leading-relaxed">
                            "Pelayanan Bothrex Bali Tour luar biasa top! Mas Budi supirnya ramah banget, pintar ambil foto di Kelingking Beach Nusa Penida. Hasil fotonya serasa pake fotografer profesional. Mobilnya juga bersih dan harum."
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80" alt="Siti Rahma" class="w-11 h-11 rounded-full object-cover">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Siti Rahmawati</h4>
                            <span class="text-xs text-slate-400">Jakarta Selatan (Trip Nusa Penida)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 text-sm space-x-1 mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-slate-700 text-sm italic leading-relaxed">
                            "Jeep Tour Kintamani Sunrise gokil banget!! Driver jeep ramah & jago bgt nyetir di jalur black lava. Pas bgt buat honeymoon kami. Proses booking via WA cepat dan tanpa ribet. Makasih Bothrex!"
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" alt="Andi Hendra" class="w-11 h-11 rounded-full object-cover">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Andi & Maya</h4>
                            <span class="text-xs text-slate-400">Surabaya (Jeep Batur & Ubud)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 text-sm space-x-1 mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-slate-700 text-sm italic leading-relaxed">
                            "Rombongan kantor kami 12 orang ambil paket Uluwatu Kecak Dance + Dinner Jimbaran. Semuanya satisfied! Koordinasi agen sangat rapi dari penjemputan bandara sampai pengantaran."
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Devi Permata" class="w-11 h-11 rounded-full object-cover">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Devi Permata</h4>
                            <span class="text-xs text-slate-400">Bandung (Family & Corporate Trip)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section for Google Rich Snippets & Trust -->
    <section class="py-20 bg-slate-100/70 border-t border-slate-200" id="faq">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">FAQ / Tanya Jawab</span>
                <h2 class="text-3xl font-extrabold text-slate-900 font-serif-heading mt-3">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-slate-600 text-sm mt-2">Semua hal yang perlu Anda ketahui tentang layanan paket liburan Bali bersama {{ $company->company_name ?? 'Bothrex Bali Tour' }}.</p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                    <button @click="active = (active === 1 ? null : 1)" class="w-full px-6 py-4 text-left font-bold text-slate-800 flex items-center justify-between gap-4 hover:text-emerald-600 transition text-sm sm:text-base">
                        <span>Apa saja paket wisata Bali yang paling populer di {{ $company->company_name ?? 'Bothrex Bali Tour' }}?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-emerald-600' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Kami menyediakan 4 paket tour utama terlengkap: 
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li><strong>Ubud Tour:</strong> Galeri Batik & Perak, Coffee Plantation Luwak, Lunch Bebek Joni, Tegalalang Rice Terrace, Monkey Forest, Tegenungan Waterfall (+ Wahana ATV/Rafting/Swing/Buggy).</li>
                            <li><strong>Kintamani Tour:</strong> Panorama Gunung & Danau Batur, Lunch Batur Sari Resto, Kebun Stroberi, Pura Tirta Empul, Desa Penglipuran (+ Sunrise Jeep 4WD Black Lava).</li>
                            <li><strong>Bedugul Tour:</strong> Pura Ulun Danu Beratan, The Blooms Garden, Handara Gate, dan Lunch Buffet Mentari Resto.</li>
                            <li><strong>Uluwatu Tour:</strong> Tanjung Benoa Watersport, Pantai Pandawa & Melasti, Pura Uluwatu & Tari Kecak Sunset, Dinner Seafood Jimbaran, serta Pusat Oleh-Oleh (Krisna / Agung Bali / The Keranjang).</li>
                        </ul>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                    <button @click="active = (active === 2 ? null : 2)" class="w-full px-6 py-4 text-left font-bold text-slate-800 flex items-center justify-between gap-4 hover:text-emerald-600 transition text-sm sm:text-base">
                        <span>Apakah tour ini bersifat Private atau digabung dengan peserta lain?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-emerald-600' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Semua paket kami adalah <strong>Private Tour (Mobil Privat AC)</strong>. Anda dan keluarga/rombongan tidak akan digabung dengan orang asing, sehingga liburan lebih intim, leluasa, dan santai.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                    <button @click="active = (active === 3 ? null : 3)" class="w-full px-6 py-4 text-left font-bold text-slate-800 flex items-center justify-between gap-4 hover:text-emerald-600 transition text-sm sm:text-base">
                        <span>Apakah paket tour sudah termasuk penjemputan dan pengantaran ke hotel?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-emerald-600' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        <strong>Ya, 100% Termasuk!</strong> Supir ramah kami akan menjemput langsung di lobi hotel/villa Anda di area Kuta, Seminyak, Legian, Canggu, Jimbaran, Nusa Dua, Sanur, Ubud, maupun Bandara Internasional I Gusti Ngurah Rai.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                    <button @click="active = (active === 4 ? null : 4)" class="w-full px-6 py-4 text-left font-bold text-slate-800 flex items-center justify-between gap-4 hover:text-emerald-600 transition text-sm sm:text-base">
                        <span>Bagaimana mekanisme pemesanan paket wisata?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="active === 4 ? 'rotate-180 text-emerald-600' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Pilih paket tour yang diinginkan di website, lengkapi tanggal dan jumlah tamu pada formulir booking, lalu klik tombol pesan. Sistem akan membuat kode booking resmi dan menghubungkan Anda langsung ke WhatsApp Customer Service kami untuk konfirmasi instan.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                    <button @click="active = (active === 5 ? null : 5)" class="w-full px-6 py-4 text-left font-bold text-slate-800 flex items-center justify-between gap-4 hover:text-emerald-600 transition text-sm sm:text-base">
                        <span>Apakah jadwal waktu tour fleksibel?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="active === 5 ? 'rotate-180 text-emerald-600' : 'text-slate-400'"></i>
                    </button>
                    <div x-show="active === 5" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Sangat fleksibel! Waktu penjemputan dan durasi singgah di tiap destinasi wisata dapat disesuaikan dengan kenyamanan liburan Anda. Driver kami siap menemani dengan ramah dan penuh kesabaran.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action WhatsApp Banner (Parallax with Dark Overlay) -->
    <section class="relative py-24 bg-fixed bg-cover bg-center text-white overflow-hidden" 
             style="background-image: url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=2000&q=80');">
        <!-- Dark Overlay Filter for High Contrast -->
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-[2px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 bg-white/10 p-8 sm:p-12 rounded-3xl backdrop-blur-md border border-white/20 shadow-2xl">
                <div class="space-y-3 text-center lg:text-left">
                    <span class="inline-block bg-emerald-500/20 text-emerald-400 text-xs font-extrabold uppercase tracking-widest px-3 py-1 rounded-full border border-emerald-500/30">
                        <i class="fa-solid fa-headset mr-1"></i> Layanan 24/7 Konsultasi Gratis
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold font-serif-heading text-white drop-shadow-md leading-tight">
                        Ingin Paket Custom Atau Tanya Promo Liburan?
                    </h2>
                    <p class="text-slate-200 text-sm sm:text-base max-w-xl font-medium leading-relaxed drop-shadow">
                        Konsultasikan rencana liburan Bali Anda secara gratis dengan customer service kami. Kami bantu racik itinerary terbaik sesuai budget Anda!
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <a href="https://wa.me/{{ $company->whatsapp_number ?? '6281338374254' }}?text=Halo%20Admin%20{{ urlencode($company->company_name ?? 'Bothrex Bali Tour') }},%20saya%20mau%20konsultasi%20paket%20tour%20custom" 
                       target="_blank" 
                       class="inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-2xl shadow-emerald-500/40 transition-all hover:scale-105 active:scale-95 text-sm border border-emerald-400/40">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                        <span>Chat CS 1 (0813-3837-4254)</span>
                    </a>
                    <a href="https://wa.me/{{ $company->whatsapp_number_2 ?? '6281246376329' }}?text=Halo%20Admin%20{{ urlencode($company->company_name ?? 'Bothrex Bali Tour') }},%20saya%20mau%20konsultasi%20paket%20tour%20custom" 
                       target="_blank" 
                       class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-2xl shadow-blue-600/40 transition-all hover:scale-105 active:scale-95 text-sm border border-blue-400/40">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                        <span>Chat CS 2 (0812-4637-6329)</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}type": "FAQPage",
  "mainEntity": [
    {
      "{{ '@' }}type": "Question",
      "name": "Apa saja paket wisata Bali yang paling populer di {{ addslashes($company->company_name ?? 'Bothrex Bali Tour') }}?",
      "acceptedAnswer": {
        "{{ '@' }}type": "Answer",
        "text": "Paket paling diminati traveler kami antara lain: One Day Tour Nusa Penida Barat (Kelingking & Diamond Beach), Jeep Sunrise Gunung Batur 4WD Kintamani, Ubud Swing & Monkey Forest Waterfall, serta Uluwatu Sunset & Pertunjukan Tari Kecak Jimbaran."
      }
    },
    {
      "{{ '@' }}type": "Question",
      "name": "Apakah tour ini bersifat Private atau digabung dengan peserta lain?",
      "acceptedAnswer": {
        "{{ '@' }}type": "Answer",
        "text": "Semua paket kami adalah Private Tour (Mobil Privat AC). Anda dan rombongan tidak akan digabung dengan orang asing, sehingga liburan lebih intim, leluasa, dan santai."
      }
    },
    {
      "{{ '@' }}type": "Question",
      "name": "Apakah paket tour sudah termasuk penjemputan dan pengantaran ke hotel?",
      "acceptedAnswer": {
        "{{ '@' }}type": "Answer",
        "text": "Ya, 100% Termasuk! Supir ramah kami akan menjemput langsung di lobi hotel/villa Anda di area Kuta, Seminyak, Legian, Canggu, Jimbaran, Nusa Dua, Sanur, Ubud, maupun Bandara Ngurah Rai."
      }
    },
    {
      "{{ '@' }}type": "Question",
      "name": "Bagaimana mekanisme pemesanan paket wisata?",
      "acceptedAnswer": {
        "{{ '@' }}type": "Answer",
        "text": "Pilih paket tour yang diinginkan di website, lengkapi tanggal dan jumlah tamu pada formulir booking, lalu klik tombol pesan. Sistem akan membuat kode booking resmi dan menghubungkan Anda langsung ke WhatsApp Customer Service kami untuk konfirmasi instan."
      }
    },
    {
      "{{ '@' }}type": "Question",
      "name": "Apakah jadwal waktu tour fleksibel?",
      "acceptedAnswer": {
        "{{ '@' }}type": "Answer",
        "text": "Sangat fleksibel! Waktu penjemputan dan durasi singgah di tiap destinasi wisata dapat disesuaikan dengan kenyamanan liburan Anda tanpa terburu-buru oleh jam kaku."
      }
    }
  ]
}
</script>
@endpush
