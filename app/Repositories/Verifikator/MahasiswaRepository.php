<?php

namespace App\Repositories\Verifikator;

use App\Models\Mahasiswa;

class MahasiswaRepository
{
    public function getAll(?string $search = null)
    {
        return Mahasiswa::query()

            ->when($search, function ($query) use ($search) {

                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(10);
    }

    public function findById(int $id)
    {
        return Mahasiswa::findOrFail($id);
    }
}
