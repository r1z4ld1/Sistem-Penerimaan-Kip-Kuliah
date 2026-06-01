@extends('layouts.app')

@section('content')
    {{-- Header Section --}}
    <div class="mb-6 lg:mb-8">
        <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
            Verifikasi Pendaftaran
        </h1>
        <p class="text-sm text-slate-500 mt-1 font-medium">
            Kelola dan tinjau data mahasiswa pendaftar program.
        </p>
    </div>

    {{-- Table Container --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- Responsive Wrapper --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                {{-- Table Head --}}
                <thead class="bg-slate-50/80 border-b border-slate-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Kode
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Mahasiswa
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Universitas
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap text-right">
                            Aksi
                        </th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-slate-100">
                    @forelse($pendaftaran as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">

                            {{-- Kolom Kode --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $item->kode_pendaftaran }}
                                </span>
                            </td>

                            {{-- Kolom Mahasiswa --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-800">
                                    {{ $item->mahasiswa->nama }}
                                </div>
                            </td>

                            {{-- Kolom Universitas --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $item->universitas->nama_universitas }}
                                </div>
                            </td>

                            {{-- Kolom Status --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if (strtolower($item->status) === 'diterima')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Diterima
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-600 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if (strtolower($item->status) !== 'diterima')
                                    <a href="{{ route('verifikator.pendaftaran.show', $item->id) }}"
                                        class="inline-flex items-center gap-1.5 bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-xl hover:bg-blue-700 hover:shadow-md hover:shadow-blue-500/20 focus:ring-4 focus:ring-blue-100 transition-all">
                                        <span>Detail</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-xl bg-slate-50 text-slate-500 border border-slate-200">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="p-4 bg-slate-50 rounded-full mb-3">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-700">Tidak ada data pendaftaran</h3>
                                    <p class="text-xs text-slate-500 mt-1">Belum ada pendaftaran yang masuk untuk
                                        diverifikasi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
