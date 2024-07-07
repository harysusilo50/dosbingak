<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Jadwal_bimbingan\JadwalBimbinganController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pages\BimbinganAkademik\BimbinganAkademikController;
use App\Http\Controllers\Admin\BimbinganAkademik\BimbinganAkademikController as AdminBimbinganAkademikController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\Inventory\InventoryController;
use App\Http\Controllers\Pages\Inventory\WeeklyBreakageController;
use App\Http\Controllers\Pages\Loan\LoanController;
use App\Http\Controllers\Pages\Machine\DailyScoopController;
use App\Http\Controllers\Pages\Machine\HighTempMachineController;
use App\Http\Controllers\Pages\Machine\IceMachineController;
use App\Http\Controllers\Pages\Machine\ManualPotSinkController;
use App\Http\Controllers\Pages\Profile\ProfileController;
use App\Http\Controllers\Pages\TaskList\TaskListController;
use App\Http\Controllers\Pages\User\VerifyController;
use App\Http\Controllers\Pages\ValidasiKrs\ValidasiKrsController;
use App\Models\HighTempMachine;
use App\Models\ValidasiKrs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user-verify-account', [VerifyController::class, 'not_verified'])->name('user.not_verified');
    Route::post('/user-send-verify-account', [VerifyController::class, 'user_send_verify'])->name('user.send.verify');
    Route::group(['middleware' => 'check.verify'], function () {
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/bimbingan-akademik', [BimbinganAkademikController::class, 'index'])->name('bimbingan-akademik.index');
        Route::get('/bimbingan-akademik/create', [BimbinganAkademikController::class, 'create'])->name('bimbingan-akademik.create');
        Route::post('/bimbingan-akademik/store', [BimbinganAkademikController::class, 'store'])->name('bimbingan-akademik.store');
        
        Route::get('/persetujuan-krs', [ValidasiKrsController::class, 'index'])->name('validasi-krs.index');
        Route::get('/persetujuan-krs/create', [ValidasiKrsController::class, 'create'])->name('validasi-krs.create');
        Route::post('/persetujuan-krs/store', [ValidasiKrsController::class, 'store'])->name('validasi-krs.store');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::group(['middleware' => ['auth', 'check.admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');

    // User
    Route::get('/user-all', [UserController::class, 'all'])->name('user.all');
    Route::resource('/user', UserController::class);
    Route::get('/verification-list-user', [UserController::class, 'list_verify'])->name('user.list-verify');
    Route::post('/verify-user', [UserController::class, 'verify_user'])->name('user.verify_user');
    Route::post('/reject-user', [UserController::class, 'reject_user'])->name('user.reject_user');

    Route::get('/jadwal-bimbingan', [JadwalBimbinganController::class, 'index'])->name('jadwal-bimbingan.index');
    Route::get('/jadwal-bimbingan/create', [JadwalBimbinganController::class, 'create'])->name('jadwal-bimbingan.create');
    Route::post('/jadwal-bimbingan/store', [JadwalBimbinganController::class, 'store'])->name('jadwal-bimbingan.store');
    Route::delete('/jadwal-bimbingan/delete/{id}', [JadwalBimbinganController::class, 'destroy'])->name('jadwal-bimbingan.destroy');

    Route::get('/bimbingan-akademik', [AdminBimbinganAkademikController::class, 'index'])->name('admin.bimbingan-akademik.index');
    Route::post('/bimbingan-akademik/setujui', [AdminBimbinganAkademikController::class, 'setujui_konsultasi_bimbingan'])->name('admin.bimbingan-akademik.setujui');
    Route::post('/bimbingan-akademik/tolak', [AdminBimbinganAkademikController::class, 'tolak_konsultasi_bimbingan'])->name('admin.bimbingan-akademik.tolak');
});
