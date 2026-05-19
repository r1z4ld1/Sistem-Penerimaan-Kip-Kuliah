<?php

namespace App\Services;

use App\Models\Pendaftaran;

class PendaftaranService
{
    public function store(array $data)
    {
        return Pendaftaran::create($data);
    }
}
