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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Approval routes (approve/reject pengajuan)
    Route::post('/pengajuan/{type}/{id}/approve', [\App\Http\Controllers\ApprovalController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan/{type}/{id}/reject', [\App\Http\Controllers\ApprovalController::class, 'reject'])->name('pengajuan.reject');

    // Direktur Routes
    Route::prefix('direktur')->name('direktur.')->middleware('auth')->group(function () {
        Route::get('/persetujuan-cuti-lembur', [DirekturController::class, 'persetujuanCutiLembur'])->name('persetujuan-cuti-lembur');
        Route::get('/persetujuan-surat', [DirekturController::class, 'persetujuanSurat'])->name('persetujuan-surat');
        Route::get('/ringkasan-karyawan', [DirekturController::class, 'ringkasanKaryawan'])->name('ringkasan-karyawan');
        Route::get('/laporan', [DirekturController::class, 'laporan'])->name('laporan');
        Route::get('/riwayat-persetujuan', [DirekturController::class, 'riwayatPersetujuan'])->name('riwayat-persetujuan');
    });

    // Karyawan Routes
    Route::prefix('karyawan')->name('karyawan.')->middleware('auth')->group(function () {
        Route::get('/absensi', function () {
            return view('karyawan.absensi');
        })->name('absensi');
        
        Route::get('/pengajuan-cuti', function () {
            return view('karyawan.pengajuan-cuti');
        })->name('pengajuan-cuti');
        
        Route::get('/pengajuan-lembur', function () {
            return view('karyawan.pengajuan-lembur');
        })->name('pengajuan-lembur');
        
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
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
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
        
        Route::get('/template', function () {
            return view('admin.template');
        })->name('template');

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
