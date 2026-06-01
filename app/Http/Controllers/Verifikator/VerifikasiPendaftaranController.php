<?php

namespace App\Http\Controllers\Verifikator;

use App\Models\Pendaftaran;
use App\Services\PendaftaranService;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifikasiPendaftaranRequest;

class VerifikasiPendaftaranController extends Controller
{
    protected PendaftaranService $service;

    public function __construct(
        PendaftaranService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $pendaftaran = $this->service
            ->getAll();

        return view(
            'dashboard.verifikator.pendaftaran.index',
            compact('pendaftaran')
        );
    }

    public function show(
        Pendaftaran $pendaftaran
    ) {
        return view(
            'dashboard.verifikator.pendaftaran.show',
            compact('pendaftaran')
        );
    }

    public function update(
        VerifikasiPendaftaranRequest $request,
        Pendaftaran $pendaftaran
    ) {
        if ($pendaftaran->status === 'diterima') {

            return back()->with(
                'error',
                'Pendaftaran yang sudah diterima tidak dapat diubah.'
            );
        }

        $this->service->updateStatus(
            $pendaftaran,
            [
                'status' => $request->status,
                'catatan_pendaftaran' => $request->catatan_pendaftaran
            ]
        );

        return redirect()
            ->route('verifikator.pendaftaran.index')
            ->with(
                'success',
                'Status pendaftaran berhasil diperbarui'
            );
    }
}
