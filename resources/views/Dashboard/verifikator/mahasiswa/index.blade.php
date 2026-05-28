@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">

                Data Mahasiswa

            </h1>

            <p class="text-gray-500 mt-1">

                Data mahasiswa untuk kebutuhan verifikasi

            </p>

        </div>

    </div>

    {{-- SEARCH --}}
    <form method="GET" class="mb-5">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa..."
            class="w-full border rounded-lg px-4 py-2">

    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Foto
                    </th>

                    <th class="p-3 text-left">
                        NIK
                    </th>

                    <th class="p-3 text-left">
                        NISN
                    </th>

                    <th class="p-3 text-left">
                        Sekolah
                    </th>

                    <th class="p-3 text-left">
                        No HP
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($mahasiswa as $item)
                    <tr class="border-t">

                        <td class="p-3">

                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-14 h-14 rounded object-cover">
                            @else
                                <div class="w-14 h-14 rounded bg-gray-200"></div>
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

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-5 text-center text-gray-500">

                            Data mahasiswa kosong

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-5">

        {{ $mahasiswa->links() }}

    </div>
@endsection
