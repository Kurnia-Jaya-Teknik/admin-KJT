<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403);
        }
    }

    public function index()
    {
        $this->ensureAdminHRD();
        
        $magangList = Magang::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.magang', [
            'magangList' => $magangList,
        ]);
    }

    public function detail($id)
    {
        $this->ensureAdminHRD();
        
        $magang = Magang::findOrFail($id);
        
        return response()->json([
            'ok' => true,
            'data' => [
                'id' => $magang->id,
                'nama_peserta' => $magang->nama_peserta,
                'sekolah_asal' => $magang->sekolah_asal,
                'jurusan' => $magang->jurusan,
                'tanggal_mulai' => $magang->tanggal_mulai->format('d/m/Y'),
                'tanggal_selesai' => $magang->tanggal_selesai->format('d/m/Y'),
                'durasi_hari' => $magang->durasi_hari,
                'keperluan' => $magang->keperluan,
                'phone' => $magang->phone,
                'status' => $magang->status,
            ]
        ]);
    }

    public function markSuratCreated(Request $request, $id)
    {
        $this->ensureAdminHRD();
        
        $magang = Magang::findOrFail($id);
        $magang->status = 'Surat Dibuat';
        $magang->save();

        if ($request->ajax()) {
            return response()->json(['ok' => true, 'status' => 'Surat Dibuat']);
        }

        return redirect()->back()->with('status', 'Surat magang berhasil dibuat.');
    }

    public function storeMagangSurat(Request $request, $magangId)
    {
        $this->ensureAdminHRD();
        
        $magang = Magang::findOrFail($magangId);

        try {
            // Get up to 3 peserta from same school with SAME status as current peserta
            $magangList = Magang::where('sekolah_asal', $magang->sekolah_asal)
                ->where('status', $magang->status)  // Use current peserta's status
                ->orderBy('created_at', 'asc')
                ->limit(3)
                ->get();
            
            // Check if there are any peserta 
            if ($magangList->isEmpty()) {
                return response()->json(['ok' => false, 'message' => 'Tidak ada peserta dari sekolah ini'], 400);
            }
            
            $logoPath = public_path('img/image.png');
            
            $html = view('surat.magang', [
                'magangList' => $magangList,
                'logoPath' => $logoPath,
            ])->render();
            
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $fileName = 'Surat_Magang_'.$magang->sekolah_asal.'_'.time().'.pdf';
            $fileName = str_replace(' ', '_', $fileName);
            $path = storage_path('app/public/generated/'.$fileName);
            if (!file_exists(dirname($path))) mkdir(dirname($path), 0755, true);
            file_put_contents($path, $dompdf->output());
            
            // Mark all included peserta as "Surat Selesai" only if they are "Permintaan Surat"
            foreach ($magangList as $item) {
                if ($item->status === 'Permintaan Surat') {
                    $item->status = 'Surat Selesai';
                    $item->save();
                }
            }
            
            $downloadUrl = asset('storage/generated/'.$fileName);
            
            // Return PDF content as base64 for preview
            return response()->json([
                'ok' => true, 
                'url' => $downloadUrl,
                'pdfBase64' => base64_encode($dompdf->output())
            ]);
            
        } catch (\Throwable $e) {
            \Log::error('Error generating magang surat: '.$e->getMessage());
            return response()->json(['ok' => false, 'message' => 'Error: '.$e->getMessage()], 500);
        }
    }

    public function previewMagangSurat(Request $request, $id)
    {
        $this->ensureAdminHRD();
        
        $fileName = $request->query('file');
        if (!$fileName) {
            abort(404);
        }
        
        $path = storage_path('app/public/generated/'.$fileName);
        if (!file_exists($path)) {
            abort(404);
        }
        
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
        ]);
    }
}

