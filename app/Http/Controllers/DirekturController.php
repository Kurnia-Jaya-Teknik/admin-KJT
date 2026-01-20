<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Lembur;
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

    public function riwayatPersetujuan()
    {
        return view('direktur.riwayat-persetujuan');
    }
}
