<ul class="space-y-2">

    <li>
        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
            Dashboard
        </a>
    </li>

    @role('admin')
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                Manajemen User
            </a>
        </li>

        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                Role & Permission
            </a>
        </li>
    @endrole

    @role('mahasiswa')
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                Biodata
            </a>
        </li>

        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                Pendaftaran
            </a>
        </li>
    @endrole

    @role('verifikator')
        <li>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                Verifikasi Berkas
            </a>
        </li>
    @endrole

</ul>
