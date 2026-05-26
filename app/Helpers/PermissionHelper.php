<?php

namespace App\Helpers;

class PermissionHelper
{
    public static function label($permission)
    {
        return match ($permission) {

            // USER
            'view user' => 'Lihat User',
            'create user' => 'Tambah User',
            'edit user' => 'Edit User',
            'delete user' => 'Hapus User',

            // ROLE
            'manage role' => 'Management Role',

            // PERMISSION
            'manage permission' => 'Management Permission',

            //JURUSAN
            'view jurusan' => 'Lihar Jurusan',
            'create jurusan' => 'Tambah Jurusan',
            'edit jurusan' => 'Edit Jurusan',
            'delete jurusan' => 'Hapus Jurusan',

            //UNIVERSITAS
            'view universitas' => 'Lihat Universitas',
            'create universitas' => 'Tambah Universitas',
            'edit universitas' => 'Edit Universitas',
            'delete universitas' => 'Hapus Universitas',

            // MAHASISWA
            'view mahasiswa' => 'Lihat Mahasiswa',
            'create mahasiswa' => 'Tambah Mahasiswa',
            'edit mahasiswa' => 'Edit Mahasiswa',
            'delete mahasiswa' => 'Hapus Mahasiswa',

            // PENDAFTARAN
            'view pendaftaran' => 'Lihat Pendaftaran',
            'create pendaftaran' => 'Buat Pendaftaran',
            'edit pendaftaran' => 'Edit Pendaftaran',
            'delete pendaftaran' => 'Hapus Pendaftaran',

            // BERKAS
            'view berkas' => 'Lihat Berkas',
            'create berkas' => 'Upload Berkas',
            'edit berkas' => 'Edit Berkas',
            'delete berkas' => 'Hapus Berkas',

            // VERIFIKASI
            'view verifikasi' => 'Lihat Verifikasi',
            'approve verifikasi' => 'Approve Verifikasi',

            default => ucfirst($permission)
        };
    }

    public static function group($permission)
    {
        return match (true) {

            str_contains($permission, 'user')
            => 'User Management',

            str_contains($permission, 'role')
            => 'Role Management',

            str_contains($permission, 'permission')
            => 'Permission Management',

            str_contains($permission, 'jurusan')
            => 'Jurusan Management',

            str_contains($permission, 'universitas')
            => 'Universitas Management',

            str_contains($permission, 'mahasiswa')
            => 'Mahasiswa Management',

            str_contains($permission, 'pendaftaran')
            => 'Pendaftaran Management',

            str_contains($permission, 'berkas')
            => 'Berkas Management',

            str_contains($permission, 'verifikasi')
            => 'Verifikasi Management',

            default => 'Lainnya'
        };
    }
}
