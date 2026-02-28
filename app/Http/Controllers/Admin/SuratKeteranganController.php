<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeterangan;
use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
     * HELPER: GENERATE PDF
     * =============================
     */
    private function generatePdfSurat(SuratKeterangan $surat, $karyawan)
    {
        try {
            // Ensure directory exists
            if (!Storage::exists('public/surat-keterangan')) {
                Storage::makeDirectory('public/surat-keterangan');
            }
            
            // Get the public logo path
            $logoPath = public_path('img/kop_surat.png');
            
            // Render Blade template to HTML
            $html = view('surat.keterangan-kerja', [
                'surat' => $surat->toArray(),
                'karyawan' => $karyawan,
                'logoPath' => $logoPath,
            ])->render();

            // Generate PDF
            $pdf = Pdf::loadHTML($html)
                ->setPaper('A4', 'portrait');

            // Generate unique filename
            $fileName = 'surat-keterangan-' . $surat->id . '-' . Str::random(8) . '.pdf';
            $path = 'public/surat-keterangan/' . $fileName;

            // Save to storage
            Storage::put($path, $pdf->output());

            return 'surat-keterangan/' . $fileName;

        } catch (\Throwable $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            throw $e;
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
            'tanggal_diminta' => $request->tanggal_diminta ?? null,
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
                'user_id' => $user->id,
                'surat_keterangan_request_id' => $requestId,
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
                'jabatan' => $validated['jabatan'],
                'unit_kerja' => $validated['unit_kerja'],
                'tanggal_mulai_kerja' => $validated['tanggal_mulai_kerja'],
                'keterangan' => $validated['keterangan'] ?? null,
                'status' => 'Selesai',
            ]);

            // Load user relationship
            $surat->load('user');

            // Generate PDF
            $filePath = $this->generatePdfSurat($surat, $surat->user);
            
            // Update surat with file path
            $surat->update(['file_surat' => $filePath]);

            // Update request status to Completed
            $req->update(['status' => 'Completed']);

            return response()->json([
                'ok' => true,
                'message' => 'Surat berhasil dibuat',
                'surat_id' => $surat->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error creating surat: ' . $e->getMessage());
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
            // Create surat in database first
            $surat = SuratKeterangan::create([
                ...$validated,
                'status' => 'Selesai',
            ]);

            // Load user relationship
            $surat->load('user');

            // Generate PDF
            $filePath = $this->generatePdfSurat($surat, $surat->user);
            
            // Update surat with file path
            $surat->update(['file_surat' => $filePath]);

            return response()->json([
                'ok' => true,
                'message' => 'Surat keterangan berhasil dibuat',
                'id' => $surat->id,
            ]);

        } catch (\Throwable $e) {
            Log::error('Error Surat Keterangan: ' . $e->getMessage());

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

        $surat = SuratKeterangan::with('user.departemen')->findOrFail($id);

        // Mapping role ke jabatan default jika jabatan kosong
        $jabatanDefault = [
            'admin_hrd' => 'HRD Manager',
            'admin' => 'Administrator',
            'karyawan' => 'Staff',
            'karyawan_tetap' => 'Karyawan Tetap',
            'karyawan_kontrak' => 'Karyawan Kontrak',
        ];

        $jabatan = $surat->user->jabatan ?: ($jabatanDefault[$surat->user->role] ?? 'Staff');

        return response()->json([
            'ok' => true,
            'surat' => [
                'id' => $surat->id,
                'nama_karyawan' => $surat->user->name,
                'nomor_surat' => $surat->nomor_surat,
                'tanggal_surat' => optional($surat->tanggal_surat)->format('Y-m-d'),
                'jabatan' => $surat->jabatan,
                'unit_kerja' => $surat->unit_kerja,
                'tanggal_mulai_kerja' => optional($surat->tanggal_mulai_kerja)->format('Y-m-d'),
                'tanggal_selesai_kerja' => optional($surat->tanggal_selesai_kerja)->format('Y-m-d'),
                'keterangan' => $surat->keterangan ?? '',
                'status' => $surat->status,
                'file_url' => $surat->file_surat ? asset('storage/' . $surat->file_surat) : null,
                'user' => [
                    'name' => $surat->user->name,
                    'email' => $surat->user->email,
                    'jabatan' => $jabatan,
                    'departemen' => $surat->user->departemen ? $surat->user->departemen->nama : 'CV. Kurnia Jaya Teknik',
                ]
            ]
        ]);
    }



    /**
     * =============================
     * UPDATE - EDIT SURAT
     * =============================
     */
    public function update(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $surat = SuratKeterangan::findOrFail($id);

        // Validasi: tidak bisa edit jika sudah dikirim
        if ($surat->is_sent) {
            return response()->json([
                'ok' => false,
                'message' => 'Surat yang sudah dikirim tidak bisa diedit'
            ], 400);
        }

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'jabatan' => 'required|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'tanggal_mulai_kerja' => 'required|date',
            'tanggal_selesai_kerja' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        try {
            // Update data surat
            $surat->update($validated);
            
            // Reload user relationship
            $surat->load('user');

            // Regenerate PDF
            $filePath = $this->generatePdfSurat($surat, $surat->user);
            
            // Update file path
            $surat->update(['file_surat' => $filePath]);

            return response()->json([
                'ok' => true,
                'message' => 'Surat keterangan berhasil diperbarui',
                'surat' => $surat
            ]);
        } catch (\Throwable $e) {
            Log::error('Error Update Surat: ' . $e->getMessage());
            
            return response()->json([
                'ok' => false,
                'message' => 'Gagal memperbarui surat: ' . $e->getMessage()
            ], 500);
        }
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
            return response()->json([
                'ok' => false,
                'message' => 'File surat tidak ditemukan',
            ], 404);
        }

        $path = storage_path('app/public/' . $surat->file_surat);
        $pdfBase64 = base64_encode(file_get_contents($path));
        $downloadUrl = asset('storage/' . $surat->file_surat);

        return response()->json([
            'ok' => true,
            'pdfBase64' => $pdfBase64,
            'downloadUrl' => $downloadUrl,
        ]);
    }

    /**
     * =============================
     * SEND SURAT TO KARYAWAN
     * =============================
     */
    public function send($id)
    {
        $this->ensureAdminHRD();

        $surat = SuratKeterangan::findOrFail($id);

        try {
            // Send notification to karyawan
            $surat->user->notify(new \App\Notifications\SuratKeteranganSent($surat));

            // Update sent status
            $surat->update([
                'is_sent' => true,
                'sent_at' => now(),
                'sent_notes' => 'Dikirim oleh ' . Auth::user()->name . ' pada ' . now()->format('d/m/Y H:i:s'),
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Surat berhasil dikirim ke ' . $surat->user->name,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error sending surat keterangan: ' . $e->getMessage());

            return response()->json([
                'ok' => false,
                'message' => 'Gagal mengirim surat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * =============================
     * LIST SURAT YANG DIBUAT (API)
     * =============================
     */
    public function listDibuat()
    {
        $this->ensureAdminHRD();

        $suratList = SuratKeterangan::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'user' => [
                    'name' => $s->user->name,
                    'email' => $s->user->email,
                ],
                'nomor_surat' => $s->nomor_surat,
                'jabatan' => $s->jabatan,
                'tanggal_surat' => $s->tanggal_surat?->toDateString(),
                'file_surat' => $s->file_surat,
                'is_sent' => $s->is_sent,
                'sent_at' => $s->sent_at?->format('d/m/Y H:i'),
                'created_at' => $s->created_at?->format('d/m/Y H:i'),
            ]);

        return response()->json([
            'ok' => true,
            'data' => $suratList,
        ]);
    }

    /**
     * =============================
     * GET USER DETAIL
     * =============================
     */
    public function getUserDetail($id)
    {
        $this->ensureAdminHRD();

        $user = User::with('departemen')->findOrFail($id);

        // Mapping role ke jabatan default jika jabatan kosong
        $jabatanDefault = [
            'admin_hrd' => 'HRD Manager',
            'admin' => 'Administrator',
            'karyawan' => 'Staff',
            'karyawan_tetap' => 'Karyawan Tetap',
            'karyawan_kontrak' => 'Karyawan Kontrak',
        ];

        $jabatan = $user->jabatan ?: ($jabatanDefault[$user->role] ?? 'Staff');

        return response()->json([
            'ok' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'jabatan' => $jabatan,
                'departemen' => $user->departemen ? $user->departemen->nama : 'CV. Kurnia Jaya Teknik',
            ]
        ]);
    }
}

