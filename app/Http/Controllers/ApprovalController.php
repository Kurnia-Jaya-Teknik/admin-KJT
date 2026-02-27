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
        try {
            \Log::info("Approve request received", [
                'type' => $type,
                'id' => $id,
                'user' => Auth::id(),
                'role' => Auth::user()->role ?? 'unknown'
            ]);

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
                // Generate nomor surat otomatis
                $tahun = now()->year;
                $bulan = now()->month;
                $lastSurat = \App\Models\Surat::whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan)
                    ->orderBy('id', 'desc')
                    ->first();
                $urutan = $lastSurat ? ((int) substr($lastSurat->nomor_surat, 0, 3)) + 1 : 1;
                $nomorSurat = sprintf('%03d/SKT-CUTI/%s/%d', $urutan, strtoupper(now()->format('M')), $tahun);
                
                $surat = \App\Models\Surat::create([
                    'user_id' => $model->user_id,
                    'jenis' => 'Surat Keterangan Cuti',
                    'nomor_surat' => $nomorSurat,
                    'perihal' => 'Persetujuan ' . $model->jenis . ' - ' . ($model->user->name ?? ''),
                    'isi_surat' => view('surat.templates.cuti', ['cuti' => $model])->render(),
                    'tanggal_surat' => now()->toDateString(),
                    'status' => 'Disetujui',
                    'dibuat_oleh' => auth()->id(),
                    'disetujui_oleh' => auth()->id(),
                    'tanggal_persetujuan' => now(),
                    'referensi_type' => get_class($model),
                    'referensi_id' => $model->id,
                ]);

                // Surat otomatis dibuat — beri tahu Admin HRD supaya dapat mengirim ke karyawan
                try {
                    $admins = \App\Models\User::where('role', 'admin_hrd')->get();
                    if ($admins->count()) {
                        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SuratButuhPengiriman($surat));
                    }
                } catch (\Throwable $e) {
                    // Log notification failure but don't block approval
                    \Log::error('Gagal notifikasi Admin setelah pembuatan surat otomatis: ' . $e->getMessage());
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

        \Log::warning("Invalid type for approve", ['type' => $type]);
        abort(404);
    } catch (\Exception $e) {
        \Log::error("Error in approve method", [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        if ($request->expectsJson() || $request->is('*/api/*')) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
        
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function reject(Request $request, string $type, int $id)
    {
        try {
            \Log::info("Reject request received", [
                'type' => $type,
                'id' => $id,
                'user' => Auth::id(),
                'role' => Auth::user()->role ?? 'unknown'
            ]);

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

            \Log::warning("Invalid type for reject", ['type' => $type]);
            abort(404);
        } catch (\Exception $e) {
            \Log::error("Error in reject method", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->expectsJson() || $request->is('*/api/*')) {
                return response()->json([
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Return rendered preview HTML for a pengajuan (used by direktur to preview surat before approving)
     */
    public function preview(Request $request, string $type, int $id)
    {
        $this->ensureDirector();

        if ($type === 'cuti') {
            $model = Cuti::with('user')->findOrFail($id);
            
            // Load delegated users
            if (!empty($model->dilimpahkan_ke) && is_array($model->dilimpahkan_ke)) {
                $model->delegated_users = \App\Models\User::whereIn('id', $model->dilimpahkan_ke)
                    ->select('id', 'name', 'email')
                    ->get();
            } else {
                $model->delegated_users = collect();
            }
            
            $html = view('surat.templates.cuti', ['cuti' => $model])->render();
            
            // Append pelimpahan tugas info if exists
            if ($model->delegated_users->count() > 0) {
                $pelimpahanHtml = '<div class="mt-6 p-4 border border-blue-300 rounded-lg bg-blue-50">';
                $pelimpahanHtml .= '<h4 class="text-base font-semibold mb-3 text-blue-800">👥 Pelimpahan Tugas</h4>';
                $pelimpahanHtml .= '<p class="text-sm text-gray-700 mb-2">Tugas dilimpahkan kepada:</p>';
                $pelimpahanHtml .= '<ul class="list-disc list-inside space-y-1">';
                foreach ($model->delegated_users as $user) {
                    $pelimpahanHtml .= '<li class="text-sm text-gray-800"><strong>' . htmlspecialchars($user->name) . '</strong>';
                    if ($user->email) {
                        $pelimpahanHtml .= ' <span class="text-gray-500">(' . htmlspecialchars($user->email) . ')</span>';
                    }
                    $pelimpahanHtml .= '</li>';
                }
                $pelimpahanHtml .= '</ul></div>';
                $html .= $pelimpahanHtml;
            }

            // If this is an Ijin Sakit with an uploaded bukti, append a bukti preview/link
            if (isset($model->jenis) && $model->jenis === 'Ijin Sakit' && !empty($model->bukti)) {
                try {
                    $disk = \Illuminate\Support\Facades\Storage::disk('public');
                    if ($disk->exists($model->bukti)) {
                        $filename = basename($model->bukti);
                        $url = route('files.bukti', $filename);
                        $ext = pathinfo($model->bukti, PATHINFO_EXTENSION);
                        $buktiHtml = '<div class="mt-6 p-4 border border-gray-300 rounded-lg bg-gray-50">';
                        $buktiHtml .= '<h4 class="text-base font-semibold mb-3 text-gray-800">📎 Lampiran Surat Dokter</h4>';
                        if (in_array(strtolower($ext), ['jpg','jpeg','png','gif','bmp','tiff'])) {
                            $buktiHtml .= '<div class="bg-white p-2 rounded border"><img src="' . htmlspecialchars($url) . '" alt="Surat Dokter" class="max-w-full h-auto rounded" style="max-height: 500px; margin: 0 auto; display: block;" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'block\';" />';
                            $buktiHtml .= '<div style="display:none;" class="text-red-600 text-sm p-4">Gagal memuat gambar. <a href="' . htmlspecialchars($url) . '" target="_blank" class="underline">Buka di tab baru</a></div></div>';
                        } elseif (strtolower($ext) === 'pdf') {
                            $buktiHtml .= '<div class="mb-2"><a href="' . htmlspecialchars($url) . '" target="_blank" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">📄 Buka PDF Surat Dokter</a></div>';
                        } else {
                            $buktiHtml .= '<div><a href="' . htmlspecialchars($url) . '" target="_blank" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">📥 Unduh Lampiran</a></div>';
                        }
                        $buktiHtml .= '</div>';
                        $html .= $buktiHtml;
                    }
                } catch (\Throwable $e) {
                    \Log::error('Preview bukti failed: ' . $e->getMessage());
                }
            }

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
