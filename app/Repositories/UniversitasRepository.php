<?php

namespace App\Repositories;

use App\Models\Universitas;

class UniversitasRepository
{
    public function getAll()
    {
        return Universitas::latest()->paginate(10);
    }

    public function store(array $data)
    {
        return Universitas::create($data);
    }

    public function update(Universitas $universitas, array $data)
    {
        return $universitas->update($data);
    }

    public function delete(Universitas $universitas)
    {
        return $universitas->delete();
    }
}
