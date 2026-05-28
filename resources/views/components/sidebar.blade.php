<ul class="space-y-2">

    {{-- ====================================================== --}}
    {{-- DASHBOARD --}}
    {{-- ====================================================== --}}

    <li>

        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">

            Dashboard

        </a>

    </li>

    {{-- ====================================================== --}}
    {{-- ADMIN --}}
    {{-- ====================================================== --}}

    @role('admin')
        @can('view user')
            <li>

                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Manajemen User

                </a>

            </li>
        @endcan

        @can('manage role')
            <li>

                <a href="{{ route('admin.roles.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Manajemen Role

                </a>

            </li>
        @endcan

        @can('manage permission')
            <li>

                <a href="{{ route('admin.permissions.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Manajemen Permission

                </a>

            </li>
        @endcan

        @can('view mahasiswa')
            <li>

                <a href="{{ route('admin.mahasiswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Data Mahasiswa

                </a>

            </li>
        @endcan

        @can('view universitas')
            <li>

                <a href="{{ route('admin.universitas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Data Universitas

                </a>

            </li>
        @endcan

        @can('view jurusan')
            <li>

                <a href="{{ route('admin.jurusan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Data Jurusan

                </a>

            </li>
        @endcan
    @endrole

    {{-- ====================================================== --}}
    {{-- MAHASISWA --}}
    {{-- ====================================================== --}}

    @role('mahasiswa')
        <li>

            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                Biodata

            </a>

        </li>

        @can('view pendaftaran')
            <li>

                <a href="{{ route('mahasiswa.pendaftaran.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Pendaftaran KIP

                </a>

            </li>
        @endcan

        @can('view berkas')
            <li>

                <a href="{{ route('mahasiswa.berkas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Upload Berkas

                </a>

            </li>
        @endcan
    @endrole

    {{-- ====================================================== --}}
    {{-- VERIFIKATOR --}}
    {{-- ====================================================== --}}

    @role('verifikator')
        @can('view mahasiswa')
            <li>

                <a href="{{ route('verifikator.mahasiswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Data Mahasiswa

                </a>

            </li>
        @endcan

        @can('view verifikasi')
            <li>

                <a href="{{ route('verifikator.berkas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">

                    Verifikasi Berkas

                </a>

            </li>
        @endcan
    @endrole

</ul>
