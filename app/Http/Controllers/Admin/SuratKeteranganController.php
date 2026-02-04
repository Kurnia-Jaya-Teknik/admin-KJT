<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeterangan;
use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;

class SuratKeteranganController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403, 'Akses ditolak');
        }
    }

    /**
     * =============================
     * LIST SURAT KETERANGAN
     * =============================
     */
    public function index()
    {
        $this->ensureAdminHRD();

        $suratList = SuratKeterangan::with('user')
            ->orderBy('tanggal_surat', 'desc')
            ->paginate(10);

        // Ambil daftar karyawan untuk form modal
        $karyawanList = User::whereRole('karyawan')
            ->where('status', 'Aktif')
            ->orderBy('name')
            ->get();

        return view('admin.surat-keterangan', compact('suratList', 'karyawanList'));
    }

    /**
     * =============================
     * CREATE - TAMPILKAN FORM
     * =============================
     */
    public function create()
    {
        $this->ensureAdminHRD();
        
        // Ambil daftar karyawan
        $karyawanList = User::whereRole('karyawan')
            ->where('status', 'Aktif')
            ->orderBy('name')
            ->get();

        return view('admin.surat-keterangan-create', compact('karyawanList'));
    }

    /**
     * =============================
     * PENDING REQUESTS
     * =============================
     */
    public function pendingRequests()
    {
        $this->ensureAdminHRD();

        $requests = SuratKeteranganRequest::with('user')
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($requests->map(fn($r) => [
            'id' => $r->id,
            'user' => [
                'name' => $r->user->name,
                'email' => $r->user->email,
            ],
            'alasan' => $r->alasan,
            'keperluan' => $r->keperluan,
            'tanggal_diminta' => $r->tanggal_diminta?->toDateString(),
            'created_at' => $r->created_at->toDateString(),
        ]));
    }

    /**
     * =============================
     * APPROVE REQUEST
     * =============================
     */
    public function approveRequest($id)
    {
        $this->ensureAdminHRD();

        $request = SuratKeteranganRequest::findOrFail($id);

        // Update status
        $request->update(['status' => 'Approved']);

        return response()->json([
            'ok' => true,
            'message' => 'Permintaan berhasil disetujui',
        ]);
    }

    /**
     * =============================
     * GET REQUEST DETAIL
     * =============================
     */
    public function getRequest($id)
    {
        $this->ensureAdminHRD();

        $request = SuratKeteranganRequest::with('user')->findOrFail($id);

        return response()->json([
            'id' => $request->id,
            'user' => [
                'name' => $request->user->name,
                'email' => $request->user->email,
                'id' => $request->user->id,
            ],
            'alasan' => $request->alasan,
            'keperluan' => $request->keperluan,
            'tanggal_diminta' => $request->tanggal_diminta?->toDateString(),
            'status' => $request->status,
        ]);
    }

    /**
     * =============================
     * CREATE SURAT FROM REQUEST
     * =============================
     */
    public function createSuratFromRequest(Request $request, $requestId)
    {
        $this->ensureAdminHRD();

        $req = SuratKeteranganRequest::findOrFail($requestId);
        $user = $req->user;

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'jabatan' => 'required|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'tanggal_mulai_kerja' => 'required|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            // Create surat keterangan
            $surat = SuratKeterangan::create([
                'user_id' => Auth::id(),
                'surat_keterangan_request_id' => $requestId,
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
                'jabatan' => $validated['jabatan'],
                'unit_kerja' => $validated['unit_kerja'],
                'tanggal_mulai_kerja' => $validated['tanggal_mulai_kerja'],
                'keterangan' => $validated['keterangan'] ?? null,
                'status' => 'Selesai',
            ]);

            // Update request status to Completed
            $req->update(['status' => 'Completed']);

            return response()->json([
                'ok' => true,
                'message' => 'Surat berhasil dibuat',
                'surat_id' => $surat->id,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Error creating surat: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'message' => 'Gagal membuat surat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * =============================
     * REJECT REQUEST
     * =============================
     */
    public function rejectRequest($id)
    {
        $this->ensureAdminHRD();

        $request = SuratKeteranganRequest::findOrFail($id);

        // Update status
        $request->update(['status' => 'Rejected']);

        return response()->json([
            'ok' => true,
            'message' => 'Permintaan ditolak',
        ]);
    }

    /**
     * =============================
     * STORE - SIMPAN SURAT
     * =============================
     */
    public function store(Request $request)
    {
        $this->ensureAdminHRD();

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nomor_surat' => 'required|string|max:100|unique:surat_keterangans',
            'tanggal_surat' => 'required|date',
            'jabatan' => 'required|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'tanggal_mulai_kerja' => 'required|date',
            'tanggal_selesai_kerja' => 'nullable|date|after:tanggal_mulai_kerja',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            // Generate PDF
            $user = User::findOrFail($validated['user_id']);
            
            $html = view('surat.keterangan-kerja', [
                'karyawan' => $user,
                'surat' => $validated,
                'logoPath' => public_path('img/image.png'),
            ])->render();

            $dompdf = new Dompdf([
                'chroot' => public_path(),
                'isHtml5ParserEnabled' => true,
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Simpan file
            $fileName = 'Surat_Keterangan_' . str_replace(' ', '_', $user->name) . '_' . time() . '.pdf';
            $path = storage_path('app/public/keterangan/' . $fileName);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            file_put_contents($path, $dompdf->output());

            // Simpan ke database
            $surat = SuratKeterangan::create([
                ...$validated,
                'file_surat' => 'keterangan/' . $fileName,
                'status' => 'Selesai',
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Surat keterangan berhasil dibuat',
                'id' => $surat->id,
                'url' => asset('storage/keterangan/' . $fileName),
            ]);

        } catch (\Throwable $e) {
            \Log::error('Error Surat Keterangan: ' . $e->getMessage());

            return response()->json([
                'ok' => false,
                'message' => 'Gagal membuat surat keterangan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * =============================
     * SHOW - LIHAT DETAIL
     * =============================
     */
    public function show($id)
    {
        $this->ensureAdminHRD();

        $surat = SuratKeterangan::with('user')->findOrFail($id);

        return response()->json([
            'ok' => true,
            'data' => [
                'id' => $surat->id,
                'nama_karyawan' => $surat->user->name,
                'nomor_surat' => $surat->nomor_surat,
                'tanggal_surat' => optional($surat->tanggal_surat)->format('d/m/Y'),
                'jabatan' => $surat->jabatan,
                'unit_kerja' => $surat->unit_kerja,
                'tanggal_mulai' => optional($surat->tanggal_mulai_kerja)->format('d/m/Y'),
                'tanggal_selesai' => optional($surat->tanggal_selesai_kerja)->format('d/m/Y'),
                'status' => $surat->status,
                'file_url' => $surat->file_surat ? asset('storage/' . $surat->file_surat) : null,
            ]
        ]);
    }

    /**
     * =============================
     * DELETE - HAPUS SURAT
     * =============================
     */
    public function destroy($id)
    {
        $this->ensureAdminHRD();

        $surat = SuratKeterangan::findOrFail($id);
        
        // Hapus file jika ada
        if ($surat->file_surat && file_exists(storage_path('app/public/' . $surat->file_surat))) {
            unlink(storage_path('app/public/' . $surat->file_surat));
        }

        $surat->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Surat keterangan berhasil dihapus',
        ]);
    }

    /**
     * =============================
     * PREVIEW PDF
     * =============================
     */
    public function preview($id)
    {
        $this->ensureAdminHRD();

        $surat = SuratKeterangan::findOrFail($id);

        if (!$surat->file_surat || !file_exists(storage_path('app/public/' . $surat->file_surat))) {
            abort(404, 'File surat tidak ditemukan');
        }

        $path = storage_path('app/public/' . $surat->file_surat);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
        ]);
    }
}
