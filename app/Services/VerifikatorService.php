<?php

namespace App\Services;

use App\Models\Verifikator;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Enums\StatusPendaftaranEnum;
use App\Models\Berkas;
use App\Repositories\MahasiswaRepository;
use Illuminate\Support\Facades\Auth;

class VerifikatorService
{
    private $mahasiswaRepository;

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function getMahasiswaVerifikasi(
        $search = null,
        $status = null
    ) {
        $query = Mahasiswa::with([
            'pendaftaran.berkas'
        ])
            ->whereHas('pendaftaran.berkas');

        /*
    |--------------------------------------------------------------------------
    | Search Nama Mahasiswa
    |--------------------------------------------------------------------------
    */
        if ($search) {

            $query->where(
                'nama',
                'like',
                '%' . $search . '%'
            );
        }

        $mahasiswa = $query
            ->latest()
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */
        if ($status) {

            $mahasiswa = $mahasiswa->filter(
                function ($item) use ($status) {

                    return $this
                        ->getStatusMahasiswa($item)
                        === $status;
                }
            );
        }

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $mahasiswa->forPage(
                request()->get('page', 1),
                10
            ),
            $mahasiswa->count(),
            10,
            request()->get('page', 1),
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    private function updateStatusPendaftaran($berkas)
    {
        /*
    |--------------------------------------------------------------------------
    | ambil pendaftaran
    |--------------------------------------------------------------------------
    */
        $pendaftaran = $berkas->pendaftaran;

        if (!$pendaftaran) {
            return;
        }

        /*
    |--------------------------------------------------------------------------
    | ambil semua berkas
    |--------------------------------------------------------------------------
    */
        $allBerkas = $pendaftaran->berkas;

        /*
    |--------------------------------------------------------------------------
    | cek apakah ada ditolak
    |--------------------------------------------------------------------------
    */
        $hasRejected = $allBerkas->contains(function ($item) {

            return $item->status_verifikasi?->value == 'ditolak';
        });

        if ($hasRejected) {

            $pendaftaran->update([
                'status' => 'ditolak'
            ]);

            return;
        }

        /*
    |--------------------------------------------------------------------------
    | cek apakah semua diterima
    |--------------------------------------------------------------------------
    */
        $allAccepted =
            $allBerkas->count() > 0
            &&
            $allBerkas->every(function ($item) {

                return $item->status_verifikasi?->value == 'diterima';
            });

        if ($allAccepted) {

            $pendaftaran->update([
                'status' => 'diterima'
            ]);

            return;
        }

        /*
    |--------------------------------------------------------------------------
    | default pending
    |--------------------------------------------------------------------------
    */
        $pendaftaran->update([
            'status' => 'pending'
        ]);
    }
    public function updateVerifikasi($berkas, array $data)
    {
        $berkas->update([

            'status_verifikasi'
            => $data['status_verifikasi'],

            'catatan_verifikasi'
            => $data['catatan_verifikasi'],

            'verified_by'
            => $data['verified_by'],

            'verified_at'
            => $data['verified_at'],
        ]);

        /*
    |--------------------------------------------------------------------------
    | sinkron status pendaftaran
    |--------------------------------------------------------------------------
    */
        $this->updateStatusPendaftaran($berkas);
    }
    public function getVerificationSummary(): array
    {
        return $this->mahasiswaRepository
            ->getVerificationSummary();
    }

    public function getProgressMahasiswa($mahasiswa): int
    {
        $berkas = $mahasiswa
            ->pendaftaran
            ->flatMap(fn($item) => $item->berkas);

        $total = $berkas->count();

        if ($total === 0) {
            return 0;
        }

        $verified = $berkas
            ->where(
                'status_verifikasi',
                '!=',
                'pending'
            )
            ->count();

        return (int) round(
            ($verified / $total) * 100
        );
    }

    public function getStatusMahasiswa($mahasiswa): string
    {
        $pendaftaran = $mahasiswa
            ->pendaftaran
            ->last();

        if (!$pendaftaran) {
            return 'pending';
        }

        return $pendaftaran->status ?? 'pending';
    }
}
