<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Dashboard
    case VIEW_DASHBOARD = 'view dashboard';

        // Mahasiswa
    case VIEW_MAHASISWA = 'view mahasiswa';
    case CREATE_MAHASISWA = 'create mahasiswa';
    case EDIT_MAHASISWA = 'edit mahasiswa';
    case DELETE_MAHASISWA = 'delete mahasiswa';

        // Pendaftaran
    case VIEW_PENDAFTARAN = 'view pendaftaran';
    case CREATE_PENDAFTARAN = 'create pendaftaran';
    case EDIT_PENDAFTARAN = 'edit pendaftaran';
    case DELETE_PENDAFTARAN = 'delete pendaftaran';

        // Berkas
    case VIEW_BERKAS = 'view berkas';
    case CREATE_BERKAS = 'create berkas';
    case EDIT_BERKAS = 'edit berkas';
    case DELETE_BERKAS = 'delete berkas';

        // Verifikasi
    case VIEW_VERIFIKASI = 'view verifikasi';
    case APPROVE_VERIFIKASI = 'approve verifikasi';

        // Role Permission
    case MANAGE_ROLE = 'manage role';
    case MANAGE_PERMISSION = 'manage permission';

        // User
    case VIEW_USER = 'view user';
    case CREATE_USER = 'create user';
    case EDIT_USER = 'edit user';
    case DELETE_USER = 'delete user';
}
