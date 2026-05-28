@extends('layouts.app')

@section('content')
    <div class="mb-6">

        <h1 class="text-3xl font-bold">

            Biodata Mahasiswa

        </h1>

        <p class="text-gray-500 mt-1">

            Lengkapi biodata diri anda

        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        @if ($mahasiswa)
            <form action="{{ route('mahasiswa.profile.update', $mahasiswa->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')
            @else
                <form action="{{ route('mahasiswa.profile.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- NAMA --}}
            <div>

                <label class="block mb-2 font-medium">

                    Nama Lengkap

                </label>

                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('nama')
                    <small class="text-red-500">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            {{-- NIK --}}
            <div>

                <label class="block mb-2 font-medium">

                    NIK

                </label>

                <input type="text" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('nik')
                    <small class="text-red-500">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            {{-- NISN --}}
            <div>

                <label class="block mb-2 font-medium">

                    NISN

                </label>

                <input type="text" name="nisn" value="{{ old('nisn', $mahasiswa->nisn ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            {{-- TEMPAT LAHIR --}}
            <div>

                <label class="block mb-2 font-medium">

                    Tempat Lahir

                </label>

                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            {{-- TANGGAL LAHIR --}}
            <div>

                <label class="block mb-2 font-medium">

                    Tanggal Lahir

                </label>

                <input type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            {{-- JENIS KELAMIN --}}
            <div>

                <label class="block mb-2 font-medium">

                    Jenis Kelamin

                </label>

                <select name="jenis_kelamin" class="w-full border rounded-lg px-4 py-3">

                    <option value="L" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Laki-Laki')>

                        Laki-Laki

                    </option>

                    <option value="P" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Perempuan')>

                        Perempuan

                    </option>

                </select>

            </div>

            {{-- NO HP --}}
            <div>

                <label class="block mb-2 font-medium">

                    No HP

                </label>

                <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            {{-- SEKOLAH --}}
            <div>

                <label class="block mb-2 font-medium">

                    Sekolah

                </label>

                <input type="text" name="sekolah" value="{{ old('sekolah', $mahasiswa->sekolah ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            {{-- TAHUN LULUS --}}
            <div>

                <label class="block mb-2 font-medium">

                    Tahun Lulus

                </label>

                <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

        </div>

        {{-- FOTO --}}
        <div class="mt-5">

            <label class="block mb-2 font-medium">

                Foto

            </label>

            <input type="file" name="foto" class="w-full border rounded-lg px-4 py-3">

        </div>

        {{-- FOTO PREVIEW --}}
        @if ($mahasiswa?->foto)
            <div class="mt-4">

                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="w-32 h-32 rounded-lg object-cover">

            </div>
        @endif

        {{-- ALAMAT --}}
        <div class="mt-5">

            <label class="block mb-2 font-medium">

                Alamat

            </label>

            <textarea name="alamat" rows="5" class="w-full border rounded-lg px-4 py-3">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>

        </div>

        {{-- BUTTON --}}
        <div class="mt-6">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg">

                @if ($mahasiswa)
                    Update Biodata
                @else
                    Simpan Biodata
                @endif

            </button>

        </div>

        </form>

    </div>
@endsection
