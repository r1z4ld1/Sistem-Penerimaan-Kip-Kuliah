@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <h1 class="text-3xl font-bold">
            Data Mahasiswa
        </h1>

        <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded">

            Tambah Mahasiswa
        </a>

    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-4">

        <input type="text" name="search" placeholder="Cari mahasiswa..." value="{{ request('search') }}"
            class="border rounded px-3 py-2 w-full">

    </form>

    <div class="overflow-x-auto bg-white rounded shadow">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">NIK</th>
                    <th class="p-3 text-left">NISN</th>
                    <th class="p-3 text-left">Sekolah</th>
                    <th class="p-3 text-left">No HP</th>
                    <th class="p-3 text-left">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($mahasiswa as $item)
                    <tr class="border-t">

                        <td class="p-3">

                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-14 h-14 rounded object-cover">
                            @else
                                -
                            @endif

                        </td>

                        <td class="p-3">
                            {{ $item->nik }}
                        </td>

                        <td class="p-3">
                            {{ $item->nisn }}
                        </td>

                        <td class="p-3">
                            {{ $item->sekolah }}
                        </td>

                        <td class="p-3">
                            {{ $item->no_hp }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                class="bg-yellow-400 text-white px-3 py-1 rounded">

                                Edit
                            </a>

                            <form action="{{ route('admin.mahasiswa.destroy', $item->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus data?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="p-5 text-center">

                            Data kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">

        {{ $mahasiswa->links() }}

    </div>
@endsection
