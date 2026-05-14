<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        if ($user->hasRole('admin')) {
            return view('dashboard.admin.index');
        }

        if ($user->hasRole('mahasiswa')) {
            return view('dashboard.mahasiswa.index');
        }

        if ($user->hasRole('verifikator')) {
            return view('dashboard.verifikator.index');
        }

        abort(403);
    }
}
