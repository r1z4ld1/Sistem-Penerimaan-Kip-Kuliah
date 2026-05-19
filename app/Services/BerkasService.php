<?php

namespace App\Services;

use App\Models\Berkas;

class BerkasService
{
    public function store(array $data)
    {
        return Berkas::create($data);
    }
}
