@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Tambah Mahasiswa
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Lengkapi formulir di bawah ini untuk menambahkan data mahasiswa baru.
            </p>
        </div>

        {{-- Kembali ke index --}}
        <div class="shrink-0">
            <a href="{{ route('admin.mahasiswa.index') }}"
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
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Akun User --}}
                <div class="md:col-span-2 border-b border-slate-100 pb-4 mb-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Akun User Mahasiswa <span class="text-rose-500">*</span>
                    </label>
                    <select name="user_id"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                        <option value="">-- Pilih Akun User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-500 mt-1.5">Pilih akun pengguna yang akan dihubungkan dengan data
                        mahasiswa ini.</p>
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Nomor Induk Kependudukan"
                        maxlength="16" minlength="16" pattern="[0-9]{16}" inputmode="numeric"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                    <span class="text-rose-500 text-xs italic">*NIK harus terdiri dari 16 digit angka tanpa spasi atau
                        karakter lain.</span>
                    @error('nik')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- NISN --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}"
                        placeholder="Nomor Induk Siswa Nasional"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        placeholder="Kota/Kabupaten kelahiran"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal
                        Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jenis
                        Kelamin</label>
                    <select name="jenis_kelamin"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Sekolah Asal --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sekolah Asal</label>
                    <input type="text" name="sekolah" value="{{ old('sekolah') }}" placeholder="Nama sekolah asal"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tahun Lulus --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2023"
                        min="1990" max="{{ date('Y') + 1 }}"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Foto Mahasiswa --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Profil</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all
                        file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-[11px] text-slate-500 mt-1.5">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</p>
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat
                        Lengkap</label>
                    <textarea name="alamat" rows="4" placeholder="Masukkan alamat lengkap domisili..."
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">{{ old('alamat') }}</textarea>
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.mahasiswa.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Data Mahasiswa
                </button>
            </div>
        </form>
    </div>
@endsection
