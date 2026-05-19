@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-5">
        Upload Berkas
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

    <form action="{{ route('mahasiswa.berkas.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow p-6">

        @csrf

        {{-- Pendaftaran --}}
        <div class="mb-4">

            <label class="block mb-2">
                Pendaftaran
            </label>

            <select name="pendaftaran_id" class="w-full border rounded px-3 py-2">

                @foreach ($pendaftaran as $item)
                    <option value="{{ $item->id }}">

                        {{ $item->kode_pendaftaran }}

                    </option>
                @endforeach

            </select>

        </div>

        {{-- Nama Berkas --}}
        <div class="mb-4">

            <label class="block mb-2">
                Nama Berkas
            </label>

            <input type="text" name="nama_berkas" class="w-full border rounded px-3 py-2"
                placeholder="Contoh: KTP / KK / Rapor">

        </div>

        {{-- File --}}
        <div class="mb-4">

            <label class="block mb-2">
                File Berkas
            </label>

            <input type="file" name="file_berkas" class="w-full border rounded px-3 py-2">

            <p class="text-sm text-gray-500 mt-1">
                Format: PDF, JPG, JPEG, PNG maksimal 2MB
            </p>

        </div>

        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Upload Berkas

        </button>

    </form>

@endsection
