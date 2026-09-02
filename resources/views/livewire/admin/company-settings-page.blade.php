<div>
    <!-- Dashboard Header -->
    <div class="bg-slate-900 text-white py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Panel Kelola Admin</span>
                <h1 class="text-3xl font-extrabold font-serif-heading mt-1 flex items-center gap-3">
                    <i class="fa-solid fa-building text-emerald-500"></i> Pengaturan Data Perusahaan
                </h1>
                <p class="text-xs text-slate-300 mt-1">Kelola profil agen, kontak CS, alamat, rekening bank, dan tautan sosial media.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <i class="fa-solid fa-globe mr-1"></i> Web Utama
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-extrabold px-4 py-2.5 rounded-xl transition flex items-center gap-1.5 shadow">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Admin Navigation Tabs -->
        <div class="flex border-b border-slate-200 mb-8 space-x-4 overflow-x-auto">
            <a href="/admin/bookings" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/bookings*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-receipt"></i> Data Reservasi & Booking
            </a>
            <a href="/admin/packages" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/packages*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-compass"></i> Kelola Paket Wisata
            </a>
            <a href="/admin/destinations" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/destinations*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-map-location-dot"></i> Kelola Destinasi
            </a>
            <a href="/admin/attractions" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/attractions*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-camera-retro"></i> Tempat Wisata & Kategori
            </a>
            <a href="/admin/company" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/company*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-sliders"></i> Profil & Pengaturan PT
            </a>
        </div>

        <!-- Flash Message Notification -->
        @if (session()->has('message'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 text-xs font-bold flex items-center justify-between shadow-sm">
            <span><i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i> {{ session('message') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <form wire:submit.prevent="saveSettings" class="space-y-8">

            <!-- Section 1: Basic Company Info & Contact -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                <h2 class="text-lg font-bold text-slate-900 font-serif-heading mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-address-card text-emerald-600"></i> Identitas & Kontak Perusahaan
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Perusahaan / Travel *</label>
                        <input type="text" 
                               wire:model="company_name" 
                               placeholder="Bothrex Bali Tour" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @error('company_name') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tagline Perusahaan</label>
                        <input type="text" 
                               wire:model="tagline" 
                               placeholder="Agen Tour & Travel Resmi Bali #1" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Telepon CS *</label>
                        <input type="text" 
                               wire:model="phone" 
                               placeholder="+62 812-3456-7890" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @error('phone') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp CS (Tanpa +, Cth: 6281234567890) *</label>
                        <input type="text" 
                               wire:model="whatsapp_number" 
                               placeholder="6281234567890" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @error('whatsapp_number') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Perusahaan *</label>
                        <input type="email" 
                               wire:model="email" 
                               placeholder="info@bothrexbalitour.com" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @error('email') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Operasional</label>
                        <input type="text" 
                               wire:model="operating_hours" 
                               placeholder="Senin - Minggu: 07:00 - 22:00 WITA" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap Kantor *</label>
                        <input type="text" 
                               wire:model="address" 
                               placeholder="Jl. Raya Kuta No. 88, Badung, Bali" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @error('address') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: About Text & Bank Account Details -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                <h2 class="text-lg font-bold text-slate-900 font-serif-heading mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-file-lines text-emerald-600"></i> Tentang Perusahaan & Rekening Pembayaran
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Tentang Perusahaan (Footer & Web)</label>
                        <textarea wire:model="about_text" 
                                  rows="5" 
                                  placeholder="Tuliskan deskripsi singkat profil travel anda..." 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Rincian Rekening Bank (Untuk Pembayaran)</label>
                        <textarea wire:model="bank_info" 
                                  rows="5" 
                                  placeholder="Contoh:&#10;BCA: 123-456-7890 a/n Bothrex Tour&#10;Mandiri: 987-654-3210 a/n Bothrex Tour" 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 3: Social Media Links -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                <h2 class="text-lg font-bold text-slate-900 font-serif-heading mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-share-nodes text-emerald-600"></i> Tautan Media Sosial
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fa-brands fa-instagram text-pink-600 mr-1.5"></i> Instagram URL</label>
                        <input type="url" 
                               wire:model="instagram_url" 
                               placeholder="https://instagram.com/bothrexbalitour" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fa-brands fa-facebook text-blue-600 mr-1.5"></i> Facebook URL</label>
                        <input type="url" 
                               wire:model="facebook_url" 
                               placeholder="https://facebook.com/bothrexbalitour" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fa-brands fa-tiktok text-slate-900 mr-1.5"></i> TikTok URL</label>
                        <input type="url" 
                               wire:model="tiktok_url" 
                               placeholder="https://tiktok.com/@bothrexbalitour" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2"><i class="fa-brands fa-youtube text-red-600 mr-1.5"></i> YouTube URL</label>
                        <input type="url" 
                               wire:model="youtube_url" 
                               placeholder="https://youtube.com/@bothrexbalitour" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold px-8 py-4 rounded-2xl shadow-lg shadow-emerald-600/30 transition-all hover:scale-105 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Data Company</span>
                </button>
            </div>
        </form>
    </div>
</div>
