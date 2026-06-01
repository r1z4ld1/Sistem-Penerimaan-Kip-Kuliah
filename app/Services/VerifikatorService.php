<?php

namespace App\Services;

use App\Models\Verifikator;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Enums\StatusPendaftaranEnum;
use App\Models\Berkas;
use App\Repositories\MahasiswaRepository;
use App\Services\NotificationService;
use App\Enums\NotificationTypeEnum;
use App\Enums\StatusBerkasEnum;


class VerifikatorService
{
    private $mahasiswaRepository;
    protected NotificationService $notificationService;

    public function __construct(MahasiswaRepository $mahasiswaRepository, NotificationService $notificationService)
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->notificationService = $notificationService;
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
                        ->getStatusBerkasMahasiswa($item)
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

    //baris kode fungsi sementara, dan ini belum dipanggil di controller manapun, karena masih dalam tahap pengembangan
    /*private function updateStatusPendaftaran($berkas)
    {
        /*
    |--------------------------------------------------------------------------
    | ambil pendaftaran
    |--------------------------------------------------------------------------
    */
    /*$pendaftaran = $berkas->pendaftaran;

        if (!$pendaftaran) {
            return;
        }

        /*
    |--------------------------------------------------------------------------
    | ambil semua berkas
    |--------------------------------------------------------------------------
    */
    /* $allBerkas = $pendaftaran->berkas;

        /*
    |--------------------------------------------------------------------------
    | cek apakah ada ditolak
    |--------------------------------------------------------------------------
    */
    /*$hasRejected = $allBerkas->contains(function ($item) {

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
    /*$allAccepted =
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
    /*$pendaftaran->update([
            'status' => 'pending'
        ]);
    }*/

    public function updateVerifikasi(
        $berkas,
        array $data
    ) {
        $berkas->update([

            'status_verifikasi'
            => $data['status_verifikasi'],

            'catatan_verifikasi'
            => $data['catatan_verifikasi'],

            'verified_by'
            => $data['verified_by'] ?? null,

            'verified_at'
            => $data['verified_at'] ?? null,
        ]);

        $this->sendNotification(
            $berkas->fresh()
        );
    }

    private function sendNotification($berkas)
    {
        $user = $berkas
            ->pendaftaran
            ->mahasiswa
            ->user;

        if (!$user) {
            return;
        }

        /*
    |--------------------------------------------------------------------------
    | DITERIMA
    |--------------------------------------------------------------------------
    */
        if (
            $berkas->status_verifikasi
            === StatusBerkasEnum::DITERIMA
        ) {

            $this->notificationService
                ->create(

                    $user,

                    'Berkas Diterima',

                    'Berkas '
                        . $berkas->nama_berkas .
                        ' telah diterima oleh verifikator.',

                    NotificationTypeEnum::SUCCESS
                );
        }

        /*
    |--------------------------------------------------------------------------
    | DITOLAK
    |--------------------------------------------------------------------------
    */
        if (
            $berkas->status_verifikasi
            === StatusBerkasEnum::DITOLAK
        ) {

            $this->notificationService
                ->create(

                    $user,

                    'Berkas Ditolak',

                    'Berkas '
                        . $berkas->nama_berkas .
                        ' ditolak. Alasan: '
                        . ($berkas->catatan_verifikasi ?? '-'),

                    NotificationTypeEnum::ERROR
                );
        }
    }

    public function getVerificationSummary(): array
    {
        $mahasiswa = $this->mahasiswaRepository
            ->getMahasiswaDenganBerkas();

        $pending = 0;
        $diterima = 0;
        $ditolak = 0;

        foreach ($mahasiswa as $item) {

            $status = $this
                ->getStatusBerkasMahasiswa($item);

            match ($status) {
                'pending' => $pending++,
                'diterima' => $diterima++,
                'ditolak' => $ditolak++,
            };
        }

        return [
            'total' => $mahasiswa->count(),
            'pending' => $pending,
            'diterima' => $diterima,
            'ditolak' => $ditolak,
        ];
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

    public function getStatusBerkasMahasiswa($mahasiswa): string
    {
        $berkas = $mahasiswa
            ->pendaftaran
            ->flatMap(fn($item) => $item->berkas);

        if ($berkas->isEmpty()) {
            return 'pending';
        }

        // jika ada yang ditolak
        if ($berkas->contains(
            fn($item) =>
            $item->status_verifikasi?->value === 'ditolak'
        )) {
            return 'ditolak';
        }

        // jika masih ada pending
        if ($berkas->contains(
            fn($item) =>
            $item->status_verifikasi?->value === 'pending'
        )) {
            return 'pending';
        }

        // semua diterima
        return 'diterima';
    }
}
