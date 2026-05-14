<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin.index');
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa.index');
    }

    public function verifikator()
    {
        return view('dashboard.verifikator.index');
    }
}
