@extends('layouts.app')

@section('content')
    {{-- Header & Tombol Kembali --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 lg:mb-8">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Detail Pendaftaran
            </h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">
                Tinjau informasi berkas mahasiswa secara saksama sebelum memberikan keputusan.
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-800 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    {{-- Main Responsive Grid Wrapper --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- KOLOM KIRI: DATA MAHASISWA (Spans 2 columns on Desktop) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil & Informasi Akademik
                </h3>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                    {{-- Nama --}}
                    <div class="sm:col-span-2 pb-4 border-b border-slate-50">
                        <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</dt>
                        <dd class="text-base font-bold text-slate-800 mt-1">{{ $pendaftaran->mahasiswa->nama }}</dd>
                    </div>

                    {{-- NIK --}}
                    <div class="pb-2 sm:border-b sm:border-slate-50">
                        <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider">NIK (Nomor Induk Kependudukan)
                        </dt>
                        <dd
                            class="text-sm font-semibold text-slate-700 mt-1 bg-slate-50 px-2.5 py-1 rounded-md inline-block tracking-wide">
                            {{ $pendaftaran->mahasiswa->nik }}
                        </dd>
                    </div>

                    {{-- NISN --}}
                    <div class="pb-4 border-b border-slate-50 sm:border-b">
                        <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider">NISN (Nomor Induk Siswa
                            Nasional)</dt>
                        <dd
                            class="text-sm font-semibold text-slate-700 mt-1 bg-slate-50 px-2.5 py-1 rounded-md inline-block tracking-wide">
                            {{ $pendaftaran->mahasiswa->nisn }}
                        </dd>
                    </div>

                    {{-- Universitas --}}
                    <div class="pt-2 sm:pt-0">
                        <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider">Universitas Tujuan</dt>
                        <dd class="text-sm font-bold text-slate-800 mt-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            {{ $pendaftaran->universitas->nama_universitas }}
                        </dd>
                    </div>

                    {{-- Jurusan --}}
                    <div>
                        <dt class="text-xs font-bold text-slate-400 uppercase tracking-wider">Program Studi / Jurusan</dt>
                        <dd class="text-sm font-bold text-slate-800 mt-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            {{ $pendaftaran->jurusan->nama_jurusan }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM VERIFIKASI (Spans 1 column) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Tindakan Verifikator
                </h3>
            </div>

            <div class="p-6">
                <form action="{{ route('verifikator.pendaftaran.update', $pendaftaran->id) }}" method="POST"
                    class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Input Status --}}
                    <div>
                        <label for="status" class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">
                            Status Kelulusan
                        </label>
                        <div class="relative">
                            <select name="status" id="status"
                                class="w-full rounded-xl border border-slate-200 p-3 pr-10 text-sm font-medium text-slate-700 bg-white focus:outline-none focus:ring-4 focus:ring-slate-100 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                                <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>⏳ Pending
                                    / Menunggu</option>
                                <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak
                                </option>
                                <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>✅
                                    Diterima</option>
                            </select>
                            {{-- Custom Arrow SVG Icon --}}
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Input Catatan --}}
                    <div>
                        <label for="catatan_pendaftaran"
                            class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">
                            Catatan Verifikasi
                        </label>
                        <textarea name="catatan_pendaftaran" id="catatan_pendaftaran" rows="4"
                            placeholder="Tulis alasan jika ditolak atau catatan tambahan jika diperlukan..."
                            class="w-full rounded-xl border border-slate-200 p-3 text-sm font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-slate-100 focus:border-blue-500 transition-all resize-none">{{ $pendaftaran->catatan_pendaftaran }}</textarea>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 text-white text-sm font-bold px-4 py-3 rounded-xl hover:bg-emerald-700 hover:shadow-md hover:shadow-emerald-500/20 focus:ring-4 focus:ring-emerald-100 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Hasil Verifikasi</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
