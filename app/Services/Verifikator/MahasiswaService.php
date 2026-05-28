<?php

namespace App\Services\Verifikator;

use App\Repositories\Verifikator\MahasiswaRepository;

class MahasiswaService
{
    protected $repository;

    public function __construct(
        MahasiswaRepository $repository
    ) {

        $this->repository = $repository;
    }

    public function getAll(?string $search = null)
    {
        return $this->repository
            ->getAll($search);
    }

    public function findById(int $id)
    {
        return $this->repository
            ->findById($id);
    }
}
