<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            return redirect()->back()->with('status', 'Pengajuan cuti disetujui.');
        }

        if ($type === 'lembur') {
            $model = Lembur::findOrFail($id);
            $model->status = 'Disetujui';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            $model->save();

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

            return redirect()->back()->with('status', 'Pengajuan cuti ditolak.');
        }

        if ($type === 'lembur') {
            $model = Lembur::findOrFail($id);
            $model->status = 'Ditolak';
            $model->disetujui_oleh = Auth::id();
            $model->tanggal_persetujuan = now();
            $model->keterangan_persetujuan = $request->input('keterangan');
            $model->save();

            return redirect()->back()->with('status', 'Pengajuan lembur ditolak.');
        }

        abort(404);
    }
}
