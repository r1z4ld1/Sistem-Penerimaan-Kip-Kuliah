@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Dashboard Admin
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Selamat datang kembali, Admin. Berikut adalah ringkasan sistem hari ini.
            </p>
        </div>

        {{-- Tombol Aksi Cepat --}}
        <div class="flex gap-2 shrink-0">
            <a href="#"
                class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan
            </a>
            {{-- <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan
            </button> --}}
        </div>
    </div>

    {{-- QUICK STATS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6 mb-8">

        {{-- Pengguna Sistem --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total Mahasiswa</p>
                    <h2 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ number_format($totalMahasiswa) }}
                    </h2>
                </div>
                <div
                    class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                +12% dari bulan lalu
            </p>
        </div>

        {{-- Akun Terdaftar --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Akun Terdaftar</p>
                    <h2 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ number_format($totalUser) }}
                    </h2>
                </div>
                <div
                    class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                +5% pengguna aktif
            </p>
        </div>

        {{-- Total Program Studi / Universitas --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Mitra Kampus</p>
                    <h2 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ number_format($totalUniversitas) }}
                    </h2>
                </div>
                <div
                    class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500">Sebagai Penerima KIP Kuliah</p>
        </div>

        {{-- Jurusan & Program Studi --}}
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Jurusan/Program Studi</p>
                    <h2 class="text-3xl font-extrabold text-slate-800 mt-2">
                        {{ number_format($totalJurusan) }}
                    </h2>
                </div>
                <div
                    class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm shadow-amber-500/10">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500">Pilihan Jurusan Terakreditasi KIP-K </p>
        </div>


    </div>

    {{-- MAIN CONTENT AREA --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Bagian Kiri: Shortcut / Quick Links --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Akses Cepat
                </h3>
                <div class="space-y-3">
                    {{-- Shortcut Verifikasi --}}
                    <a href="{{ route('admin.users.index') }}"
                        class="group flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-blue-700">Manajemen
                                User</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    {{-- Shortcut Data Mahasiswa --}}
                    <a href="{{ route('admin.mahasiswa.index') }}"
                        class="group flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700">Data
                                Mahasiswa</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    {{-- Shortcut Manajemen Role & Akses (Sistem) --}}
                    <a href="{{ route('admin.roles.index') }}"
                        class="group flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-700 group-hover:text-slate-900">Manajemen
                                    Role</span>
                                <span class="text-[10px] text-slate-500 font-medium">Atur Role</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bagian kanan tahapan pendafataran kip kuliah --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 h-full">
                {{-- Header Timeline --}}
                <div class="flex justify-between items-center mb-8 border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="font-extrabold text-lg text-slate-800 tracking-tight">Tahapan Pendaftaran KIP Kuliah
                        </h3>
                        <p class="text-sm text-slate-500 mt-1">Alur proses dari awal hingga akhir seleksi.</p>
                    </div>
                </div>

                {{-- Timeline Container --}}
                <div
                    class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-slate-200 before:via-slate-200 before:to-transparent">

                    {{-- Item 1: Lengkapi Biodata --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-blue-100 text-blue-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon User --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-slate-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Tahap
                                    1</span>
                                Lengkapi Biodata
                            </div>
                            <div class="text-sm text-slate-500 leading-relaxed">
                                Mahasiswa mengisi data diri seperti NIK, NISN, alamat, sekolah asal, dan informasi pendukung
                                lainnya.
                            </div>
                        </div>
                    </div>

                    {{-- Item 2: Pendaftaran KIP Kuliah --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-100 text-indigo-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon Gedung Sekolah --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-slate-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-indigo-100 text-indigo-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Tahap
                                    2</span>
                                Pilih Program Studi
                            </div>
                            <div class="text-sm text-slate-500 leading-relaxed">
                                Setelah biodata lengkap, mahasiswa dapat memilih universitas dan program studi tujuan untuk
                                proses pendaftaran.
                            </div>
                        </div>
                    </div>

                    {{-- Item 3: Upload Berkas --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-purple-100 text-purple-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon Upload Dokumen --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-slate-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-purple-100 text-purple-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Tahap
                                    3</span>
                                Upload Persyaratan
                            </div>
                            <div class="text-sm text-slate-500 leading-relaxed">
                                Mahasiswa mengunggah dokumen persyaratan seperti KTP, Kartu Keluarga, rapor, dan dokumen
                                pendukung lainnya.
                            </div>
                        </div>
                    </div>

                    {{-- Item 4: Verifikasi Berkas --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-amber-100 text-amber-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon Kaca Pembesar --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-slate-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-amber-100 text-amber-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Tahap
                                    4</span>
                                Proses Verifikasi
                            </div>
                            <div class="text-sm text-slate-500 leading-relaxed">
                                Petugas verifikator memeriksa setiap dokumen yang diunggah untuk memastikan kelengkapan dan
                                keabsahan data.
                            </div>
                        </div>
                    </div>

                    {{-- Item 5: Hasil Verifikasi --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-orange-100 text-orange-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon Refresh/Revisi --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-slate-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-orange-100 text-orange-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Tahap
                                    5</span>
                                Hasil Verifikasi
                            </div>
                            <div class="text-sm text-slate-500 leading-relaxed">
                                Berkas dapat diterima atau ditolak. Jika ada kesalahan, mahasiswa diberikan kesempatan untuk
                                memperbaiki dan mengunggah ulang.
                            </div>
                        </div>
                    </div>

                    {{-- Item 6: Seleksi Selesai --}}
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-emerald-100 text-emerald-600 shadow-sm shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                            {{-- Ikon Centang Selesai --}}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div
                            class="w-[calc(100%-3.5rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl border border-emerald-100 bg-emerald-50/50 hover:bg-emerald-50 hover:shadow-md shadow-sm transition-all duration-300">
                            <div class="font-bold text-emerald-800 text-base mb-1.5 flex items-center gap-2">
                                <span
                                    class="bg-emerald-100 text-emerald-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Final</span>
                                Seleksi Selesai
                            </div>
                            <div class="text-sm text-emerald-600/90 leading-relaxed">
                                Setelah seluruh tahapan selesai dan lolos verifikasi, mahasiswa dapat melihat status akhir
                                pendaftaran melalui dashboard.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
