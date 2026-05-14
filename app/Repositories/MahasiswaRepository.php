<?php

namespace App\Repositories;

use App\Models\Mahasiswa;

class MahasiswaRepository
{
    public function getAll()
    {
        return Mahasiswa::latest()->paginate(10);
    }

    public function store(array $data)
    {
        return Mahasiswa::create($data);
    }

    public function update(Mahasiswa $mahasiswa, array $data)
    {
        return $mahasiswa->update($data);
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        return $mahasiswa->delete();
    }
}
