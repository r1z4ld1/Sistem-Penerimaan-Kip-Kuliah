@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <h1 class="text-3xl font-bold">
            Data Universitas
        </h1>

        <a href="{{ route('admin.universitas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

            Tambah Universitas

        </a>

    </div>

    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari universitas..." value="{{ request('search') }}"
            class="border rounded px-3 py-2 w-full">

    </form>

    <div class="overflow-x-auto bg-white rounded shadow">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Nama Universitas</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($universitas as $item)
                    <tr class="border-t">

                        <td class="p-3">
                            {{ $item->nama_universitas }}
                        </td>

                        <td class="p-3">
                            {{ $item->alamat ?? '-' }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.universitas.edit', $item->id) }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form action="{{ route('admin.universitas.destroy', $item->id) }}" method="POST"
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

        {{ $universitas->links() }}

    </div>
@endsection
