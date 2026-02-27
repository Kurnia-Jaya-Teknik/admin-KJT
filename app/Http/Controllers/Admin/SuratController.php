<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;


class SuratController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403);
        }
    }

    public function approve(Request $request, $id)
    {
        $this->ensureAdminHRD();
        $surat = Surat::findOrFail($id);
        $surat->status = 'Disetujui';
        $surat->disetujui_oleh = Auth::id();
        $surat->tanggal_persetujuan = now();
        $surat->save();

        if ($request->ajax()) {
            return response()->json(['ok' => true, 'status' => 'Disetujui']);
        }

        return redirect()->back()->with('status', 'Surat disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $this->ensureAdminHRD();
        $surat = Surat::findOrFail($id);
        $surat->status = 'Ditolak';
        $surat->disetujui_oleh = Auth::id();
        $surat->tanggal_persetujuan = now();
        $surat->keterangan = $request->input('keterangan');
        $surat->save();

        if ($request->ajax()) {
            return response()->json(['ok' => true, 'status' => 'Ditolak']);
        }

        return redirect()->back()->with('status', 'Surat ditolak.');
    }

    public function store(Request $request)
    {
        $this->ensureAdminHRD();

        $data = $request->validate([
            'nomor' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:100',
            'karyawan' => 'required|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'sections' => 'nullable|array',
            'kop_surat_id' => 'nullable|exists:kop_surats,id',
            'placeholders' => 'nullable|array',
        ]);

        // Apply placeholders (if provided) to isi/tujuan/karyawan/nomor before saving and generating
        $placeholders = $data['placeholders'] ?? [];
        $filled = [
            'isi' => $data['isi'],
            'tujuan' => $data['tujuan'] ?? '',
            'karyawan' => $data['karyawan'],
            'nomor' => $data['nomor'] ?? '',
        ];
        if (!empty($placeholders) && is_array($placeholders)) {
            foreach ($placeholders as $k => $v) {
                if (!is_scalar($v)) continue;
                $key = strtoupper($k);
                $filled = array_map(function($val) use ($key, $v) {
                    return str_ireplace(['['.$key.']','{'.$key.'}','%'.$key.'%','{{'.$key.'}}'], $v, $val);
                }, $filled);
            }
        }

        // create surat record with filled values
        $surat = Surat::create([
            'user_id' => auth()->id(),
            'jenis' => $data['jenis'],
            'nomor_surat' => $filled['nomor'] ?: null,
            'perihal' => $filled['tujuan'] ?: null,
            'isi_surat' => $filled['isi'],
            'tanggal_surat' => $data['tanggal'],
            'status' => 'Diterbitkan',
            'dibuat_oleh' => auth()->id(),
            'kop_surat_id' => $data['kop_surat_id'] ?? null,
        ]);

        // If template selected, generate filled docx (and try convert to PDF)
        if (!empty($data['kop_surat_id'])) {
            $kop = \App\Models\KopSurat::find($data['kop_surat_id']);
            if ($kop && $kop->is_template) {
                try {
                    $full = storage_path('app/public/'.$kop->file_path);
                    $tp = new \PhpOffice\PhpWord\TemplateProcessor($full);
                    $payload = $data['placeholders'] ?? [];

                    // add common placeholders
                    $payload['NOMOR'] = $surat->nomor_surat ?? '';
                    $payload['TANGGAL'] = $surat->tanggal_surat ? $surat->tanggal_surat->format('d M Y') : '';
                    $payload['KARYAWAN'] = $data['karyawan'];
                    $payload['TUJUAN'] = $data['tujuan'] ?? '';
                    $payload['ISI'] = $data['isi'];

                    foreach ($payload as $k => $v) {
                        if (is_scalar($v)) $tp->setValue($k, $v);
                    }

                    $outName = 'surat_'.time().'_'.uniqid().'.docx';
                    $outPath = storage_path('app/public/generated/'.$outName);
                    if (!file_exists(dirname($outPath))) mkdir(dirname($outPath), 0755, true);
                    $tp->saveAs($outPath);

                    $surat->generated_file_path = 'generated/'.$outName;
                    $surat->generated_file_url = asset('storage/generated/'.$outName);
                    $surat->generated_mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                    $surat->save();

                    // Try convert to PDF if possible (optional)
                    try {
                        // Attempt to use PhpWord PDF writer (requires Dompdf or other lib configured)
                        $phpWord = \PhpOffice\PhpWord\IOFactory::load($outPath);
                        $pdfName = pathinfo($outName, PATHINFO_FILENAME).'.pdf';
                        $pdfPath = storage_path('app/public/generated/'.$pdfName);
                        // attempt Save using DomPDF via IOFactory
                        \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF')->save($pdfPath);
                        $surat->generated_file_path = 'generated/'.$pdfName;
                        $surat->generated_file_url = asset('storage/generated/'.$pdfName);
                        $surat->generated_mime = 'application/pdf';
                        $surat->save();
                    } catch (\Throwable $e) {
                        // ignore conversion failure
                    }
                } catch (\Throwable $e) {
                    // record generation error message in keterangan
                    $surat->keterangan = 'Gagal generate template: '.$e->getMessage();
                    $surat->save();
                }
            }
        }

        if ($request->ajax()) {
            return response()->json(['ok' => true, 'surat' => $surat]);
        }

        return redirect()->back()->with('status', 'Surat berhasil diterbitkan.');
    }

    /**
     * Generate a PDF from the provided form data and return a public URL.
     */
    public function generatePdf(Request $request)
    {
        $this->ensureAdminHRD();

        $data = $request->validate([
            'nomor' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'jenis' => 'nullable|string|max:100',
            'karyawan' => 'required|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'sections' => 'nullable|array',
            'kop_surat_id' => 'nullable|exists:kop_surats,id',
            'jabatan' => 'nullable|string|max:255',
            'departemen' => 'nullable|string|max:255',
        ]);

        // prepare data for the view
        $viewData = [
            'nomor' => $data['nomor'] ?? '',
            'tanggal' => $data['tanggal'] ?? now()->toDateString(),
            'jenis' => $data['jenis'] ?? '',
            'karyawan' => $data['karyawan'],
            'tujuan' => $data['tujuan'] ?? '',
            'isi' => $data['isi'],
            'jabatan' => $data['jabatan'] ?? '',
            'departemen' => $data['departemen'] ?? '',
            'kop' => null,
        ];

        // apply placeholders if present
        $placeholders = $request->input('placeholders', []);
        if (!empty($placeholders) && is_array($placeholders)) {
            foreach ($placeholders as $k => $v) {
                if (!is_scalar($v)) continue;
                $key = strtoupper($k);
                // replace [KEY] or {KEY} occurrences in relevant fields
                $viewData['isi'] = str_ireplace(['['.$key.']','{'.$key.'}','%'.$key.'%'], $v, $viewData['isi']);
                $viewData['tujuan'] = str_ireplace(['['.$key.']','{'.$key.'}','%'.$key.'%'], $v, $viewData['tujuan']);
                $viewData['karyawan'] = str_ireplace(['['.$key.']','{'.$key.'}','%'.$key.'%'], $v, $viewData['karyawan']);
                $viewData['nomor'] = str_ireplace(['['.$key.']','{'.$key.'}','%'.$key.'%'], $v, $viewData['nomor']);
            }
        }

        if (!empty($data['kop_surat_id'])) {
            $kop = \App\Models\KopSurat::find($data['kop_surat_id']);
            if ($kop) $viewData['kop'] = $kop;
        }

        $html = view('letters.preview', $viewData)->render();

        try {
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $out = $dompdf->output();

            $name = 'surat_preview_'.time().'_'.uniqid().'.pdf';
            $path = storage_path('app/public/generated/'.$name);
            if (!file_exists(dirname($path))) mkdir(dirname($path), 0755, true);
            file_put_contents($path, $out);

            $url = asset('storage/generated/'.$name);
            return response()->json(['ok' => true, 'url' => $url]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function storeCutiSurat(Request $request, $cutiId)
    {
        $this->ensureAdminHRD();

<<<<<<< Updated upstream
        // Increase execution time for PDF generation
        set_time_limit(120);

        $cuti = \App\Models\Cuti::findOrFail($cutiId);

        if ($cuti->status !== 'Disetujui') {
            return response()->json(['ok' => false, 'message' => 'Pengajuan cuti belum disetujui'], 400);
        }

        $karyawan = $cuti->user;

        // Get delegated users from dilimpahkan_ke array
        $delegatedUsers = collect();
        if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
            $delegatedUsers = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get();
        }

        // ✅ PATH LOGO WAJIB FILE://
        $logoPath = 'file://' . public_path('img/image.png');

        $html = view('surat.cuti', [
            'karyawan' => $karyawan,
            'cuti' => $cuti,
            'logoPath' => $logoPath,
            'delegatedUsers' => $delegatedUsers,
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

=======
        $cuti = \App\Models\Cuti::with(['user'])->findOrFail($cutiId);

        if ($cuti->status !== 'Disetujui') {
            return response()->json(['ok' => false, 'message' => 'Pengajuan cuti belum disetujui'], 400);
        }

        // Check if surat already exists for this cuti
        $existingSurat = Surat::where('referensi_type', 'App\\Models\\Cuti')
            ->where('referensi_id', $cutiId)
            ->first();

        if ($existingSurat) {
            return response()->json([
                'ok' => false,
                'message' => 'Surat untuk cuti ini sudah dibuat',
                'surat_id' => $existingSurat->id
            ], 400);
        }

        $karyawan = $cuti->user;

        // Create Surat record first
        $surat = Surat::create([
            'user_id' => $karyawan->id,
            'jenis' => 'Cuti',
            'nomor_surat' => null, // Will be filled by admin
            'perihal' => 'Pengajuan Cuti - ' . $cuti->jenis,
            'isi_surat' => $cuti->alasan,
            'tanggal_surat' => now(),
            'status' => 'Pending', // Admin can edit before finalizing
            'dibuat_oleh' => auth()->id(),
            'referensi_type' => 'App\\Models\\Cuti',
            'referensi_id' => $cutiId,
        ]);

        // Generate PDF
        $logoPath = 'file://' . public_path('img/image.png');

        $html = view('surat.cuti', [
            'karyawan' => $karyawan,
            'cuti' => $cuti,
            'logoPath' => $logoPath,
        ])->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fileName = 'Surat_Cuti_' . $karyawan->name . '_' . time() . '.pdf';
        $path = storage_path('app/public/generated/' . $fileName);

>>>>>>> Stashed changes
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $dompdf->output());

<<<<<<< Updated upstream
        // Save file path to cuti table
        $cuti->update([
            'file_surat' => $folderPath.'/'.$fileName
        ]);

        return response()->json([
            'ok' => true,
            'url' => asset('storage/'.$folderPath.'/'.$fileName)
=======
        // Update surat with file info
        $surat->generated_file_path = 'generated/' . $fileName;
        $surat->generated_file_url = asset('storage/generated/' . $fileName);
        $surat->generated_mime = 'application/pdf';
        $surat->save();

        return response()->json([
            'ok' => true,
            'message' => 'Surat berhasil dibuat',
            'url' => asset('storage/generated/' . $fileName),
            'surat_id' => $surat->id
>>>>>>> Stashed changes
        ]);
    }


    /**
     * Create a surat (letter) from an approved lembur (overtime) request
     * POST /admin/lembur/{lemburId}/buat-surat
     */
    public function storeLemburSurat(Request $request, $lemburId)
    {
        $this->ensureAdminHRD();
        
        // Get the lembur request
        $lembur = \App\Models\Lembur::findOrFail($lemburId);
        
        // Verify it's approved
        if ($lembur->status !== 'Disetujui') {
            return response()->json(['ok' => false, 'message' => 'Pengajuan lembur belum disetujui'], 400);
        }
        
        // Get karyawan info
        $karyawan = $lembur->user;
        if (!$karyawan) {
            return response()->json(['ok' => false, 'message' => 'Data karyawan tidak ditemukan'], 404);
        }
        
        try {
            $logoPath = public_path('img/image.png');
            
            $html = view('surat.lembur', [
                'karyawan' => $karyawan,
                'lembur' => $lembur,
                'logoPath' => $logoPath,
            ])->render();
            
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            // Save and return URL for preview
            $fileName = 'Surat_Lembur_'.$karyawan->name.'_'.time().'.pdf';
            $path = storage_path('app/public/generated/'.$fileName);
            if (!file_exists(dirname($path))) mkdir(dirname($path), 0755, true);
            file_put_contents($path, $dompdf->output());
            
            $url = asset('storage/generated/'.$fileName);
            return response()->json(['ok' => true, 'url' => $url]);
            
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'message' => 'Error: '.$e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->ensureAdminHRD();
        $surat = Surat::findOrFail($id);
        $surat->delete();

        if ($request->ajax()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->back()->with('status', 'Surat dihapus.');
    }

    public function show(Request $request, $id)
    {
        $this->ensureAdminHRD();
        $surat = Surat::with('user','creator')->findOrFail($id);
        if ($request->ajax() || $request->is('*/admin/surat/*')) {
            return response()->json(['ok' => true, 'surat' => $surat]);
        }
        return view('admin.surat-show', ['surat' => $surat]);
    }

    /**
     * Return list of surat ready to be sent (status = Disetujui)
     */
    public function pendingList()
    {
        $this->ensureAdminHRD();
        $list = Surat::where('status', 'Disetujui')->with('user')->orderBy('created_at', 'desc')->get(['id','nomor_surat','perihal','user_id','generated_file_url','created_at']);
        // map to include user name for convenience
        $mapped = $list->map(function($s) {
            return [
                'id' => $s->id,
                'nomor_surat' => $s->nomor_surat,
                'perihal' => $s->perihal,
                'user_id' => $s->user_id,
                'user_name' => $s->user->name ?? null,
                'generated_file_url' => $s->generated_file_url,
                'created_at' => $s->created_at,
            ];
        });
        return response()->json(['ok' => true, 'list' => $mapped]);
    }

    /**
     * Kirim surat ke karyawan (mengirim email dan update status)
     */
    public function kirim(Request $request, $id)
    {
        $this->ensureAdminHRD();
        $surat = Surat::findOrFail($id);

        // allow admin to optionally edit isi before sending via request
        $isi = $request->input('isi');
        if ($isi) $surat->isi_surat = $isi;

        try {
            if ($surat->user && $surat->user->email) {
                \Mail::to($surat->user->email)->send(new \App\Mail\KirimSuratMailable($surat));
            }
            $surat->status = 'Diterbitkan';
            $surat->dikirim_oleh = auth()->id();
            $surat->dikirim_at = now();
            $surat->save();

            if ($request->ajax()) {
                return response()->json(['ok' => true, 'surat' => $surat]);
            }

            return redirect()->back()->with('status', 'Surat berhasil dikirim.');
        } catch (\Throwable $e) {
            \Log::error('Gagal kirim surat: '.$e->getMessage());
            if ($request->ajax()) {
                return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Gagal mengirim surat.');
        }
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdminHRD();

        try {
            $surat = Surat::findOrFail($id);
            $cutiId = $request->input('cuti_id');

            if ($cutiId) {
                $cuti = \App\Models\Cuti::findOrFail($cutiId);

                // Update cuti data from form
                if ($request->has('tanggal_mulai')) {
                    $cuti->tanggal_mulai = $request->input('tanggal_mulai');
                }
                if ($request->has('tanggal_selesai')) {
                    $cuti->tanggal_selesai = $request->input('tanggal_selesai');
                }
                if ($request->has('alasan')) {
                    $cuti->alasan = $request->input('alasan');
                }

                // Recalculate duration
                if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
                    $start = new \DateTime($cuti->tanggal_mulai);
                    $end = new \DateTime($cuti->tanggal_selesai);
                    $durasi = $start->diff($end)->days + 1;
                    $cuti->durasi = $durasi . ' Hari';
                }

                $cuti->save();
            }

            // Update surat data
            if ($request->has('nomor_surat')) {
                $surat->nomor_surat = $request->input('nomor_surat');
            }
            if ($request->has('catatan')) {
                $surat->keterangan = $request->input('catatan');
            }

            $surat->save();

            // Regenerate PDF with updated data
            if ($cutiId && $surat->referensi_type === 'App\\Models\\Cuti') {
                $karyawan = $cuti->user;
                $logoPath = 'file://' . public_path('img/image.png');

                $html = view('surat.cuti', [
                    'karyawan' => $karyawan,
                    'cuti' => $cuti,
                    'logoPath' => $logoPath,
                ])->render();

                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $options->set('isHtml5ParserEnabled', true);

                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                $fileName = 'Surat_Cuti_' . $karyawan->name . '_' . time() . '.pdf';
                $path = storage_path('app/public/generated/' . $fileName);

                if (!file_exists(dirname($path))) {
                    mkdir(dirname($path), 0755, true);
                }

                file_put_contents($path, $dompdf->output());

                $surat->generated_file_path = 'generated/' . $fileName;
                $surat->generated_file_url = asset('storage/generated/' . $fileName);
                $surat->generated_mime = 'application/pdf';
                $surat->save();
            }

            return response()->json([
                'ok' => true,
                'message' => 'Surat berhasil diupdate',
                'surat' => $surat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
