<div class="min-h-screen bg-slate-100">
    <!-- Top Header Bar -->
    <div class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap justify-between items-center gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-1">
                    <span>Panel Admin</span>
                    <span>/</span>
                    <span class="text-slate-800 font-bold">Artikel & Panduan SEO</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Kelola Artikel & Blog SEO</h1>
            </div>
            
            <div class="flex items-center gap-3">
                <button wire:click="openCreateModal" 
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl transition shadow-lg shadow-emerald-600/30 flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i> Tulis Artikel Baru
                </button>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 font-bold text-xs px-4 py-2.5 rounded-xl border border-slate-200 transition">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
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
            <a href="/admin/articles" class="py-3 px-5 text-xs font-bold transition flex items-center gap-2 border-b-2 whitespace-nowrap {{ request()->is('admin/articles*') ? 'text-emerald-700 border-emerald-600' : 'text-slate-500 hover:text-emerald-600 border-transparent' }}">
                <i class="fa-solid fa-newspaper"></i> Artikel & Blog SEO
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

        <!-- Filter & Search Bar -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="w-full md:w-96 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari artikel / kategori..." 
                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
            </div>

            <div class="w-full md:w-auto flex items-center gap-3">
                <select wire:model.live="categoryFilter" 
                        class="bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 py-2.5 px-4 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <option value="all">Semua Kategori</option>
                    <option value="Travel Guide">Travel Guide</option>
                    <option value="Itinerary">Itinerary</option>
                    <option value="Tips & Trik">Tips & Trik</option>
                    <option value="Hidden Gem">Hidden Gem</option>
                </select>
                <a href="/blog" target="_blank" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold py-2.5 px-4 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Lihat Halaman Blog
                </a>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-extrabold text-[10px] uppercase tracking-wider border-b border-slate-100">
                            <th class="py-4 px-6">Artikel & Panduan</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6 text-center">Dibaca (Views)</th>
                            <th class="py-4 px-6 text-center">Featured</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                        @forelse($articles as $art)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3 max-w-md">
                                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-16 h-12 object-cover rounded-lg shrink-0 border border-slate-200">
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-900 truncate">{{ $art->title }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $art->excerpt }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">Penulis: {{ $art->author_name }} &bull; {{ $art->reading_time }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-emerald-50 text-emerald-800 font-bold px-2.5 py-1 rounded-md text-[11px]">
                                    {{ $art->category }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-slate-800">
                                <i class="fa-regular fa-eye mr-1 text-slate-400"></i> {{ number_format($art->views_count) }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button type="button" 
                                        wire:click="toggleFeatured({{ $art->id }})" 
                                        class="cursor-pointer {{ $art->is_featured ? 'text-amber-500' : 'text-slate-300 hover:text-amber-400' }} text-lg transition">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button type="button" 
                                        wire:click="togglePublished({{ $art->id }})" 
                                        class="cursor-pointer text-[11px] font-bold px-3 py-1 rounded-full transition {{ $art->is_published ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                    {{ $art->is_published ? 'Published' : 'Draft' }}
                                </button>
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap space-x-2">
                                <a href="/blog/{{ $art->slug }}" target="_blank" class="p-2 text-slate-400 hover:text-emerald-600 transition" title="Lihat Artikel">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button type="button" wire:click="openEditModal({{ $art->id }})" class="p-2 text-slate-400 hover:text-emerald-600 transition cursor-pointer" title="Edit Artikel">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" wire:click="deleteArticle({{ $art->id }})" wire:confirm="Apakah Anda yakin ingin menghapus artikel ini?" class="p-2 text-slate-400 hover:text-rose-600 transition cursor-pointer" title="Hapus Artikel">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 font-semibold">
                                Belum ada artikel yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($articles->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $articles->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Create / Edit Article Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.outside="$wire.set('showModal', false)">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <h3 class="text-lg font-black text-slate-800">
                    {{ $editingId ? 'Edit Artikel Panduan' : 'Tulis Artikel Panduan Baru' }}
                </h3>
                <button type="button" wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form wire:submit.prevent="saveArticle" class="space-y-4 text-xs">
                <!-- Title -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">Judul Artikel *</label>
                    <input type="text" wire:model="title" placeholder="Contoh: Panduan Liburan 5 Hari di Bali untuk Pemula" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-medium">
                    @error('title') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Category & Author -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">Kategori *</label>
                        <select wire:model="category" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-medium">
                            <option value="Travel Guide">Travel Guide</option>
                            <option value="Itinerary">Itinerary</option>
                            <option value="Tips & Trik">Tips & Trik</option>
                            <option value="Hidden Gem">Hidden Gem</option>
                        </select>
                        @error('category') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Penulis *</label>
                        <input type="text" wire:model="author_name" placeholder="Bothrex Bali Tour Team" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-medium">
                        @error('author_name') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Image URL -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">URL Foto Utama (Image URL) *</label>
                    <input type="url" wire:model="image_url" placeholder="https://images.unsplash.com/..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-medium">
                    @error('image_url') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">Ringkasan Singkat (Excerpt) *</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="Ringkasan 1-2 kalimat untuk preview di Google Search dan card blog..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-medium"></textarea>
                    @error('excerpt') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1">Isi Konten Artikel (HTML / Teks) *</label>
                    <textarea wire:model="content" rows="8" placeholder="<h2>Sub Judul</h2><p>Paragraf konten...</p>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono text-xs"></textarea>
                    @error('content') <span class="text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Switches -->
                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" wire:model="is_published" class="rounded text-emerald-600 focus:ring-emerald-500">
                        <span>Publikasikan Langsung (Published)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" wire:model="is_featured" class="rounded text-amber-500 focus:ring-amber-400">
                        <span>Jadikan Artikel Unggulan (Featured)</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                    <button type="button" wire:click="$set('showModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold shadow-lg shadow-emerald-600/30 transition">
                        Simpan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
