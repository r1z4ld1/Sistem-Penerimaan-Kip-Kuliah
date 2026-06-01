@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Edit Jurusan
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Perbarui detail informasi nama program studi atau sesuaikan relasi universitas induknya.
            </p>
        </div>

        {{-- Kembali ke index --}}
        <div class="shrink-0">
            <a href="{{ route('admin.jurusan.index') }}"
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
        <div class="max-w-4xl bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl mb-6 flex gap-3 items-start">
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
    <div class="max-w-4xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Pilihan Universitas --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Universitas / Institusi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="universitas_id"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all appearance-none cursor-pointer text-slate-800">
                            @foreach ($universitas as $item)
                                <option value="{{ $item->id }}" @selected(old('universitas_id', $jurusan->universitas_id) == $item->id)>
                                    {{ $item->nama_universitas }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Nama Jurusan --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Jurusan / Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                        placeholder="Masukkan nama resmi program studi"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.jurusan.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Update Jurusan
                </button>
            </div>
        </form>
    </div>
@endsection
