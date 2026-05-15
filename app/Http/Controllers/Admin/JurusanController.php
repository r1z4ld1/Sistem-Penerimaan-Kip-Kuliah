<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Models\Universitas;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\JurusanService;

use App\Http\Requests\JurusanStoreRequest;
use App\Http\Requests\JurusanUpdateRequest;

class JurusanController extends Controller
{
    protected $service;

    public function __construct(JurusanService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Jurusan::with('universitas');

        if ($request->search) {

            $query->where('nama_jurusan', 'like', '%' . $request->search . '%')
                ->orWhereHas('universitas', function ($q) use ($request) {

                    $q->where(
                        'nama_universitas',
                        'like',
                        '%' . $request->search . '%'
                    );
                });
        }

        $jurusan = $query
            ->latest()
            ->paginate(10);

        return view(
            'dashboard.admin.jurusan.index',
            compact('jurusan')
        );
    }

    public function create()
    {
        $universitas = Universitas::all();

        return view(
            'dashboard.admin.jurusan.create',
            compact('universitas')
        );
    }

    public function store(JurusanStoreRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan');
    }

    public function edit(Jurusan $jurusan)
    {
        $universitas = Universitas::all();

        return view(
            'dashboard.admin.jurusan.edit',
            compact('jurusan', 'universitas')
        );
    }

    public function update(
        JurusanUpdateRequest $request,
        Jurusan $jurusan
    ) {

        $this->service->update(
            $jurusan,
            $request->validated()
        );

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $this->service->delete($jurusan);

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus');
    }
}
