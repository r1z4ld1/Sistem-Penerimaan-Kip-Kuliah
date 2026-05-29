<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Services\VerifikatorService;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin.index');
    }

    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::where(
            'user_id',
            auth()->id()
        )->first();

        $pendaftaran = Pendaftaran::with('berkas')
            ->where(
                'mahasiswa_id',
                $mahasiswa?->id
            )
            ->latest()
            ->first();
        $statusPendaftaran = 'Belum Mendaftar';

        if ($pendaftaran) {

            switch ($pendaftaran->status) {

                case 'pending':

                    $statusPendaftaran =
                        'Menunggu Verifikasi';

                    break;

                case 'diterima':

                    $statusPendaftaran =
                        'Diterima';

                    break;

                case 'ditolak':

                    $statusPendaftaran =
                        'Ditolak';

                    break;

                default:

                    $statusPendaftaran =
                        'Sudah Mendaftar';
            }
        }

        $totalBerkas = 0;

        $pending = 0;

        $diterima = 0;

        $ditolak = 0;

        if ($pendaftaran) {

            $totalBerkas = $pendaftaran
                ->berkas
                ->count();

            foreach ($pendaftaran->berkas as $berkas) {

                $status = $berkas
                    ->status_verifikasi?->value;

                if ($status === 'pending') {

                    $pending++;
                }

                if ($status === 'diterima') {

                    $diterima++;
                }

                if ($status === 'ditolak') {

                    $ditolak++;
                }
            }
        }

        $progress = 0;

        if ($totalBerkas > 0) {

            $progress = round(
                (
                    ($diterima + $ditolak)
                    /
                    $totalBerkas
                ) * 100
            );
        }

        return view(
            'dashboard.mahasiswa.index',
            compact(
                'mahasiswa',
                'pendaftaran',
                'statusPendaftaran',
                'totalBerkas',
                'pending',
                'diterima',
                'ditolak',
                'progress'
            )
        );
    }

    public function verifikator(
        VerifikatorService $service
    ) {
        $summary = $service
            ->getVerificationSummary();

        return view(
            'dashboard.verifikator.index',
            compact('summary')
        );
    }
}
