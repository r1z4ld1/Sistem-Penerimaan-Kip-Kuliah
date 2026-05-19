<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\UniversitasController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Mahasiswa\PendaftaranController;

Route::get('/', function () {
    return view('welcome');
});

//route untuk role admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'admin'])
            ->name('dashboard');

        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('universitas', UniversitasController::class)
            ->parameters([
                'universitas' => 'universitas'
            ]);
        Route::resource('jurusan', JurusanController::class)
            ->parameters([
                'jurusan' => 'jurusan'
            ]);
    });

//route untuk role mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('dashboard/mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'mahasiswa'])
            ->name('dashboard');

        Route::resource('pendaftaran', PendaftaranController::class)
            ->parameters([
                'pendaftaran' => 'pendaftaran'
            ]);

        // route untuk mengambil jurusan berdasarkan universitas
        Route::get(
            'get-jurusan/{universitas_id}',
            [PendaftaranController::class, 'getJurusan']
        )->name('mahasiswa.getJurusan');
    });

//route untuk role verifikator
Route::middleware(['auth', 'role:verifikator'])
    ->prefix('dashboard/verifikator')
    ->name('verifikator.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'verifikator'])
            ->name('dashboard');
    });

require __DIR__ . '/auth.php';
