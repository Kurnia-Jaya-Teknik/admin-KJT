<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cuti;
use App\Models\Lembur;

class ApprovalController extends Controller
{
    protected function ensureDirector()
    {
        if (Auth::user()->role !== 'direktur') {
            abort(403);
        }
    }

    public function approve(Request $request, string $type, int $id)
    {
        $this->ensureDirector();

        if ($type === 'cuti') {
            $model = Cuti::findOrFail($id);
            $model->status = 'Disetujui';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            // decrease sisa_cuti if applicable
            if ($model->jenis === 'Cuti Tahunan' && $model->durasi_hari > 0) {
                $user = $model->user;
                if ($user) {
                    $user->sisa_cuti = max(0, ($user->sisa_cuti ?? 0) - $model->durasi_hari);
                    $user->save();
                }
            }
            $model->save();

            // notify requester
            if ($model->user) {
                \Illuminate\Support\Facades\Notification::send($model->user, new \App\Notifications\CutiStatusChanged($model));
            }

            // Create Surat otomatis untuk Admin agar dapat mengirimkan ke karyawan
            $surat = null;
            try {
                $surat = \App\Models\Surat::create([
                    'user_id' => $model->user_id,
                    'jenis' => 'Surat Keterangan',
                    'nomor_surat' => 'AUTO-'.uniqid(),
                    'perihal' => 'Persetujuan Cuti - ' . ($model->user->name ?? ''),
                    'isi_surat' => view('surat.templates.cuti', ['cuti' => $model])->render(),
                    'tanggal_surat' => now()->toDateString(),
                    'status' => 'Disetujui',
                    'dibuat_oleh' => auth()->id(),
                    'referensi_type' => get_class($model),
                    'referensi_id' => $model->id,
                ]);

                // Notify all admin_hrd users
                $admins = \App\Models\User::where('role', 'admin_hrd')->get();
                if ($admins->count()) {
                    \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SuratButuhPengiriman($surat));
                }
            } catch (\Throwable $e) {
                // Do not block approval if surat creation fails; log for later
                \Log::error('Gagal buat surat otomatis setelah approve cuti: ' . $e->getMessage());
            }

            if ($request->expectsJson() || $request->is('*/api/*')) {
                $resp = ['message' => 'Pengajuan cuti disetujui.', 'status' => $model->status];
                if ($surat) $resp['surat_created'] = true;
                return response()->json($resp, 200);
            }

            $redirect = redirect()->back()->with('status', 'Pengajuan cuti disetujui.');
            if ($surat) $redirect->with('surat_created', true);
            return $redirect;
        }

        if ($type === 'lembur') {
            $model = Lembur::findOrFail($id);
            $model->status = 'Disetujui';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            $model->save();

            if ($request->expectsJson() || $request->is('*/api/*')) {
                return response()->json(['message' => 'Pengajuan lembur disetujui.', 'status' => $model->status], 200);
            }

            return redirect()->back()->with('status', 'Pengajuan lembur disetujui.');
        }

        abort(404);
    }

    public function reject(Request $request, string $type, int $id)
    {
        $this->ensureDirector();

        if ($type === 'cuti') {
            $model = Cuti::findOrFail($id);
            $model->status = 'Ditolak';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            $model->keterangan_persetujuan = $request->input('keterangan');
            $model->save();

            // notify requester
            if ($model->user) {
                \Illuminate\Support\Facades\Notification::send($model->user, new \App\Notifications\CutiStatusChanged($model));
            }

            if ($request->expectsJson() || $request->is('*/api/*')) {
                return response()->json(['message' => 'Pengajuan cuti ditolak.', 'status' => $model->status], 200);
            }

            return redirect()->back()->with('status', 'Pengajuan cuti ditolak.');
        }

        if ($type === 'lembur') {
            $model = Lembur::findOrFail($id);
            $model->status = 'Ditolak';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            $model->keterangan_persetujuan = $request->input('keterangan');
            $model->save();

            if ($request->expectsJson() || $request->is('*/api/*')) {
                return response()->json(['message' => 'Pengajuan lembur ditolak.', 'status' => $model->status], 200);
            }

            return redirect()->back()->with('status', 'Pengajuan lembur ditolak.');
        }

        abort(404);
    }

    /**
     * Return rendered preview HTML for a pengajuan (used by direktur to preview surat before approving)
     */
    public function preview(Request $request, string $type, int $id)
    {
        $this->ensureDirector();

        if ($type === 'cuti') {
            $model = Cuti::with('user')->findOrFail($id);
            $html = view('surat.templates.cuti', ['cuti' => $model])->render();
            return response()->json(['ok' => true, 'html' => $html]);
        }

        if ($type === 'lembur') {
            $model = Lembur::with('user')->findOrFail($id);
            // Fallback simple HTML for lembur preview
            $html = '<div><p>Yth. '.htmlspecialchars($model->user->name ?? '').',</p>' .
                    '<p>Pengajuan lembur tanggal: '.htmlspecialchars($model->tanggal ?? '').'</p>' .
                    '<p>Durasi: '.htmlspecialchars(($model->durasi ?? 0)).' jam</p>' .
                    '<p>Keterangan: '.nl2br(htmlspecialchars($model->keterangan ?? $model->alasan ?? '-')).'</p></div>';
            return response()->json(['ok' => true, 'html' => $html]);
        }

        abort(404);
    }
}
