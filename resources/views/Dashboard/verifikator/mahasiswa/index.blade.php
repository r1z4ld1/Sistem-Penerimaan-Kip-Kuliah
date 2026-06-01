@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Data Mahasiswa
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Daftar lengkap data mahasiswa untuk kebutuhan verifikasi.
            </p>
        </div>
    </div>

    {{-- SEARCH & FILTER --}}
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

    {{-- MAIN TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200/80">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-20 text-center">
                            Foto</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NISN</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Sekolah</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">No HP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mahasiswa as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group align-middle">

                            {{-- Foto --}}
                            <td class="px-6 py-4 text-center">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama }}"
                                        class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-sm inline-block">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center inline-flex">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-800">{{ $item->nama }}</p>
                            </td>

                            {{-- NIK --}}
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 font-mono">{{ $item->nik ?? '-' }}</span>
                            </td>

                            {{-- NISN --}}
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 font-mono">{{ $item->nisn ?? '-' }}</span>
                            </td>

                            {{-- Sekolah --}}
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-600">{{ $item->sekolah ?? '-' }}</p>
                            </td>

                            {{-- No HP --}}
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-600">{{ $item->no_hp ?? '-' }}</p>
                            </td>

                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
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
                                    <p class="text-xs text-slate-500">
                                        {{ request('search') ? 'Pencarian tidak menemukan hasil yang sesuai.' : 'Belum ada data mahasiswa yang terdaftar dalam sistem.' }}
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
