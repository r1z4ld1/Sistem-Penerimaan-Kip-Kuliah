@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Hak Akses Role
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base flex items-center gap-2 flex-wrap">
                Atur bilah izin (permission) khusus untuk tingkatan role:
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wide">
                    {{ $role->name }}
                </span>
            </p>
        </div>

        {{-- Kembali ke index --}}
        <div class="shrink-0">
            <a href="{{ route('admin.roles.index') }}"
                class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- ERROR ALERT (Opsional jika ada validasi) --}}
    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl mb-6 flex gap-3 items-start">
            <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h5 class="font-bold text-sm mb-1">Terjadi kesalahan pemrosesan data:</h5>
                <ul class="list-disc pl-4 text-xs space-y-0.5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- MAIN CONFIGURATION CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.roles.permissions.update', $role->id) }}" method="POST" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            {{-- PERMISSION GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($permissions as $permission)
                    <label
                        class="flex items-start gap-3.5 border border-slate-200/80 rounded-xl p-4 hover:bg-slate-50/80 hover:border-slate-300 cursor-pointer transition-all select-none group">
                        {{-- Checkbox Input --}}
                        <div class="flex items-center h-5 mt-0.5">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500/40 focus:ring-2 transition-all">
                        </div>

                        {{-- Meta Text --}}
                        <div>
                            <span
                                class="block text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">
                                {{ $permission->name }}
                            </span>
                            <span class="block text-[11px] text-slate-400 mt-0.5 font-medium tracking-normal">
                                Mengontrol akses fungsi terkait {{ explode('.', $permission->name)[0] ?? 'modul' }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>

            {{-- FORM ACTIONS --}}
            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.roles.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Permission
                </button>
            </div>
        </form>
    </div>
@endsection
