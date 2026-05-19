@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-5">

        <div>

            <h1 class="text-3xl font-bold">
                Upload Berkas
            </h1>

            <p class="text-gray-500 mt-1">
                Data berkas pendaftaran KIP
            </p>

        </div>

        <a href="{{ route('mahasiswa.berkas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">

            Upload Berkas

        </a>

    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Nama Berkas
                    </th>

                    <th class="p-3 text-left">
                        File
                    </th>

                    <th class="p-3 text-left">
                        Status
                    </th>

                    <th class="p-3 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($berkas as $item)
                    <tr class="border-t">

                        <td class="p-3">

                            {{ $item->nama_berkas }}

                        </td>

                        <td class="p-3">

                            <a href="{{ asset('storage/' . $item->file_berkas) }}" target="_blank"
                                class="text-blue-500 underline">

                                Lihat File

                            </a>

                        </td>

                        <td class="p-3">

                            @if ($item->status_verifikasi == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Pending

                                </span>
                            @elseif($item->status_verifikasi == 'diterima')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Diterima

                                </span>
                            @elseif($item->status_verifikasi == 'ditolak')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Ditolak

                                </span>
                            @endif

                        </td>

                        <td class="p-3">

                            <form action="{{ route('mahasiswa.berkas.destroy', $item->id) }}" method="POST"
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

                        <td colspan="4" class="p-5 text-center">

                            Belum ada berkas

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
