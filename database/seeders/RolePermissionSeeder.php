<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionEnum::cases() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission->value
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => RoleEnum::ADMIN->value
        ]);

        $mahasiswa = Role::firstOrCreate([
            'name' => RoleEnum::MAHASISWA->value
        ]);

        $verifikator = Role::firstOrCreate([
            'name' => RoleEnum::VERIFIKATOR->value
        ]);

        // ADMIN
        $admin->givePermissionTo(Permission::all());

        // MAHASISWA
        $mahasiswa->givePermissionTo([
            PermissionEnum::VIEW_DASHBOARD->value,

            PermissionEnum::VIEW_PENDAFTARAN->value,
            PermissionEnum::CREATE_PENDAFTARAN->value,
            PermissionEnum::EDIT_PENDAFTARAN->value,

            PermissionEnum::VIEW_BERKAS->value,
            PermissionEnum::CREATE_BERKAS->value,
        ]);

        // VERIFIKATOR
        $verifikator->givePermissionTo([
            PermissionEnum::VIEW_DASHBOARD->value,

            PermissionEnum::VIEW_VERIFIKASI->value,
            PermissionEnum::APPROVE_VERIFIKASI->value,

            PermissionEnum::VIEW_PENDAFTARAN->value,
            PermissionEnum::VIEW_BERKAS->value,
        ]);
    }
}
