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
        $suratPending = Surat::where('status', 'Pending')->count();

        // Overall status counts (for charts)
        $statusApproved = Cuti::where('status','Disetujui')->count() + Lembur::where('status','Disetujui')->count() + Surat::where('status','Disetujui')->count();
        $statusPending = Cuti::where('status','Pending')->count() + Lembur::where('status','Pending')->count() + Surat::where('status','Pending')->count();
        $statusRejected = Cuti::where('status','Ditolak')->count() + Lembur::where('status','Ditolak')->count() + Surat::where('status','Ditolak')->count();
        $statusTotal = $statusApproved + $statusPending + $statusRejected;

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

        // Additional metrics
        $hadirHariIni = Absensi::whereDate('tanggal', today())->where('status', 'Hadir')->count();

        $persetujuanSelesai = Cuti::where('status', 'Disetujui')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count()
            + Lembur::where('status', 'Disetujui')
                ->whereYear('tanggal_persetujuan', now()->year)
                ->whereMonth('tanggal_persetujuan', now()->month)
                ->count();

        $ditolakBulan = Cuti::where('status', 'Ditolak')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count() + Lembur::where('status', 'Ditolak')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count();

        $suratDikirim = Surat::whereNotNull('dikirim_at')->count();
        $suratDikirimBulan = Surat::whereNotNull('dikirim_at')
            ->whereYear('dikirim_at', now()->year)
            ->whereMonth('dikirim_at', now()->month)
            ->count();

        // tindakan penting: use pending approvals
        $tindakanDiperlukan = $pendingApprovals;

        // Pengajuan per bulan (last 6 months)
        $pengajuanPerBulan = collect();
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->copy()->subMonths($i);
            $count = Cuti::whereYear('tanggal_mulai', $m->year)->whereMonth('tanggal_mulai', $m->month)->count()
                + Lembur::whereYear('tanggal_mulai', $m->year)->whereMonth('tanggal_mulai', $m->month)->count();
            $pengajuanPerBulan->push(['label' => $m->format('M'), 'count' => $count]);
        }
        $totalPengajuan6 = $pengajuanPerBulan->sum('count');
        $maxPengajuan = max(1, $pengajuanPerBulan->max('count'));

        // Kehadiran per departemen (hari ini)
        $departemenStats = \App\Models\Departemen::orderBy('nama')->get()->map(function($d){
            $total = \App\Models\User::where('role','karyawan')->where('departemen_id',$d->id)->count();
            $present = \App\Models\Absensi::whereDate('tanggal', today())->where('status','Hadir')->whereHas('user', function($q) use ($d){ $q->where('departemen_id',$d->id); })->count();
            return ['nama' => $d->nama, 'present' => $present, 'total' => $total, 'pct' => $total ? round(($present/$total)*100,1) : 0];
        })->toArray();

        return [
            'totalKaryawan' => $totalKaryawan,
            'persentaseKehadiran' => $persentaseKehadiran,
            'pendingApprovals' => $pendingApprovals,
            'suratDiterbitkan' => $suratDiterbitkan,
            'suratPending' => $suratPending,
            'statusKaryawan' => $statusKaryawan,
            'jenisSurat' => $jenisSurat,
            'pengajuanMenunggu' => $pengajuanMenunggu,
            'cutiPending' => $cutiPending,
            'lemburPending' => $lemburPending,
            'hadirHariIni' => $hadirHariIni,
            'persetujuanSelesai' => $persetujuanSelesai,
            'suratDikirim' => $suratDikirim,
            'suratDikirimBulan' => $suratDikirimBulan,
            'tindakanDiperlukan' => $tindakanDiperlukan,
            'pengajuanPerBulan' => $pengajuanPerBulan->toArray(),
            'totalPengajuan6' => $totalPengajuan6,
            'maxPengajuan' => $maxPengajuan,
            'departemenStats' => $departemenStats,
            'ditolakBulan' => $ditolakBulan,
            // overall status for charts
            'statusApproved' => $statusApproved,
            'statusPending' => $statusPending,
            'statusRejected' => $statusRejected,
            'statusTotal' => $statusTotal,
        ];
    }
    }

    private function getAdminHRDData()
    {
        // Total karyawan
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // Hadir hari ini
        $hadirHariIni = Absensi::whereDate('tanggal', today())
            ->where('status', 'Hadir')
            ->count();

        // calculate monthly attendance percentage
        $totalHariKerja = now()->day;
        $totalAbsensi = Absensi::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->where('status', 'Hadir')
            ->count();
        $persentaseKehadiran = $totalKaryawan > 0 && $totalHariKerja > 0
            ? round(($totalAbsensi / ($totalKaryawan * $totalHariKerja)) * 100, 1)
            : 0;

        // Pengajuan disetujui bulan ini
        $pengajuanDisetujui = Cuti::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count() +
            Lembur::where('status', 'Disetujui')
            ->whereMonth('tanggal_persetujuan', now()->month)
            ->count();

        // Surat siap dikirim
        $suratSiapDikirim = Surat::where('status', 'Disetujui')->count();

        // Revisi / Ditolak
        $revisiCount = Cuti::where('status', 'Ditolak')->count() + Lembur::where('status', 'Ditolak')->count();

        // Surat menunggu (untuk card)
        $suratMenunggu = Surat::where('status', 'Pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        // pending counts
        $cutiPending = Cuti::where('status', 'Pending')->count();
        $lemburPending = Lembur::where('status', 'Pending')->count();
        $suratPending = Surat::where('status', 'Pending')->count();

        // overall status counts for charts
        $statusApproved = Cuti::where('status','Disetujui')->count() + Lembur::where('status','Disetujui')->count() + Surat::where('status','Disetujui')->count();
        $statusPending = Cuti::where('status','Pending')->count() + Lembur::where('status','Pending')->count() + Surat::where('status','Pending')->count();
        $statusRejected = Cuti::where('status','Ditolak')->count() + Lembur::where('status','Ditolak')->count() + Surat::where('status','Ditolak')->count();
        $statusTotal = $statusApproved + $statusPending + $statusRejected;

        return [
            'totalKaryawan' => $totalKaryawan,
            'hadirHariIni' => $hadirHariIni,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'suratSiapDikirim' => $suratSiapDikirim,
            'suratMenunggu' => $suratMenunggu,
            'cutiPending' => $cutiPending,
            'lemburPending' => $lemburPending,
            'suratPending' => $suratPending,
            'persentaseKehadiran' => $persentaseKehadiran,
            'revisiCount' => $revisiCount,
            'statusApproved' => $statusApproved,
            'statusPending' => $statusPending,
            'statusRejected' => $statusRejected,
            'statusTotal' => $statusTotal,
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

        // Lembur this month for user (count)
        $lemburBulanIni = \App\Models\Lembur::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // Last request status (cuti or lembur)
        $lastCuti = Cuti::where('user_id', $user->id)->latest()->first();
        $lastLembur = Lembur::where('user_id', $user->id)->latest()->first();
        $last = null;
        if ($lastCuti && $lastLembur) {
            $last = $lastCuti->created_at > $lastLembur->created_at ? $lastCuti : $lastLembur;
        } else {
            $last = $lastCuti ?: $lastLembur;
        }
        $lastRequestStatus = $last ? ($last->status ?? '') : 'Tidak Ada';

        // Attendance days for current month up to today
        $daysInMonth = now()->daysInMonth;
        $attendanceDays = [];
        $presentDaysThisMonth = 0;
        for ($d = 1; $d <= now()->day; $d++) {
            $date = now()->copy()->startOfMonth()->addDays($d - 1)->toDateString();
            $present = \App\Models\Absensi::where('user_id', $user->id)->whereDate('tanggal', $date)->where('status', 'Hadir')->exists();
            if ($present) $presentDaysThisMonth++;
            $attendanceDays[] = ['day' => $d, 'present' => $present];
        }

        return [
            'statusAbsensi' => $statusAbsensi,
            'sisaCuti' => $cutiRemaining,
            // use actual approved cuti sum for display
            'cutiDipakai' => $cutiDipakai,
            'lemburBulanIni' => $lemburBulanIni,
            'lastRequestStatus' => $lastRequestStatus,
            'attendanceDays' => $attendanceDays,
            'presentDaysThisMonth' => $presentDaysThisMonth,
            'daysInMonth' => $daysInMonth,
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
