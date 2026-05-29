<?php

//use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\UniversitasController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Mahasiswa\PendaftaranController;
use App\Http\Controllers\Mahasiswa\BerkasController;
use App\Http\Controllers\Mahasiswa\ProfileController;
use App\Http\Controllers\Verifikator\VerifikasiBerkasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

//route untuk melihat notifikasi
Route::get(
    '/notifications',
    [NotificationController::class, 'index']
)->name('notifications.index');

Route::get(
    '/notifications/latest',
    [NotificationController::class, 'latest']
)->name('notifications.latest');

//route group untuk role admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'admin'])
            ->name('dashboard');

        // route management user
        Route::resource(
            'users',
            UserController::class
        );
        // route management role
        Route::resource(
            'roles',
            RoleController::class
        );

        // role management permission
        Route::resource(
            'permissions',
            PermissionController::class
        );
        Route::get(
            'roles/{role}/permissions',
            [RoleController::class, 'permissions']
        )->name('roles.permissions');

        Route::put(
            'roles/{role}/permissions',
            [RoleController::class, 'updatePermissions']
        )->name('roles.permissions.update');

        // route management mahasiswa
        Route::resource('mahasiswa', MahasiswaController::class);

        // route management universitas
        Route::resource('universitas', UniversitasController::class)
            ->parameters([
                'universitas' => 'universitas'
            ]);

        // route management jurusan
        Route::resource('jurusan', JurusanController::class)
            ->parameters([
                'jurusan' => 'jurusan'
            ]);
    });

//route group untuk role mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('dashboard/mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'mahasiswa'])
            ->name('dashboard');

        //route untuk melihat profil mahasiswa
        Route::get(
            '/profile',
            [ProfileController::class, 'index']
        )->name('profile.index');

        Route::post(
            '/profile',
            [ProfileController::class, 'store']
        )->name('profile.store');

        Route::put(
            '/profile/{mahasiswa}',
            [ProfileController::class, 'update']
        )->name('profile.update');

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

//route group untuk role verifikator
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

        //route untuk lihat detail mahasiswa
        Route::get(
            'mahasiswa',
            [\App\Http\Controllers\Verifikator\MahasiswaController::class, 'index']
        )->name('mahasiswa.index');

        //route untuk lihat detail pendafatran mahasiswa
        Route::get(
            '/berkas/{mahasiswa}',
            [VerifikasiBerkasController::class, 'show']
        )->name('berkas.show');
        Route::put(
            '/berkas/{berkas}',
            [VerifikasiBerkasController::class, 'update']
        )->name('berkas.update');
    });

require __DIR__ . '/auth.php';
