<?php

namespace App\Repositories;

use App\Models\Pendaftaran;

class PendaftaranRepository
{
    public function getAll()
    {
        return Pendaftaran::with([
            'mahasiswa',
            'universitas',
            'jurusan'
        ])
            ->latest()
            ->get();
    }
    public function getByMahasiswa(int $mahasiswaId)
    {
        return Pendaftaran::with([
            'universitas',
            'jurusan'
        ])
            ->where(
                'mahasiswa_id',
                $mahasiswaId
            )
            ->latest()
            ->get();
    }

    public function find(int $id)
    {
        return Pendaftaran::with([
            'mahasiswa',
            'universitas',
            'jurusan'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Pendaftaran::create($data);
    }

    public function updateStatus(
        Pendaftaran $pendaftaran,
        array $data
    ) {
        $pendaftaran->update($data);

        return $pendaftaran->fresh();
    }
}
