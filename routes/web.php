<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirekturController;

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
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        return match($user->role) {
            'admin_hrd' => view('dashboard'),
            'direktur' => view('dashboard'),
            'karyawan' => view('dashboard'),
            default => view('dashboard'),
        };
    })->name('dashboard');

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
    });
});
