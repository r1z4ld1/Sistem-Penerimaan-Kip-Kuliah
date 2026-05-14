@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-5">
        Edit Mahasiswa
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>

                <label>User Mahasiswa</label>

                <select name="user_id" class="w-full border rounded px-3 py-2">

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $mahasiswa->user_id == $user->id ? 'selected' : '' }}>

                            {{ $user->name }}

                        </option>
                    @endforeach

                </select>

            </div>

            <div>
                <label>NIK</label>

                <input type="text" name="nik" value="{{ old('nik', $mahasiswa->nik) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>NISN</label>

                <input type="text" name="nisn" value="{{ old('nisn', $mahasiswa->nisn) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tempat Lahir</label>

                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tanggal Lahir</label>

                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="w-full border rounded px-3 py-2">

                    <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>

                        Laki-Laki

                    </option>

                    <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>

                        Perempuan

                    </option>

                </select>
            </div>

            <div>
                <label>No HP</label>

                <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Sekolah</label>

                <input type="text" name="sekolah" value="{{ old('sekolah', $mahasiswa->sekolah) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tahun Lulus</label>

                <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div>

                <label>Foto</label>

                <input type="file" name="foto" id="foto" class="w-full border rounded px-3 py-2">

                @if ($mahasiswa->foto)
                    <img id="preview" src="{{ asset('storage/' . $mahasiswa->foto) }}"
                        class="w-24 h-24 object-cover rounded mt-3">
                @else
                    <img id="preview" class="w-24 h-24 object-cover rounded mt-3 hidden">
                @endif

            </div>

        </div>

        <div class="mt-4">

            <label>Alamat</label>

            <textarea name="alamat" rows="4" class="w-full border rounded px-3 py-2">{{ old('alamat', $mahasiswa->alamat) }}</textarea>

        </div>

        <button class="mt-5 bg-blue-500 text-white px-5 py-2 rounded">

            Update

        </button>

    </form>

    <script>
        document
            .getElementById('foto')
            .addEventListener('change', function(event) {

                const preview = document.getElementById('preview');

                preview.src = URL.createObjectURL(event.target.files[0]);

                preview.classList.remove('hidden');
            });
    </script>

@endsection
