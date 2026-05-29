<footer class="mt-auto bg-white/50 backdrop-blur-md border-t border-slate-200/60">
    <div
        class="px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-2 sm:gap-0 text-center sm:text-left">

        {{-- Hak Cipta --}}
        <span class="text-xs sm:text-sm font-medium text-slate-500 tracking-tight">
            © {{ date('Y') }} <span class="font-bold text-slate-700 bg-clip-text">Sistem Penerimaan KIP
                Kuliah</span>. All rights reserved.
        </span>

        {{-- Badge Versi --}}
        <div class="flex items-center gap-2">
            <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200/80 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Versi 1.0.0
            </span>
        </div>

    </div>
</footer>
