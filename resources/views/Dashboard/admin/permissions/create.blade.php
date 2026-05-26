@extends('layouts.app')

@section('content')

    <div class="mb-5">

        <h1 class="text-3xl font-bold">

            Tambah Permission

        </h1>

        <p class="text-gray-500 mt-1">

            Tambahkan permission baru sistem

        </p>

    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('admin.permissions.store') }}" method="POST" class="bg-white rounded-xl shadow p-6">

        @csrf

        {{-- PERMISSION NAME --}}
        <div class="mb-5">

            <label class="block mb-2">

                Nama Permission

            </label>

            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: create user / tambah user"
                class="w-full border rounded px-3 py-2">

        </div>

        {{-- BUTTON --}}
        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Simpan Permission

        </button>

    </form>

@endsection
