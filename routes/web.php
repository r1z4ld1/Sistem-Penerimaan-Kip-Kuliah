<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\UniversitasController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Mahasiswa\PendaftaranController;
use App\Http\Controllers\Mahasiswa\BerkasController;
use App\Http\Controllers\Verifikator\VerifikasiBerkasController;

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

        //route resource untuk pendaftaran
        Route::resource('pendaftaran', PendaftaranController::class)
            ->parameters([
                'pendaftaran' => 'pendaftaran'
            ]);
        // route resource untuk berkas
        Route::resource('berkas', BerkasController::class)
            ->parameters([
                'berkas' => 'berkas'
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

        //route untuk verifikasi berkas
        Route::get(
            'berkas',
            [VerifikasiBerkasController::class, 'index']
        )->name('berkas.index');

        Route::put(
            'berkas/{berkas}/verifikasi',
            [VerifikasiBerkasController::class, 'verifikasi']
        )->name('berkas.verifikasi');
    });

require __DIR__ . '/auth.php';
