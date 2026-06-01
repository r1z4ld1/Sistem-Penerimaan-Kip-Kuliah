@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Dashboard Verifikator
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Ringkasan data dan monitoring verifikasi berkas KIP Kuliah.
            </p>
        </div>
        <div
            class="text-sm text-slate-500 font-medium bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- WELCOME BANNER --}}
    <div
        class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 lg:p-8 mb-8 shadow-lg shadow-blue-500/20 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
        {{-- Background Pattern --}}
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none">
        </div>
        <div class="absolute bottom-0 right-32 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

        <div class="relative z-10 w-full md:w-2/3">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Selamat Bertugas!</h2>
            <p class="text-blue-100 text-sm md:text-base leading-relaxed">
                Saat ini terdapat <span
                    class="font-bold text-white bg-white/20 px-2 py-0.5 rounded">{{ $summary['pending'] }} berkas
                    pendaftaran</span> yang berstatus <strong class="text-white">Pending</strong> dan membutuhkan verifikasi
                Anda. Mari pastikan penyaluran KIP Kuliah tepat sasaran.
            </p>
        </div>

        <div class="relative z-10 w-full md:w-auto shrink-0">
            {{-- Sesuaikan route ini dengan route tabel verifikasi Anda --}}
            <a href="{{ url('/dashboard/verifikator/berkas') }}"
                class="w-full md:w-auto block text-center bg-white text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-xl text-sm font-bold shadow transition-all active:scale-95">
                Mulai Verifikasi
            </a>
        </div>
    </div>

    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6 mb-8">

        {{-- Total Pendaftaran --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1.5 h-full bg-sky-400"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total Pendaftaran</p>
                    <h2 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $summary['total'] }}</h2>
                </div>
                <div
                    class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium">Semua berkas masuk</p>
        </div>

        {{-- Pending --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1.5 h-full bg-amber-400"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Pending</p>
                    <h2 class="text-3xl font-extrabold text-amber-500 mt-2 flex items-center gap-2">
                        {{ $summary['pending'] }}
                        @if ($summary['pending'] > 0)
                            <span class="flex w-2.5 h-2.5 bg-amber-500 rounded-full animate-ping absolute ml-12"></span>
                            <span class="flex w-2.5 h-2.5 bg-amber-500 rounded-full ml-2"></span>
                        @endif
                    </h2>
                </div>
                <div
                    class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium">Menunggu proses verifikasi</p>
        </div>

        {{-- Diterima --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1.5 h-full bg-emerald-400"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Diterima</p>
                    <h2 class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $summary['diterima'] }}</h2>
                </div>
                <div
                    class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium">Berkas disetujui & valid</p>
        </div>

        {{-- Ditolak --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1.5 h-full bg-rose-400"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Ditolak</p>
                    <h2 class="text-3xl font-extrabold text-rose-600 mt-2">{{ $summary['ditolak'] }}</h2>
                </div>
                <div
                    class="p-3 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium">Berkas tidak memenuhi syarat</p>
        </div>

    </div>

    {{-- BOTTOM SECTIONS (Quick Info/Actions to fill the page) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Panduan Singkat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                SOP Verifikasi Berkas
            </h3>
            <div class="space-y-4 text-sm text-slate-600">
                <div class="flex items-start gap-3">
                    <div
                        class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center shrink-0">
                        1</div>
                    <p>Periksa kecocokan data <span class="font-semibold text-slate-800">Nama, NIK, dan NISN</span> dengan
                        dokumen asli (KTP/KK).</p>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center shrink-0">
                        2</div>
                    <p>Pastikan file hasil *scan* dapat dibaca dengan jelas. Jika buram atau terpotong, tolak dengan
                        memberikan <span class="font-semibold text-rose-600">Catatan Revisi</span>.</p>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center shrink-0">
                        3</div>
                    <p>Berikan status <span class="font-semibold text-emerald-600">Diterima</span> hanya jika seluruh
                        persyaratan dokumen telah terpenuhi sesuai pedoman KIP Kuliah tahun berjalan.</p>
                </div>
            </div>
        </div>

        {{-- Aktivitas Cepat / Quick Links --}}
        <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wide mb-4">Akses Cepat</h3>
            <div class="space-y-3">
                <a href="{{ url('/dashboard/verifikator/berkas') }}"
                    class="flex items-center justify-between p-3 bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-sm transition-all group">
                    <div class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </div>
                        Verifikasi Berkas
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Bisa disesuaikan dengan route lain --}}
                <a href="{{ url('/dashboard/verifikator/mahasiswa') }}"
                    class="flex items-center justify-between p-3 bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-sm transition-all group">
                    <div class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        Data Mahasiswa
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
@endsection
