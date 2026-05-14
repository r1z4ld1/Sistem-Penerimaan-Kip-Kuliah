<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

//route untuk admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'admin'])
            ->name('dashboard');

        Route::resource('mahasiswa', MahasiswaController::class);
    });

//route untuk mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('dashboard/mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'mahasiswa'])
            ->name('dashboard');
    });

//route untuk verifikator
Route::middleware(['auth', 'role:verifikator'])
    ->prefix('dashboard/verifikator')
    ->name('verifikator.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'verifikator'])
            ->name('dashboard');
    });

require __DIR__ . '/auth.php';
