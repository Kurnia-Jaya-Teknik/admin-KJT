<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        // Get all cuti with user, delegated users, and surat reference
        $cutiList = Cuti::with(['user', 'user.departemen'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Enrich with delegated users and surat info
        $cutiList->transform(function($cuti) {
            // Add delegated users
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $cuti->delegated_users = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get(['id', 'name']);
            } else {
                $cuti->delegated_users = collect();
            }
            
            // Check if surat already created
            $surat = Surat::where('referensi_type', 'App\\Models\\Cuti')
                ->where('referensi_id', $cuti->id)
                ->first(['id', 'nomor_surat', 'status', 'created_at']);
            
            $cuti->surat = $surat;
            
            return $cuti;
        });
        
        return view('admin.cuti', compact('cutiList'));
    }

    public function list(Request $request)
    {
        $this->ensureAdminHRD();
        
        $cutiList = Cuti::with(['user', 'user.departemen'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Enrich with delegated users and surat info
        $cutiList->transform(function($cuti) {
            // Add delegated users
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $cuti->delegated_users = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get(['id', 'name']);
            } else {
                $cuti->delegated_users = collect();
            }
            
            // Check if surat already created
            $surat = Surat::where('referensi_type', 'App\\Models\\Cuti')
                ->where('referensi_id', $cuti->id)
                ->first(['id', 'nomor_surat', 'status', 'created_at']);
            
            $cuti->surat = $surat;
            
            // Add computed flag: apakah sudah bisa dibuat surat
            $cuti->can_create_surat = $cuti->status === 'Disetujui' && !$cuti->file_surat;
            
            return $cuti;
        });
        
        return response()->json(['ok' => true, 'list' => $cutiList]);
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

    public function buatSurat(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $cuti = Cuti::with('user')->find($id);
        
        if (!$cuti) {
            return response()->json(['ok' => false, 'message' => 'Cuti tidak ditemukan'], 404);
        }

        // Validate status
        if ($cuti->status !== 'Disetujui') {
            return response()->json(['ok' => false, 'message' => 'Cuti belum disetujui'], 400);
        }

        if ($cuti->file_surat) {
            return response()->json(['ok' => false, 'message' => 'Surat sudah dibuat sebelumnya'], 400);
        }

        // Validate request
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date'
        ]);

        try {
            // Get user data
            $karyawan = $cuti->user;
            $logoPath = public_path('img/kop_surat.png');

            // Get delegated users if any
            $delegatedUsers = collect();
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $delegatedUsers = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get();
            }

            // Prepare data for PDF
            $data = [
                'karyawan' => $karyawan,
                'cuti' => $cuti,
                'logoPath' => $logoPath,
                'delegatedUsers' => $delegatedUsers,
                'nomor_surat' => $validated['nomor_surat'],
                'tanggal_surat' => $validated['tanggal_surat'],
            ];

            // Generate PDF
            $pdf = Pdf::loadView('surat.cuti', $data);
            
            // Create directory if not exists
            $directory = storage_path('app/public/cuti');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Generate filename
            $filename = 'Surat_Cuti_' . str_replace(' ', '_', $karyawan->name) . '_' . time() . '.pdf';
            $filePath = 'cuti/' . $filename;
            $fullPath = storage_path('app/public/' . $filePath);

            // Save PDF
            $pdf->save($fullPath);

            // Update cuti with file_surat
            $cuti->file_surat = $filePath;
            $cuti->save();

            return response()->json([
                'ok' => true,
                'message' => 'Surat berhasil dibuat',
                'file_surat' => $filePath
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating cuti surat: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'message' => 'Gagal membuat surat: ' . $e->getMessage()
            ], 500);
        }
    }
}