@extends('layouts.app')

@section('content')

    <h1 class="text-3xl font-bold mb-5">
        Buat Pendaftaran KIP
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" class="bg-white rounded-xl shadow p-6">

        @csrf

        {{-- Universitas --}}
        <div class="mb-4">

            <label class="block mb-2">
                Universitas
            </label>

            <select name="universitas_id" class="w-full border rounded px-3 py-2" id="universitas">

                <option value="">
                    Pilih Universitas
                </option>

                @foreach ($universitas as $item)
                    <option value="{{ $item->id }}">

                        {{ $item->nama_universitas }}

                    </option>
                @endforeach

            </select>

        </div>

        {{-- Jurusan --}}
        <div class="mb-4">

            <label class="block mb-2">
                Jurusan
            </label>

            <select name="jurusan_id" class="w-full border rounded px-3 py-2" id="jurusan">

                <option value="">
                    Pilih Jurusan
                </option>


            </select>

        </div>

        <button class="bg-blue-500 text-white px-5 py-2 rounded">

            Simpan Pendaftaran

        </button>

    </form>
    <script>
        document
            .getElementById('universitas')
            .addEventListener('change', function() {

                let universitasId = this.value;

                fetch('/dashboard/mahasiswa/get-jurusan/' + universitasId)

                    .then(response => response.json())

                    .then(data => {

                        let jurusan = document.getElementById('jurusan');

                        jurusan.innerHTML =
                            '<option value="">Pilih Jurusan</option>';

                        data.forEach(item => {

                            jurusan.innerHTML += `
                        <option value="${item.id}">
                            ${item.nama_jurusan}
                        </option>
                    `;

                        });

                    });

            });
    </script>

@endsection
