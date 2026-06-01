@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
            Biodata Mahasiswa
        </h1>
        <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
            Lengkapi data diri Anda dengan benar sesuai dengan dokumen kependudukan.
        </p>
    </div>

    {{-- ALERT ERRORS --}}
    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5 mb-6 flex items-start gap-4 shadow-sm">
            <div class="text-rose-500 mt-0.5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-rose-800 mb-2">Terdapat kesalahan pada isian Anda:</h3>
                <ul class="list-disc pl-5 text-sm text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="p-6 lg:p-8">

            @if ($mahasiswa)
                <form action="{{ route('mahasiswa.profile.update', $mahasiswa->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('mahasiswa.profile.store') }}" method="POST" enctype="multipart/form-data">
            @endif
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NAMA --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Sesuai KTP/Ijazah">
                    @error('nama')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">NIK (Nomor Induk
                        Kependudukan)</label>
                    <span class="text-rose-500 text-xs italic">*NIK harus terdiri dari 16 digit angka tanpa spasi atau
                        karakter lain.</span>
                    <input type="text" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}" maxlength="16"
                        minlength="16" pattern="[0-9]{16}" inputmode="numeric"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="16 Digit NIK">

                    @error('nik')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- NISN --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $mahasiswa->nisn ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Nomor Induk Siswa Nasional">
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">No. Handphone
                        (WhatsApp)</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Contoh: 081234567890">
                </div>

                {{-- TEMPAT LAHIR --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir"
                        value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400">
                </div>

                {{-- TANGGAL LAHIR --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- JENIS KELAMIN --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all appearance-none">
                        <option value="" disabled
                            {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>Pilih Jenis
                            Kelamin</option>
                        <option value="L"
                            {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="P"
                            {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                {{-- TAHUN LULUS --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus"
                        value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Contoh: 2024">
                </div>

                {{-- SEKOLAH --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Asal Sekolah</label>
                    <input type="text" name="sekolah" value="{{ old('sekolah', $mahasiswa->sekolah ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Nama SMA/SMK/MA Asal">
                </div>

                {{-- ALAMAT --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Alamat
                        Lengkap</label>
                    <textarea name="alamat" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all placeholder:text-slate-400"
                        placeholder="Masukkan alamat domisili lengkap beserta RT/RW, Kelurahan, dan Kecamatan">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                </div>

                {{-- UPLOAD FOTO --}}
                <div class="md:col-span-2 mt-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-3">Pas Foto
                        Formal</label>

                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        {{-- Image Preview Area --}}
                        @if ($mahasiswa?->foto)
                            <div class="shrink-0">
                                <div
                                    class="relative w-32 h-40 bg-slate-100 rounded-xl border-2 border-slate-200 overflow-hidden shadow-sm">
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Preview Foto"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute bottom-0 inset-x-0 bg-black/50 text-white text-[10px] py-1 text-center font-medium backdrop-blur-sm">
                                        Foto Saat Ini
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- File Input --}}
                        <div class="flex-1 w-full">
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all border border-slate-200 rounded-xl p-2 bg-slate-50 cursor-pointer">
                            <p class="text-xs text-slate-500 mt-2">
                                Format yang didukung: JPG, JPEG, PNG. Maksimal ukuran file: 2MB. Disarankan foto berlatar
                                belakang merah/biru.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $mahasiswa ? 'Simpan Perubahan' : 'Simpan Biodata' }}
                </button>
            </div>

            </form>
        </div>
    </div>
@endsection
