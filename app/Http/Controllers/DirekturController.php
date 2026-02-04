<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Magang;
use Illuminate\Http\Request;

class DirekturController extends Controller
{
    public function persetujuanCutiLembur(Request $request)
    {
        // Get filter parameters
        $jenis = $request->query('jenis');
        $status = $request->query('status');
        $periode = $request->query('periode');

        // Start query for Cuti
        $cutiQuery = Cuti::with('user')
            ->where('status', '!=', null);

        // Filter by status
        if ($status) {
            $statusMap = [
                'menunggu' => 'Pending',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ];
            $cutiStatus = $statusMap[strtolower($status)] ?? null;
            if ($cutiStatus) {
                $cutiQuery->where('status', $cutiStatus);
            }
        }

        // Filter by periode
        if ($periode) {
            $cutiQuery->whereYear('tanggal_mulai', explode('-', $periode)[0])
                ->whereMonth('tanggal_mulai', explode('-', $periode)[1]);
        }

        $cutiRequests = $cutiQuery->orderBy('created_at', 'desc')->get();

        // Start query for Lembur
        $lemburQuery = Lembur::with('user')
            ->where('status', '!=', null);

        // Filter by status
        if ($status) {
            $statusMap = [
                'menunggu' => 'Pending',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ];
            $lemburStatus = $statusMap[strtolower($status)] ?? null;
            if ($lemburStatus) {
                $lemburQuery->where('status', $lemburStatus);
            }
        }

        // Filter by periode
        if ($periode) {
            $lemburQuery->whereYear('tanggal', explode('-', $periode)[0])
                ->whereMonth('tanggal', explode('-', $periode)[1]);
        }

        $lemburRequests = $lemburQuery->orderBy('created_at', 'desc')->get();

        // Merge and sort by creation date
        $requests = collect([...$cutiRequests, ...$lemburRequests])
            ->sortByDesc('created_at')
            ->values();

        return view('direktur.persetujuan-cuti-lembur', compact('requests'));
    }

    public function persetujuanSurat()
    {
        return view('direktur.persetujuan-surat');
    }

    public function ringkasanKaryawan()
    {
        return view('direktur.ringkasan-karyawan');
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }

    // New: dedicated cuti report page
    public function laporanCuti()
    {
        return view('direktur.laporan-cuti');
    }

    public function laporanAbsensi()
    {
        return view('direktur.laporan-absensi');
    }

    public function laporanLembur()
    {
        return view('direktur.laporan-lembur');
    }

    public function laporanCutiPdf(Request $request)
    {
        // Accepts month, year, period_by, q (search)
        $month = (int) $request->query('month', now()->month);
        $year = (int) $request->query('year', now()->year);
        $periodBy = $request->query('period_by', 'tanggal_mulai');
        $q = trim((string) $request->query('q', ''));

        $query = \App\Models\Cuti::with('user', 'approver')
            ->where('status', 'Disetujui');

        if ($periodBy === 'tanggal_persetujuan') {
            $query->whereYear('tanggal_persetujuan', $year)
                  ->whereMonth('tanggal_persetujuan', $month);
        } else {
            $query->whereYear('tanggal_mulai', $year)
                  ->whereMonth('tanggal_mulai', $month);
        }

        if ($q !== '') {
            $query->where(function($qbuilder) use ($q) {
                $like = '%' . $q . '%';
                $qbuilder->whereHas('user', function($u) use ($like) { $u->where('name', 'like', $like); })
                    ->orWhere('jenis', 'like', $like)
                    ->orWhere('alasan', 'like', $like)
                    ->orWhere('telp', 'like', $like);
            });
        }

        $items = $query->orderBy('tanggal_persetujuan', 'desc')->get();

        // Map to simpler array for view
        $rows = $items->map(function($c){
            $pel = [];
            if (is_array($c->dilimpahkan_ke) && count($c->dilimpahkan_ke)) {
                $users = \App\Models\User::whereIn('id', $c->dilimpahkan_ke)->get();
                $pel = $users->map(function($u){ return $u->name . ($u->departemen ? ' — ' . $u->departemen->nama : ''); })->toArray();
            }
            return [
                'id' => $c->id,
                'nama' => $c->user ? $c->user->name : '-',
                'divisi' => $c->user && $c->user->departemen ? $c->user->departemen->nama : '',
                'jenis' => $c->jenis,
                'tanggal_mulai' => $c->tanggal_mulai ? $c->tanggal_mulai->toDateString() : '',
                'tanggal_selesai' => $c->tanggal_selesai ? $c->tanggal_selesai->toDateString() : '',
                'durasi' => $c->durasi_hari,
                'pelimpahan' => implode(', ', $pel),
                'telp' => $c->telp,
                'alasan' => $c->alasan,
                'tanggal_persetujuan' => $c->tanggal_persetujuan ? $c->tanggal_persetujuan->toDateString() : '',
                'approved_by' => $c->approver ? $c->approver->name : ''
            ];
        })->toArray();

        $periodLabel = monthName($month) . ' ' . $year;

        // attempt to find kop surat (logo) for Kurnia Jaya Teknik, fallback to first available
        $kopLogoData = null;
        try {
            $kop = \App\Models\KopSurat::where('name', 'like', '%Kurnia%')->first();
            if (! $kop) {
                $kop = \App\Models\KopSurat::where('is_template', true)->first() ?: \App\Models\KopSurat::first();
            }

            if ($kop && $kop->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($kop->file_path)) {
                $content = \Illuminate\Support\Facades\Storage::disk('public')->get($kop->file_path);
                $mime = $kop->mime ?: (\Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $kop->file_path)) ?: 'image/png');
                $kopLogoData = 'data:' . $mime . ';base64,' . base64_encode($content);
            }

            // fallback: if we didn't find a KopSurat DB record, try any file in storage/kop-surat
            if (empty($kopLogoData)) {
                try {
                    $files = \Illuminate\Support\Facades\Storage::disk('public')->files('kop-surat');
                    if (!empty($files)) {
                        $first = $files[0];
                        $content = \Illuminate\Support\Facades\Storage::disk('public')->get($first);
                        $mime = \Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $first)) ?: 'image/png';
                        $kopLogoData = 'data:' . $mime . ';base64,' . base64_encode($content);
                    }
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        } catch (\Throwable $e) {
            // ignore; fallback to text header
        }

        // debug log whether we found a kop and its source
        try {
            \Illuminate\Support\Facades\Log::info('laporanCutiPdf kop status', [
                'kop_present' => !empty($kopLogoData),
            ]);
        } catch (\Throwable $e) {
            // ignore logging failures
        }

        $html = view('direktur.laporan-cuti-pdf', ['rows' => $rows, 'period' => $periodLabel, 'query' => $q, 'kop_logo' => $kopLogoData])->render();

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="laporan_cuti_' . str_replace(' ', '_', $periodLabel) . '.pdf"');
    }

    public function riwayatPersetujuan()
    {
        return view('direktur.riwayat-persetujuan');
    }

    /**
     * =============================
     * REQUEST SURAT MAGANG (DIREKTUR)
     * =============================
     * 
     * Alur:
     * 1. Direktur lihat data magang
     * 2. Direktur klik "Request Surat"
     * 3. Form modal: input nomor surat + tanggal surat
     * 4. Admin menerima notif dan bisa preview surat
     */
    public function requestMagangSurat(Request $request, $magangId)
    {
        $magang = Magang::findOrFail($magangId);

        $validated = $request->validate([
            'nomor_surat_diminta' => 'required|string|max:100',
            'tanggal_surat_diminta' => 'required|date',
        ], [
            'nomor_surat_diminta.required' => 'Nomor surat harus diisi',
            'tanggal_surat_diminta.required' => 'Tanggal surat harus diisi',
        ]);

        // Update status ke "Permintaan Surat" dan simpan nomor + tanggal
        $magang->update([
            'status' => 'Permintaan Surat',
            'nomor_surat_diminta' => $validated['nomor_surat_diminta'],
            'tanggal_surat_diminta' => $validated['tanggal_surat_diminta'],
        ]);

        // TODO: Kirim notifikasi ke admin HRD
        // Notification::send($adminHRD, new MagangSuratRequested($magang));

        return response()->json([
            'ok' => true,
            'message' => 'Permintaan surat berhasil dikirim ke Admin HRD',
        ]);
    }
}

