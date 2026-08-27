<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-3xl shadow-2xl border border-slate-200">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-emerald-600 flex items-center justify-center text-white text-2xl mx-auto shadow-lg shadow-emerald-600/30 mb-4">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 font-serif-heading">Masuk Admin Panel</h2>
            <p class="text-slate-500 text-xs mt-1">Silakan masukkan kredensial akun administrator Anda.</p>
        </div>

        <form wire:submit.prevent="login" class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email *</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="email" 
                           wire:model="email" 
                           placeholder="admin@bothrex.com" 
                           class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                @error('email') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password *</label>
                <div class="relative">
                    <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="password" 
                           wire:model="password" 
                           placeholder="••••••••" 
                           class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                @error('password') <span class="text-[11px] text-rose-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center cursor-pointer text-slate-600">
                    <input type="checkbox" wire:model="remember" class="rounded text-emerald-600 focus:ring-emerald-500 mr-2">
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all hover:scale-[1.02] active:scale-95 text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk ke Dashboard</span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <span class="text-[11px] text-slate-400">
                Default Login: <strong class="text-slate-700 font-mono">admin@bothrex.com</strong> / <strong class="text-slate-700 font-mono">password</strong>
            </span>
        </div>
    </div>
</div>
