<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Berkas;
use App\Models\Pendaftaran;

use Illuminate\Support\Facades\Storage;

use App\Services\BerkasService;

use App\Http\Controllers\Controller;

use App\Http\Requests\BerkasStoreRequest;

class BerkasController extends Controller
{
    protected $service;

    public function __construct(BerkasService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $berkas = Berkas::whereHas(
            'pendaftaran',
            function ($q) use ($mahasiswa) {

                $q->where(
                    'mahasiswa_id',
                    $mahasiswa->id
                );
            }
        )
            ->latest()
            ->get();

        return view(
            'dashboard.mahasiswa.berkas.index',
            compact('berkas')
        );
    }

    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $pendaftaran = Pendaftaran::where(
            'mahasiswa_id',
            $mahasiswa->id
        )->get();

        return view(
            'dashboard.mahasiswa.berkas.create',
            compact('pendaftaran')
        );
    }

    public function store(BerkasStoreRequest $request)
    {
        $file = $request->file('file_berkas');

        $path = $file->store(
            'berkas',
            'public'
        );

        $data = [

            'pendaftaran_id' => $request->pendaftaran_id,

            'nama_berkas' => $request->nama_berkas,

            'file_berkas' => $path,

            'status_verifikasi' => 'pending',
        ];

        $this->service->store($data);

        return redirect()
            ->route('mahasiswa.berkas.index')
            ->with('success', 'Berkas berhasil diupload');
    }
    public function destroy(Berkas $berkas)
    {
        Storage::disk('public')
            ->delete($berkas->file_berkas);

        $berkas->delete();

        return redirect()
            ->route('mahasiswa.berkas.index')
            ->with('success', 'Berkas berhasil dihapus');
    }
}
