<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Universitas;
use App\Http\Requests\UniversitasStoreRequest;
use App\Http\Requests\UniversitasUpdateRequest;
use App\Services\UniversitasService;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;

    public function __construct(UniversitasService $service)
    {
        $this->service = $service;
        $this->middleware('permission:view universitas')
            ->only('index');

        $this->middleware('permission:create universitas')
            ->only(['create', 'store']);

        $this->middleware('permission:edit universitas')
            ->only(['edit', 'update']);

        $this->middleware('permission:delete universitas')
            ->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Universitas::query();

        if ($request->search) {

            $query->where(
                'nama_universitas',
                'like',
                '%' . $request->search . '%'
            );
        }

        $universitas = $query
            ->latest()
            ->paginate(10);

        return view(
            'dashboard.admin.universitas.index',
            compact('universitas')
        );
    }

    public function create()
    {
        return view('dashboard.admin.universitas.create');
    }

    public function store(UniversitasStoreRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.universitas.index')
            ->with('success', 'Data universitas berhasil ditambahkan');
    }

    public function edit(Universitas $universitas)
    {
        return view(
            'dashboard.admin.universitas.edit',
            compact('universitas')
        );
    }

    public function update(
        UniversitasUpdateRequest $request,
        Universitas $universitas
    ) {

        $this->service->update(
            $universitas,
            $request->validated()
        );

        return redirect()
            ->route('admin.universitas.index')
            ->with('success', 'Data universitas berhasil diupdate');
    }

    public function destroy(Universitas $universitas)
    {
        $this->service->delete($universitas);

        return redirect()
            ->route('admin.universitas.index')
            ->with('success', 'Data universitas berhasil dihapus');
    }
}
