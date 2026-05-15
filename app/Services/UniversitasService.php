<?php

namespace App\Services;

use App\Models\Universitas;
use App\Repositories\UniversitasRepository;

class UniversitasService
{
    protected $repository;

    public function __construct(UniversitasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(Universitas $universitas, array $data)
    {
        return $this->repository->update($universitas, $data);
    }

    public function delete(Universitas $universitas)
    {
        return $this->repository->delete($universitas);
    }
}
