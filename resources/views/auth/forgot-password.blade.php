<x-guest-layout>

    {{-- ============================================================
         INLINE STYLE: Komponen khusus halaman Forgot Password
         Menggunakan token warna & tipografi yang sama dengan login
    ============================================================ --}}
    <style>
        /* Ikon amplop bergerak naik-turun */
        @keyframes kip-envelope-float {

            0%,
            100% {
                transform: translateY(0) rotate(-2deg);
            }

            50% {
                transform: translateY(-7px) rotate(2deg);
            }
        }

        /* Badge langkah berdenyut saat aktif */
        @keyframes kip-step-glow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(21, 96, 189, 0);
            }

            50% {
                box-shadow: 0 0 0 4px rgba(21, 96, 189, 0.15);
            }
        }

        /* Tombol kirim: efek kirim saat di-hover */
        @keyframes kip-send-slide {
            0% {
                transform: translateX(0);
            }

            40% {
                transform: translateX(4px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .kip-fp-icon-wrap {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, #e6f1fb, #dbeafe);
            border: 1.5px solid #bfdbfe;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            animation: kip-envelope-float 3s ease-in-out infinite;
        }

        /* Kartu langkah-langkah proses reset */
        .kip-step-card {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 6px;
            text-align: center;
        }

        .kip-step-num {
            width: 24px;
            height: 24px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 6px;
        }

        .kip-step-label {
            font-size: 10px;
            font-weight: 600;
            color: #475569;
            line-height: 1.3;
        }

        /* Input email dengan ikon di dalam */
        .kip-input-wrapper {
            position: relative;
        }

        .kip-input-wrapper svg.kip-input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        /* Override padding-left untuk input ber-ikon */
        .kip-input-wrapper .kip-has-icon {
            padding-left: 40px !important;
        }

        /* Ikon panah kirim bergerak saat hover tombol */
        .kip-btn-send:hover .kip-send-arrow {
            animation: kip-send-slide 0.5s ease-in-out;
        }

        /* Pesan sukses */
        .kip-success-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 1.25rem;
        }

        .kip-success-box p {
            font-size: 13px;
            color: #166534;
            margin: 0;
            line-height: 1.5;
        }
    </style>

    {{-- ============================================================
         BADGE IDENTITAS SISTEM
    ============================================================ --}}
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
         KARTU UTAMA
    ============================================================ --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 px-8 py-8">

        {{-- Ikon Amplop Animasi --}}
        <div class="kip-fp-icon-wrap" aria-hidden="true">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#1560bd" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
            </svg>
        </div>

        {{-- Judul & Deskripsi --}}
        <h2 class="text-2xl font-bold text-blue-900 mb-1">Lupa Password?</h2>
        <p class="text-sm text-gray-500 leading-relaxed mb-5">
            Masukkan email yang terdaftar pada akun KIP Kuliah Anda. Kami akan mengirimkan
            tautan untuk membuat password baru.
        </p>

        {{-- Garis aksen --}}
        <div class="h-1 w-14 rounded-full bg-gradient-to-r from-blue-700 to-sky-400 mb-6"></div>

        {{-- Langkah-langkah Proses --}}
        <div class="flex gap-3 mb-6">
            <div class="kip-step-card">
                <div class="kip-step-num">1</div>
                <div class="kip-step-label">Masukkan<br>Email</div>
            </div>
            <div class="kip-step-card">
                <div class="kip-step-num">2</div>
                <div class="kip-step-label">Cek<br>Inbox</div>
            </div>
            <div class="kip-step-card">
                <div class="kip-step-num">3</div>
                <div class="kip-step-label">Buat Password<br>Baru</div>
            </div>
        </div>

        {{-- Garis pemisah --}}
        <div class="border-t border-gray-100 mb-5"></div>

        {{-- Session Status — pesan sukses setelah email terkirim --}}
        @if (session('status'))
            <div class="kip-success-box">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        {{-- ============================================================
             FORM RESET PASSWORD
        ============================================================ --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Input Email --}}
            <div class="mb-5">
                <x-input-label for="email" :value="__('Alamat Email Terdaftar')" />

                {{-- Wrapper dengan ikon di dalam input --}}
                <div class="kip-input-wrapper mt-1">
                    <svg class="kip-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>

                    <x-text-input id="email" class="block w-full kip-has-icon" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="email" placeholder="email@example.com" />
                </div>

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Tombol Kirim --}}
            <button type="submit"
                class="kip-btn-send w-full flex items-center justify-center gap-2.5
                           py-3 rounded-xl font-bold text-sm text-white tracking-wide
                           bg-gradient-to-r from-blue-700 to-sky-500
                           hover:opacity-90 transition-all active:scale-95">
                <svg class="kip-send-arrow w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 2 11 13" />
                    <path d="M22 2 15 22 11 13 2 9l20-7z" />
                </svg>
                Kirim Tautan Reset Password
            </button>
        </form>

        {{-- Link Kembali ke Login --}}
        <div class="text-center mt-5">
            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-1.5 text-sm text-blue-700
                      font-semibold hover:underline transition-all">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                Kembali ke Halaman Masuk
            </a>
        </div>

    </div>
    {{-- END KARTU UTAMA --}}

</x-guest-layout>
