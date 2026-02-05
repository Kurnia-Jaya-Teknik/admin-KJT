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
    }}