<?php

namespace App\Services;

use App\Models\Jurusan;

use App\Repositories\JurusanRepository;

class JurusanService
{
    protected $repository;

    public function __construct(JurusanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(Jurusan $jurusan, array $data)
    {
        return $this->repository->update($jurusan, $data);
    }

    public function delete(Jurusan $jurusan)
    {
        return $this->repository->delete($jurusan);
    }
}
