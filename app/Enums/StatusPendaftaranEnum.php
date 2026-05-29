<?php

namespace App\Enums;

enum StatusPendaftaranEnum: string
{
    case PENDING = 'pending';

    case DITERIMA = 'diterima';

    case DITOLAK = 'ditolak';
}
