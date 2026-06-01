<?php

namespace App\Repositories;

use App\Models\Mahasiswa;
use App\Models\Pendaftaran;

class MahasiswaRepository
{
    public function getAll(
        ?string $search = null
    ) {

        return Mahasiswa::query()

            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        'nik',
                        'like',
                        "%{$search}%"
                    );
                }
            )

            ->latest()
            ->paginate(10);
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
    public function getMahasiswaVerifikasi()
    {
        return Mahasiswa::with([
            'pendaftaran.berkas'
        ])
            ->whereHas('pendaftaran.berkas')
            ->latest()
            ->paginate(10);
    }
    public function getMahasiswaDenganBerkas()
    {
        return Mahasiswa::with([
            'pendaftaran.berkas'
        ])
            ->whereHas('pendaftaran.berkas')
            ->get();
    }
}
