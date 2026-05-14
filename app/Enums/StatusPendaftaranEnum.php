<?php

namespace App\Enums;

enum StatusPendaftaranEnum: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case DIVERIFIKASI = 'diverifikasi';
    case DITOLAK = 'ditolak';
    case DITERIMA = 'diterima';
}
