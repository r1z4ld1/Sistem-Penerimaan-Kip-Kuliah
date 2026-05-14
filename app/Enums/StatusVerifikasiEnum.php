<?php

namespace App\Enums;

enum StatusVerifikasiEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
