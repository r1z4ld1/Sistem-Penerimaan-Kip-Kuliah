@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Verifikasi Berkas
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Manajemen dan pemeriksaan kelengkapan dokumen mahasiswa.
            </p>
        </div>
    </div>

    {{-- SUMMARY CARDS --}}
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
        </div>
    </div>

    {{-- FILTER & SEARCH SECTION --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 mb-6">
        <form method="GET" action="{{ route('verifikator.berkas.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                {{-- Search Nama --}}
                <div class="md:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama mahasiswa..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors">
                </div>

                {{-- Filter Status --}}
                <div class="md:col-span-4 relative">
                    <select name="status"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm appearance-none focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95 flex justify-center items-center gap-2">
                        Filter
                    </button>
                    <a href="{{ route('verifikator.berkas.index') }}"
                        class="flex-1 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95 flex justify-center items-center">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- MAIN TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200/80">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Total Berkas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mahasiswa as $item)
                        @php
                            $pendaftaran = $item->pendaftaran->last();
                            $totalBerkas = $item->pendaftaran->sum(function ($pendaftaran) {
                                return $pendaftaran->berkas->count();
                            });
                        @endphp

                        <tr class="hover:bg-slate-50/50 transition-colors group align-middle">

                            {{-- Nama Mahasiswa --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-800">{{ $item->nama }}</p>
                            </td>

                            {{-- Total Berkas --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center justify-center bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-md text-xs border border-slate-200">
                                    {{ $totalBerkas }} Dokumen
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                @if ($pendaftaran)
                                    @if ($item->status_berkas == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($item->status_berkas == 'diterima')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Diterima
                                        </span>
                                    @elseif($item->status_berkas == 'ditolak')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-slate-50 text-slate-500 border border-slate-200 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        Belum Mendaftar
                                    </span>
                                @endif
                            </td>

                            {{-- Progress --}}
                            <td class="px-6 py-4 w-[250px]">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <div
                                            class="w-full bg-slate-100 rounded-full h-2 overflow-hidden border border-slate-200/50">
                                            <div class="bg-blue-500 h-full rounded-full transition-all duration-500 ease-out"
                                                style="width: {{ $item->progress }}%"></div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-600 w-8 text-right">
                                        {{ $item->progress }}%
                                    </span>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('verifikator.berkas.show', $item->id) }}"
                                    class="inline-flex items-center justify-center gap-1.5 bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm active:scale-95">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </td>

                        </tr>
                    @empty
                        {{-- Empty State --}}
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
                                    <h3 class="text-sm font-bold text-slate-800 mb-1">Tidak Ada Data</h3>
                                    <p class="text-xs text-slate-500">Belum ada berkas mahasiswa yang tersedia untuk
                                        kriteria ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endempty
            </tbody>
        </table>
    </div>
</div>
@endsection
