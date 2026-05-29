<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MahasiswaService
{
    protected $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(
        ?string $search = null
    ) {
        return $this->repository->getAll($search);
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
    public function storeProfile(array $data)
    {
        $data['user_id'] = Auth::id();

        return Mahasiswa::create($data);
    }
}
