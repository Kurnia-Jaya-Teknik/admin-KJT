<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\KopSuratController;
use App\Http\Controllers\Admin\SuratKeteranganController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});



Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/surat-keterangan', [SuratKeteranganController::class, 'index'])
        ->name('surat-keterangan');
});

// top-level session api-token alias for JS (uses web auth)

// Serve storage files - use different prefix to avoid Apache conflict
Route::get('/files/bukti/{filename}', function ($filename) {
    $fullPath = storage_path('app/public/cuti-bukti/' . $filename);
    if (!file_exists($fullPath) || !is_file($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath);
})->name('files.bukti');

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
        Route::get('/persetujuan-lembur', [DirekturController::class, 'persetujuanLembur'])->name('persetujuan-lembur');
        Route::get('/persetujuan-surat', [DirekturController::class, 'persetujuanSurat'])->name('persetujuan-surat');
        Route::get('/ringkasan-karyawan', [DirekturController::class, 'ringkasanKaryawan'])->name('ringkasan-karyawan');
        Route::get('/ringkasan-karyawan/kelola', [DirekturController::class, 'kelolaKaryawan'])->name('ringkasan-karyawan.kelola');
        Route::post('/ringkasan-karyawan/{id}/update', [DirekturController::class, 'updateUser'])->name('ringkasan-karyawan.update');
        Route::post('/ringkasan-karyawan/{id}/reset-password', [DirekturController::class, 'resetPassword'])->name('ringkasan-karyawan.reset-password');
        Route::post('/ringkasan-karyawan/{id}/toggle-status', [DirekturController::class, 'toggleStatus'])->name('ringkasan-karyawan.toggle-status');
        Route::delete('/ringkasan-karyawan/{id}/delete', [DirekturController::class, 'deleteUser'])->name('ringkasan-karyawan.delete');
        Route::get('/laporan', [DirekturController::class, 'laporan'])->name('laporan');
        // Dedicated cuti report page
        Route::get('/laporan/cuti', [DirekturController::class, 'laporanCuti'])->name('laporan.cuti');
        Route::get('/laporan/cuti/pdf', [DirekturController::class, 'laporanCutiPdf'])->name('laporan.cuti.pdf');
        Route::get('/laporan/absensi', [DirekturController::class, 'laporanAbsensi'])->name('laporan.absensi');
        Route::get('/laporan/lembur', [DirekturController::class, 'laporanLembur'])->name('laporan.lembur');
        Route::get('/riwayat-persetujuan', [DirekturController::class, 'riwayatPersetujuan'])->name('riwayat-persetujuan');
        
        // Magang surat request dari direktur
        Route::post('/magang/{id}/request-surat', [DirekturController::class, 'requestMagangSurat'])->name('magang.request-surat');
        
        // Director approval endpoints (AJAX calls from view) - type harus di URL untuk match method signature
        Route::post('/api/{type}/{id}/approve', [\App\Http\Controllers\ApprovalController::class, 'approve'])->name('approve');
        Route::post('/api/{type}/{id}/reject', [\App\Http\Controllers\ApprovalController::class, 'reject'])->name('reject');
        // Preview pengajuan (render surat template preview for direktur before approving)
        Route::get('/api/{type}/{id}/preview', [\App\Http\Controllers\ApprovalController::class, 'preview'])->name('preview');
    });

    // Karyawan Routes
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/absensi', function () {
            return view('karyawan.absensi');
        })->name('absensi');
        
        Route::get('/pengajuan-cuti', function () {
            $employees = \App\Models\User::with('departemen')->where('role', 'karyawan')->where('id', '!=', auth()->id())->orderBy('name')->get();
            $departemens = \App\Models\Departemen::whereIn('kode', ['mekanik','elektrik','cleaning'])->orderBy('nama')->get();
            return view('karyawan.pengajuan-cuti', compact('employees', 'departemens'));
        })->name('pengajuan-cuti');

        // Dedicated Ijin Sakit page (separate from Pengajuan Cuti)
        Route::get('/ijin-sakit', function () {
            $employees = \App\Models\User::with('departemen')->where('role', 'karyawan')->where('id', '!=', auth()->id())->orderBy('name')->get();
            $departemens = \App\Models\Departemen::whereIn('kode', ['mekanik','elektrik','cleaning'])->orderBy('nama')->get();
            return view('karyawan.ijin-sakit', compact('employees', 'departemens'));
        })->name('ijin-sakit');
        
        Route::get('/pengajuan-lembur', function () {
            return view('karyawan.pengajuan-lembur');
        })->name('pengajuan-lembur');

        // Employee Lembur API (basic CRUD)
        Route::get('/api/lembur', [\App\Http\Controllers\Api\Employee\LemburController::class, 'index'])->name('lembur.index');
        Route::post('/api/lembur', [\App\Http\Controllers\Api\Employee\LemburController::class, 'store'])->name('lembur.store');
        Route::put('/api/lembur/{lembur}', [\App\Http\Controllers\Api\Employee\LemburController::class, 'update'])->name('lembur.update');
        Route::delete('/api/lembur/{lembur}', [\App\Http\Controllers\Api\Employee\LemburController::class, 'destroy'])->name('lembur.destroy');

        // provide a session API token for JS to call (web authenticated only)
        Route::get('/session/api-token', [\App\Http\Controllers\SessionController::class, 'token'])->middleware('auth')->name('session.api-token');

        // Employee API endpoints for pengajuan-cuti page (web-authenticated)
        Route::get('/api/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'show'])->name('profile.show');
        Route::put('/api/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/api/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'index'])->name('requests.index');
        Route::post('/api/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'store'])->name('requests.store');
        Route::put('/api/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'update'])->name('requests.update');
        Route::delete('/api/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'destroy'])->name('requests.destroy');

// also expose a top-level alias so client scripts using /session/api-token won't 404
Route::get('/session/api-token', [\App\Http\Controllers\SessionController::class, 'token'])->middleware('auth')->name('session.api-token.alias');
        
        Route::get('/surat', function () {
            return view('karyawan.surat');
        })->name('surat');

        // Surat Keterangan Request Routes
        Route::get('/surat-keterangan-request', [\App\Http\Controllers\Karyawan\SuratKeteranganRequestController::class, 'index'])->name('surat-keterangan.request.index');
        Route::post('/surat-keterangan-request', [\App\Http\Controllers\Karyawan\SuratKeteranganRequestController::class, 'store'])->name('surat-keterangan.request.store');
        Route::post('/surat-keterangan-request/{id}/cancel', [\App\Http\Controllers\Karyawan\SuratKeteranganRequestController::class, 'cancel'])->name('surat-keterangan.request.cancel');
        
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
        
        // Karyawan Management
        Route::get('/karyawan', [\App\Http\Controllers\Admin\KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/karyawan/list', [\App\Http\Controllers\Admin\KaryawanController::class, 'index'])->name('karyawan.list');
        Route::get('/karyawan/{id}', [\App\Http\Controllers\Admin\KaryawanController::class, 'show'])->name('karyawan.show');
        Route::post('/karyawan', [\App\Http\Controllers\Admin\KaryawanController::class, 'store'])->name('karyawan.store');
        Route::put('/karyawan/{id}', [\App\Http\Controllers\Admin\KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/karyawan/{id}', [\App\Http\Controllers\Admin\KaryawanController::class, 'destroy'])->name('karyawan.destroy');
        Route::post('/karyawan/{id}/reset-password', [\App\Http\Controllers\Admin\KaryawanController::class, 'resetPassword'])->name('karyawan.reset-password');
        Route::post('/karyawan/{id}/deactivate', [\App\Http\Controllers\Admin\KaryawanController::class, 'deactivate'])->name('karyawan.deactivate');
        Route::post('/karyawan/{id}/activate', [\App\Http\Controllers\Admin\KaryawanController::class, 'activate'])->name('karyawan.activate');
        Route::post('/karyawan/{id}/set-leave', [\App\Http\Controllers\Admin\KaryawanController::class, 'setLeave'])->name('karyawan.set-leave');
        Route::post('/karyawan/{id}/return-from-leave', [\App\Http\Controllers\Admin\KaryawanController::class, 'returnFromLeave'])->name('karyawan.return-from-leave');
        Route::get('/karyawan-stats', [\App\Http\Controllers\Admin\KaryawanController::class, 'getStats'])->name('karyawan.stats');
        
        Route::get('/cuti', [\App\Http\Controllers\Admin\CutiController::class, 'index'])->name('cuti');
        Route::get('/cuti/list', [\App\Http\Controllers\Admin\CutiController::class, 'list'])->name('cuti.list');
        Route::post('/cuti/{id}/buat-surat', [\App\Http\Controllers\Admin\SuratController::class, 'storeCutiSurat'])->name('cuti.buat-surat');
        
        Route::get('/magang', [\App\Http\Controllers\Admin\MagangController::class, 'index'])->name('magang');
        Route::get('/magang-stats', [\App\Http\Controllers\Admin\MagangController::class, 'getStats'])->name('magang.stats');
        Route::get('/magang/{id}/detail', [\App\Http\Controllers\Admin\MagangController::class, 'detail'])->name('magang.detail');
        Route::post('/magang/{id}/buat-surat', [\App\Http\Controllers\Admin\MagangController::class, 'storeMagangSurat'])->name('magang.buat-surat');
        Route::get('/magang/{id}/get-surat', [\App\Http\Controllers\Admin\MagangController::class, 'getExistingSurat'])->name('magang.get-surat');
        Route::get('/magang/{id}/preview-surat', [\App\Http\Controllers\Admin\MagangController::class, 'previewMagangSurat'])->name('magang.preview-surat');
        Route::post('/magang/{id}/mark-created', [\App\Http\Controllers\Admin\MagangController::class, 'markSuratCreated'])->name('magang.mark-created');
        Route::post('/magang/{id}/approve', [\App\Http\Controllers\Admin\MagangController::class, 'approveMagang'])->name('magang.approve');
        Route::post('/magang/{id}/reject', [\App\Http\Controllers\Admin\MagangController::class, 'rejectMagang'])->name('magang.reject');
        
        // Lembur routes disabled for now
        // Route::get('/lembur', function () {
        //     return view('admin.lembur');
        // })->name('lembur');
        // Route::post('/lembur/{id}/buat-surat', [\App\Http\Controllers\Admin\SuratController::class, 'storeLemburSurat'])->name('lembur.buat-surat');
        
        Route::get('/surat', function () {
            return view('admin.surat');
        })->name('surat');

        // Admin surat detail (AJAX helper + detail view)
        Route::get('/surat/{id}', [\App\Http\Controllers\Admin\SuratController::class, 'show']);

        // Admin Surat actions (approve/reject/delete)
        Route::post('/surat/{id}/approve', [\App\Http\Controllers\Admin\SuratController::class, 'approve'])->name('surat.approve');
        Route::post('/surat/{id}/reject', [\App\Http\Controllers\Admin\SuratController::class, 'reject'])->name('surat.reject');
        Route::delete('/surat/{id}', [\App\Http\Controllers\Admin\SuratController::class, 'destroy'])->name('surat.destroy');

        // Send surat (after director approved and admin review)
        Route::get('/surat/pending/list', [\App\Http\Controllers\Admin\SuratController::class, 'pendingList']);
        Route::post('/surat/{id}/kirim', [\App\Http\Controllers\Admin\SuratController::class, 'kirim'])->name('surat.kirim');

        // Create surat
        Route::post('/surat', [\App\Http\Controllers\Admin\SuratController::class, 'store'])->name('surat.store');
        // Preview / generate PDF from form data (returns generated PDF URL)
        Route::post('/surat/preview-pdf', [\App\Http\Controllers\Admin\SuratController::class, 'generatePdf'])->name('surat.preview-pdf');
        
        // Surat Keterangan Kerja
        Route::get('/surat-keterangan', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'index'])->name('surat-keterangan.index');
        Route::get('/surat-keterangan/list-dibuat', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'listDibuat'])->name('surat-keterangan.list-dibuat');
        Route::get('/surat-keterangan/requests/pending', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'pendingRequests'])->name('surat-keterangan.requests.pending');
        Route::get('/surat-keterangan/requests/{id}', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'getRequest'])->name('surat-keterangan.requests.get');
        Route::post('/surat-keterangan/requests/{id}/create-surat', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'createSuratFromRequest'])->name('surat-keterangan.requests.create-surat');
        Route::post('/surat-keterangan/requests/{id}/approve', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'approveRequest'])->name('surat-keterangan.request.approve');
        Route::post('/surat-keterangan/requests/{id}/reject', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'rejectRequest'])->name('surat-keterangan.request.reject');
        Route::get('/surat-keterangan/create', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'create'])->name('surat-keterangan.create');
        Route::post('/surat-keterangan', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'store'])->name('surat-keterangan.store');
        Route::get('/surat-keterangan/{id}', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'show'])->name('surat-keterangan.show');
        Route::delete('/surat-keterangan/{id}', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'destroy'])->name('surat-keterangan.destroy');
        Route::get('/surat-keterangan/{id}/preview', [\App\Http\Controllers\Admin\SuratKeteranganController::class, 'preview'])->name('surat-keterangan.preview');
        
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

// Temporary route to reset OPcache and clear caches (restricted to local requests)
Route::get('/_opcache_reset', function () {
    // allow only local/in-development access
    if (!app()->environment('local') && request()->ip() !== '127.0.0.1' && request()->ip() !== '::1') {
        abort(403);
    }

    if (function_exists('opcache_reset')) {
        opcache_reset();
    }

    // clear Laravel caches
    \Artisan::call('view:clear');
    \Artisan::call('optimize:clear');

    return response('OPcache reset and caches cleared', 200);
});
