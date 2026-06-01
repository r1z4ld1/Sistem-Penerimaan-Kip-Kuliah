<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Repositories\PendaftaranRepository;

class PendaftaranService
{
    protected PendaftaranRepository $repository;

    public function __construct(
        PendaftaranRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        return $this->repository
            ->create($data);
    }

    public function getAll()
    {
        return $this->repository
            ->getAll();
    }

    public function find(int $id)
    {
        return $this->repository
            ->find($id);
    }

    public function updateStatus(
        Pendaftaran $pendaftaran,
        array $data
    ) {
        return $this->repository
            ->updateStatus(
                $pendaftaran,
                $data
            );
    }
    public function getByMahasiswa(
        int $mahasiswaId
    ) {
        return $this->repository
            ->getByMahasiswa(
                $mahasiswaId
            );
    }
}
