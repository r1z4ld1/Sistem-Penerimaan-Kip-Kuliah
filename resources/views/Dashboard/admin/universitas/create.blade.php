@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-5">
        Tambah Universitas
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

    <form action="{{ route('admin.universitas.store') }}" method="POST" class="bg-white p-6 rounded shadow">

        @csrf

        <div class="mb-4">

            <label>Nama Universitas</label>

            <input type="text" name="nama_universitas" value="{{ old('nama_universitas') }}"
                class="w-full border rounded px-3 py-2">

        </div>

        <div class="mb-4">

            <label>Alamat</label>

            <textarea name="alamat" rows="4" class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>

        </div>

        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Simpan

        </button>

    </form>

@endsection
