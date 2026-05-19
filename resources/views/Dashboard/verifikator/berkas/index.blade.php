@extends('layouts.app')

@section('content')
    <div class="mb-6">

        <h1 class="text-3xl font-bold">
            Verifikasi Berkas
        </h1>

        <p class="text-gray-500 mt-1">
            Pemeriksaan berkas mahasiswa
        </p>

    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">
                        Mahasiswa
                    </th>

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
                        Verifikasi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($berkas as $item)
                    <tr class="border-t align-top">

                        {{-- Nama Mahasiswa --}}
                        <td class="p-3">

                            {{ $item->pendaftaran->mahasiswa->user->name }}

                        </td>

                        {{-- Nama Berkas --}}
                        <td class="p-3">

                            {{ $item->nama_berkas }}

                        </td>

                        {{-- File --}}
                        <td class="p-3">

                            <a href="{{ asset('storage/' . $item->file_berkas) }}" target="_blank"
                                class="text-blue-500 underline">

                                Lihat File

                            </a>

                        </td>

                        {{-- Status --}}
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

                        {{-- Form Verifikasi --}}
                        <td class="p-3">

                            <form action="{{ route('verifikator.berkas.verifikasi', $item->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                {{-- Status --}}
                                <select name="status_verifikasi" class="border rounded px-3 py-2 w-full mb-2">

                                    <option value="pending" {{ $item->status_verifikasi == 'pending' ? 'selected' : '' }}>

                                        Pending

                                    </option>

                                    <option value="diterima" {{ $item->status_verifikasi == 'diterima' ? 'selected' : '' }}>

                                        Diterima

                                    </option>

                                    <option value="ditolak" {{ $item->status_verifikasi == 'ditolak' ? 'selected' : '' }}>

                                        Ditolak

                                    </option>

                                </select>

                                {{-- Catatan --}}
                                <textarea name="catatan_verifikasi" rows="3" placeholder="Catatan verifikasi..."
                                    class="border rounded px-3 py-2 w-full mb-2">{{ $item->catatan_verifikasi }}</textarea>

                                <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">

                                    Simpan Verifikasi

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-5 text-center">

                            Belum ada berkas

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
