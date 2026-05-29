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
        $this->authorizeBerkas($berkas);
        $this->ensureEditable($berkas);
        Storage::disk('public')
            ->delete($berkas->file_berkas);

        $berkas->delete();

        return redirect()
            ->route('mahasiswa.berkas.index')
            ->with(
                'success',
                'Berkas berhasil dihapus'
            );
    }
    public function edit(Berkas $berkas)
    {
        $this->authorizeBerkas($berkas);
        $this->ensureEditable($berkas);

        return view(
            'dashboard.mahasiswa.berkas.edit',
            compact('berkas')
        );
    }

    public function update(
        BerkasStoreRequest $request,
        Berkas $berkas

    ) {
        $this->authorizeBerkas($berkas);
        $this->ensureEditable($berkas);
        if ($request->hasFile('file_berkas')) {

            Storage::disk('public')
                ->delete($berkas->file_berkas);

            $path = $request
                ->file('file_berkas')
                ->store('berkas', 'public');

            $berkas->update([

                'file_berkas' => $path,

                /*
            |--------------------------------------------------------------------------
            | reset verifikasi
            |--------------------------------------------------------------------------
            */

                'status_verifikasi' => 'pending',

                'catatan_verifikasi' => null,

                'verified_by' => null,

                'verified_at' => null,
            ]);
        }

        return redirect()
            ->route('mahasiswa.berkas.index')
            ->with(
                'success',
                'Berkas berhasil diupload ulang'
            );
    }

    private function authorizeBerkas(Berkas $berkas)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $isOwner = $berkas
            ->pendaftaran
            ->mahasiswa_id === $mahasiswa->id;

        abort_unless(
            $isOwner,
            403,
            'Akses ditolak'
        );
    }

    private function ensureEditable(
        Berkas $berkas
    ) {
        if (
            $berkas->status_verifikasi &&
            $berkas->status_verifikasi->value === 'diterima'
        ) {

            abort(
                403,
                'Berkas sudah diterima dan tidak dapat diubah'
            );
        }
    }
}
