@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-5">
        Tambah Mahasiswa
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

    <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label>User Mahasiswa</label>

                <select name="user_id" class="w-full border rounded px-3 py-2">

                    <option value="">Pilih User</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label>NIK</label>

                <input type="text" name="nik" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>NISN</label>

                <input type="text" name="nisn" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tempat Lahir</label>

                <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tanggal Lahir</label>

                <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="w-full border rounded px-3 py-2">

                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>

                </select>
            </div>

            <div>
                <label>No HP</label>

                <input type="text" name="no_hp" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Sekolah</label>

                <input type="text" name="sekolah" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Tahun Lulus</label>

                <input type="number" name="tahun_lulus" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label>Foto</label>

                <input type="file" name="foto" class="w-full border rounded px-3 py-2">
            </div>

        </div>

        <div class="mt-4">

            <label>Alamat</label>

            <textarea name="alamat" rows="4" class="w-full border rounded px-3 py-2"></textarea>

        </div>

        <button class="mt-5 bg-blue-500 text-black px-5 py-2 rounded">

            Simpan

        </button>

    </form>
@endsection
