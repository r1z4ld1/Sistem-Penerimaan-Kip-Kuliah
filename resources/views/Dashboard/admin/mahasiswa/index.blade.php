@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Data Mahasiswa
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Kelola dan pantau informasi biodata mahasiswa aktif di dalam sistem.
            </p>
        </div>

        {{-- Action Button --}}
        @can('create mahasiswa')
            <div class="shrink-0">
                <a href="{{ route('admin.mahasiswa.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Mahasiswa
                </a>
            </div>
        @endcan
    </div>

    {{-- FLASH NOTIFICATION --}}
    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl mb-6 flex gap-3 items-center">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- SEARCH BAR --}}
    <div class="mb-6 flex justify-between items-center">
        <form method="GET" class="w-full md:max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, NIK, atau NISN mahasiswa..."
                class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm shadow-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors">

            @if (request('search'))
                <a href="{{ url()->current() }}"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </form>
    </div>

    {{-- DATA TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200/80">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-20">Foto</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NISN</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Sekolah Asal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">No HP</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-32 text-right">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mahasiswa as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors align-middle">

                            {{-- Foto --}}
                            <td class="px-6 py-3.5">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        class="w-11 h-11 rounded-full object-cover border border-slate-100 shadow-sm ring-2 ring-slate-100">
                                @else
                                    <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400"
                                        title="Tidak ada foto">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 0118 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="px-6 py-3.5">
                                <span class="text-sm font-bold text-slate-800 block">{{ $item->nama }}</span>
                                <span class="text-[11px] text-slate-400 font-medium">Mahasiswa Terdaftar</span>
                            </td>

                            {{-- NIK --}}
                            <td class="px-6 py-3.5">
                                <span
                                    class="text-sm font-medium text-slate-600 font-mono tracking-tight">{{ $item->nik }}</span>
                            </td>

                            {{-- NISN --}}
                            <td class="px-6 py-3.5">
                                <span
                                    class="text-sm font-medium text-slate-600 font-mono tracking-tight">{{ $item->nisn }}</span>
                            </td>

                            {{-- Sekolah --}}
                            <td class="px-6 py-3.5">
                                <span class="text-sm font-semibold text-slate-700">{{ $item->sekolah }}</span>
                            </td>

                            {{-- No HP --}}
                            <td class="px-6 py-3.5">
                                <span class="text-sm font-medium text-slate-600">{{ $item->no_hp ?? '-' }}</span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('edit mahasiswa')
                                        <a href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-colors"
                                            title="Edit Mahasiswa">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('delete mahasiswa')
                                        <form action="{{ route('admin.mahasiswa.destroy', $item->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white transition-colors"
                                                title="Hapus Mahasiswa">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800 mb-1">Tidak Ada Data Mahasiswa</h3>
                                    <p class="text-xs text-slate-500 max-w-xs mx-auto">
                                        {{ request('search') ? 'Tidak ada hasil pencarian yang cocok.' : 'Belum ada data mahasiswa terdaftar yang dimasukkan ke sistem.' }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($mahasiswa->hasPages())
        <div class="mt-6">
            {{ $mahasiswa->links() }}
        </div>
    @endif
@endsection
