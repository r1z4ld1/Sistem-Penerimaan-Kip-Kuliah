@extends('layouts.app')

@section('content')

    @php
        use App\Helpers\PermissionHelper;
    @endphp

    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-3xl font-bold">

                Management Permission

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola permission dan hak akses sistem

            </p>

        </div>

        @can('manage permission')
            <a href="{{ route('admin.permissions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

                Tambah Permission

            </a>
        @endcan

    </div>

    {{-- SEARCH --}}
    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari permission..." value="{{ request('search') }}"
            class="w-full border rounded px-3 py-2">

    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">

                        Modul

                    </th>

                    <th class="p-3 text-left">

                        Permission

                    </th>

                    <th class="p-3 text-left">

                        Digunakan Oleh

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

                @forelse($permissions as $permission)
                    <tr class="border-t">

                        {{-- MODUL --}}
                        <td class="p-3">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                {{ PermissionHelper::group($permission->name) }}

                            </span>

                        </td>

                        {{-- LABEL --}}
                        <td class="p-3 font-semibold">

                            {{ PermissionHelper::label($permission->name) }}

                        </td>

                        {{-- ROLE --}}
                        <td class="p-3">

                            <div class="flex flex-wrap gap-2">

                                @forelse($permission->roles as $role)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        {{ ucfirst($role->name) }}

                                    </span>

                                @empty

                                    <span class="text-gray-500">

                                        Belum Digunakan

                                    </span>
                                @endforelse

                            </div>

                        </td>

                        {{-- CREATED --}}
                        <td class="p-3">

                            {{ $permission->created_at->format('d M Y') }}

                        </td>

                        {{-- ACTION --}}
                        <td class="p-3">

                            <div class="flex gap-2">

                                @can('manage permission')
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded">

                                        Edit

                                    </a>
                                @endcan

                                @can('manage permission')
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                                        class="form-delete">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-500 text-white px-3 py-1 rounded">

                                            Hapus

                                        </button>

                                    </form>
                                @endcan

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-5 text-center text-gray-500">

                            Data permission kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-5">

        {{ $permissions->links() }}

    </div>

@endsection
