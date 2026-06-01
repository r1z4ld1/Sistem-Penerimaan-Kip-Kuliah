<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\Universitas;
use App\Services\PendaftaranService;
use App\Http\Controllers\Controller;

use App\Http\Requests\PendaftaranStoreRequest;

class PendaftaranController extends Controller
{
    protected $service;

    public function __construct(PendaftaranService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa) {

            return redirect()
                ->route('mahasiswa.dashboard')
                ->with(
                    'error',
                    'Silakan lengkapi biodata terlebih dahulu sebelum membuat pendaftaran KIP Kuliah.'
                );
        }

        $pendaftaran = $this->service
            ->getByMahasiswa(
                $mahasiswa->id
            );

        return view(
            'dashboard.mahasiswa.pendaftaran.index',
            compact('pendaftaran')
        );
    }

    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $pendaftaran = Pendaftaran::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
            ->latest()
            ->first();

        // batasi 1 pendaftaran
        $cek = $this->service
            ->existsByMahasiswa(
                $mahasiswa->id
            );

        if ($pendaftaran) {

            /*
        |--------------------------------------------------------------------------
        | masih pending
        |--------------------------------------------------------------------------
        */

            if ($pendaftaran->status === 'pending') {

                return redirect()
                    ->route('mahasiswa.pendaftaran.index')
                    ->with(
                        'error',
                        'Pendaftaran Anda masih menunggu verifikasi.'
                    );
            }

            /*
        |--------------------------------------------------------------------------
        | sudah diterima
        |--------------------------------------------------------------------------
        */

            if ($pendaftaran->status === 'diterima') {

                return redirect()
                    ->route('mahasiswa.berkas.index')
                    ->with(
                        'success',
                        'Pendaftaran telah diterima. Silakan upload berkas.'
                    );
            }
        }

        $universitas = Universitas::all();

        $jurusan = Jurusan::all();

        return view(
            'dashboard.mahasiswa.pendaftaran.create',
            compact(
                'universitas',
                'jurusan'
            )
        );
    }

    public function getJurusan($universitas_id)
    {
        $jurusan = Jurusan::where(
            'universitas_id',
            $universitas_id
        )->get();

        return response()->json($jurusan);
    }

    public function store(PendaftaranStoreRequest $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $data = [

            'mahasiswa_id' => $mahasiswa->id,

            'universitas_id' => $request->universitas_id,

            'jurusan_id' => $request->jurusan_id,

            'kode_pendaftaran' => 'KIP-' . time(),

            'tanggal_daftar' => now(),
        ];

        $this->service->store($data);

        return redirect()
            ->route('mahasiswa.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dibuat');
    }
}
