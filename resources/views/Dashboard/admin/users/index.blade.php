@extends('layouts.app')

@section('content')

    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-3xl font-bold">

                Management User

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola seluruh user sistem

            </p>

        </div>

        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

            Tambah User

        </a>

    </div>

    {{-- SEARCH --}}
    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}"
            class="w-full border rounded px-3 py-2">

    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Nama
                    </th>

                    <th class="p-3 text-left">
                        Email
                    </th>

                    <th class="p-3 text-left">
                        Role
                    </th>

                    <th class="p-3 text-left">
                        Dibuat
                    </th>

                    <th class="p-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)
                    <tr class="border-t">

                        {{-- NAMA --}}
                        <td class="p-3 font-semibold">

                            {{ $user->name }}

                        </td>

                        {{-- EMAIL --}}
                        <td class="p-3">

                            {{ $user->email }}

                        </td>

                        {{-- ROLE --}}
                        <td class="p-3">

                            @forelse($user->roles as $role)
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    {{ $role->name }}

                                </span>

                            @empty

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                    Tidak Ada Role

                                </span>
                            @endforelse

                        </td>

                        {{-- CREATED --}}
                        <td class="p-3">

                            {{ $user->created_at->format('d M Y') }}

                        </td>

                        {{-- AKSI --}}
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-5 text-center text-gray-500">

                            Data user kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-5">

        {{ $users->links() }}

    </div>

@endsection
