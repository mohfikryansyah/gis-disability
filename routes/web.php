<?php

use App\Constants\UserRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyandangController;
use App\Http\Controllers\PersebaranController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Exports\RelawanExportController;
use App\Http\Controllers\Exports\PimpinanExportController;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login_index'])->middleware('guest')->name('login.index');
    Route::post('/login/authenticate', [AuthController::class, 'login_authenticate'])->name('login.authenticate');
    Route::get('/register', [AuthController::class, 'register_index'])->name('register.index');
    Route::post('/register/submit', [AuthController::class, 'register_submit'])->name('register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::prefix('export')->name('export.')->middleware('auth')->group(function () {
    Route::post('/penyandang', [RelawanExportController::class, 'ExportPenyandang'])->name('relawan.penyandang');
    Route::post('/bantuan', [PimpinanExportController::class, 'ExportBantuan'])->name('pimpinan.bantuan');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('master')->name('master.')->middleware(['roles:' . UserRole::ADMIN])->group(function () {
        Route::resource('/relawan', RelawanController::class)->names('relawan');
        Route::resource('/penyandang', PenyandangController::class)->names('penyandang');
    });
    Route::get('/penyandang', [PenyandangController::class, 'index'])->name('penyandang.index');
    Route::get('/penyandang/{penyandang}', [PenyandangController::class, 'show'])->name('penyandang.show');
    Route::resource('/persebaran', PersebaranController::class)->names('persebaran');
    Route::resource('/bantuan', BantuanController::class)->names('bantuan');
    Route::resource('/activity', ActivityController::class)->names('activity');
    Route::patch('/bantuan/{bantuan}/approve', [BantuanController::class, 'approve'])->middleware(['roles:' . UserRole::ADMIN])->name('bantuan.approve');
    Route::patch('/bantuan/{bantuan}/decline', [BantuanController::class, 'decline'])->middleware(['roles:' . UserRole::ADMIN])->name('bantuan.decline');
    Route::patch('/bantuan/{bantuan}/received', [BantuanController::class, 'received'])->middleware(['roles:' . UserRole::RELAWAN])->name('bantuan.received');
    Route::prefix('security')->name('security.')->middleware([])->group(function () {
        Route::get('/', [SecurityController::class, 'index'])->name('index');
        Route::put('/update/password', [SecurityController::class, 'update_password'])->name('update.password');
    });
});
