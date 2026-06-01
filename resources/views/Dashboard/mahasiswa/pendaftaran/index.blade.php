@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Pendaftaran KIP
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Kelola data riwayat pendaftaran KIP Kuliah Anda.
            </p>
        </div>

        {{-- Tombol Buat Pendaftaran (Hanya muncul jika belum ada) --}}
        @if ($pendaftaran->count() == 0)
            <a href="{{ route('mahasiswa.pendaftaran.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 transition-all active:scale-95 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                @php

                    $pendaftaranTerakhir = $pendaftaran->first();

                @endphp
                @if (!$pendaftaranTerakhir || $pendaftaranTerakhir->status === 'ditolak')
                    <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="...">

                        Ajukan Pendaftaran

                    </a>
                @endif

            </a>
        @endif
    </div>

    {{-- TABEL CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200/80">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Universitas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status Pendaftaran
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                    @forelse($pendaftaran as $item)
                        @php
                            $statusPendaftaran = $item->status;
                        @endphp

                        <tr class="hover:bg-slate-50/50 transition-colors group">

                            {{-- KODE --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 font-bold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-md text-sm border border-slate-200">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    {{ $item->kode_pendaftaran }}
                                </span>
                            </td>

                            {{-- NAMA --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-800">{{ $item->mahasiswa->nama }}</p>
                            </td>

                            {{-- UNIVERSITAS --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-800">{{ $item->universitas->nama_universitas }}
                                </p>
                            </td>

                            {{-- JURUSAN --}}
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 font-medium">{{ $item->jurusan->nama_jurusan }}</span>
                            </td>

                            {{-- TANGGAL --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->tanggal_daftar }}
                                </div>
                            </td>

                            {{-- STATUS BERKAS --}}
                            <td class="px-6 py-4 text-center">

                                @if ($statusPendaftaran == 'pending')
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>

                                        Menunggu Verifikasi

                                    </span>
                                @elseif($statusPendaftaran == 'diterima')
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Diterima

                                    </span>
                                @elseif($statusPendaftaran == 'ditolak')
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">

                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>

                                        Ditolak

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-slate-50 text-slate-600 border border-slate-200 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">

                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                        Draft

                                    </span>
                                @endif
                                @if ($item->catatan_pendaftaran)
                                    <div class="mt-2">

                                        <button onclick="toggleCatatan({{ $item->id }})"
                                            class="text-xs text-blue-600 hover:text-blue-800 font-medium">

                                            Lihat Catatan Verifikator

                                        </button>

                                        <div id="catatan-{{ $item->id }}"
                                            class="hidden mt-2 p-3 rounded-lg bg-amber-50 border border-amber-200">

                                            <p class="text-xs font-semibold text-amber-700 mb-1">

                                                Catatan Verifikator

                                            </p>

                                            <p class="text-sm text-slate-700">

                                                {{ $item->catatan_pendaftaran }}

                                            </p>

                                        </div>

                                    </div>
                                @endif
                            </td>

                        </tr>

                    @empty
                        {{-- EMPTY STATE --}}
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800 mb-1">Belum Ada Pendaftaran</h3>
                                    <p class="text-xs text-slate-500 mb-4">Anda belum melakukan pendaftaran KIP Kuliah sama
                                        sekali.</p>

                                    {{-- Mengarahkan user untuk menekan tombol di atas --}}
                                    <div
                                        class="inline-flex items-center gap-2 text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                        Klik tombol "Buat Pendaftaran" di atas untuk memulai
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endempty

            </tbody>
        </table>
    </div>
</div>
<script>
    function toggleCatatan(id) {
        document
            .getElementById(
                'catatan-' + id
            )
            .classList
            .toggle('hidden');
    }
</script>
@endsection
