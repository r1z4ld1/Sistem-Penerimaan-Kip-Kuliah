@extends('layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold">
                Detail Verifikasi Berkas
            </h1>

            <p class="text-gray-500 mt-1">
                Nama Lengkap Mahasiswa:
                <span class="font-semibold">
                    {{ $mahasiswa->nama }}
                </span>
            </p>

        </div>

        <a href="{{ route('verifikator.berkas.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

            Kembali

        </a>

    </div>

    @foreach ($mahasiswa->pendaftaran as $pendaftaran)
        <div class="bg-white rounded-xl shadow mb-6 overflow-hidden">

            <div class="p-5 border-b bg-gray-50">

                <h2 class="font-bold text-lg">
                    Data Pendaftaran
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 text-sm">

                    <div>
                        <span class="text-gray-500">
                            Nik:
                        </span>

                        <div class="font-medium">
                            {{ $mahasiswa->nik ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">
                            No Telepon:
                        </span>

                        <div class="font-medium">
                            {{ $mahasiswa->no_hp ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">
                            Universitas:
                        </span>

                        <div class="font-medium">
                            {{ $pendaftaran->universitas->nama_universitas ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">
                            Jurusan:
                        </span>

                        <div class="font-medium">
                            {{ $pendaftaran->jurusan->nama_jurusan ?? '-' }}
                        </div>
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

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
                                Catatan
                            </th>

                            <th class="p-3 text-left">
                                Verifikasi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($pendaftaran->berkas as $berkas)
                            <tr class="border-t align-top">

                                {{-- nama berkas --}}
                                <td class="p-3 font-medium">
                                    {{ $berkas->nama_berkas }}
                                </td>

                                {{-- file --}}
                                <td class="p-3">

                                    <a href="{{ asset('storage/' . $berkas->file) }}" target="_blank"
                                        class="text-blue-500 hover:underline">

                                        Lihat File

                                    </a>

                                </td>

                                {{-- status --}}
                                <td class="p-3">

                                    <span class="{{ $berkas->status_verifikasi?->badge() }} px-3 py-1 rounded-full text-sm">

                                        {{ $berkas->status_verifikasi?->label() }}

                                    </span>

                                </td>

                                {{-- catatan --}}
                                <td class="p-3">

                                    {{ $berkas->catatan_verifikasi ?? '-' }}

                                </td>

                                {{-- form verifikasi --}}
                                <td class="p-3 w-[400px]">

                                    <form action="{{ route('verifikator.berkas.update', $berkas->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="space-y-3">

                                            {{-- status --}}
                                            <select name="status_verifikasi" class="w-full rounded-lg border-gray-300">

                                                @foreach (\App\Enums\StatusBerkasEnum::options() as $value => $label)
                                                    <option value="{{ $value }}" @selected($berkas->status_verifikasi?->value === $value)>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            {{-- catatan --}}
                                            <textarea name="catatan_verifikasi" rows="3" placeholder="Catatan verifikasi..."
                                                class="w-full border rounded-lg px-3 py-2">{{ $berkas->catatan_verifikasi }}</textarea>

                                            {{-- button --}}
                                            <button type="submit"
                                                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

                                                Simpan Verifikasi

                                            </button>

                                        </div>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="p-5 text-center text-gray-500">

                                    Belum ada berkas

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    @endforeach
@endsection
