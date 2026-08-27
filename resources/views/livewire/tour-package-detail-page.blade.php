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
                    <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs px-4 py-2 rounded-full flex items-center gap-2">
                        <i class="fa-solid fa-clock text-emerald-400"></i> Durasi: <strong>{{ $package->duration }}</strong>
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

                <!-- Itinerary Timeline -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-bold text-slate-900 font-serif-heading mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-route text-emerald-600"></i> Rencana Perjalanan (Itinerary)
                    </h2>
                    <div class="space-y-6 relative before:absolute before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-emerald-200">
                        @foreach($package->itinerary ?? [] as $item)
                        <div class="relative pl-10">
                            <div class="absolute left-1.5 top-1.5 w-5 h-5 rounded-full bg-emerald-600 border-4 border-white shadow flex items-center justify-center text-[10px] text-white font-bold"></div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                <span class="bg-emerald-100 text-emerald-800 text-[11px] font-extrabold px-2.5 py-0.5 rounded shadow-sm inline-block mb-1">
                                    {{ $item['time'] }} WITA
                                </span>
                                <h3 class="text-sm font-bold text-slate-900 mt-1">{{ $item['title'] }}</h3>
                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $item['description'] }}</p>
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
            <div class="lg:col-span-1">
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-slate-200 sticky top-24">
                    <div class="pb-6 border-b border-slate-100 mb-6">
                        <span class="text-xs text-slate-400 uppercase font-semibold block">Harga Spesial All-In</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl font-extrabold text-emerald-700">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            @if($package->original_price)
                            <span class="text-sm text-slate-400 line-through">Rp {{ number_format($package->original_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <span class="text-xs text-slate-500 mt-1 block">/ orang (Private Tour Car & Guide)</span>
                    </div>

                    <!-- Booking Form -->
                    <form wire:submit.prevent="submitBooking" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap Pemesan *</label>
                            <input type="text" 
                                   wire:model="customer_name" 
                                   placeholder="Contoh: Budi Santoso" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            @error('customer_name') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Pemesan *</label>
                            <input type="email" 
                                   wire:model="customer_email" 
                                   placeholder="budi@example.com" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            @error('customer_email') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">No. WhatsApp (Aktif) *</label>
                            <input type="text" 
                                   wire:model="customer_phone" 
                                   placeholder="081234567890" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            @error('customer_phone') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Tanggal Tour *</label>
                                <input type="date" 
                                       wire:model.live="travel_date" 
                                       class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                @error('travel_date') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jumlah Peserta *</label>
                                <input type="number" 
                                       wire:model.live="number_of_guests" 
                                       min="1" max="50" 
                                       class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                @error('number_of_guests') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Lokasi Penjemputan</label>
                            <input type="text" 
                                   wire:model="pickup_location" 
                                   placeholder="Nama Hotel / Bandara Ngurah Rai" 
                                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Catatan Tambahan</label>
                            <textarea wire:model="special_notes" 
                                      rows="2" 
                                      placeholder="Permintaan khusus / car seat / alergi makanan..." 
                                      class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                        </div>

                        <!-- Live Price Summary Box -->
                        <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-200 my-4">
                            <div class="flex justify-between items-center text-xs text-slate-600 mb-1">
                                <span>Kalkulasi Total ({{ $number_of_guests ?? 1 }} Orang):</span>
                                <span>{{ $number_of_guests ?? 1 }} x Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-emerald-200 text-sm font-extrabold text-emerald-900">
                                <span>Total Pembayaran:</span>
                                <span class="text-lg text-emerald-700">Rp {{ number_format($this->calculateTotal(), 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl shadow-xl shadow-emerald-600/30 transition-all hover:scale-[1.02] active:scale-95 text-sm flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Pesan Paket & Konfirmasi WA</span>
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <span class="text-[11px] text-slate-400 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-lock text-emerald-500"></i> Data tersimpan aman & langsung terhubung ke WA CS
                        </span>
                    </div>

                    <!-- Share Package to Social Media Widget -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
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

            <div class="bg-slate-50 p-4 rounded-2xl text-left text-xs space-y-1.5 border border-slate-200 my-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Paket:</span>
                    <strong class="text-slate-800">{{ $package->title }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Pemesan:</span>
                    <strong class="text-slate-800">{{ $createdBooking->customer_name }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal:</span>
                    <strong class="text-slate-800">{{ $createdBooking->travel_date->format('d M Y') }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Jumlah Peserta:</span>
                    <strong class="text-slate-800">{{ $createdBooking->number_of_guests }} Orang</strong>
                </div>
                <div class="flex justify-between pt-2 border-t border-slate-200 font-bold text-slate-900">
                    <span>Total Biaya:</span>
                    <span class="text-emerald-700 text-sm">Rp {{ number_format($createdBooking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="text-xs text-slate-500 my-4">
                Klik tombol di bawah untuk membuka WhatsApp dan menyelesaikan pembayaran serta verifikasi instruksi rekening admin.
            </p>

            <a href="{{ $createdBooking->whatsapp_link }}" 
               target="_blank" 
               class="w-full inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-4 rounded-2xl shadow-lg shadow-emerald-600/30 transition-all hover:scale-105 text-base">
                <i class="fa-brands fa-whatsapp text-2xl"></i>
                <span>Lanjut ke WhatsApp Admin</span>
            </a>
        </div>
    </div>
    @endif
</div>
