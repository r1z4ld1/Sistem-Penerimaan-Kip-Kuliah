<nav class="flex-1 space-y-8 px-4 py-6 overflow-y-auto">

    {{-- ====================================================== --}}
    {{-- ADMIN MENU --}}
    {{-- ====================================================== --}}
    @role('admin')
        <div>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Admin Dashboard</span>
            </a>
        </div>
        <div>
            <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Menu Administrator</h3>
            <ul class="space-y-1.5">

                @can('view user')
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manajemen User
                        </a>
                    </li>
                @endcan

                @can('manage role')
                    <li>
                        <a href="{{ route('admin.roles.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Manajemen Role
                        </a>
                    </li>
                @endcan

                @can('manage permission')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Manajemen Permission
                        </a>
                    </li>
                @endcan

                @can('view mahasiswa')
                    <li>
                        <a href="{{ route('admin.mahasiswa.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                            Data Mahasiswa
                        </a>
                    </li>
                @endcan

                @can('view universitas')
                    <li>
                        <a href="{{ route('admin.universitas.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Data Universitas
                        </a>
                    </li>
                @endcan

                @can('view jurusan')
                    <li>
                        <a href="{{ route('admin.jurusan.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-blue-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-blue-600 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Data Jurusan
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    @endrole

    {{-- ====================================================== --}}
    {{-- MAHASISWA MENU --}}
    {{-- ====================================================== --}}
    @php

        $pendaftaranAktif = auth()->check() ? auth()->user()->mahasiswa?->pendaftaran()->latest()->first() : null;

    @endphp
    @role('mahasiswa')
        <div>
            <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Menu Pendaftar</h3>
            <ul class="space-y-1.5">
                <li>
                    <a href="{{ route('mahasiswa.dashboard') }}"
                        class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-emerald-600 hover:translate-x-1 md:py-3">
                        <div
                            class="absolute inset-y-2 left-0 w-1 bg-emerald-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Biodata
                    </a>
                </li>

                @can('view pendaftaran')
                    <li>
                        <a href="{{ route('mahasiswa.pendaftaran.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-emerald-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-emerald-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Pendaftaran KIP
                        </a>
                    </li>
                @endcan

                @can('view berkas')
                    @if (!$pendaftaranAktif)
                        <li>

                            <div
                                class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-400 cursor-not-allowed">

                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 11V7m0 4v4m8-4A8 8 0 114 11a8 8 0 0116 0z" />

                                </svg>

                                Upload Berkas

                            </div>

                            <p class="text-xs text-gray-400 ml-11">

                                Belum mengajukan pendaftaran

                            </p>

                        </li>
                    @elseif($pendaftaranAktif->status === 'pending')
                        <li>

                            <div
                                class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-400 cursor-not-allowed">

                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                                </svg>

                                Upload Berkas

                            </div>

                            <p class="text-xs text-yellow-600 ml-11">

                                Menunggu verifikasi pendaftaran

                            </p>

                        </li>
                    @elseif($pendaftaranAktif->status === 'ditolak')
                        <li>

                            <div
                                class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-400 cursor-not-allowed">

                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M6 18L18 6M6 6l12 12" />

                                </svg>

                                Upload Berkas

                            </div>

                            <p class="text-xs text-red-600 ml-11">

                                Pendaftaran ditolak

                            </p>

                        </li>
                    @elseif($pendaftaranAktif->status === 'diterima')
                        <li>

                            <a href="{{ route('mahasiswa.berkas.index') }}"
                                class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-emerald-600 hover:translate-x-1 md:py-3">

                                <div
                                    class="absolute inset-y-2 left-0 w-1 bg-emerald-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500 transition-colors duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />

                                </svg>

                                Upload Berkas

                            </a>

                        </li>
                    @endif
                @endcan
            </ul>
        </div>
    @endrole

    {{-- ====================================================== --}}
    {{-- VERIFIKATOR MENU --}}
    {{-- ====================================================== --}}
    @role('verifikator')
        <div>
            <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Menu Verifikator</h3>
            <ul class="space-y-1.5">
                <li>
                    <a href="{{ route('verifikator.dashboard') }}"
                        class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-purple-600 hover:translate-x-1 md:py-3">
                        <div
                            class="absolute inset-y-2 left-0 w-1 bg-purple-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('verifikator.pendaftaran.index') }}"
                        class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-purple-600 hover:translate-x-1 md:py-3">
                        <div
                            class="absolute inset-y-2 left-0 w-1 bg-purple-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Verifikasi Pendaftaran
                    </a>

                    @can('view verifikasi')
                    <li>
                        <a href="{{ route('verifikator.berkas.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-purple-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-purple-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Verifikasi Berkas
                        </a>
                    </li>
                @endcan

                @can('view mahasiswa')
                    <li>
                        <a href="{{ route('verifikator.mahasiswa.index') }}"
                            class="group relative flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all duration-300 ease-in-out hover:bg-white/60 hover:backdrop-blur-md hover:shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:text-purple-600 hover:translate-x-1 md:py-3">
                            <div
                                class="absolute inset-y-2 left-0 w-1 bg-purple-500 rounded-r-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Data Mahasiswa
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    @endrole

</nav>
