<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $data = [
            'user' => $user,
        ];

        if ($role === 'direktur') {
            $data = array_merge($data, $this->getDirekturData());
        } elseif ($role === 'admin_hrd') {
            $data = array_merge($data, $this->getAdminHRDData());
        } else {
            $data = array_merge($data, $this->getKaryawanData($user));
        }

        return view('dashboard', $data);
    }

    private function getDirekturData()
    {
        // Total karyawan
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // Kehadiran bulan ini
        $bulanIni = now()->format('Y-m');
        $totalHariKerja = now()->day;
        $totalAbsensi = Absensi::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->where('status', 'Hadir')
            ->count();
        $totalKaryawanAktif = User::where('role', 'karyawan')->count();
        $persentaseKehadiran = $totalKaryawanAktif > 0 && $totalHariKerja > 0
            ? round(($totalAbsensi / ($totalKaryawanAktif * $totalHariKerja)) * 100, 1)
            : 0;

        // Pengajuan menunggu persetujuan
        $cutiPending = Cuti::where('status', 'Pending')->count();
        $lemburPending = Lembur::where('status', 'Pending')->count();
        $pendingApprovals = $cutiPending + $lemburPending;

        // Surat diterbitkan
        $suratDiterbitkan = Surat::where('status', 'Diterbitkan')->count();

        // Status karyawan
        $statusKaryawan = User::where('role', 'karyawan')
            ->select('status_kontrak', DB::raw('count(*) as total'))
            ->groupBy('status_kontrak')
            ->pluck('total', 'status_kontrak')
            ->toArray();

        // Jenis surat terbit
        $jenisSurat = Surat::where('status', 'Diterbitkan')
            ->select('jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis')
            ->pluck('total', 'jenis')
            ->toArray();

        // Pengajuan untuk tabel
        $pengajuanMenunggu = collect()
            ->merge(
                Cuti::where('status', 'Pending')
                    ->with('user')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($cuti) {
                        return [
                            'nama' => $cuti->user->name,
                            'jenis' => $cuti->jenis,
                            'durasi' => $cuti->durasi_hari . ' hari',
                            'tanggal' => $cuti->created_at->format('d M Y'),
                            'type' => 'cuti',
                            'id' => $cuti->id,
                        ];
                    })
            )
            ->merge(
                Lembur::where('status', 'Pending')
                    ->with('user')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($lembur) {
                        return [
                            'nama' => $lembur->user->name,
                            'jenis' => 'Lembur',
                            'durasi' => $lembur->durasi_jam . ' jam',
                            'tanggal' => $lembur->created_at->format('d M Y'),
                            'type' => 'lembur',
                            'id' => $lembur->id,
                        ];
                    })
            )
            ->sortByDesc('tanggal')
            ->take(5);

        return [
            'totalKaryawan' => $totalKaryawan,
            'persentaseKehadiran' => $persentaseKehadiran,
            'pendingApprovals' => $pendingApprovals,
            'suratDiterbitkan' => $suratDiterbitkan,
            'statusKaryawan' => $statusKaryawan,
            'jenisSurat' => $jenisSurat,
            'pengajuanMenunggu' => $pengajuanMenunggu,
        ];
    }

    private function getAdminHRDData()
    {
        // Total karyawan
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // Hadir hari ini
        $hadirHariIni = Absensi::whereDate('tanggal', today())
            ->where('status', 'Hadir')
            ->count();

        // Pengajuan disetujui bulan ini
        $pengajuanDisetujui = Cuti::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count() +
            Lembur::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count();

        // Surat siap dikirim
        $suratSiapDikirim = Surat::where('status', 'Disetujui')->count();

        // Surat menunggu (untuk card)
        $suratMenunggu = Surat::where('status', 'Pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return [
            'totalKaryawan' => $totalKaryawan,
            'hadirHariIni' => $hadirHariIni,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'suratSiapDikirim' => $suratSiapDikirim,
            'suratMenunggu' => $suratMenunggu,
        ];
    }

    private function getKaryawanData($user)
    {
        // Status absensi hari ini
        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();
        $statusAbsensi = $absensiHariIni ? $absensiHariIni->status : 'Belum Absen';

        // Sisa cuti
        $sisaCuti = $user->sisa_cuti ?? 12;

        // Pengajuan disetujui
        $pengajuanDisetujui = Cuti::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->count() +
            Lembur::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->count();

        // Status kontrak
        $statusKontrak = $user->status_kontrak ?? 'PKWTT';

        return [
            'statusAbsensi' => $statusAbsensi,
            'sisaCuti' => $sisaCuti,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'statusKontrak' => $statusKontrak,
        ];
    }
}
