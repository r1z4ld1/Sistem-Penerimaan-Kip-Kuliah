<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Services\MahasiswaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MahasiswaStoreRequest;
use App\Http\Requests\MahasiswaUpdateRequest;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(
        MahasiswaService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {

        $mahasiswa = Mahasiswa::where(
            'user_id',
            Auth::id()
        )->first();

        return view(
            'dashboard.mahasiswa.profile.index',
            compact('mahasiswa')
        );
    }

    public function store(
        MahasiswaStoreRequest $request
    ) {

        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $this->service->store($data);

        return redirect()
            ->route('mahasiswa.dashboard')
            ->with(
                'success',
                'Biodata berhasil dilengkapi'
            );
    }

    public function update(
        MahasiswaUpdateRequest $request,
        Mahasiswa $mahasiswa
    ) {

        if ($mahasiswa->user_id != Auth::id()) {
            abort(403);
        }

        $this->service->update(
            $mahasiswa,
            $request->validated()
        );

        return redirect()
            ->route('mahasiswa.dashboard')
            ->with(
                'success',
                'Biodata berhasil diupdate'
            );
    }
}
