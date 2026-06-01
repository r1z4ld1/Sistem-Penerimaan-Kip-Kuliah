@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Dokumen Berkas
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Unggah dan kelola dokumen persyaratan pendaftaran KIP Kuliah Anda.
            </p>
        </div>

        <a href="{{ route('mahasiswa.berkas.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 transition-all active:scale-95 shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Upload Berkas
        </a>
    </div>

    {{-- TABEL CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200/80">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Berkas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">File Dokumen</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Catatan Verifikator
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                    @forelse($berkas as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">

                            {{-- Nama Berkas --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-800">{{ $item->nama_berkas }}</p>
                            </td>

                            {{-- File Link --}}
                            <td class="px-6 py-4">
                                <a href="{{ asset('storage/' . $item->file_berkas) }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline decoration-blue-300 underline-offset-4 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Dokumen
                                </a>
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-6 py-4">
                                <span
                                    class="{{ $item->status_verifikasi?->badge() }} px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                    {{ $item->status_verifikasi?->label() ?? 'Menunggu' }}
                                </span>
                            </td>

                            {{-- Catatan --}}
                            <td class="px-6 py-4">
                                @if ($item->catatan_verifikasi)
                                    <div
                                        class="flex items-start gap-2 bg-rose-50 text-rose-700 px-3 py-2 rounded-lg text-sm border border-rose-100/50">
                                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">{{ $item->catatan_verifikasi }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-300 font-medium ml-4">-</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">

                                    {{-- Upload Ulang (Hanya jika ditolak) --}}
                                    @if ($item->status_verifikasi && $item->status_verifikasi->value === 'ditolak')
                                        <a href="{{ route('mahasiswa.berkas.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Re-Upload
                                        </a>
                                    @endif

                                    {{-- Hapus (Hanya jika pending atau ditolak) --}}
                                    @if (!$item->status_verifikasi || in_array($item->status_verifikasi->value, ['pending', 'ditolak']))
                                        <form action="{{ route('mahasiswa.berkas.destroy', $item->id) }}" method="POST"
                                            class="form-delete inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Terkunci (Jika Diterima) --}}
                                    @if ($item->status_verifikasi && $item->status_verifikasi->value === 'diterima')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-bold cursor-not-allowed">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Terkunci
                                        </span>
                                    @endif

                                </div>
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
                                                d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800 mb-1">Belum Ada Berkas Diunggah</h3>
                                    <p class="text-xs text-slate-500 mb-4">Silakan klik tombol "Upload Berkas" di atas untuk
                                        menambahkan dokumen persyaratan.</p>
                                </div>
                            </td>
                        </tr>
                    @endempty

            </tbody>
        </table>
    </div>
</div>
@endsection
