<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case MAHASISWA = 'mahasiswa';
    case VERIFIKATOR = 'verifikator';
}
