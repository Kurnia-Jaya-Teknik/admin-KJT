<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\KopSuratController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// top-level session api-token alias for JS (uses web auth)
Route::get('/session/api-token', [\App\Http\Controllers\SessionController::class, 'token'])->middleware('auth')->name('session.api-token.global');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Alias for SPA-friendly dashboard API (session-authenticated)
    Route::get('/api/employee/dashboard', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'index'])->name('api.employee.dashboard');

    // Approval routes (approve/reject pengajuan)
    Route::post('/pengajuan/{type}/{id}/approve', [\App\Http\Controllers\ApprovalController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan/{type}/{id}/reject', [\App\Http\Controllers\ApprovalController::class, 'reject'])->name('pengajuan.reject');

    // Direktur Routes
    Route::prefix('direktur')->name('direktur.')->group(function () {
        Route::get('/persetujuan-cuti-lembur', [DirekturController::class, 'persetujuanCutiLembur'])->name('persetujuan-cuti-lembur');
        Route::get('/persetujuan-surat', [DirekturController::class, 'persetujuanSurat'])->name('persetujuan-surat');
        Route::get('/ringkasan-karyawan', [DirekturController::class, 'ringkasanKaryawan'])->name('ringkasan-karyawan');
        Route::get('/laporan', [DirekturController::class, 'laporan'])->name('laporan');
        Route::get('/riwayat-persetujuan', [DirekturController::class, 'riwayatPersetujuan'])->name('riwayat-persetujuan');
        
        // Director approval API endpoints (web-authenticated)
        Route::post('/api/cuti/{cuti}/approve', [\App\Http\Controllers\Api\Director\ApprovalController::class, 'approveCuti'])->name('cuti.approve');
        Route::post('/api/cuti/{cuti}/reject', [\App\Http\Controllers\Api\Director\ApprovalController::class, 'rejectCuti'])->name('cuti.reject');
        Route::post('/api/lembur/{lembur}/approve', [\App\Http\Controllers\Api\Director\ApprovalController::class, 'approveLembur'])->name('lembur.approve');
        Route::post('/api/lembur/{lembur}/reject', [\App\Http\Controllers\Api\Director\ApprovalController::class, 'rejectLembur'])->name('lembur.reject');
    });

    // Karyawan Routes
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/absensi', function () {
            return view('karyawan.absensi');
        })->name('absensi');
        
        Route::get('/pengajuan-cuti', function () {
            return view('karyawan.pengajuan-cuti');
        })->name('pengajuan-cuti');
        
        Route::get('/pengajuan-lembur', function () {
            return view('karyawan.pengajuan-lembur');
        })->name('pengajuan-lembur');

        // provide a session API token for JS to call (web authenticated only)
        Route::get('/session/api-token', [\App\Http\Controllers\SessionController::class, 'token'])->middleware('auth')->name('session.api-token');

        // Employee API endpoints for pengajuan-cuti page (web-authenticated)
        Route::get('/api/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'show'])->name('profile.show');
        Route::put('/api/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/api/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'index'])->name('requests.index');
        Route::post('/api/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'store'])->name('requests.store');
        Route::put('/api/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'update'])->name('requests.update');
        Route::delete('/api/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'destroy'])->name('requests.destroy');

        // Absensi (basic) - endpoints for today's status + checkin/checkout
        Route::get('/api/absensi/today', [\App\Http\Controllers\Employee\AbsensiController::class, 'today'])->name('api.absensi.today');
        Route::post('/api/absensi/checkin', [\App\Http\Controllers\Employee\AbsensiController::class, 'checkIn'])->name('api.absensi.checkin');
        Route::post('/api/absensi/checkout', [\App\Http\Controllers\Employee\AbsensiController::class, 'checkOut'])->name('api.absensi.checkout');

// also expose a top-level alias so client scripts using /session/api-token won't 404
Route::get('/session/api-token', [\App\Http\Controllers\SessionController::class, 'token'])->middleware('auth')->name('session.api-token.alias');
        
        Route::get('/surat', function () {
            return view('karyawan.surat');
        })->name('surat');
        
        Route::get('/riwayat', function () {
            return view('karyawan.riwayat');
        })->name('riwayat');
        
        Route::get('/profil', function () {
            return view('karyawan.profil');
        })->name('profil');

        Route::get('/notifikasi', function () {
            return view('karyawan.notifikasi');
        })->name('notifikasi');
    });

    // Admin/HRD Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::get('/karyawan', function () {
            return view('admin.karyawan');
        })->name('karyawan');
        
        Route::get('/cuti', function () {
            return view('admin.cuti');
        })->name('cuti');
        
        Route::get('/lembur', function () {
            return view('admin.lembur');
        })->name('lembur');
        
        Route::get('/surat', function () {
            return view('admin.surat');
        })->name('surat');

        // Admin Surat actions (approve/reject/delete)
        Route::post('/surat/{id}/approve', [\App\Http\Controllers\Admin\SuratController::class, 'approve'])->name('surat.approve');
        Route::post('/surat/{id}/reject', [\App\Http\Controllers\Admin\SuratController::class, 'reject'])->name('surat.reject');
        Route::delete('/surat/{id}', [\App\Http\Controllers\Admin\SuratController::class, 'destroy'])->name('surat.destroy');

        // Create surat
        Route::post('/surat', [\App\Http\Controllers\Admin\SuratController::class, 'store'])->name('surat.store');
        // Preview / generate PDF from form data (returns generated PDF URL)
        Route::post('/surat/preview-pdf', [\App\Http\Controllers\Admin\SuratController::class, 'generatePdf'])->name('surat.preview-pdf');
        
        Route::get('/template', function () {
            return view('admin.template');
        })->name('template');

        // Template API (CRUD)
        Route::get('/template/list', [\App\Http\Controllers\Admin\SuratTemplateController::class, 'index']);
        Route::get('/template/{id}', [\App\Http\Controllers\Admin\SuratTemplateController::class, 'show']);
        Route::post('/template', [\App\Http\Controllers\Admin\SuratTemplateController::class, 'store']);
        Route::put('/template/{id}', [\App\Http\Controllers\Admin\SuratTemplateController::class, 'update']);
        Route::delete('/template/{id}', [\App\Http\Controllers\Admin\SuratTemplateController::class, 'destroy']);

        // Kop Surat (AJAX)
        Route::get('/kop-surat', [KopSuratController::class, 'index']);
        Route::post('/kop-surat', [KopSuratController::class, 'store']);
        Route::get('/kop-surat/{id}/placeholders', [KopSuratController::class, 'placeholders']);
        Route::post('/kop-surat/{id}/fill', [KopSuratController::class, 'fill']);
        
        Route::get('/riwayat-surat', function () {
            return view('admin.riwayat-surat');
        })->name('riwayat-surat');
        
        Route::get('/notifikasi', function () {
            return view('admin.notifikasi');
        })->name('notifikasi');
        
        Route::get('/profil', function () {
            return view('admin.profil');
        })->name('profil');
    });
});
