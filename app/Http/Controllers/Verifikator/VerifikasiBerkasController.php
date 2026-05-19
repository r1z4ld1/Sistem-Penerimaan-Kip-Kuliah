<?php

namespace App\Http\Controllers\Verifikator;

use App\Models\Berkas;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::with([
            'pendaftaran.mahasiswa.user'
        ])
            ->latest()
            ->get();

        return view(
            'dashboard.verifikator.berkas.index',
            compact('berkas')
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
}
