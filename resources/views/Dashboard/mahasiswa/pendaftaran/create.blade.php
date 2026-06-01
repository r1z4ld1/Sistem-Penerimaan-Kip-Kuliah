@extends('layouts.app')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">
                Buat Pendaftaran KIP
            </h1>
            <p class="text-slate-500 mt-1.5 text-sm lg:text-base">
                Pilih perguruan tinggi dan program studi tujuan Anda.
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('mahasiswa.pendaftaran.index') }}"
            class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all active:scale-95 shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- ALERT ERRORS --}}
    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5 mb-6 flex items-start gap-4 shadow-sm">
            <div class="text-rose-500 mt-0.5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-rose-800 mb-2">Terdapat kesalahan pada isian Anda:</h3>
                <ul class="list-disc pl-5 text-sm text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-3xl">
        <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" class="p-6 lg:p-8">
            @csrf

            <div class="space-y-6">

                {{-- UNIVERSITAS --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Universitas Tujuan
                    </label>
                    <div class="relative">
                        <select name="universitas_id" id="universitas" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih Universitas --</option>
                            @foreach ($universitas as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_universitas }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('universitas_id')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- JURUSAN --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Program Studi / Jurusan
                    </label>
                    <div class="relative">
                        <select name="jurusan_id" id="jurusan" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih Universitas Terlebih Dahulu --</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('jurusan_id')
                        <p class="text-rose-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mahasiswa.pendaftaran.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Pendaftaran
                </button>
            </div>

        </form>
    </div>

    {{-- JAVASCRIPT FETCH JURUSAN --}}
    <script>
        document.getElementById('universitas').addEventListener('change', function() {
            let universitasId = this.value;
            let jurusanSelect = document.getElementById('jurusan');

            // Jika tidak ada universitas yang dipilih (misal reset)
            if (!universitasId) {
                jurusanSelect.innerHTML =
                    '<option value="" disabled selected>-- Pilih Universitas Terlebih Dahulu --</option>';
                return;
            }

            // Menampilkan loading state
            jurusanSelect.innerHTML = '<option value="" disabled selected>Memuat data jurusan...</option>';

            // Fetch AJAX
            fetch('/dashboard/mahasiswa/get-jurusan/' + universitasId)
                .then(response => response.json())
                .then(data => {
                    // Reset dropdown
                    jurusanSelect.innerHTML = '<option value="" disabled selected>-- Pilih Jurusan --</option>';

                    // Populasi opsi baru
                    data.forEach(item => {
                        jurusanSelect.innerHTML += `
                            <option value="${item.id}">
                                ${item.nama_jurusan}
                            </option>
                        `;
                    });
                })
                .catch(error => {
                    jurusanSelect.innerHTML =
                        '<option value="" disabled selected>Terjadi kesalahan. Gagal memuat jurusan.</option>';
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
