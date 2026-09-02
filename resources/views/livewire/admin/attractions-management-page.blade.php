<div>
    <!-- Dashboard Header -->
    <div class="bg-slate-900 text-white py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Panel Kelola Admin</span>
                <h1 class="text-3xl font-extrabold font-serif-heading mt-1 flex items-center gap-3">
                    <i class="fa-solid fa-camera-retro text-emerald-500"></i> Kelola Tempat Wisata & Kategorinya
                </h1>
                <p class="text-xs text-slate-300 mt-1">Kelola spot foto / tempat wisata Bali dan buat kategori destinasi wisata.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <i class="fa-solid fa-globe mr-1"></i> Web Utama
                </a>
                @if($activeTab === 'attractions')
                <button wire:click="openCreateAttractionModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-5 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-plus text-sm"></i> Tambah Tempat Wisata
                </button>
                @else
                <button wire:click="openCreateCategoryModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-5 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-plus text-sm"></i> Tambah Kategori Baru
                </button>
                @endif
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
            <a href="/admin/bookings" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-receipt"></i> Data Reservasi & Booking
            </a>
            <a href="/admin/packages" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-compass"></i> Kelola Paket Wisata
            </a>
            <a href="/admin/destinations" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-map-location-dot"></i> Kelola Destinasi
            </a>
            <a href="/admin/attractions" class="py-3 px-5 text-xs font-bold text-emerald-700 border-b-2 border-emerald-600 flex items-center gap-2">
                <i class="fa-solid fa-camera-retro"></i> Tempat Wisata & Kategori
            </a>
            <a href="/admin/company" class="py-3 px-5 text-xs font-bold text-slate-500 hover:text-emerald-600 transition flex items-center gap-2 border-b-2 border-transparent">
                <i class="fa-solid fa-building"></i> Profil & Pengaturan PT
            </a>
        </div>

        @if(session()->has('message'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-5 py-3.5 rounded-2xl text-xs font-bold mb-6 flex items-center justify-between shadow-sm">
            <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('message') }}</span>
        </div>
        @endif

        <!-- Sub-Tabs Switch (Tempat Wisata VS Kategori) -->
        <div class="flex items-center gap-3 mb-6">
            <button wire:click="switchTab('attractions')" class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition flex items-center gap-2 {{ $activeTab === 'attractions' ? 'bg-slate-900 text-white shadow' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                <i class="fa-solid fa-location-pin"></i> Daftar Tempat Wisata ({{ count($attractions) }})
            </button>
            <button wire:click="switchTab('categories')" class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition flex items-center gap-2 {{ $activeTab === 'categories' ? 'bg-slate-900 text-white shadow' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                <i class="fa-solid fa-layer-group"></i> Kategori Tempat Wisata ({{ count($categories) }})
            </button>
        </div>

        <!-- TAB 1: DAFTAR TEMPAT WISATA -->
        @if($activeTab === 'attractions')
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div class="relative w-full md:w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" wire:model.live="search" placeholder="Cari nama tempat wisata / lokasi..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-3.5 px-4">Tempat Wisata</th>
                            <th class="py-3.5 px-4">Destinasi Wilayah</th>
                            <th class="py-3.5 px-4">Kategori</th>
                            <th class="py-3.5 px-4">Info Tiket / Keterangan</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($attractions as $attr)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $attr->image_url }}" alt="{{ $attr->name }}" class="w-12 h-10 rounded-xl object-cover shrink-0 shadow-sm border">
                                    <div>
                                        <h4 class="font-bold text-slate-900">{{ $attr->name }}</h4>
                                        <span class="text-[11px] text-slate-500">{{ $attr->location }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-700">
                                {{ $attr->destination->name ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($attr->category)
                                <span class="bg-slate-100 text-slate-700 text-[10px] font-bold px-2.5 py-1 rounded-lg border border-slate-200 inline-flex items-center gap-1">
                                    <i class="fa-solid {{ $attr->category->icon ?? 'fa-tag' }} text-emerald-600"></i>
                                    {{ $attr->category->name }}
                                </span>
                                @else
                                <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $attr->ticket_price_info ?? 'Gratis / Standard' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($attr->is_active)
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Aktif</span>
                                @else
                                <span class="bg-slate-200 text-slate-600 text-[10px] font-bold px-2.5 py-1 rounded-full">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="toggleAttractionActive({{ $attr->id }})" title="Toggle Active/Disable" class="p-1.5 rounded-lg {{ $attr->is_active ? 'bg-amber-100 text-amber-800 hover:bg-amber-200' : 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' }} transition">
                                        <i class="fa-solid {{ $attr->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                    <button wire:click="openEditAttractionModal({{ $attr->id }})" class="p-1.5 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="deleteAttraction({{ $attr->id }})" wire:confirm="Hapus tempat wisata ini?" class="p-1.5 bg-rose-100 text-rose-800 hover:bg-rose-200 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Belum ada data tempat wisata. Klik "Tambah Tempat Wisata" untuk menambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- TAB 2: KATEGORI TEMPAT WISATA -->
        @if($activeTab === 'categories')
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-3.5 px-4">Kategori Wisata</th>
                            <th class="py-3.5 px-4">Icon FontAwesome</th>
                            <th class="py-3.5 px-4">Deskripsi Singkat</th>
                            <th class="py-3.5 px-4 text-center">Jumlah Tempat Wisata</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                {{ $cat->name }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="bg-slate-100 px-2.5 py-1 rounded-lg text-slate-700 font-mono text-[11px] inline-flex items-center gap-1.5">
                                    <i class="fa-solid {{ $cat->icon }} text-emerald-600"></i> {{ $cat->icon }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $cat->description ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center font-extrabold text-slate-800">
                                {{ $cat->attractions_count }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($cat->is_active)
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Aktif</span>
                                @else
                                <span class="bg-slate-200 text-slate-600 text-[10px] font-bold px-2.5 py-1 rounded-full">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="toggleCategoryActive({{ $cat->id }})" title="Toggle Status" class="p-1.5 rounded-lg {{ $cat->is_active ? 'bg-amber-100 text-amber-800 hover:bg-amber-200' : 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' }} transition">
                                        <i class="fa-solid {{ $cat->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                    <button wire:click="openEditCategoryModal({{ $cat->id }})" class="p-1.5 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-lg transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="deleteCategory({{ $cat->id }})" wire:confirm="Hapus kategori tempat wisata ini?" class="p-1.5 bg-rose-100 text-rose-800 hover:bg-rose-200 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">Belum ada kategori tempat wisata.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>

    <!-- MODAL 1: ATTRACTION FORM -->
    @if($showAttractionModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full p-6 sm:p-8 max-h-[90vh] overflow-y-auto border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <h3 class="text-lg font-bold text-slate-900 font-serif-heading">
                    {{ $editingAttractionId ? 'Edit Tempat Wisata' : 'Tambah Tempat Wisata Baru' }}
                </h3>
                <button wire:click="$set('showAttractionModal', false)" class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form wire:submit.prevent="saveAttraction" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Destinasi Wilayah *</label>
                        <select wire:model="destination_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                            @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori Wisata</label>
                        <select wire:model="attraction_category_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Tanpa Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Tempat Wisata *</label>
                    <input type="text" wire:model="attraction_name" placeholder="Contoh: Kelingking Beach" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    @error('attraction_name') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Lokasi Spesiﬁk</label>
                        <input type="text" wire:model="attraction_location" placeholder="Contoh: Nusa Penida, Klungkung" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Info Tiket / Keterangan</label>
                        <input type="text" wire:model="attraction_ticket_price_info" placeholder="Contoh: Termasuk dalam paket tour" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">URL Foto Tempat Wisata *</label>
                    <input type="url" wire:model="attraction_image_url" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    @error('attraction_image_url') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat Tempat Wisata</label>
                    <textarea wire:model="attraction_description" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                        <input type="checkbox" wire:model="attraction_is_active" class="rounded text-emerald-600 focus:ring-emerald-500">
                        <span>Aktifkan Tempat Wisata Ini</span>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" wire:click="$set('showAttractionModal', false)" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">Batal</button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 text-white text-xs font-extrabold shadow hover:bg-emerald-700">Simpan Tempat Wisata</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- MODAL 2: CATEGORY FORM -->
    @if($showCategoryModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 sm:p-8 border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <h3 class="text-lg font-bold text-slate-900 font-serif-heading">
                    {{ $editingCategoryId ? 'Edit Kategori Wisata' : 'Tambah Kategori Baru' }}
                </h3>
                <button wire:click="$set('showCategoryModal', false)" class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form wire:submit.prevent="saveCategory" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Kategori Wisata *</label>
                    <input type="text" wire:model="category_name" placeholder="Contoh: Pantai & Pulau" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    @error('category_name') <span class="text-rose-500 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Icon FontAwesome (fa-solid) *</label>
                    <input type="text" wire:model="category_icon" placeholder="fa-umbrella-beach" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500">
                    <span class="text-[10px] text-slate-400 mt-1 block">Contoh: fa-umbrella-beach, fa-gopuram, fa-mountain, fa-water</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat</label>
                    <textarea wire:model="category_description" rows="2" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                        <input type="checkbox" wire:model="category_is_active" class="rounded text-emerald-600 focus:ring-emerald-500">
                        <span>Aktifkan Kategori</span>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" wire:click="$set('showCategoryModal', false)" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">Batal</button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 text-white text-xs font-extrabold shadow hover:bg-emerald-700">Simpan Kategori</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
