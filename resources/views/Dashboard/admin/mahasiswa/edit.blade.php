@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-6 lg:mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Edit Mahasiswa
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Perbarui informasi biodata dan detail akun mahasiswa.
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
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6 md:p-8">
            @csrf
            @method('PUT')

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
                            <option value="{{ $user->id }}"
                                {{ old('user_id', $mahasiswa->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-500 mt-1.5">Ubah tautan akun pengguna jika diperlukan.</p>
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $mahasiswa->nik) }}"
                        placeholder="Nomor Induk Kependudukan" maxlength="16" minlength="16" pattern="[0-9]{16}"
                        inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)"
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
                    <input type="text" name="nisn" value="{{ old('nisn', $mahasiswa->nisn) }}"
                        placeholder="Nomor Induk Siswa Nasional"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}"
                        placeholder="Kota/Kabupaten kelahiran"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal
                        Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jenis
                        Kelamin</label>
                    <select name="jenis_kelamin"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                        <option value="L"
                            {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="P"
                            {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                        placeholder="Contoh: 08123456789"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Sekolah Asal --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sekolah Asal</label>
                    <input type="text" name="sekolah" value="{{ old('sekolah', $mahasiswa->sekolah) }}"
                        placeholder="Nama sekolah asal"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Tahun Lulus --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus) }}"
                        placeholder="Contoh: 2023" min="1990" max="{{ date('Y') + 1 }}"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">
                </div>

                {{-- Foto Mahasiswa --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Profil</label>
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="shrink-0">
                            @if ($mahasiswa->foto)
                                <img id="preview" src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                    class="w-24 h-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                            @else
                                <img id="preview"
                                    class="w-24 h-24 object-cover rounded-xl border border-slate-200 shadow-sm hidden">
                                <div id="preview-placeholder"
                                    class="w-24 h-24 rounded-xl border border-dashed border-slate-300 bg-slate-50 flex flex-col items-center justify-center text-slate-400 {{ $mahasiswa->foto ? 'hidden' : '' }}">
                                    <svg class="w-8 h-8 mb-1 text-slate-300" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[10px] font-semibold">Kosong</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow pt-1">
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all
                                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            <p class="text-[11px] text-slate-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto saat
                                ini. Format yang didukung: JPG, JPEG, PNG (Maksimal 2MB).</p>
                        </div>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat
                        Lengkap</label>
                    <textarea name="alamat" rows="4" placeholder="Masukkan alamat lengkap domisili..."
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
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
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Update Data Mahasiswa
                </button>
            </div>
        </form>
    </div>

    {{-- SCRIPT PREVIEW FOTO --}}
    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('preview-placeholder');

            if (event.target.files && event.target.files[0]) {
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
        });
    </script>
@endsection
