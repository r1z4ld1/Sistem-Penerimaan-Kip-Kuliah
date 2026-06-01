@extends('layouts.app')

@section('content')
    {{-- HEADER & GREETING --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2">
                Halo, {{ auth()->user()->name }}
                <span class="origin-bottom-right hover:rotate-12 transition-transform duration-300">👋</span>
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Selamat datang di Dasbor Sistem KIP Kuliah
            </p>
        </div>
    </div>

    {{-- PROGRESS VERIFIKASI (HERO SECTION) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 lg:p-8 mb-8 relative overflow-hidden">
        {{-- Background Ornament --}}
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="font-bold text-lg text-slate-800">Progress Pendaftaran KIP</h2>
                    <p class="text-sm text-slate-500">Selesaikan tahapan untuk memproses KIP Kuliah Anda</p>
                </div>
                <span
                    class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-bold text-lg border border-blue-100">
                    {{ $progress }}%
                </span>
            </div>

            <div
                class="w-full bg-slate-100 rounded-full h-3 lg:h-4 overflow-hidden border border-slate-200/60 shadow-inner">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full relative transition-all duration-1000 ease-out"
                    style="width: {{ $progress }}%">
                    {{-- Glow Effect inside bar --}}
                    <div class="absolute top-0 right-0 bottom-0 w-10 bg-white/20 blur-sm"></div>
                </div>
                <p class="text-xs text-slate-500 mt-2">

                    Tahap Saat Ini:

                    <span class="font-semibold">

                        {{ $progressLabel }}

                    </span>

                </p>
            </div>
        </div>
    </div>

    {{-- STATUS UTAMA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
        {{-- Status Biodata --}}
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div
                class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0
                {{ $mahasiswa ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Status Biodata</p>
                <h2 class="text-xl font-bold {{ $mahasiswa ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $mahasiswa ? 'Lengkap' : 'Belum Lengkap' }}
                </h2>
            </div>
        </div>

        {{-- Status Pendaftaran --}}
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center gap-5 hover:shadow-md transition-shadow">
            @php
                $statusColor = match ($statusPendaftaran) {
                    'Diterima' => 'text-emerald-600',
                    'Ditolak' => 'text-rose-600',
                    'Menunggu Verifikasi' => 'text-amber-500',
                    default => 'text-slate-600',
                };
                $statusBg = match ($statusPendaftaran) {
                    'Diterima' => 'bg-emerald-50',
                    'Ditolak' => 'bg-rose-50',
                    'Menunggu Verifikasi' => 'bg-amber-50',
                    default => 'bg-slate-50',
                };
            @endphp
            <div
                class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 {{ $statusBg }} {{ $statusColor }}">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Status Pendaftaran</p>
                <h2 class="text-xl font-bold {{ $statusColor }}">
                    {{ $statusPendaftaran }}
                </h2>
            </div>
        </div>
    </div>

    {{-- STATISTIK BERKAS --}}
    <h3 class="text-lg font-bold text-slate-800 mb-4 px-1">Statistik Berkas Dokumen</h3>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        {{-- Total --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Berkas</p>
            <h2 class="text-2xl font-black text-slate-800">{{ $totalBerkas }}</h2>
        </div>
        {{-- Pending --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pending</p>
            <h2 class="text-2xl font-black text-amber-500">{{ $pending }}</h2>
        </div>
        {{-- Diterima --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Diterima</p>
            <h2 class="text-2xl font-black text-emerald-500">{{ $diterima }}</h2>
        </div>
        {{-- Ditolak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Ditolak</p>
            <h2 class="text-2xl font-black text-rose-500">{{ $ditolak }}</h2>
        </div>
    </div>

    {{-- BOTTOM SECTION (BIODATA & SHORTCUT) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI: INFORMASI BIODATA (Lebih Lebar) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Informasi Biodata</h2>
            </div>

            @if ($mahasiswa)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->nama }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">NIK</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->nik }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">NISN</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->nisn }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Nomor Handphone</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->no_hp }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Asal Sekolah</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->sekolah }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Alamat</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $mahasiswa->alamat }}</p>
                    </div>
                </div>
            @else
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 flex items-start gap-4 text-amber-800">
                    <svg class="w-6 h-6 text-amber-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="font-bold text-sm">Biodata Belum Dilengkapi!</h4>
                        <p class="text-sm mt-1 opacity-90">Silakan lengkapi biodata Anda terlebih dahulu agar dapat
                            melanjutkan ke tahap pendaftaran KIP Kuliah.</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- KOLOM KANAN: SHORTCUT MENU --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-lg font-bold text-slate-800 mb-5">Shortcut Cepat</h2>

            <div class="flex flex-col gap-3">
                {{-- Biodata --}}
                <a href="{{ route('mahasiswa.profile.index') }}"
                    class="group relative flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-white hover:bg-blue-50 hover:border-blue-200 hover:shadow-sm transition-all overflow-hidden">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-blue-700">Lengkapi Biodata</h4>
                        <p class="text-xs text-slate-500">Isi data diri & identitas</p>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Pendaftaran --}}
                <a href="{{ route('mahasiswa.pendaftaran.index') }}"
                    class="group relative flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-white hover:bg-emerald-50 hover:border-emerald-200 hover:shadow-sm transition-all overflow-hidden">
                    <div
                        class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700">Buat Pendaftaran</h4>
                        <p class="text-xs text-slate-500">Ajukan KIP Kuliah</p>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Upload --}}
                <a href="{{ route('mahasiswa.berkas.index') }}"
                    class="group relative flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-white hover:bg-amber-50 hover:border-amber-200 hover:shadow-sm transition-all overflow-hidden">
                    <div
                        class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-amber-700">Upload Berkas</h4>
                        <p class="text-xs text-slate-500">Kirim dokumen syarat</p>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
@endsection
