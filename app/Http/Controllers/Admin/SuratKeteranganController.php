<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeterangan;
use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            // Generate PDF
            $html = view('surat.keterangan-kerja', [
                'karyawan' => $user,
                'surat' => array_merge($validated, [
                    'tanggal_selesai_kerja' => null,
                    'user_id' => $user->id,
                ]),
                'logoPath' => public_path('img/image.png'),
            ])->render();

            // Generate PDF using Laravel DomPDF
            $pdf = Pdf::loadHTML($html)
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'chroot' => public_path(),
                    'isHtml5ParserEnabled' => true,
                ]);

            // Create file name using $user (not $surat which doesn't exist yet)
            $fileName = 'Surat_Keterangan_' . str_replace(' ', '_', $user->name) . '_' . time() . '.pdf';
            $path = storage_path('app/public/keterangan/' . $fileName);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $pdf->save($path);

            // Create surat keterangan dengan file_surat
            $surat = SuratKeterangan::create([
                'user_id' => $user->id,
                'surat_keterangan_request_id' => $requestId,
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
                'jabatan' => $validated['jabatan'],
                'unit_kerja' => $validated['unit_kerja'],
                'tanggal_mulai_kerja' => $validated['tanggal_mulai_kerja'],
                'keterangan' => $validated['keterangan'] ?? null,
                'file_surat' => 'keterangan/' . $fileName,
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

            // Generate PDF using Laravel DomPDF
            $pdf = Pdf::loadHTML($html)
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'chroot' => public_path(),
                    'isHtml5ParserEnabled' => true,
                ]);

            // Simpan file
            $fileName = 'Surat_Keterangan_' . str_replace(' ', '_', $user->name) . '_' . time() . '.pdf';
            $path = storage_path('app/public/keterangan/' . $fileName);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $pdf->save($path);

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

        // Update data surat
        $surat->update($validated);

        try {
            // Regenerate PDF dengan data yang baru
            $html = view('surat.keterangan-kerja', [
                'karyawan' => $surat->user,
                'surat' => $surat->toArray(),
                'logoPath' => public_path('img/image.png'),
            ])->render();

            $pdf = Pdf::loadHTML($html)
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'chroot' => public_path(),
                    'isHtml5ParserEnabled' => true,
                ]);

            // Hapus file lama jika ada
            if ($surat->file_surat && file_exists(storage_path('app/public/' . $surat->file_surat))) {
                unlink(storage_path('app/public/' . $surat->file_surat));
            }

            // Simpan file PDF baru
            $fileName = 'Surat_Keterangan_' . str_replace(' ', '_', $surat->user->name) . '_' . time() . '.pdf';
            $path = storage_path('app/public/keterangan/' . $fileName);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $pdf->save($path);

            // Update path file surat di database
            $surat->update([
                'file_surat' => 'keterangan/' . $fileName,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Gagal regenerate PDF: ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'ok' => true,
            'message' => 'Surat keterangan berhasil diperbarui',
            'surat' => $surat
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
            \Log::error('Error sending surat keterangan: ' . $e->getMessage());

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

