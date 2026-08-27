<div>
    <!-- Dashboard Header -->
    <div class="bg-slate-900 text-white py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Panel Kelola Admin</span>
                <h1 class="text-3xl font-extrabold font-serif-heading mt-1 flex items-center gap-3">
                    <i class="fa-solid fa-map-location-dot text-emerald-500"></i> Kelola Destinasi & Lokasi Wisata
                </h1>
                <p class="text-xs text-slate-300 mt-1">Tambah destinasi baru, atur lokasi & daya tarik wisata, atau non-aktifkan status.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <i class="fa-solid fa-globe mr-1"></i> Web Utama
                </a>
                <button wire:click="openCreateModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-5 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-plus text-sm"></i> Tambah Destinasi Baru
                </button>
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
        <div class="flex border-b border-slate-200 mb-8 space-x-4">
            <a href="/admin/bookings" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-receipt"></i> Data Reservasi & Booking
            </a>
            <a href="/admin/packages" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-compass"></i> Kelola Paket Wisata
            </a>
            <a href="/admin/destinations" class="py-3 px-5 text-xs font-bold text-emerald-700 border-b-2 border-emerald-600 flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot"></i> Kelola Destinasi
            </a>
            <a href="/admin/company" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-sliders"></i> Profil & Kontak Perusahaan
            </a>
        </div>

        <!-- Flash Message Notification -->
        @if (session()->has('message'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 text-xs font-bold flex items-center justify-between shadow-sm">
            <span><i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i> {{ session('message') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8 flex justify-between items-center">
            <div class="w-full md:w-96 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari nama destinasi / lokasi..." 
                       class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <span class="text-xs text-slate-500 font-semibold">
                Total: <strong class="text-slate-900">{{ $destinations->count() }}</strong> Destinasi
            </span>
        </div>

        <!-- Destinations Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-100/80 text-slate-800 font-bold uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-6">Destinasi</th>
                            <th class="py-4 px-6">Kategori & Lokasi</th>
                            <th class="py-4 px-6">Paket Terikat</th>
                            <th class="py-4 px-6 text-center">Status Visi</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($destinations as $dest)
                        <tr class="hover:bg-slate-50/80 transition-colors {{ !$dest->is_active ? 'bg-rose-50/30' : '' }}">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $dest->image_url }}" alt="{{ $dest->name }}" class="w-14 h-10 object-cover rounded-xl border border-slate-200">
                                    <div>
                                        <div class="font-bold text-slate-900 text-sm">{{ $dest->name }}</div>
                                        @if($dest->is_popular)
                                        <span class="inline-block bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded mt-0.5">
                                            Populer
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-900">{{ $dest->category }}</div>
                                <div class="text-slate-500 text-[11px]"><i class="fa-solid fa-location-dot text-amber-500 mr-1"></i> {{ $dest->location }}</div>
                            </td>

                            <td class="py-4 px-6 font-bold text-slate-800">
                                {{ $dest->packages_count }} Paket Tour
                            </td>

                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <button wire:click="toggleActive({{ $dest->id }})" 
                                        class="px-3 py-1.5 rounded-full font-bold text-xs transition shadow-sm
                                        {{ $dest->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}">
                                    <i class="fa-solid {{ $dest->is_active ? 'fa-circle-check text-emerald-600 mr-1' : 'fa-circle-minus text-rose-600 mr-1' }}"></i>
                                    {{ $dest->is_active ? 'Aktif (Visible)' : 'Disabled (Hidden)' }}
                                </button>
                            </td>

                            <td class="py-4 px-6 text-right whitespace-nowrap space-x-2">
                                <button wire:click="openEditModal({{ $dest->id }})" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-xl font-bold text-xs transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </button>
                                <button onclick="confirm('Yakin ingin menghapus destinasi ini?') || event.stopImmediatePropagation()" wire:click="deleteDestination({{ $dest->id }})" class="bg-rose-100 hover:bg-rose-200 text-rose-700 px-3 py-1.5 rounded-xl font-bold text-xs transition">
                                    <i class="fa-solid fa-trash mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                Belum ada data destinasi wisata tersimpan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create / Edit Destination Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-xl w-full p-8 shadow-2xl relative border border-slate-200 my-8">
            <button wire:click="$set('showModal', false)" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h3 class="text-xl font-bold text-slate-900 font-serif-heading mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot text-emerald-600"></i> {{ $editingId ? 'Edit Destinasi Wisata' : 'Tambah Destinasi Baru' }}
            </h3>

            <form wire:submit.prevent="saveDestination" class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Destinasi / Wilayah *</label>
                    <input type="text" wire:model="name" placeholder="Contoh: Ubud & Gianyar" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    @error('name') <span class="text-rose-500 mt-0.5 block font-semibold">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Kategori *</label>
                        <input type="text" wire:model="category" placeholder="Pantai & Pulau / Budaya" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Lokasi Wilayah *</label>
                        <input type="text" wire:model="location" placeholder="Gianyar, Bali" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">URL Foto Destinasi *</label>
                    <input type="url" wire:model="image_url" placeholder="https://images.unsplash.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    @error('image_url') <span class="text-rose-500 mt-0.5 block font-semibold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat Destinasi *</label>
                    <textarea wire:model="description" rows="3" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Daya Tarik / Spot Highlights (1 per baris)</label>
                    <textarea wire:model="highlights_text" rows="3" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                </div>

                <div class="flex items-center space-x-6 pt-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_active" class="rounded text-emerald-600 focus:ring-emerald-500 mr-2">
                        <span class="font-bold text-slate-800">Status Aktif (Ditampilkan di Web)</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_popular" class="rounded text-emerald-600 focus:ring-emerald-500 mr-2">
                        <span class="font-bold text-slate-800">Tampilkan di Homepage (Populer)</span>
                    </label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                    <button type="button" wire:click="$set('showModal', false)" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-xl">Batal</button>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold px-6 py-2.5 rounded-xl shadow-lg">Simpan Destinasi</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
