@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-3xl font-bold">

                Management Role

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola role dan hak akses sistem

            </p>

        </div>

        <a href="{{ route('admin.roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

            Tambah Role

        </a>

    </div>

    {{-- SEARCH --}}
    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari role..." value="{{ request('search') }}"
            class="w-full border rounded px-3 py-2">

    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Nama Role
                    </th>

                    <th class="p-3 text-left">
                        Total User
                    </th>

                    <th class="p-3 text-left">
                        Total Permission
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

                @forelse($roles as $role)
                    <tr class="border-t">

                        {{-- ROLE --}}
                        <td class="p-3 font-semibold">

                            {{ $role->name }}

                        </td>

                        {{-- USERS --}}
                        <td class="p-3">

                            {{ $role->users_count }}

                        </td>

                        {{-- PERMISSION --}}
                        <td class="p-3">

                            {{ $role->permissions_count }}

                        </td>

                        {{-- CREATED --}}
                        <td class="p-3">

                            {{ $role->created_at->format('d M Y') }}

                        </td>

                        {{-- ACTION --}}
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="form-delete">

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

                            Data role kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-5">

        {{ $roles->links() }}

    </div>
@endsection
