<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;
use Illuminate\Support\Facades\Storage;

class MahasiswaService
{
    protected $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function store(array $data)
    {
        if (isset($data['foto'])) {

            $data['foto'] = $data['foto']
                ->store('mahasiswa', 'public');
        }

        return $this->repository->store($data);
    }

    public function update(Mahasiswa $mahasiswa, array $data)
    {
        if (isset($data['foto'])) {

            if ($mahasiswa->foto) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            $data['foto'] = $data['foto']
                ->store('mahasiswa', 'public');
        }

        return $this->repository->update($mahasiswa, $data);
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        return $this->repository->delete($mahasiswa);
    }
}
