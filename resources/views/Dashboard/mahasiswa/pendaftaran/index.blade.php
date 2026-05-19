@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-3xl font-bold">
                Pendaftaran KIP
            </h1>

            <p class="text-gray-500 mt-1">
                Data pendaftaran KIP Kuliah
            </p>

        </div>

        @if ($pendaftaran->count() == 0)
            <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

                Buat Pendaftaran

            </a>
        @endif

    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Kode
                    </th>

                    <th class="p-3 text-left">
                        Universitas
                    </th>

                    <th class="p-3 text-left">
                        Jurusan
                    </th>

                    <th class="p-3 text-left">
                        Tanggal
                    </th>

                    <th class="p-3 text-left">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pendaftaran as $item)
                    <tr class="border-t">

                        <td class="p-3 font-semibold">

                            {{ $item->kode_pendaftaran }}

                        </td>

                        <td class="p-3">

                            {{ $item->universitas->nama_universitas }}

                        </td>

                        <td class="p-3">

                            {{ $item->jurusan->nama_jurusan }}

                        </td>

                        <td class="p-3">

                            {{ $item->tanggal_daftar }}

                        </td>

                        <td class="p-3">

                            @if ($item->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Pending

                                </span>
                            @elseif($item->status == 'diterima')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Diterima

                                </span>
                            @elseif($item->status == 'ditolak')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Ditolak

                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-5 text-center">

                            Belum ada pendaftaran

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
