@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-5">
        Tambah Jurusan
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

    <form action="{{ route('admin.jurusan.store') }}" method="POST" class="bg-white p-6 rounded shadow">

        @csrf

        <div class="mb-4">

            <label>Universitas</label>

            <select name="universitas_id" class="w-full border rounded px-3 py-2">

                <option value="">
                    Pilih Universitas
                </option>

                @foreach ($universitas as $item)
                    <option value="{{ $item->id }}">

                        {{ $item->nama_universitas }}

                    </option>
                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label>Nama Jurusan</label>

            <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan') }}"
                class="w-full border rounded px-3 py-2">

        </div>

        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Simpan

        </button>

    </form>

@endsection
