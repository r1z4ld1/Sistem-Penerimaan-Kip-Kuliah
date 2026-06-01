@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Detail Verifikasi Berkas
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base flex items-center gap-2">
                Mahasiswa:
                <span class="font-bold text-slate-800 bg-slate-100 px-2.5 py-0.5 rounded-lg border border-slate-200">
                    {{ $mahasiswa->nama }}
                </span>
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('verifikator.berkas.index') }}"
            class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95 shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- LOOP PENDAFTARAN --}}
    @foreach ($mahasiswa->pendaftaran as $pendaftaran)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">

            {{-- INFO PENDAFTARAN --}}
            <div class="p-6 lg:p-8 border-b border-slate-100 bg-slate-50/50">
                <h2 class="font-bold text-lg text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Pendaftaran
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-sm">
                    {{-- NIK --}}
                    <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            NIK
                        </span>
                        <div class="font-semibold text-slate-800">
                            {{ $mahasiswa->nik ?? '-' }}
                        </div>
                    </div>

                    {{-- No Telepon --}}
                    <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            No Telepon
                        </span>
                        <div class="font-semibold text-slate-800">
                            {{ $mahasiswa->no_hp ?? '-' }}
                        </div>
                    </div>

                    {{-- Universitas --}}
                    <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            Universitas Tujuan
                        </span>
                        <div class="font-semibold text-slate-800">
                            {{ $pendaftaran->universitas->nama_universitas ?? '-' }}
                        </div>
                    </div>

                    {{-- Jurusan --}}
                    <div class="bg-white p-4 rounded-xl border border-slate-200/60 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">
                            Program Studi
                        </span>
                        <div class="font-semibold text-slate-800">
                            {{ $pendaftaran->jurusan->nama_jurusan ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL DOKUMEN & FORM VERIFIKASI --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Berkas</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">File Dokumen
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status Saat Ini
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Catatan</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-blue-600 uppercase tracking-wider bg-blue-50/50 w-[350px]">
                                Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pendaftaran->berkas as $berkas)
                            <tr class="hover:bg-slate-50/50 transition-colors align-top">

                                {{-- Nama Berkas --}}
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-800">{{ $berkas->nama_berkas }}</p>
                                </td>

                                {{-- File --}}
                                <td class="px-6 py-5">
                                    <a href="{{ asset('storage/' . $berkas->file_berkas) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat File
                                    </a>
                                </td>

                                {{-- Status Saat Ini --}}
                                <td class="px-6 py-5">
                                    <span
                                        class="{{ $berkas->status_verifikasi?->badge() }} inline-flex items-center px-3 py-1 rounded-full text-xs font-bold shadow-sm border border-current/20">
                                        {{ $berkas->status_verifikasi?->label() }}
                                    </span>
                                </td>

                                {{-- Catatan (Current) --}}
                                <td class="px-6 py-5">
                                    @if ($berkas->catatan_verifikasi)
                                        <p
                                            class="text-sm text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-200">
                                            {{ $berkas->catatan_verifikasi }}
                                        </p>
                                    @else
                                        <span class="text-slate-400 text-sm italic">-</span>
                                    @endif
                                </td>

                                {{-- Form Verifikasi --}}
                                <td class="px-6 py-5 bg-blue-50/20 border-l border-slate-100">
                                    <form action="{{ route('verifikator.berkas.update', $berkas->id) }}" method="POST"
                                        class="space-y-3">
                                        @csrf
                                        @method('PUT')

                                        {{-- Dropdown Status --}}
                                        <div class="relative">
                                            <select name="status_verifikasi"
                                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm appearance-none focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors cursor-pointer shadow-sm">
                                                @foreach (\App\Enums\StatusBerkasEnum::options() as $value => $label)
                                                    <option value="{{ $value }}" @selected($berkas->status_verifikasi?->value === $value)>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- Input Catatan --}}
                                        <textarea name="catatan_verifikasi" rows="2" placeholder="Tambahkan catatan revisi/alasan..."
                                            class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors shadow-sm resize-none">{{ $berkas->catatan_verifikasi }}</textarea>

                                        {{-- Tombol Submit --}}
                                        <button type="submit"
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95 flex items-center justify-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Simpan Verifikasi
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3 border border-slate-100">
                                            <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Belum ada berkas yang diunggah.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endsection
