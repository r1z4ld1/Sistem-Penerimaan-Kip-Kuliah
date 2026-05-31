<x-guest-layout>

    {{-- ============================================================
         KUSTOM CSS: 3D Flip — taruh di sini agar terisolasi per-page
    ============================================================ --}}
    <style>
        /* 1. Kontainer perspektif — memberi kedalaman 3D */
        .flip-scene {
            perspective: 1200px;
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
        }

        /* 2. Kartu yang akan diputar */
        .flip-card {
            position: relative;
            width: 100%;
            /* Tinggi disesuaikan dengan konten terpanjang (Register) */
            min-height: 560px;
            transform-style: preserve-3d;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* 3. Class .flipped memicu rotasi 180 derajat */
        .flip-card.flipped {
            transform: rotateY(180deg);
        }

        /* 4. Kedua sisi kartu */
        .flip-front,
        .flip-back {
            position: absolute;
            inset: 0;
            /* top:0 right:0 bottom:0 left:0 */
            backface-visibility: hidden;
            /* Sembunyikan sisi belakang */
            -webkit-backface-visibility: hidden;
            /* Safari */
        }

        /* 5. Sisi belakang diputar 180 derajat sejak awal */
        .flip-back {
            transform: rotateY(180deg);
        }

        /* 6. Animasi shake jika ada error validasi */
        @keyframes shake {

            0%,
            100% {
                transform: rotateY(180deg) translateX(0);
            }

            20%,
            60% {
                transform: rotateY(180deg) translateX(-6px);
            }

            40%,
            80% {
                transform: rotateY(180deg) translateX(6px);
            }
        }

        .flip-card.flipped.has-error {
            animation: shake 0.4s ease-in-out;
        }
    </style>

    {{-- Header Logo --}}
    <div class="text-center mb-6">
        <div
            class="inline-flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-1.5 text-sm font-semibold text-blue-800">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
            Sistem Penerimaan KIP Kuliah
        </div>
    </div>

    {{-- ============================================================
         SCENE: Pembungkus perspektif
    ============================================================ --}}
    <div class="flip-scene">

        {{-- Kartu 3D — PHP mengisi data-flipped untuk JS --}}
        {{-- Ubah baris id="flipCard" menjadi: --}}
        <div class="flip-card" id="flipCard" data-flipped="{{ $isFlipped ? 'true' : 'false' }}"
            data-has-error="{{ $errors->any() ? 'true' : 'false' }}">

            {{-- ================================================
                 SISI DEPAN: FORM LOGIN
            ================================================ --}}
            <div class="flip-front bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                {{-- Status Session (flash message dari Laravel) --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-blue-900">Selamat Datang</h2>
                    <p class="text-sm text-gray-500 mt-1">Masuk ke akun KIP Kuliah Anda</p>
                </div>

                {{-- Garis aksen biru --}}
                <div class="h-1 w-16 rounded-full bg-gradient-to-r from-blue-700 to-sky-400 mb-6"></div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email / Nomor Pendaftaran --}}
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username"
                            placeholder="email@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-1" x-data="{ show: false }">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative mt-1">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M12 1.5a5.5 5.5 0 00-5.5 5.5v2.328A4 4 0 003 13v7a4 4 0 004 4h10a4 4 0 004-4v-7a4 4 0 00-3.5-3.972V7a5.5 5.5 0 00-5.5-5.5zM8.25 7a3.75 3.75 0 017.5 0v2.25H8.25V7zm3.75 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <x-text-input id="password" class="block w-full pl-10 pr-10"
                                x-bind:type="show ? 'text' : 'password'" name="password" required
                                autocomplete="current-password" placeholder="Masukkan password" />

                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">

                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                                <svg x-show="show" x-cloak style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Forgot Password --}}
                    @if (Route::has('password.request'))
                        <div class="text-right mb-4">
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline">
                                Lupa password?
                            </a>
                        </div>
                    @endif

                    {{-- Remember Me --}}
                    <div class="flex items-center mb-5">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <label for="remember_me" class="ms-2 text-sm text-gray-600">
                            {{ __('Ingat saya di perangkat ini') }}
                        </label>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-700 to-sky-500
                                   text-white font-semibold text-sm tracking-wide
                                   hover:opacity-90 transition-all active:scale-95">
                        Masuk &rarr;
                    </button>
                </form>

                {{-- Link ke Register --}}
                <p class="text-center text-sm text-gray-500 mt-5">
                    Belum punya akun?
                    <button type="button" onclick="flipToRegister()"
                        class="text-blue-700 font-semibold hover:underline bg-transparent border-none cursor-pointer">
                        Daftar sekarang
                    </button>
                </p>
            </div>
            {{-- END FLIP-FRONT --}}


            {{-- ================================================
                 SISI BELAKANG: FORM REGISTER
            ================================================ --}}
            <div class="flip-back bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <div class="mb-5">
                    <h2 class="text-2xl font-bold text-blue-900">Buat Akun</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftarkan diri sebagai calon penerima KIP Kuliah</p>
                </div>

                <div class="h-1 w-16 rounded-full bg-gradient-to-r from-green-600 to-sky-400 mb-5"></div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                        <x-input-label for="reg_name" :value="__('Nama Lengkap')" />
                        <x-text-input id="reg_name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autocomplete="name" placeholder="Nama sesuai KTP" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    {{-- NISN & NPSN --}}
                    {{-- <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input-label for="nisn" :value="__('NISN')" />
                            <x-text-input id="nisn" class="block mt-1 w-full" type="text" name="nisn"
                                :value="old('nisn')" maxlength="10" placeholder="10 digit" />
                            <x-input-error :messages="$errors->get('nisn')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="npsn" :value="__('NPSN Sekolah')" />
                            <x-text-input id="npsn" class="block mt-1 w-full" type="text" name="npsn"
                                :value="old('npsn')" maxlength="8" placeholder="8 digit" />
                            <x-input-error :messages="$errors->get('npsn')" class="mt-1" />
                        </div>
                    </div> --}}

                    {{-- Email --}}
                    <div class="mb-3">
                        <x-input-label for="reg_email" :value="__('Email')" />
                        <x-text-input id="reg_email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" placeholder="email@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password & Konfirmasi --}}
                    <div class="grid grid-cols-2 gap-3 mb-5">

                        <div x-data="{ show: false }">
                            <x-input-label for="reg_password" :value="__('Password')" />

                            <div class="relative mt-1">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.5 5.5 0 00-5.5 5.5v2.328A4 4 0 003 13v7a4 4 0 004 4h10a4 4 0 004-4v-7a4 4 0 00-3.5-3.972V7a5.5 5.5 0 00-5.5-5.5zM8.25 7a3.75 3.75 0 017.5 0v2.25H8.25V7zm3.75 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <x-text-input id="reg_password" class="block w-full pl-10 pr-10"
                                    x-bind:type="show ? 'text' : 'password'" name="password" required
                                    autocomplete="new-password" placeholder="Min. 8 karakter" />

                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <svg x-show="show" x-cloak style="display: none;"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div x-data="{ show: false }">
                            <x-input-label for="reg_password_confirmation" :value="__('Konfirmasi')" />

                            <div class="relative mt-1">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.5 5.5 0 00-5.5 5.5v2.328A4 4 0 003 13v7a4 4 0 004 4h10a4 4 0 004-4v-7a4 4 0 00-3.5-3.972V7a5.5 5.5 0 00-5.5-5.5zM8.25 7a3.75 3.75 0 017.5 0v2.25H8.25V7zm3.75 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <x-text-input id="reg_password_confirmation" class="block w-full pl-10 pr-10"
                                    x-bind:type="show ? 'text' : 'password'" name="password_confirmation" required
                                    autocomplete="new-password" placeholder="Ulangi" />

                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <svg x-show="show" x-cloak style="display: none;"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-green-600 to-sky-500
                                   text-white font-semibold text-sm tracking-wide
                                   hover:opacity-90 transition-all active:scale-95">
                        Daftar Sekarang &rarr;
                    </button>
                </form>

                {{-- Link ke Login --}}
                <p class="text-center text-sm text-gray-500 mt-5">
                    Sudah punya akun?
                    <button type="button" onclick="flipToLogin()"
                        class="text-blue-700 font-semibold hover:underline bg-transparent border-none cursor-pointer">
                        Masuk di sini
                    </button>
                </p>
            </div>
            {{-- END FLIP-BACK --}}

        </div>
        {{-- END FLIP-CARD --}}

    </div>
    {{-- END FLIP-SCENE --}}

    {{-- ============================================================
         JS: Kontrol Flip — taruh di sini agar terisolasi per-page
    ============================================================ --}}
    <script>
        // ================================================================
        // ELEMENT REFERENCE
        // ================================================================
        const card = document.getElementById('flipCard');

        // ================================================================
        // FUNGSI FLIP
        // ================================================================

        /** Putar kartu ke sisi Register */
        function flipToRegister() {
            card.classList.add('flipped');
        }

        /** Putar kartu kembali ke sisi Login */
        function flipToLogin() {
            card.classList.remove('flipped');
            card.classList.remove('has-error'); // Reset animasi error
        }

        // ================================================================
        // STATE MANAGEMENT — Deteksi dari PHP
        // PHP mengisi data-flipped="true/false" saat controller me-render view
        // ================================================================
        (function initFlipState() {
            // Baca nilai yang dikirim PHP via data attribute
            const shouldFlip = card.dataset.flipped === 'true';

            if (shouldFlip) {
                // Flip tanpa animasi saat halaman pertama load
                // Gunakan class 'no-transition' lalu hapus setelah render
                card.style.transition = 'none';
                card.classList.add('flipped');

                // Cek apakah ada error validasi dari Laravel (setelah POST /register gagal)
                // $errors->any() dirender sebagai data attribute oleh blade
                const hasError = card.dataset.hasError === 'true';
                if (hasError) {
                    // Tunda sedikit agar animasi shake terlihat setelah kartu muncul
                    setTimeout(() => {
                        card.classList.add('has-error');
                        // Hapus class setelah animasi selesai agar bisa diputar ulang
                        card.addEventListener('animationend', () => {
                            card.classList.remove('has-error');
                        }, {
                            once: true
                        }); // { once: true } = event listener otomatis dihapus
                    }, 150);
                }

                // Kembalikan transisi normal setelah satu frame render
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        card.style.transition = '';
                    });
                });
            }
        })();
    </script>

</x-guest-layout>
