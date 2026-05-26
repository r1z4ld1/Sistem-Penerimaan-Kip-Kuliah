@extends('layouts.app')

@section('content')

    <div class="mb-5">

        <h1 class="text-3xl font-bold">

            Edit Role

        </h1>

        <p class="text-gray-500 mt-1">

            Update data role sistem

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

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="bg-white rounded-xl shadow p-6">

        @csrf
        @method('PUT')

        {{-- ROLE NAME --}}
        <div class="mb-5">

            <label class="block mb-2">

                Nama Role

            </label>

            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                class="w-full border rounded px-3 py-2">

        </div>

        {{-- BUTTON --}}
        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Update Role

        </button>

    </form>

@endsection
