<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Http\Requests\MahasiswaStoreRequest;
use App\Http\Requests\MahasiswaUpdateRequest;
use App\Services\MahasiswaService;

class MahasiswaController extends Controller
{
    protected $service;

    public function __construct(MahasiswaService $service)
    {
        $this->service = $service;
        $this->middleware('permission:view mahasiswa')
            ->only('index');

        $this->middleware('permission:create mahasiswa')
            ->only(['create', 'store']);

        $this->middleware('permission:edit mahasiswa')
            ->only(['edit', 'update']);

        $this->middleware('permission:delete mahasiswa')
            ->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->search) {

            $query->where('nik', 'like', '%' . $request->search . '%')
                ->orWhere('nisn', 'like', '%' . $request->search . '%')
                ->orWhere('sekolah', 'like', '%' . $request->search . '%');
        }

        $mahasiswa = $query
            ->latest()
            ->paginate(10);

        return view('dashboard.admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $users = User::role('mahasiswa')->get();

        return view('dashboard.admin.mahasiswa.create', compact('users'));
    }

    public function store(MahasiswaStoreRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $users = User::role('mahasiswa')->get();

        return view('dashboard.admin.mahasiswa.edit', compact(
            'mahasiswa',
            'users'
        ));
    }

    public function update(
        MahasiswaUpdateRequest $request,
        Mahasiswa $mahasiswa
    ) {

        $this->service->update(
            $mahasiswa,
            $request->validated()
        );

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $this->service->delete($mahasiswa);

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
