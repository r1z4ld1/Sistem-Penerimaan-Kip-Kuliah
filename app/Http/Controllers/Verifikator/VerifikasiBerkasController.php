<?php

namespace App\Http\Controllers\Verifikator;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Services\VerifikatorService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiBerkasController extends Controller
{
    protected VerifikatorService $service;

    public function __construct(VerifikatorService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $mahasiswa = $this->service
            ->getMahasiswaVerifikasi(
                $request->search,
                $request->status
            );

        foreach ($mahasiswa as $item) {

            $item->progress =
                $this->service
                ->getProgressMahasiswa($item);

            $item->status_berkas =
                $this->service
                ->getStatusBerkasMahasiswa($item);
        }

        $summary = $this->service
            ->getVerificationSummary();

        return view(
            'dashboard.verifikator.berkas.index',
            compact(
                'mahasiswa',
                'summary'
            )
        );
    }

    public function verifikasi(
        Request $request,
        Berkas $berkas
    ) {

        $request->validate([

            'status_verifikasi' => 'required',

            'catatan_verifikasi' => 'nullable'

        ]);

        $berkas->update([

            'status_verifikasi' =>
            $request->status_verifikasi,

            'catatan_verifikasi' =>
            $request->catatan_verifikasi

        ]);

        return redirect()
            ->back()
            ->with('success', 'Berkas berhasil diverifikasi');
    }
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load([
            'pendaftaran.berkas'
        ]);

        return view(
            'dashboard.verifikator.berkas.show',
            compact('mahasiswa')
        );
    }

    public function update(
        Request $request,
        Berkas $berkas
    ) {

        $request->validate([

            'status_verifikasi' => [
                'required',
                'in:pending,diterima,ditolak'
            ],

            'catatan_verifikasi' => [
                'nullable',
                'string'
            ]
        ]);

        /*
    |--------------------------------------------------------------------------
    | update lewat service
    |--------------------------------------------------------------------------
    */
        $this->service->updateVerifikasi(
            $berkas,
            [
                'status_verifikasi'
                => $request->status_verifikasi,

                'catatan_verifikasi'
                => $request->catatan_verifikasi,

                'verified_by'
                => Auth::id(),

                'verified_at'
                => now(),
            ]
        );

        return back()->with(
            'success',
            'Verifikasi berhasil disimpan'
        );
    }
}
