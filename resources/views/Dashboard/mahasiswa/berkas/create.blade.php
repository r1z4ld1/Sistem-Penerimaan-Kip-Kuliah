@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Upload Berkas Baru
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Unggah dokumen persyaratan untuk melengkapi pendaftaran KIP Kuliah Anda.
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('mahasiswa.berkas.index') }}"
            class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95 shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- ALERT ERRORS --}}
    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5 mb-6 flex items-start gap-4 shadow-sm">
            <div class="text-rose-500 mt-0.5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-rose-800 mb-2">Terdapat kesalahan pada isian Anda:</h3>
                <ul class="list-disc pl-5 text-sm text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-3xl">
        <form action="{{ route('mahasiswa.berkas.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 lg:p-8">
            @csrf

            <div class="space-y-6">

                {{-- PENDAFTARAN (SELECT) --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Periode / Kode Pendaftaran
                    </label>
                    <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                        <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                        <span class="font-semibold">
                            {{ $pendaftaran->kode_pendaftaran }}
                        </span>

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- NAMA BERKAS --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Nama Berkas
                    </label>
                    <input type="text" name="nama_berkas" value="{{ old('nama_berkas') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Contoh: KTP / Kartu Keluarga / Rapor Semester 1-5">
                    @error('nama_berkas')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- FILE UPLOAD --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        File Dokumen
                    </label>

                    <div class="w-full">
                        <input type="file" name="file_berkas" accept=".pdf,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all border border-slate-200 rounded-xl p-2 bg-slate-50 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">

                        <div class="mt-3 flex items-start gap-2 text-xs text-slate-500">
                            <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>
                                Format yang diizinkan: <span class="font-semibold text-slate-700">PDF, JPG, JPEG,
                                    PNG</span>.<br>
                                Ukuran maksimal per file: <span class="font-semibold text-slate-700">2MB</span>. Pastikan
                                dokumen dapat terbaca dengan jelas.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mahasiswa.berkas.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Upload Berkas
                </button>
            </div>

        </form>
    </div>
@endsection
