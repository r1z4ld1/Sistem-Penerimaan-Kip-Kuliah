<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Services\VerifikatorService;
use App\Models\Berkas;
use App\Models\Universitas;
use App\Models\User;
use App\Enums\StatusBerkasEnum;
use App\Models\Jurusan;

class DashboardController extends Controller
{

    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();

        $totalUser = User::count();

        $totalUniversitas = Universitas::count();

        $totalJurusan = Jurusan::count();


        return view(
            'dashboard.admin.index',
            compact(
                'totalMahasiswa',
                'totalUser',
                'totalUniversitas',
                'totalJurusan'

            )
        );
    }

    public function admin()
    {
        $totalMahasiswa = Mahasiswa::count();

        $totalUser = User::count();

        $totalUniversitas = Universitas::count();

        $totalJurusan = Jurusan::count();

        return view(
            'dashboard.admin.index',
            compact(
                'totalMahasiswa',
                'totalUser',
                'totalUniversitas',
                'totalJurusan'

            )
        );
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
        $progressLabel = 'Belum Mengisi Biodata';

        if ($mahasiswa) {

            $progressLabel =
                'Biodata Lengkap';
        }

        if ($pendaftaran) {

            $progressLabel =
                'Pendaftaran Diajukan';
        }

        if (
            $pendaftaran &&
            $pendaftaran->status === 'diterima'
        ) {

            $progressLabel =
                'Pendaftaran Disetujui';
        }

        if (
            $progress === 100
        ) {

            $progressLabel =
                'Seluruh Berkas Diverifikasi';
        }

        if ($mahasiswa) {

            $progress = 25;
        }

        if ($pendaftaran) {

            $progress = 50;
        }

        if (
            $pendaftaran &&
            $pendaftaran->status === 'diterima'
        ) {

            $progress = 75;
        }

        if (
            $pendaftaran &&
            $pendaftaran->status === 'diterima' &&
            $totalBerkas > 0 &&
            $pending === 0
        ) {

            $progress = 100;
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
                'progress',
                'progressLabel',
                //'bolehUploadBerkas'
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
