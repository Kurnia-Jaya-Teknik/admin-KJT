<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class SuratCutiController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403);
        }
    }

    public function store(Request $request, $cutiId)
    {
        $this->ensureAdminHRD();

        // Increase execution time for PDF generation
        set_time_limit(120);

        $cuti = Cuti::findOrFail($cutiId);

        if ($cuti->status !== 'Disetujui') {
            return response()->json(['ok' => false, 'message' => 'Pengajuan cuti belum disetujui'], 400);
        }

        // Validate request for nomor_surat and tanggal_surat
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date'
        ]);

        $karyawan = $cuti->user;

        // Get delegated users from dilimpahkan_ke array
        $delegatedUsers = collect();
        if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
            $delegatedUsers = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get();
        }

        // ✅ Logo path - gunakan format yang sama dengan SuratKeteranganController
        $logoPath = public_path('img/kop_surat.png');

        $html = view('surat.cuti', [
            'karyawan' => $karyawan,
            'cuti' => $cuti,
            'logoPath' => $logoPath,
            'delegatedUsers' => $delegatedUsers,
            'nomor_surat' => $validated['nomor_surat'],
            'tanggal_surat' => $validated['tanggal_surat'],
        ])->render();

        // ✅ OPTIONS DOMPDF (WAJIB)
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fileName = 'Surat_Cuti_'.$karyawan->name.'_'.time().'.pdf';
        $folderPath = 'cuti';
        $path = storage_path('app/public/'.$folderPath.'/'.$fileName);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $dompdf->output());

        // Save file path to cuti table
        $cuti->update([
            'file_surat' => $folderPath.'/'.$fileName
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Surat cuti berhasil dibuat',
            'surat_id' => $cuti->id
        ]);
    }

    public function preview($id)
    {
        $this->ensureAdminHRD();

        $cuti = Cuti::find($id);
        if (!$cuti) {
            return response()->json(['ok' => false, 'message' => 'Cuti tidak ditemukan'], 404);
        }

        // Check if surat file exists
        if (!$cuti->file_surat) {
            return response()->json(['ok' => false, 'message' => 'File surat tidak ditemukan'], 404);
        }

        $filePath = storage_path('app/public/' . $cuti->file_surat);
        
        if (!file_exists($filePath)) {
            return response()->json(['ok' => false, 'message' => 'File surat tidak ditemukan'], 404);
        }

        // Read file and encode to base64
        $pdfContent = file_get_contents($filePath);
        $pdfBase64 = base64_encode($pdfContent);

        // Get download URL
        $downloadUrl = url('storage/' . $cuti->file_surat);

        return response()->json([
            'ok' => true,
            'pdfBase64' => $pdfBase64,
            'downloadUrl' => $downloadUrl,
            'filename' => basename($filePath)
        ]);
    }
}
