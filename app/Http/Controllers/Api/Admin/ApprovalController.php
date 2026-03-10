<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use App\Notifications\CutiApproved;
use App\Notifications\CutiRejected;
use App\Notifications\SuratGeneratedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApprovalController extends Controller
{
    // Untuk direktur: lihat pending xapprovals
    public function pendingApprovals(Request $request)
    {
        $user = $request->user();
        
        // Only direktur dan admin_hrd dapat melihat
        if (!in_array($user->role, ['direktur', 'admin_hrd'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $approvals = Cuti::where('status', 'Pending')
            ->where('tahap_persetujuan', 'Menunggu Direktur')
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return response()->json($approvals);
    }

    // Direktur approve pengajuan cuti
    public function approve(Request $request, Cuti $cuti)
    {
        $user = $request->user();
        
        if (!in_array($user->role, ['direktur', 'admin_hrd'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($cuti->status !== 'Pending' || $cuti->tahap_persetujuan !== 'Menunggu Direktur') {
            return response()->json(['message' => 'Pengajuan tidak dalam status untuk disetujui'], 422);
        }

        $cuti->update([
            'status' => 'Disetujui',
            'tahap_persetujuan' => 'Disetujui Direktur',
            'disetujui_oleh' => $user->id,
            'tanggal_persetujuan' => now(),
        ]);

        // Notify karyawan that their request was approved
        Notification::send($cuti->user, new CutiApproved($cuti));

        // Notify admin to create surat
        $admins = User::where('role', 'admin_hrd')->get();
        Notification::send($admins, new \App\Notifications\SuratNeedsToBeGenerated($cuti));

        return response()->json([
            'ok' => true,
            'message' => 'Pengajuan cuti disetujui',
            'cuti' => $cuti
        ]);
    }

    // Direktur reject pengajuan cuti
    public function reject(Request $request, Cuti $cuti)
    {
        $user = $request->user();
        
        if (!in_array($user->role, ['direktur', 'admin_hrd'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($cuti->status !== 'Pending') {
            return response()->json(['message' => 'Pengajuan tidak dalam status untuk ditolak'], 422);
        }

        $data = $request->validate([
            'keterangan_penolakan' => 'required|string|max:500'
        ]);

        $cuti->update([
            'status' => 'Ditolak',
            'tahap_persetujuan' => 'Ditolak',
            'disetujui_oleh' => $user->id,
            'tanggal_persetujuan' => now(),
            'keterangan_persetujuan' => $data['keterangan_penolakan'],
        ]);

        // Notify karyawan yang ditolak
        Notification::send($cuti->user, new CutiRejected($cuti));

        return response()->json([
            'ok' => true,
            'message' => 'Pengajuan cuti ditolak',
            'cuti' => $cuti
        ]);
    }

    // Admin buat surat cuti (admin sudah punya generate PDF sendiri)
    public function generateSurat(Request $request, Cuti $cuti)
    {
        $user = $request->user();
        
        if (!in_array($user->role, ['admin_hrd', 'admin'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($cuti->status !== 'Disetujui' || $cuti->tahap_persetujuan !== 'Disetujui Direktur') {
            return response()->json(['message' => 'Pengajuan belum disetujui oleh direktur'], 422);
        }

        $data = $request->validate([
            'nomor_surat' => 'required|string|unique:cuti,nomor_surat',
            'file_surat' => 'required|file|mimes:pdf|max:10240'
        ]);

        // Simpan file surat yang sudah dibuat admin
        if ($request->hasFile('file_surat')) {
            try {
                $path = $request->file('file_surat')->store('cuti-surat', 'public');
                $data['file_surat'] = $path;
            } catch (\Throwable $e) {
                Log::error('Gagal simpan surat PDF: ' . $e->getMessage());
                return response()->json(['message' => 'Gagal menyimpan file surat'], 500);
            }
        }

        $cuti->update([
            'tahap_persetujuan' => 'Surat Dibuat',
            'pembuat_surat_id' => $user->id,
            'tanggal_surat_dibuat' => now(),
            'nomor_surat' => $data['nomor_surat'],
            'file_surat' => $data['file_surat'],
        ]);

        // Update ke surat terkirim
        $cuti->update(['tahap_persetujuan' => 'Surat Terkirim']);

        // Notify karyawan surat sudah siap
        Notification::send($cuti->user, new SuratGeneratedNotification($cuti));

        // Notify direktur laporan surat sudah dibuat
        $direktur = User::where('role', 'direktur')->get();
        Notification::send($direktur, new \App\Notifications\SuratHasBeenGenerated($cuti));

        return response()->json([
            'ok' => true,
            'message' => 'Surat cuti berhasil dibuat dan terkirim ke karyawan',
            'cuti' => $cuti,
            'download_url' => $cuti->file_surat ? '/storage/' . $cuti->file_surat : null
        ]);
    }

    // Download surat untuk karyawan
    public function downloadSurat(Request $request, Cuti $cuti)
    {
        $user = $request->user();

        // Karyawan hanya bisa download surat mereka sendiri
        if ($cuti->user_id !== $user->id && !in_array($user->role, ['admin_hrd', 'direktur'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!$cuti->file_surat || !Storage::disk('public')->exists($cuti->file_surat)) {
            return response()->json(['message' => 'Surat tidak tersedia'], 404);
        }

        return response()->download(storage_path('app/public/' . $cuti->file_surat));
    }
}
