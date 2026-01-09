<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'kop_surat_id' => 'nullable|exists:kop_surats,id',
            'placeholders' => 'nullable|array',
        ]);

        // create surat record
        $surat = Surat::create([
            'user_id' => auth()->id(),
            'jenis' => $data['jenis'],
            'nomor_surat' => $data['nomor'] ?? null,
            'perihal' => $data['tujuan'] ?? null,
            'isi_surat' => $data['isi'],
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
}
