<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Dompdf\Dompdf;

class MagangController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403, 'Akses ditolak');
        }
    }

    /**
     * =============================
     * LIST DATA MAGANG (ADMIN)
     * =============================
     */
    public function index()
    {
        $this->ensureAdminHRD();

        // Admin fokus ke permintaan surat
        $magangList = Magang::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.magang', compact('magangList'));
    }

    /**
     * =============================
     * DETAIL MAGANG (MODAL / AJAX)
     * =============================
     */
    public function detail($id)
    {
        $this->ensureAdminHRD();

        $magang = Magang::findOrFail($id);

        return response()->json([
            'ok' => true,
            'data' => [
                'id' => $magang->id,
                'nama_peserta' => $magang->nama_peserta,
                'nim_nis' => $magang->nim_nis,
                'sekolah_asal' => $magang->sekolah_asal,
                'jurusan' => $magang->jurusan,
                'tanggal_mulai' => optional($magang->tanggal_mulai)->format('d/m/Y'),
                'tanggal_selesai' => optional($magang->tanggal_selesai)->format('d/m/Y'),
                'durasi_hari' => $magang->durasi_hari,
                'keperluan' => $magang->keperluan,
                'phone' => $magang->phone,
                'status' => $magang->status,
                'nomor_surat_diminta' => $magang->nomor_surat_diminta,
                'tanggal_surat_diminta' => optional($magang->tanggal_surat_diminta)->format('d/m/Y'),
            ]
        ]);
    }

    /**
     * =============================
     * GENERATE SURAT MAGANG (ADMIN)
     * =============================
     * 
     * Alur:
     * 1. Admin menerima notif dari direktur yang request surat
     * 2. Admin input nomor_surat_dibuat & tanggal_surat_dibuat (bisa sama atau berbeda dari yang diminta)
     * 3. System generate PDF dengan data dari admin
     * 4. Admin preview dan download
     */
    public function storeMagangSurat(Request $request, $magangId)
    {
        $this->ensureAdminHRD();

        $magang = Magang::findOrFail($magangId);

        /**
         * 🔴 KUNCI LOGIKA PALING PENTING
         * ADMIN HANYA BOLEH BIKIN SURAT
         * JIKA ADA PERMINTAAN DARI DIREKTUR
         */
        if ($magang->status !== 'Permintaan Surat') {
            return response()->json([
                'ok' => false,
                'message' => 'Surat hanya dapat dibuat jika ada permintaan dari direktur.'
            ], 403);
        }

        // Validasi input dari admin
        $validated = $request->validate([
            'nomor_surat_dibuat' => 'required|string|max:100',
            'tanggal_surat_dibuat' => 'required|date',
            'nim_nis' => 'required|string|max:50',
        ], [
            'nomor_surat_dibuat.required' => 'Nomor surat harus diisi',
            'tanggal_surat_dibuat.required' => 'Tanggal surat harus diisi',
            'nim_nis.required' => 'NIM/NIS harus diisi',
        ]);

        // Simpan nomor, tanggal, dan NIM/NIS yang diinput admin
        $magang->update([
            'nomor_surat_dibuat' => $validated['nomor_surat_dibuat'],
            'tanggal_surat_dibuat' => $validated['tanggal_surat_dibuat'],
            'nim_nis' => $validated['nim_nis'],
        ]);

        try {
            /**
             * Ambil SEMUA peserta dari sekolah yang sama
             * yang sedang PERMINTAAN SURAT
             */
            $magangList = Magang::where('sekolah_asal', $magang->sekolah_asal)
                ->where('status', 'Permintaan Surat')
                ->orderBy('created_at', 'asc')
                ->get();

            if ($magangList->isEmpty()) {
                return response()->json([
                    'ok' => false,
                    'message' => 'Tidak ada data magang yang bisa dibuatkan surat.'
                ], 400);
            }

            /**
             * ================= LOGO PATH
             */
            $logoPath = public_path('img/image.png');

            if (!file_exists($logoPath)) {
                throw new \Exception('Logo tidak ditemukan: ' . $logoPath);
            }

            /**
             * ================= RENDER VIEW
             */
            $html = view('surat.magang', [
                'magangList' => $magangList,
                'logoPath'   => $logoPath,
                'nomor_surat' => $validated['nomor_surat_dibuat'],
                'tanggal_surat' => $validated['tanggal_surat_dibuat'],
            ])->render();

            /**
             * ================= DOMPDF
             */
            $dompdf = new Dompdf([
                'chroot' => public_path(),
                'isHtml5ParserEnabled' => true,
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            /**
             * ================= SIMPAN FILE
             */
            $fileName = 'Surat_Magang_' . str_replace(' ', '_', $magang->sekolah_asal) . '_' . time() . '.pdf';
            $path = storage_path('app/public/generated/' . $fileName);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            file_put_contents($path, $dompdf->output());

            /**
             * ================= UPDATE STATUS & SIMPAN FILE PATH
             * SETELAH SURAT SELESAI
             */
            foreach ($magangList as $item) {
                $item->status = 'Surat Selesai';
                $item->file_surat = 'generated/' . $fileName;  // Simpan relative path
                $item->save();
            }

            /**
             * ================= KIRIM NOTIFIKASI KE DIREKTUR
             * Jika ada direktur yang request surat
             */
            $direktur = $magang->user;  // User yang membuat permintaan magang
            if ($direktur && method_exists($direktur, 'notify')) {
                try {
                    Notification::send($direktur, new \App\Notifications\MagangSuratReady($magang, $fileName));
                    \Log::info('Notifikasi surat magang ready dikirim ke user: ' . $direktur->id);
                } catch (\Throwable $e) {
                    \Log::error('Error sending notification: ' . $e->getMessage());
                }
            }

            /**
             * ================= RETURN RESPONSE
             */
            $pdfContent = $dompdf->output();
            $pdfBase64 = base64_encode($pdfContent);

            return response()->json([
                'ok' => true,
                'url' => asset('storage/generated/' . $fileName),
                'pdfBase64' => $pdfBase64,
                'fileName' => $fileName,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Error Surat Magang: ' . $e->getMessage());

            return response()->json([
                'ok' => false,
                'message' => 'Gagal membuat surat magang.',
            ], 500);
        }
    }

    /**
     * =============================
     * PREVIEW PDF
     * =============================
     */
    public function previewMagangSurat(Request $request)
    {
        $this->ensureAdminHRD();

        $fileName = $request->query('file');
        if (!$fileName) abort(404);

        $path = storage_path('app/public/generated/' . $fileName);
        if (!file_exists($path)) abort(404);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
        ]);
    }

    /**
     * =============================
     * GET EXISTING SURAT (PREVIEW)
     * =============================
     * Untuk preview surat yang sudah dibuat sebelumnya
     */
    public function getExistingSurat($id)
    {
        $this->ensureAdminHRD();

        $magang = Magang::findOrFail($id);

        // Jika surat belum selesai, return error
        if ($magang->status !== 'Surat Selesai') {
            return response()->json([
                'ok' => false,
                'message' => 'Surat belum selesai dibuat.'
            ], 403);
        }

        // Jika file tidak ada, regenerate dari template
        if (!$magang->file_surat) {
            return response()->json([
                'ok' => false,
                'message' => 'File surat tidak ditemukan.'
            ], 404);
        }

        $filePath = storage_path('app/public/' . $magang->file_surat);
        
        if (!file_exists($filePath)) {
            return response()->json([
                'ok' => false,
                'message' => 'File surat tidak ditemukan di storage.'
            ], 404);
        }

        // Read file dan encode to base64
        $pdfContent = file_get_contents($filePath);
        $pdfBase64 = base64_encode($pdfContent);

        return response()->json([
            'ok' => true,
            'url' => asset('storage/' . $magang->file_surat),
            'pdfBase64' => $pdfBase64,
            'fileName' => basename($magang->file_surat),
        ]);
    }
}
