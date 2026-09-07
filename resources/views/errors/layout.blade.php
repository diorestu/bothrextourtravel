@extends('layouts.app', [
    'title' => ($code ?? 'Error') . ' - ' . ($title ?? 'Terjadi Kesalahan') . ' | Bothrex Bali Tour',
    'robots' => 'noindex, nofollow'
])

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-slate-50">
    <!-- Decorative Background Circles -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-100/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-xl w-full bg-white p-8 sm:p-12 rounded-3xl border border-slate-200 shadow-xl text-center relative z-10">
        <!-- Error Code Pill Badge -->
        <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 text-xs font-extrabold px-4 py-1.5 rounded-full border border-emerald-200 mb-6 uppercase tracking-widest shadow-sm">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Error @yield('code', $code ?? '404')</span>
        </div>

        <!-- Big Visual Icon -->
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 text-emerald-600 flex items-center justify-center text-4xl shadow-inner">
            @yield('icon', '<i class="fa-solid fa-compass-drafting"></i>')
        </div>

        <!-- Title & Subtitle -->
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-serif-heading mb-3 leading-snug">
            @yield('title', 'Halaman Tidak Ditemukan')
        </h1>
        <p class="text-slate-600 text-sm leading-relaxed mb-8 max-w-md mx-auto">
            @yield('message', 'Halaman yang Anda tuju tidak tersedia atau rute wisata telah diperbarui. Mari temukan kembali paket liburan terbaik Anda di Bali.')
        </p>

        <!-- Primary Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold px-6 py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all hover:scale-105 active:scale-95 text-xs sm:text-sm">
                <i class="fa-solid fa-house"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="/paket" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold px-6 py-3.5 rounded-xl border border-slate-200 transition-all hover:scale-105 active:scale-95 text-xs sm:text-sm">
                <i class="fa-solid fa-compass"></i>
                <span>Lihat Semua Paket Tour</span>
            </a>
        </div>

        <!-- Direct WhatsApp Support -->
        <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col items-center justify-center gap-2 text-xs text-slate-500">
            <span>Butuh bantuan cepat atau konfirmasi pesanan?</span>
            <div class="flex flex-wrap items-center justify-center gap-3 mt-1">
                <a href="https://wa.me/{{ $company->whatsapp_number ?? '6281338374254' }}?text=Halo%20Admin%20Bothrex%20Bali%20Tour,%20saya%20mengalami%20kendala%20di%20website%20pada%20halaman%20{{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-700 font-bold hover:underline">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>CS 1 (0813-3837-4254)</span>
                </a>
                <span class="text-slate-300">|</span>
                <a href="https://wa.me/{{ $company->whatsapp_number_2 ?? '6281246376329' }}?text=Halo%20Admin%20Bothrex%20Bali%20Tour,%20saya%20mengalami%20kendala%20di%20website%20pada%20halaman%20{{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold hover:underline">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>CS 2 (0812-4637-6329)</span>
                </a>
            </div>
        </div>

        <!-- Quick Tour Destinations Recommendation -->
        <div class="mt-6 pt-4 border-t border-slate-100 text-left">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2 text-center">Rute Populer Bali:</span>
            <div class="flex flex-wrap items-center justify-center gap-2">
                <a href="/destinasi/ubud-gianyar" class="text-xs bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 px-3 py-1.5 rounded-lg border border-slate-200 transition font-medium">🌿 Ubud Tour</a>
                <a href="/destinasi/kintamani-batur" class="text-xs bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 px-3 py-1.5 rounded-lg border border-slate-200 transition font-medium">🌋 Kintamani Jeep</a>
                <a href="/destinasi/bedugul-tabanan" class="text-xs bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 px-3 py-1.5 rounded-lg border border-slate-200 transition font-medium">🌸 Bedugul Pura</a>
                <a href="/destinasi/uluwatu-bali-selatan" class="text-xs bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 px-3 py-1.5 rounded-lg border border-slate-200 transition font-medium">🌊 Uluwatu Kecak</a>
            </div>
        </div>
    </div>
</div>
@endsection
