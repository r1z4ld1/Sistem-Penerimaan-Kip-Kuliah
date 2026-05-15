@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <h1 class="text-3xl font-bold">
            Data Jurusan
        </h1>

        <a href="{{ route('admin.jurusan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

            Tambah Jurusan

        </a>

    </div>

    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari jurusan atau universitas..." value="{{ request('search') }}"
            class="border rounded px-3 py-2 w-full">

    </form>

    <div class="overflow-x-auto bg-white rounded shadow">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Universitas
                    </th>

                    <th class="p-3 text-left">
                        Jurusan
                    </th>

                    <th class="p-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($jurusan as $item)
                    <tr class="border-t">

                        <td class="p-3">

                            {{ $item->universitas->nama_universitas }}

                        </td>

                        <td class="p-3">

                            {{ $item->nama_jurusan }}

                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.jurusan.edit', $item->id) }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST"
                                class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="p-5 text-center">

                            Data kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">

        {{ $jurusan->links() }}

    </div>
@endsection
