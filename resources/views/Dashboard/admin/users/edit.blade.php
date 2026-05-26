@extends('layouts.app')

@section('content')

    <div class="mb-5">

        <h1 class="text-3xl font-bold">

            Edit User

        </h1>

        <p class="text-gray-500 mt-1">

            Update data user sistem

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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white rounded-xl shadow p-6">

        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div class="mb-4">

            <label class="block mb-2">

                Nama

            </label>

            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border rounded px-3 py-2">

        </div>

        {{-- EMAIL --}}
        <div class="mb-4">

            <label class="block mb-2">

                Email

            </label>

            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border rounded px-3 py-2">

        </div>

        {{-- PASSWORD --}}
        <div class="mb-4">

            <label class="block mb-2">

                Password Baru
                <span class="text-gray-500 text-sm">
                    (kosongkan jika tidak diubah)
                </span>

            </label>

            <input type="password" name="password" class="w-full border rounded px-3 py-2">

        </div>

        {{-- ROLE --}}
        <div class="mb-5">

            <label class="block mb-2">

                Role

            </label>

            <select name="role" class="w-full border rounded px-3 py-2">

                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->roles->first()?->name == $role->name ? 'selected' : '' }}>

                        {{ ucfirst($role->name) }}

                    </option>
                @endforeach

            </select>

        </div>

        {{-- BUTTON --}}
        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Update User

        </button>

    </form>

@endsection
