<?php

namespace App\Helpers;

use App\Enums\RoleEnum;
use App\Enums\PermissionEnum;

class PermissionHelper
{
    public static function getPermissionsByRole(string $role): array
    {
        return match ($role) {

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            */
            RoleEnum::ADMIN->value => [

                // dashboard
                PermissionEnum::VIEW_DASHBOARD->value,

                // user
                PermissionEnum::VIEW_USER->value,
                PermissionEnum::CREATE_USER->value,
                PermissionEnum::EDIT_USER->value,
                PermissionEnum::DELETE_USER->value,

                // role
                PermissionEnum::MANAGE_ROLE->value,

                // permission
                PermissionEnum::MANAGE_PERMISSION->value,

                // mahasiswa
                PermissionEnum::VIEW_MAHASISWA->value,
                PermissionEnum::CREATE_MAHASISWA->value,
                PermissionEnum::EDIT_MAHASISWA->value,
                PermissionEnum::DELETE_MAHASISWA->value,

                // universitas
                PermissionEnum::VIEW_UNIVERSITAS->value,
                PermissionEnum::CREATE_UNIVERSITAS->value,
                PermissionEnum::EDIT_UNIVERSITAS->value,
                PermissionEnum::DELETE_UNIVERSITAS->value,

                // jurusan
                PermissionEnum::VIEW_JURUSAN->value,
                PermissionEnum::CREATE_JURUSAN->value,
                PermissionEnum::EDIT_JURUSAN->value,
                PermissionEnum::DELETE_JURUSAN->value,
            ],

            /*
            |--------------------------------------------------------------------------
            | MAHASISWA
            |--------------------------------------------------------------------------
            */
            RoleEnum::MAHASISWA->value => [

                PermissionEnum::VIEW_DASHBOARD->value,

                // pendaftaran
                PermissionEnum::VIEW_PENDAFTARAN->value,
                PermissionEnum::CREATE_PENDAFTARAN->value,
                PermissionEnum::EDIT_PENDAFTARAN->value,
                //PermissionEnum::DELETE_PENDAFTARAN->value,

                // berkas
                PermissionEnum::VIEW_BERKAS->value,
                PermissionEnum::CREATE_BERKAS->value,
                PermissionEnum::EDIT_BERKAS->value,
                PermissionEnum::DELETE_BERKAS->value,
            ],

            /*
            |--------------------------------------------------------------------------
            | VERIFIKATOR
            |--------------------------------------------------------------------------
            */
            RoleEnum::VERIFIKATOR->value => [

                PermissionEnum::VIEW_DASHBOARD->value,

                // mahasiswa
                PermissionEnum::VIEW_MAHASISWA->value,

                // berkas
                PermissionEnum::VIEW_BERKAS->value,

                // verifikasi
                PermissionEnum::VIEW_VERIFIKASI->value,
                PermissionEnum::APPROVE_VERIFIKASI->value,
            ],

            default => [],
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
    public static function label($permission): string
    {
        return match ($permission) {

            // USER
            'view user' => 'Lihat User',
            'create user' => 'Tambah User',
            'edit user' => 'Edit User',
            'delete user' => 'Hapus User',

            // ROLE
            'manage role' => 'Kelola Role',

            // PERMISSION
            'manage permission' => 'Kelola Permission',

            // MAHASISWA
            'view mahasiswa' => 'Lihat Mahasiswa',
            'create mahasiswa' => 'Tambah Mahasiswa',
            'edit mahasiswa' => 'Edit Mahasiswa',
            'delete mahasiswa' => 'Hapus Mahasiswa',

            // UNIVERSITAS
            'view universitas' => 'Lihat Universitas',
            'create universitas' => 'Tambah Universitas',
            'edit universitas' => 'Edit Universitas',
            'delete universitas' => 'Hapus Universitas',

            // JURUSAN
            'view jurusan' => 'Lihat Jurusan',
            'create jurusan' => 'Tambah Jurusan',
            'edit jurusan' => 'Edit Jurusan',
            'delete jurusan' => 'Hapus Jurusan',

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

            // DASHBOARD
            'view dashboard' => 'Lihat Dashboard',

            default => ucfirst($permission),
        };
    }
}
