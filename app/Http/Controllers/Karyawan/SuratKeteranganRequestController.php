<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\SuratKeteranganRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeteranganRequestController extends Controller
{
    /**
     * =============================
     * SHOW REQUEST PAGE
     * =============================
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's requests
        $requests = SuratKeteranganRequest::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('karyawan.surat-keterangan-request', compact('requests'));
    }

    /**
     * =============================
     * SUBMIT REQUEST
     * =============================
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        try {
            $validated = $request->validate([
                'alasan' => 'required|string|max:100',
                'keperluan' => 'required|string|max:500',
                'tanggal_diminta' => 'required|date_format:Y-m-d|after_or_equal:' . date('Y-m-d'),
            ], [
                'alasan.required' => 'Alasan permintaan harus diisi',
                'alasan.max' => 'Alasan maksimal 100 karakter',
                'keperluan.required' => 'Keperluan surat harus diisi',
                'keperluan.max' => 'Keperluan maksimal 500 karakter',
                'tanggal_diminta.required' => 'Tanggal yang diminta harus diisi',
                'tanggal_diminta.date_format' => 'Format tanggal harus YYYY-MM-DD',
                'tanggal_diminta.after_or_equal' => 'Tanggal harus hari ini atau lebih dari hari ini',
            ]);

            $suratRequest = SuratKeteranganRequest::create([
                'user_id' => $user->id,
                'alasan' => $validated['alasan'],
                'keperluan' => $validated['keperluan'],
                'tanggal_diminta' => $validated['tanggal_diminta'],
                'status' => 'Pending',
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Permintaan surat keterangan berhasil dikirim ke admin',
                'id' => $suratRequest->id,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Validation failed for surat request', ['errors' => $e->errors()]);
            
            return response()->json([
                'ok' => false,
                'message' => 'Validasi gagal. Periksa kembali data Anda.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            \Log::error('Error Request Surat Keterangan: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json([
                'ok' => false,
                'message' => 'Gagal mengirim permintaan surat keterangan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * =============================
     * CANCEL REQUEST
     * =============================
     */
    public function cancel($id)
    {
        $user = Auth::user();
        
        $request = SuratKeteranganRequest::findOrFail($id);

        // Only user who submitted can cancel
        if ($request->user_id !== $user->id) {
            return response()->json([
                'ok' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        // Only pending requests can be canceled
        if ($request->status !== 'Pending') {
            return response()->json([
                'ok' => false,
                'message' => 'Hanya permintaan yang pending yang bisa dibatalkan',
            ], 403);
        }

        $request->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Permintaan berhasil dibatalkan',
        ]);
    }

    /**
     * =============================
     * SHOW SURAT KETERANGAN PAGE
     * =============================
     */
    public function suratKeteranganIndex()
    {
        return view('karyawan.surat-keterangan');
    }

    /**
     * =============================
     * GET SURAT KETERANGAN RECEIVED (API)
     * =============================
     */
    public function getSuratReceived()
    {
        $user = Auth::user();

        // Get surat keterangan yang sudah dikirim ke user ini
        $suratList = \App\Models\SuratKeterangan::where('user_id', $user->id)
            ->where('is_sent', true)
            ->orderBy('sent_at', 'desc')
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'nomor_surat' => $s->nomor_surat,
                'jabatan' => $s->jabatan,
                'unit_kerja' => $s->unit_kerja,
                'tanggal_surat' => $s->tanggal_surat?->format('d/m/Y'),
                'sent_at' => $s->sent_at?->format('d/m/Y H:i'),
                'file_surat' => $s->file_surat,
                'file_url' => $s->file_surat ? asset('storage/' . $s->file_surat) : null,
                'download_url' => $s->file_surat ? asset('storage/' . $s->file_surat) : null,
                'keterangan' => $s->keterangan,
            ]);

        return response()->json([
            'ok' => true,
            'data' => $suratList,
        ]);
    }
}

