<div>
    <!-- Hero / Breadcrumb Header -->
    <div class="bg-slate-900 text-white py-12 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                <a href="/" class="hover:text-emerald-400">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="/paket" class="hover:text-emerald-400">Paket Wisata</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-emerald-400 truncate">{{ $package->title }}</span>
            </div>
            <div class="flex flex-wrap items-center gap-3 mb-2">
                <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-xs font-bold px-3 py-1 rounded-full">
                    <i class="fa-solid fa-location-dot mr-1"></i> {{ $package->destination->name ?? 'Bali' }}
                </span>
                <span class="bg-amber-500/20 text-amber-300 border border-amber-500/40 text-xs font-bold px-3 py-1 rounded-full">
                    <i class="fa-solid fa-star mr-1"></i> {{ $package->rating }} ({{ $package->review_count }} Ulasan)
                </span>
                @if($package->badge)
                <span class="bg-gradient-gold text-white text-xs font-extrabold px-3 py-1 rounded-full">
                    {{ $package->badge }}
                </span>
                @endif
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-serif-heading leading-snug max-w-4xl">
                {{ $package->title }}
            </h1>
        </div>
    </div>

    <!-- Main Content & Booking Form Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Details, Gallery, Itinerary & Inclusions -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Gallery Image -->
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 h-96 relative">
                    <img src="{{ $package->image_url }}" alt="{{ $package->title }}" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 right-4 bg-black/70 backdrop-blur-md text-white text-xs px-4 py-2 rounded-full flex items-center gap-2 border border-white/20">
                        <i class="fa-solid fa-person-walking-luggage text-emerald-400"></i> Durasi: <strong>{{ $package->duration }}</strong>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-slate-900 font-serif-heading mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-emerald-600"></i> Deskripsi Paket Tour
                    </h2>
                    <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                        {{ $package->description }}
                    </p>
                </div>

                <!-- Rangkaian Tujuan Wisata & Flexi Itinerary -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-slate-100">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 font-serif-heading flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-emerald-600"></i> Rangkaian Tujuan Wisata
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">Layanan kendaraan privat & waktu tour santai fleksibel tanpa terburu-buru jam.</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 text-xs font-extrabold px-3 py-1.5 rounded-full border border-emerald-300 shrink-0">
                            <i class="fa-solid fa-car-side"></i> Privat Jemput-Antar Hotel
                        </span>
                    </div>

                    <div class="space-y-5 relative before:absolute before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-emerald-200">
                        @foreach($package->itinerary ?? [] as $index => $item)
                        <div class="relative pl-10">
                            <div class="absolute left-1.5 top-2 w-5 h-5 rounded-full bg-emerald-600 border-4 border-white shadow flex items-center justify-center text-[10px] text-white font-bold"></div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 hover:border-emerald-300 transition">
                                <div class="flex items-center gap-2">
                                    <span class="bg-emerald-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                        Rute #{{ $index + 1 }}
                                    </span>
                                    <h3 class="text-sm font-bold text-slate-900">{{ $item['title'] }}</h3>
                                </div>
                                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">{{ $item['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Inclusions & Exclusions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Inclusions -->
                    <div class="bg-emerald-50/70 p-6 rounded-3xl border border-emerald-200">
                        <h3 class="text-base font-bold text-emerald-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Fasilitas Termasuk
                        </h3>
                        <ul class="space-y-2.5 text-xs text-emerald-950 font-medium">
                            @foreach($package->inclusions ?? [] as $inc)
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 mt-0.5"></i>
                                <span>{{ $inc }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Exclusions -->
                    <div class="bg-rose-50/70 p-6 rounded-3xl border border-rose-200">
                        <h3 class="text-base font-bold text-rose-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-circle-xmark text-rose-600"></i> Belum Termasuk
                        </h3>
                        <ul class="space-y-2.5 text-xs text-rose-950 font-medium">
                            @foreach($package->exclusions ?? [] as $exc)
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-xmark text-rose-500 mt-0.5"></i>
                                <span>{{ $exc }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Booking Form Card -->
            <div class="lg:col-span-1" 
                 x-data="{
                    guests: @entangle('number_of_guests').live,
                    days: @entangle('duration_days').live,
                    unitPrice: {{ (int)$package->price }},
                    get numGuests() {
                        return Math.max(1, parseInt(this.guests) || 1);
                    },
                    get numDays() {
                        return Math.max(1, parseInt(this.days) || 1);
                    },
                    get totalAmount() {
                        return this.numGuests * this.numDays * this.unitPrice;
                    },
                    setDays(d) {
                        this.days = d;
                    },
                    setGuests(g) {
                        this.guests = g;
                    },
                    incGuests() {
                        if (this.numGuests < 50) this.guests = this.numGuests + 1;
                    },
                    decGuests() {
                        if (this.numGuests > 1) this.guests = this.numGuests - 1;
                    },
                    incDays() {
                        if (this.numDays < 30) this.days = this.numDays + 1;
                    },
                    decDays() {
                        if (this.numDays > 1) this.days = this.numDays - 1;
                    }
                 }">
                <div class="bg-white p-6 sm:p-7 rounded-3xl shadow-xl border border-slate-200 sticky top-24">
                    <!-- Pricing Header -->
                    <div class="pb-5 border-b border-slate-100 mb-5">
                        <div class="flex items-center justify-between gap-2 mb-1.5">
                            <span class="text-[11px] font-extrabold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-car mr-1"></i> Private Tour AC
                            </span>
                            @if($package->original_price)
                            <span class="text-xs text-rose-600 font-bold bg-rose-50 px-2 py-0.5 rounded-full">
                                Hemat {{ round((($package->original_price - $package->price) / $package->original_price) * 100) }}%
                            </span>
                            @endif
                        </div>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl sm:text-4xl font-extrabold text-emerald-700 tracking-tight" x-text="$store.currency ? $store.currency.format({{ (int)$package->price }}) : 'Rp {{ number_format($package->price, 0, ',', '.') }}'">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                            @if($package->original_price)
                            <span class="text-sm text-slate-400 line-through" x-text="$store.currency ? $store.currency.format({{ (int)$package->original_price }}) : 'Rp {{ number_format($package->original_price, 0, ',', '.') }}'">
                                Rp {{ number_format($package->original_price, 0, ',', '.') }}
                            </span>
                            @endif
                        </div>
                        <span class="text-xs text-slate-500 mt-1 block font-medium">/ orang / hari (All-In Mobil Privat & Supir)</span>
                    </div>

                    <!-- Booking Form -->
                    <form wire:submit.prevent="submitBooking" class="space-y-4">
                        <!-- Customer Name -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                                <span>Nama Pemesan *</span>
                                <span class="text-[10px] text-slate-400 font-normal lowercase">(sesuai KTP/Passport)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </div>
                                <input type="text" 
                                       wire:model="customer_name" 
                                       placeholder="Nama Lengkap Anda" 
                                       class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                            </div>
                            @error('customer_name') <span class="text-[11px] text-rose-500 mt-1 block font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                        </div>

                        <!-- WhatsApp & Email in 2 columns -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- WhatsApp -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. WhatsApp *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-600">
                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           wire:model="customer_phone" 
                                           placeholder="081234567890" 
                                           class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                                </div>
                                @error('customer_phone') <span class="text-[11px] text-rose-500 mt-1 block font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Pemesan *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-envelope text-xs"></i>
                                    </div>
                                    <input type="email" 
                                           wire:model="customer_email" 
                                           placeholder="email@anda.com" 
                                           class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                                </div>
                                @error('customer_email') <span class="text-[11px] text-rose-500 mt-1 block font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Date Picker -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                <i class="fa-solid fa-calendar-days text-emerald-600 mr-1"></i> Tanggal Mulai Tour *
                            </label>
                            <input type="date" 
                                   wire:model.live="travel_date" 
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                            @error('travel_date') <span class="text-[11px] text-rose-500 mt-1 block font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
                        </div>

                        <!-- Duration & Guests Steppers -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <!-- Duration Stepper -->
                            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2 flex items-center justify-between">
                                    <span><i class="fa-solid fa-clock text-emerald-600 mr-1"></i> Durasi Tour</span>
                                    <span class="text-xs font-extrabold text-emerald-700" x-text="numDays + ' Hari'"></span>
                                </label>
                                <div class="flex items-center justify-between bg-white rounded-xl border border-slate-200 p-1">
                                    <button type="button" @click="decDays()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-700 flex items-center justify-center font-bold text-base transition active:scale-90 cursor-pointer">
                                        <i class="fa-solid fa-minus text-xs"></i>
                                    </button>
                                    <input type="number" 
                                           wire:model.live="duration_days" 
                                           min="1" max="30"
                                           class="w-12 text-center font-extrabold text-sm text-slate-900 focus:outline-none border-0 p-0">
                                    <button type="button" @click="incDays()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-700 flex items-center justify-center font-bold text-base transition active:scale-90 cursor-pointer">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <template x-for="d in [1, 2, 3, 4, 5]" :key="d">
                                        <button type="button" 
                                                @click="setDays(d)" 
                                                class="flex-1 py-1 rounded-lg text-[10px] font-bold transition cursor-pointer"
                                                :class="numDays === d ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-200 border border-slate-200'"
                                                x-text="d + 'h'"></button>
                                    </template>
                                </div>
                                @error('duration_days') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Guests Stepper -->
                            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2 flex items-center justify-between">
                                    <span><i class="fa-solid fa-users text-emerald-600 mr-1"></i> Peserta</span>
                                    <span class="text-xs font-extrabold text-emerald-700" x-text="numGuests + ' Orang'"></span>
                                </label>
                                <div class="flex items-center justify-between bg-white rounded-xl border border-slate-200 p-1">
                                    <button type="button" @click="decGuests()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-700 flex items-center justify-center font-bold text-base transition active:scale-90 cursor-pointer">
                                        <i class="fa-solid fa-minus text-xs"></i>
                                    </button>
                                    <input type="number" 
                                           wire:model.live="number_of_guests" 
                                           min="1" max="50"
                                           class="w-12 text-center font-extrabold text-sm text-slate-900 focus:outline-none border-0 p-0">
                                    <button type="button" @click="incGuests()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-700 flex items-center justify-center font-bold text-base transition active:scale-90 cursor-pointer">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <template x-for="g in [2, 4, 6, 8]" :key="g">
                                        <button type="button" 
                                                @click="setGuests(g)" 
                                                class="flex-1 py-1 rounded-lg text-[10px] font-bold transition cursor-pointer"
                                                :class="numGuests === g ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-200 border border-slate-200'"
                                                x-text="g + 'p'"></button>
                                    </template>
                                </div>
                                @error('number_of_guests') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pickup Location -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                <i class="fa-solid fa-location-dot text-emerald-600 mr-1"></i> Lokasi Penjemputan
                            </label>
                            <input type="text" 
                                   wire:model="pickup_location" 
                                   placeholder="Contoh: Hotel Grand Inna Kuta / Bandara Ngurah Rai" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                        </div>

                        <!-- Special Notes -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                <i class="fa-solid fa-pen-to-square text-emerald-600 mr-1"></i> Permintaan Khusus / Catatan (Opsional)
                            </label>
                            <textarea wire:model="special_notes" 
                                      rows="2" 
                                      placeholder="Contoh: Butuh baby car seat, preferensi jam jemput, makanan halal, dll..." 
                                      class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition"></textarea>
                        </div>

                        <!-- Live Price Breakdown & Estimasi Total Biaya Card -->
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50/70 p-4 sm:p-5 rounded-2xl border border-emerald-200/80 my-4 space-y-2.5">
                            <div class="flex items-center justify-between text-xs text-slate-600 pb-2 border-b border-emerald-200/60">
                                <span class="font-medium">Kalkulasi Tarif:</span>
                                <span class="font-bold text-slate-800" x-text="numGuests + ' Peserta × ' + numDays + ' Hari × ' + ($store.currency ? $store.currency.format(unitPrice) : 'Rp ' + unitPrice.toLocaleString('id-ID'))">
                                    {{ $number_of_guests ?? 2 }} Orang x {{ $duration_days ?? 1 }} Hari x Rp {{ number_format($package->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div>
                                    <span class="text-xs font-extrabold text-slate-800 uppercase tracking-wider block">Estimasi Total Biaya:</span>
                                    <span class="text-[10px] text-emerald-700 font-semibold flex items-center gap-1 mt-0.5">
                                        <i class="fa-solid fa-circle-check"></i> Harga All-In (Tanpa Biaya Tersembunyi)
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl sm:text-3xl font-extrabold text-emerald-700 tracking-tight" 
                                          x-text="$store.currency ? $store.currency.format(totalAmount) : 'Rp ' + totalAmount.toLocaleString('id-ID')">
                                        Rp {{ number_format($this->calculateTotal(), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit CTA Button -->
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:opacity-60 text-white font-extrabold py-4 px-4 rounded-2xl shadow-xl shadow-emerald-600/30 transition-all hover:scale-[1.01] active:scale-95 text-sm flex items-center justify-center gap-2 cursor-pointer">
                            <span wire:loading.remove class="inline-flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                                <span>Pesan Paket Sekarang & Chat WA</span>
                            </span>
                            <span wire:loading class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-lg"></i>
                                <span>Menyimpan Pesanan...</span>
                            </span>
                        </button>
                    </form>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-center gap-4 text-[11px] text-slate-500 font-medium">
                        <span class="flex items-center gap-1"><i class="fa-solid fa-lock text-emerald-600"></i> Data Terenkripsi</span>
                        <span>•</span>
                        <span class="flex items-center gap-1"><i class="fa-solid fa-shield-halved text-emerald-600"></i> Agen Resmi Terpercaya</span>
                    </div>

                    <!-- Share Package to Social Media Widget -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="text-xs font-bold text-slate-500">Bagikan Paket Ini:</span>
                        <div class="flex items-center gap-2">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode('Cek paket liburan Bali keren ini: ' . $package->title . ' - ' . url()->current()) }}" 
                               target="_blank" 
                               class="bg-emerald-100 hover:bg-emerald-200 text-emerald-800 text-xs font-bold px-3 py-1.5 rounded-xl transition flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i> Share WA
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link paket berhasil disalin!')" 
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-xl transition flex items-center gap-1.5">
                                <i class="fa-solid fa-copy"></i> Salin Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Success & WhatsApp Modal -->
    @if($showSuccessModal && $createdBooking)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4 animate-fade-in">
        <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl relative text-center border border-slate-200">
            <!-- Close icon -->
            <button wire:click="$set('showSuccessModal', false)" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <!-- Check mark icon -->
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl shadow-inner">
                <i class="fa-solid fa-circle-check animate-bounce"></i>
            </div>

            <h3 class="text-2xl font-extrabold text-slate-900 font-serif-heading">Reservasi Berhasil Disimpan!</h3>
            <p class="text-xs text-slate-600 mt-2">
                Data pesanan Anda telah resmi tersimpan di sistem kami dengan Kode Booking:
            </p>

            <div class="bg-slate-100 p-3 rounded-2xl my-4 inline-block font-mono font-bold text-emerald-700 text-base border border-slate-200">
                📌 {{ $createdBooking->booking_code }}
            </div>

            <div class="bg-slate-50 p-4 rounded-2xl text-left text-xs space-y-2 border border-slate-200 my-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Paket:</span>
                    <strong class="text-slate-800">{{ $package->title }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Pemesan:</span>
                    <strong class="text-slate-800">{{ $createdBooking->customer_name }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal Mulai:</span>
                    <strong class="text-slate-800">{{ $createdBooking->travel_date->format('d M Y') }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Durasi Tour:</span>
                    <strong class="text-emerald-700 font-bold">{{ $createdBooking->duration_days ?? 1 }} Hari</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Jumlah Peserta:</span>
                    <strong class="text-slate-800">{{ $createdBooking->number_of_guests }} Orang</strong>
                </div>
                <div class="flex justify-between pt-2 border-t border-slate-200 font-bold text-slate-900">
                    <span>Estimasi Total Biaya:</span>
                    <span class="text-emerald-700 text-sm font-extrabold" x-text="$store.currency ? $store.currency.format({{ (int)$createdBooking->total_price }}) : 'Rp {{ number_format($createdBooking->total_price, 0, ',', '.') }}'">Rp {{ number_format($createdBooking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="text-xs text-slate-500 my-4">
                Pilih salah satu nomor WhatsApp Customer Service kami di bawah untuk konfirmasi & reservasi:
            </p>

            <div class="space-y-2.5">
                <a href="{{ $createdBooking->whatsapp_link }}" 
                   target="_blank" 
                   class="w-full inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-3.5 px-4 rounded-2xl shadow-lg shadow-emerald-600/30 transition-all hover:scale-[1.02] text-sm">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                    <div class="text-left">
                        <div class="font-bold">Chat WhatsApp CS 1</div>
                        <div class="text-[11px] text-emerald-100 font-normal">0813-3837-4254 (Fast Response)</div>
                    </div>
                </a>

                <a href="{{ $createdBooking->whatsapp_link_2 }}" 
                   target="_blank" 
                   class="w-full inline-flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3.5 px-4 rounded-2xl shadow-lg shadow-blue-600/30 transition-all hover:scale-[1.02] text-sm">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                    <div class="text-left">
                        <div class="font-bold">Chat WhatsApp CS 2</div>
                        <div class="text-[11px] text-blue-100 font-normal">0812-4637-6329 (Alternatif)</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

@push('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}graph": [
    {
      "{{ '@' }}type": ["TouristTrip", "Product"],
      "{{ '@' }}id": "{{ url('/paket/' . $package->slug) }}#trip",
      "name": "{{ addslashes($package->title) }}",
      "description": "{{ addslashes(Str::limit(strip_tags($package->description), 200)) }}",
      "image": "{{ $package->image_url }}",
      "touristType": ["Family", "Couple", "Solo Traveler", "Group"],
      "offers": {
        "{{ '@' }}type": "Offer",
        "price": "{{ $package->price }}",
        "priceCurrency": "IDR",
        "availability": "https://schema.org/InStock",
        "url": "{{ url('/paket/' . $package->slug) }}",
        "validFrom": "{{ date('Y-01-01') }}",
        "priceValidUntil": "{{ date('Y-12-31') }}"
      },
      "aggregateRating": {
        "{{ '@' }}type": "AggregateRating",
        "ratingValue": "{{ $package->rating ?? 4.9 }}",
        "bestRating": "5",
        "worstRating": "1",
        "reviewCount": "{{ $package->review_count ?? 150 }}"
      },
      "provider": {
        "{{ '@' }}type": "TravelAgency",
        "name": "{{ $company->company_name ?? 'Bothrex Bali Tour & Travel' }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ $company->phone ?? '+62 812-3456-7890' }}"
      },
      "itinerary": {
        "{{ '@' }}type": "ItemList",
        "numberOfItems": {{ count($package->itinerary ?? []) }},
        "itemListElement": [
          @foreach($package->itinerary ?? [] as $idx => $item)
          {
            "{{ '@' }}type": "TouristAttraction",
            "position": {{ $idx + 1 }},
            "name": "{{ addslashes($item['title'] ?? '') }}",
            "description": "{{ addslashes($item['description'] ?? '') }}"
          }@if(!$loop->last),@endif
          @endforeach
        ]
      }
    },
    {
      "{{ '@' }}type": "BreadcrumbList",
      "{{ '@' }}id": "{{ url('/paket/' . $package->slug) }}#breadcrumbs",
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
          "name": "Paket Wisata Bali",
          "item": "{{ url('/paket') }}"
        },
        {
          "{{ '@' }}type": "ListItem",
          "position": 3,
          "name": "{{ addslashes($package->title) }}",
          "item": "{{ url('/paket/' . $package->slug) }}"
        }
      ]
    }
  ]
}
</script>
@endpush
