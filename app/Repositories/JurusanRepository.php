<?php

namespace App\Repositories;

use App\Models\Jurusan;

class JurusanRepository
{
    public function store(array $data)
    {
        return Jurusan::create($data);
    }

    public function update(Jurusan $jurusan, array $data)
    {
        return $jurusan->update($data);
    }

    public function delete(Jurusan $jurusan)
    {
        return $jurusan->delete();
    }
}
