<div>
    <!-- Dashboard Header -->
    <div class="bg-slate-900 text-white py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Panel Kelola Admin</span>
                <h1 class="text-3xl font-extrabold font-serif-heading mt-1 flex items-center gap-3">
                    <i class="fa-solid fa-list-check text-emerald-500"></i> Data Reservasi & Booking
                </h1>
                <p class="text-xs text-slate-300 mt-1">Sistem manajemen pemesanan paket wisata Bali dan follow up customer via WhatsApp.</p>
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
        <div class="mb-6 bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 text-xs font-bold flex items-center justify-between">
            <span><i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i> {{ session('message') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Pesanan</span>
                    <span class="text-2xl font-extrabold text-slate-900">{{ $totalBookings }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Pending / Menunggu WA</span>
                    <span class="text-2xl font-extrabold text-amber-600">{{ $pendingCount }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Terkonfirmasi</span>
                    <span class="text-2xl font-extrabold text-blue-600">{{ $confirmedCount }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Omset Disetujui</span>
                    <span class="text-xl font-extrabold text-purple-700">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-96 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari kode booking, nama, hp..." 
                       class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold text-slate-500 whitespace-nowrap">Filter Status:</span>
                <select wire:model.live="statusFilter" class="px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <option value="all">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-100/80 text-slate-800 font-bold uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-6">Kode Booking</th>
                            <th class="py-4 px-6">Customer & Kontak</th>
                            <th class="py-4 px-6">Paket Tour</th>
                            <th class="py-4 px-6">Tanggal & Peserta</th>
                            <th class="py-4 px-6">Total Biaya</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-right">Aksi & WA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($bookings as $b)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <!-- Booking Code -->
                            <td class="py-4 px-6 font-mono font-bold text-emerald-700 whitespace-nowrap">
                                {{ $b->booking_code }}
                                <span class="block text-[10px] text-slate-400 font-sans font-normal mt-0.5">
                                    {{ $b->created_at->format('d/m/Y H:i') }}
                                </span>
                            </td>

                            <!-- Customer info -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm">{{ $b->customer_name }}</div>
                                <div class="text-slate-500 text-[11px] flex items-center gap-1.5 mt-0.5">
                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i> {{ $b->customer_phone }}
                                </div>
                                <div class="text-slate-400 text-[11px]">{{ $b->customer_email }}</div>
                            </td>

                            <!-- Tour Package -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-800 line-clamp-1 max-w-xs">{{ $b->tourPackage->title ?? 'Custom Tour' }}</div>
                                <span class="inline-block bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded mt-1">
                                    {{ $b->tourPackage->destination->name ?? 'Bali' }}
                                </span>
                            </td>

                            <!-- Travel Date & Guests -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-semibold text-slate-900"><i class="fa-solid fa-calendar text-emerald-600 mr-1"></i> {{ $b->travel_date ? $b->travel_date->format('d M Y') : '-' }}</div>
                                <div class="text-slate-500 text-[11px] mt-0.5"><i class="fa-solid fa-users text-slate-400 mr-1"></i> {{ $b->number_of_guests }} Orang Peserta</div>
                            </td>

                            <!-- Total Price -->
                            <td class="py-4 px-6 font-extrabold text-slate-900 text-sm whitespace-nowrap">
                                Rp {{ number_format($b->total_price, 0, ',', '.') }}
                            </td>

                            <!-- Status Dropdown -->
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <select wire:change="updateStatus({{ $b->id }}, $event.target.value)" 
                                        class="text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 focus:outline-none cursor-pointer
                                        {{ $b->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : '' }}
                                        {{ $b->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                                        {{ $b->status === 'completed' ? 'bg-blue-100 text-blue-800 border-blue-300' : '' }}
                                        {{ $b->status === 'cancelled' ? 'bg-rose-100 text-rose-800 border-rose-300' : '' }}">
                                    <option value="pending" {{ $b->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $b->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $b->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $b->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>

                            <!-- Actions & WhatsApp -->
                            <td class="py-4 px-6 text-right whitespace-nowrap space-x-2">
                                <button wire:click="viewDetails({{ $b->id }})" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-xl font-bold text-xs transition">
                                    <i class="fa-solid fa-eye mr-1"></i> Detail
                                </button>
                                
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $b->customer_phone);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                    $greetingMsg = urlencode("Halo Kak {$b->customer_name}, terima kasih telah melakukan pemesanan paket {$b->tourPackage->title} (Kode Booking: {$b->booking_code}) di Bothrex Bali Tour. Kami ingin mengonfirmasi detail tour Anda.");
                                @endphp

                                <a href="https://wa.me/{{ $cleanPhone }}?text={{ $greetingMsg }}" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-xl font-bold text-xs shadow transition">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>Chat WA</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-inbox text-3xl mb-2 block"></i>
                                Belum ada data pesanan booking tersimpan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    @if($showDetailModal && $selectedBooking)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl max-w-xl w-full p-8 shadow-2xl relative border border-slate-200">
            <button wire:click="$set('showDetailModal', false)" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h3 class="text-xl font-bold text-slate-900 font-serif-heading mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice text-emerald-600"></i> Rincian Pesanan #{{ $selectedBooking->booking_code }}
            </h3>

            <div class="space-y-3 text-xs text-slate-700">
                <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                    <div>
                        <span class="text-slate-400 block font-semibold">Nama Pemesan</span>
                        <strong class="text-slate-900 text-sm">{{ $selectedBooking->customer_name }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold">Nomor WhatsApp</span>
                        <strong class="text-emerald-700 text-sm">{{ $selectedBooking->customer_phone }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold">Email</span>
                        <strong class="text-slate-800">{{ $selectedBooking->customer_email }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold">Tanggal Tour</span>
                        <strong class="text-slate-900">{{ $selectedBooking->travel_date ? $selectedBooking->travel_date->format('d M Y') : '-' }}</strong>
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Paket Wisata:</span>
                        <strong class="text-slate-900">{{ $selectedBooking->tourPackage->title ?? '-' }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Jumlah Peserta:</span>
                        <strong class="text-slate-900">{{ $selectedBooking->number_of_guests }} Orang</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Lokasi Penjemputan:</span>
                        <strong class="text-slate-900">{{ $selectedBooking->pickup_location ?: 'Diinfokan kemudian' }}</strong>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-slate-200 text-sm font-bold">
                        <span class="text-slate-900">Total Harga:</span>
                        <span class="text-emerald-700">Rp {{ number_format($selectedBooking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($selectedBooking->special_notes)
                <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200">
                    <span class="text-amber-800 font-bold block mb-1">Catatan Khusus Customer:</span>
                    <p class="text-amber-950 italic">{{ $selectedBooking->special_notes }}</p>
                </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="$set('showDetailModal', false)" class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-6 py-2.5 rounded-xl text-xs">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
