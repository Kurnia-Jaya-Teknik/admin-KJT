<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
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
        
        // Get all cuti with user and departemen
        $cutiList = Cuti::with(['user', 'user.departemen'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate statistics
        $totalPengajuan = $cutiList->count();
        $menungguPersetujuan = $cutiList->where('status', 'Pending')->count();
        $disetujui = $cutiList->where('status', 'Disetujui')->count();
        $ditolak = $cutiList->where('status', 'Ditolak')->count();
        
        // Collect all approver IDs and delegated user IDs upfront to avoid N+1
        $approverIds = $cutiList->pluck('disetujui_oleh')->filter()->unique();
        $approvers = \App\Models\User::whereIn('id', $approverIds)->get(['id', 'name', 'email'])->keyBy('id');
        
        // Get all delegated user IDs
        $allDelegatedIds = [];
        foreach ($cutiList as $cuti) {
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $allDelegatedIds = array_merge($allDelegatedIds, $cuti->dilimpahkan_ke);
            }
        }
        $allDelegatedIds = array_unique($allDelegatedIds);
        $delegatedUsers = \App\Models\User::whereIn('id', $allDelegatedIds)->get(['id', 'name'])->keyBy('id');
        
        // Get all surat references at once
        $cutiIds = $cutiList->pluck('id');
        $suratList = Surat::where('referensi_type', 'App\\Models\\Cuti')
            ->whereIn('referensi_id', $cutiIds)
            ->get(['id', 'nomor_surat', 'status', 'created_at', 'referensi_id'])
            ->keyBy('referensi_id');
        
        // Enrich cuti list
        $cutiList->transform(function($cuti) use ($approvers, $delegatedUsers, $suratList) {
            // Add approver
            if ($cuti->disetujui_oleh && isset($approvers[$cuti->disetujui_oleh])) {
                $cuti->approver = $approvers[$cuti->disetujui_oleh];
            }
            
            // Add delegated users
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $cuti->delegated_users = collect($cuti->dilimpahkan_ke)
                    ->map(fn($id) => $delegatedUsers[$id] ?? null)
                    ->filter();
            } else {
                $cuti->delegated_users = collect();
            }
            
            // Add surat
            $cuti->surat = $suratList[$cuti->id] ?? null;
            
            return $cuti;
        });
        
        return view('admin.cuti', compact('cutiList', 'totalPengajuan', 'menungguPersetujuan', 'disetujui', 'ditolak'));
    }

    public function list(Request $request)
    {
        $this->ensureAdminHRD();
        
        $cutiList = Cuti::with(['user', 'user.departemen'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Collect all approver IDs and delegated user IDs upfront to avoid N+1
        $approverIds = $cutiList->pluck('disetujui_oleh')->filter()->unique();
        $approvers = \App\Models\User::whereIn('id', $approverIds)->get(['id', 'name', 'email'])->keyBy('id');
        
        // Get all delegated user IDs
        $allDelegatedIds = [];
        foreach ($cutiList as $cuti) {
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $allDelegatedIds = array_merge($allDelegatedIds, $cuti->dilimpahkan_ke);
            }
        }
        $allDelegatedIds = array_unique($allDelegatedIds);
        $delegatedUsers = \App\Models\User::whereIn('id', $allDelegatedIds)->get(['id', 'name'])->keyBy('id');
        
        // Get all surat references at once
        $cutiIds = $cutiList->pluck('id');
        $suratList = Surat::where('referensi_type', 'App\\Models\\Cuti')
            ->whereIn('referensi_id', $cutiIds)
            ->get(['id', 'nomor_surat', 'status', 'created_at', 'referensi_id'])
            ->keyBy('referensi_id');
        
        // Enrich cuti list
        $cutiList->transform(function($cuti) use ($approvers, $delegatedUsers, $suratList) {
            // Add approver
            if ($cuti->disetujui_oleh && isset($approvers[$cuti->disetujui_oleh])) {
                $cuti->approver = $approvers[$cuti->disetujui_oleh];
            }
            
            // Add delegated users
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $cuti->delegated_users = collect($cuti->dilimpahkan_ke)
                    ->map(fn($id) => $delegatedUsers[$id] ?? null)
                    ->filter();
            } else {
                $cuti->delegated_users = collect();
            }
            
            // Add surat
            $cuti->surat = $suratList[$cuti->id] ?? null;
            
            return $cuti;
        });
        
        return response()->json(['ok' => true, 'list' => $cutiList]);
    }

<<<<<<< Updated upstream
=======
    public function store(Request $request)
    {
        $this->ensureAdminHRD();

        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'jenis' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'alasan' => 'required|string',
                'status' => 'required|in:Pending,Disetujui,Ditolak',
            ]);

            // Calculate duration
            $start = new \DateTime($request->tanggal_mulai);
            $end = new \DateTime($request->tanggal_selesai);
            $durasi = $start->diff($end)->days + 1;

            // Create cuti
            $cuti = Cuti::create([
                'user_id' => $request->user_id,
                'jenis' => $request->jenis,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'durasi' => $durasi . ' Hari',
                'alasan' => $request->alasan,
                'status' => $request->status,
                'disetujui_oleh' => $request->status === 'Disetujui' ? Auth::id() : null,
                'tanggal_persetujuan' => $request->status === 'Disetujui' ? now() : null,
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Pengajuan cuti berhasil ditambahkan',
                'cuti' => $cuti
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

>>>>>>> Stashed changes
    public function preview($id)
    {
        $this->ensureAdminHRD();

<<<<<<< Updated upstream
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

    public function show($id)
    {
        $this->ensureAdminHRD();

        $cuti = Cuti::with(['user', 'user.departemen'])->find($id);
        
        if (!$cuti) {
            return response()->json(['ok' => false, 'message' => 'Cuti tidak ditemukan'], 404);
        }

        return response()->json([
            'ok' => true,
            'cuti' => $cuti
        ]);
    }
}
=======
        try {
            $cuti = Cuti::with(['user', 'user.departemen'])->findOrFail($id);

            // Check if approved
            if ($cuti->status !== 'Disetujui') {
                return response('<div class="text-center text-amber-500 py-12">
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p>Hanya bisa preview surat yang sudah disetujui</p>
                </div>', 200);
            }

            // Get direktur/approver
            $approver = $cuti->disetujui_oleh ? \App\Models\User::find($cuti->disetujui_oleh) : null;

            // Generate surat preview HTML
            $html = view('templates.surat-cuti-preview', [
                'cuti' => $cuti,
                'approver' => $approver
            ])->render();

            return response($html, 200);
        } catch (\Exception $e) {
            return response('<div class="text-center text-red-500 py-12">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>' . $e->getMessage() . '</p>
            </div>', 500);
        }
    }

    public function detail($id)
    {
        $this->ensureAdminHRD();

        try {
            $cuti = Cuti::with(['user', 'user.departemen'])->findOrFail($id);

            return response()->json([
                'id' => $cuti->id,
                'user' => [
                    'id' => $cuti->user->id,
                    'name' => $cuti->user->name,
                    'nik' => $cuti->user->nik,
                    'jabatan' => $cuti->user->jabatan,
                    'departemen' => [
                        'id' => $cuti->user->departemen->id ?? null,
                        'nama' => $cuti->user->departemen->nama ?? '-'
                    ]
                ],
                'jenis' => $cuti->jenis,
                'tanggal_mulai' => $cuti->tanggal_mulai,
                'tanggal_selesai' => $cuti->tanggal_selesai,
                'durasi' => $cuti->durasi,
                'alasan' => $cuti->alasan,
                'status' => $cuti->status,
                'dilimpahkan_ke' => $cuti->dilimpahkan_ke,
                'created_at' => $cuti->created_at,
                'tanggal_persetujuan' => $cuti->tanggal_persetujuan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdminHRD();

        try {
            $cuti = Cuti::findOrFail($id);

            // Validate request
            $request->validate([
                'jenis' => 'nullable|string',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'alasan' => 'nullable|string',
            ]);

            // Update cuti data
            if ($request->has('jenis')) {
                $cuti->jenis = $request->jenis;
            }
            if ($request->has('tanggal_mulai')) {
                $cuti->tanggal_mulai = $request->tanggal_mulai;
            }
            if ($request->has('tanggal_selesai')) {
                $cuti->tanggal_selesai = $request->tanggal_selesai;
            }
            if ($request->has('alasan')) {
                $cuti->alasan = $request->alasan;
            }

            // Recalculate duration if dates changed
            if ($request->has('tanggal_mulai') || $request->has('tanggal_selesai')) {
                $start = new \DateTime($cuti->tanggal_mulai);
                $end = new \DateTime($cuti->tanggal_selesai);
                $durasi = $start->diff($end)->days + 1;
                $cuti->durasi = $durasi . ' Hari';
            }

            $cuti->save();

            return response()->json([
                'ok' => true,
                'message' => 'Data cuti berhasil diupdate',
                'cuti' => $cuti
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
>>>>>>> Stashed changes
