@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Tambah Permission
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Tambahkan hak akses dasar baru untuk mengamankan fitur sistem.
            </p>
        </div>

        {{-- Kembali ke index --}}
        <div class="shrink-0">
            <a href="{{ route('admin.permissions.index') }}"
                class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="max-w-2xl bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl mb-6 flex gap-3 items-start">
            <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h5 class="font-bold text-sm mb-1">Terjadi kesalahan pengisian data:</h5>
                <ul class="list-disc pl-4 text-xs space-y-0.5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- MAIN FORM CARD --}}
    <div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.permissions.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
            @csrf

            {{-- PERMISSION NAME --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Nama Permission
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="Contoh: gudang.create atau manage users"
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                <p class="text-[11px] text-slate-500 mt-2">
                    Gunakan format penamaan yang konsisten (misalnya menggunakan titik <code>modul.aksi</code>) agar
                    mempermudah pemetaan otomatis oleh sistem <i>helper</i>.
                </p>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.permissions.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Permission
                </button>
            </div>
        </form>
    </div>
@endsection
