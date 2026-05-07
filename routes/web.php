<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\SurveyEventController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\KaryawanController;

// ================= LOGIN =================

Route::get('/', function () {
    return view('auth.login');
});

// ================= AUTH =================

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// =====================================================
// KARYAWAN
// =====================================================

Route::middleware(['auth', 'role:karyawan'])->group(function () {

    // dashboard
    Route::get('/karyawan', [KaryawanController::class, 'dashboard']);

    // absensi
    Route::get('/karyawan/absensi', [AbsensiController::class, 'halamanAbsensi']);

    // absen kantor
    Route::post('/absen/kantor', [AbsensiController::class, 'absenKantor'])
        ->middleware('office.ip')
        ->name('absen.kantor');

    // absen luar
    Route::post('/absen/luar', [AbsensiController::class, 'absenLuar'])
        ->name('absen.luar');

    // lembur
    Route::get('/karyawan/lembur', [LemburController::class, 'halamanLembur']);

    Route::post('/lembur', [LemburController::class, 'store']);

    // riwayat
    Route::get('/karyawan/riwayat', [KaryawanController::class, 'riwayat']);
});


// =====================================================
// ADMIN
// =====================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // dashboard
    Route::get('/admin', [AdminController::class, 'dashboard']);

    // ================= ABSENSI =================

    Route::get('/admin/absensi', [AdminController::class, 'absensiPending']);

    Route::post('/admin/absensi/{id}/approve', [AdminController::class, 'approve']);

    Route::post('/admin/absensi/{id}/reject', [AdminController::class, 'reject']);

    // monitoring
    Route::get('/admin/monitoring', [AdminController::class, 'monitoring']);

    Route::get('/admin/absensi/{id}/edit', [AdminController::class, 'editAbsensi']);

    Route::post('/admin/absensi/{id}/update', [AdminController::class, 'updateAbsensi']);

    // ================= LEMBUR =================

    Route::get('/admin/lembur', [AdminController::class, 'lemburPending']);

    Route::post('/admin/lembur/{id}/approve', [AdminController::class, 'approveLembur']);

    Route::post('/admin/lembur/{id}/reject', [AdminController::class, 'rejectLembur']);

    // ================= PAYROLL =================

    Route::get('/admin/payroll', [PayrollController::class, 'index']);

    Route::get('/admin/payroll/show', [PayrollController::class, 'rekap']);

    Route::get('/admin/payroll/detail/{id}', [PayrollController::class, 'detail']);

    // ================= USERS =================

    Route::get('/admin/users', [UserController::class, 'index']);

    Route::get('/admin/users/create', [UserController::class, 'create']);

    Route::post('/admin/users', [UserController::class, 'store']);

    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit']);

    Route::put('/admin/users/{id}', [UserController::class, 'update']);

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);

    // ================= JABATAN =================

    Route::get('/admin/jabatan', [JabatanController::class, 'index']);

    Route::get('/admin/jabatan/create', [JabatanController::class, 'create']);

    Route::post('/admin/jabatan', [JabatanController::class, 'store']);

    Route::get('/admin/jabatan/{id}/edit', [JabatanController::class, 'edit']);

    Route::put('/admin/jabatan/{id}', [JabatanController::class, 'update']);

    Route::delete('/admin/jabatan/{id}', [JabatanController::class, 'destroy']);

    // ================= SURVEY EVENT =================

    Route::get('/admin/survey-event', [SurveyEventController::class, 'index']);

    Route::get('/admin/survey-event/create', [SurveyEventController::class, 'create']);

    Route::post('/admin/survey-event', [SurveyEventController::class, 'store']);

    Route::get('/admin/survey-event/{id}/edit', [SurveyEventController::class, 'edit']);

    Route::put('/admin/survey-event/{id}', [SurveyEventController::class, 'update']);

    Route::delete('/admin/survey-event/{id}', [SurveyEventController::class, 'destroy']);

    // ================= SETTINGS =================

    Route::get('/admin/setting', [SettingController::class, 'index']);

    Route::post('/admin/setting', [SettingController::class, 'update']);
});

require __DIR__.'/auth.php';