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

        // Total hadir hari ini (untuk persentase)
        $totalKaryawanHariIni = Absensi::whereDate('tanggal', today())->count();
        $persentaseHadirHariIni = $totalKaryawanHariIni > 0 ? round(($hadirHariIni / $totalKaryawan) * 100, 1) : 0;

        // Pengajuan pending (cuti + lembur)
        $cutiPending = Cuti::where('status', 'Pending')->count();
        $lemburPending = Lembur::where('status', 'Pending')->count();
        $totalPending = $cutiPending + $lemburPending;

        // Pengajuan disetujui bulan ini
        $pengajuanDisetujui = Cuti::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count() +
            Lembur::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count();

        // Surat per status
        $suratPending = Surat::where('status', 'Draft')->count() + Surat::where('status', 'Menunggu Persetujuan')->count();
        $suratDisetujui = Surat::where('status', 'Disetujui')->count();
        $suratDiterbitkan = Surat::where('status', 'Diterbitkan')->count();
        $suratDitolak = Surat::where('status', 'Ditolak')->count();

        // Surat menunggu (untuk card)
        $suratMenunggu = Surat::whereIn('status', ['Draft', 'Menunggu Persetujuan'])
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        // Kehadiran per divisi hari ini
        $kehadiranPerDivisi = DB::table('users')
            ->join('absensi', 'users.id', '=', 'absensi.user_id')
            ->join('departemen', 'users.departemen_id', '=', 'departemen.id')
            ->where('users.role', 'karyawan')
            ->whereDate('absensi.tanggal', today())
            ->select('departemen.nama', DB::raw('COUNT(*) as total'))
            ->groupBy('departemen.nama')
            ->pluck('total', 'departemen.nama')
            ->toArray();

        // Total kehadiran per divisi (semua karyawan)
        $totalPerDivisi = User::where('role', 'karyawan')
            ->join('departemen', 'users.departemen_id', '=', 'departemen.id')
            ->select('departemen.nama', DB::raw('COUNT(*) as total'))
            ->groupBy('departemen.nama')
            ->pluck('total', 'departemen.nama')
            ->toArray();

        // Data untuk chart kehadiran per divisi (format untuk view)
        $chartKehadiran = [];
        foreach ($totalPerDivisi as $divisi => $total) {
            $hadir = $kehadiranPerDivisi[$divisi] ?? 0;
            $chartKehadiran[$divisi] = [
                'hadir' => $hadir,
                'total' => $total,
                'persentase' => $total > 0 ? round(($hadir / $total) * 100, 1) : 0,
            ];
        }

        // Data pengajuan per bulan (6 bulan terakhir)
        $pengajuanPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $countCuti = Cuti::whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            $countLembur = Lembur::whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            $pengajuanPerBulan[$bulan->format('M')] = $countCuti + $countLembur;
        }

        // Status pengajuan (total)
        $totalApproved = Cuti::where('status', 'Disetujui')->count() + Lembur::where('status', 'Disetujui')->count();
        $totalPendingAll = Cuti::where('status', 'Pending')->count() + Lembur::where('status', 'Pending')->count();
        $totalRejected = Cuti::where('status', 'Ditolak')->count() + Lembur::where('status', 'Ditolak')->count();

        return [
            'totalKaryawan' => $totalKaryawan,
            'hadirHariIni' => $hadirHariIni,
            'persentaseHadirHariIni' => $persentaseHadirHariIni,
            'cutiPending' => $cutiPending,
            'lemburPending' => $lemburPending,
            'totalPending' => $totalPending,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'suratPending' => $suratPending,
            'suratDisetujui' => $suratDisetujui,
            'suratDiterbitkan' => $suratDiterbitkan,
            'suratDitolak' => $suratDitolak,
            'suratMenunggu' => $suratMenunggu,
            'chartKehadiran' => $chartKehadiran,
            'pengajuanPerBulan' => $pengajuanPerBulan,
            'totalApproved' => $totalApproved,
            'totalPendingAll' => $totalPendingAll,
            'totalRejected' => $totalRejected,
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

        // Cuti yang sudah dipakai tahun ini (sum durasi_hari dari cuti disetujui)
        $cutiDipakai = Cuti::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->sum('durasi_hari');

        // Count per-status for cuti (this year)
        $cutiApprovedCount = Cuti::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->count();
        $cutiPendingCount = Cuti::where('user_id', $user->id)->where('status', 'Pending')->count();
        $cutiRejectedCount = Cuti::where('user_id', $user->id)->where('status', 'Ditolak')->count();

        // Pengajuan disetujui (total)
        $pengajuanDisetujui = $cutiApprovedCount +
            Lembur::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->count();

        // Pengajuan menunggu (pending)
        $pendingRequests = Cuti::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->count() +
            Lembur::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->count();

        // Status kontrak
        $statusKontrak = $user->status_kontrak ?? 'PKWTT';

        // Use configured yearly entitlement as the fixed total (company policy)
        $cutiEntitlement = config('leave.cuti_tahunan_default', 20);

        // Remaining is taken from user.sisa_cuti (source of truth)
        $cutiRemaining = $sisaCuti ?? 0;

        // Derive used for display convenience
        $cutiUsed = max(0, $cutiEntitlement - $cutiRemaining);

        return [
            'statusAbsensi' => $statusAbsensi,
            'sisaCuti' => $cutiRemaining,
            // use actual approved cuti sum for display
            'cutiDipakai' => $cutiDipakai,
            'cutiApprovedCount' => $cutiApprovedCount,
            'cutiPendingCount' => $cutiPendingCount,
            'cutiRejectedCount' => $cutiRejectedCount,
            'cutiEntitlement' => $cutiEntitlement,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'pendingRequests' => $pendingRequests,
            'statusKontrak' => $statusKontrak,
        ];
    }
}
