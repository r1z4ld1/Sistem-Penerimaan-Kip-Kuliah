<?php

namespace App\Http\Controllers\Verifikator;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Verifikator\MahasiswaService;

class MahasiswaController extends Controller
{
    protected $service;

    public function __construct(
        MahasiswaService $service
    ) {

        $this->service = $service;

        $this->middleware('permission:view mahasiswa')
            ->only('index');
    }

    public function index(Request $request)
    {
        $mahasiswa = $this->service
            ->getAll($request->search);

        return view(
            'dashboard.verifikator.mahasiswa.index',
            compact('mahasiswa')
        );
    }
}
