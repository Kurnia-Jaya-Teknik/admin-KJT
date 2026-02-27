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
            return view('dashboard-direktur', $data);
        } elseif ($role === 'admin_hrd') {
            $data = array_merge($data, $this->getAdminHRDData());
            return view('dashboard-admin', $data);
        } else {
            $data = array_merge($data, $this->getKaryawanData($user));
            return view('dashboard-karyawan', $data);
        }
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

        // Surat per status
        $suratPending = Surat::whereIn('status', ['Draft', 'Menunggu Persetujuan'])->count();
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

        // Pengajuan per bulan (last 6 months)
        $pengajuanPerBulan = collect();
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->copy()->subMonths($i)->locale('id');
            $count = Cuti::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count()
                + Lembur::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count();
            // Format: Sep 25 atau Feb 26 (bulan + tahun 2 digit)
            $label = $m->isoFormat('MMM YY');
            $pengajuanPerBulan->push(['label' => $label, 'count' => $count]);
        }
        $totalPengajuan6 = $pengajuanPerBulan->sum('count');
        $maxPengajuan = max(1, $pengajuanPerBulan->max('count'));

        // Kehadiran per departemen (hari ini)
        $departemenStats = \App\Models\Departemen::orderBy('nama')->get()->map(function($d){
            $total = \App\Models\User::where('role','karyawan')->where('departemen_id',$d->id)->count();
            $present = \App\Models\Absensi::whereDate('tanggal', today())->where('status','Hadir')->whereHas('user', function($q) use ($d){ $q->where('departemen_id',$d->id); })->count();
            return ['nama' => $d->nama, 'present' => $present, 'total' => $total, 'pct' => $total ? round(($present/$total)*100,1) : 0];
        })->toArray();

        // Lembur per departemen (bulan ini)
        $lemburPerDepartemen = \App\Models\Departemen::orderBy('nama')->get()->map(function($d){
            $totalJam = Lembur::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->whereHas('user', function($q) use ($d){ $q->where('departemen_id',$d->id); })
                ->sum('durasi_jam');
            return ['nama' => $d->nama, 'total_jam' => $totalJam];
        })->filter(function($item){ return $item['total_jam'] > 0; })->values()->toArray();
        
        $maxLemburJam = collect($lemburPerDepartemen)->max('total_jam') ?: 1;
        $totalLemburBulanIni = collect($lemburPerDepartemen)->sum('total_jam');

        // overall status counts for charts
        $statusApproved = Cuti::where('status','Disetujui')->count() + Lembur::where('status','Disetujui')->count() + Surat::where('status','Disetujui')->count();
        $statusPending = Cuti::where('status','Pending')->count() + Lembur::where('status','Pending')->count() + Surat::where('status','Pending')->count();
        $statusRejected = Cuti::where('status','Ditolak')->count() + Lembur::where('status','Ditolak')->count() + Surat::where('status','Ditolak')->count();
        $statusTotal = $statusApproved + $statusPending + $statusRejected;

        // Karyawan Perlu Perhatian
        $karyawanPerluPerhatian = collect();
        
        // 1. Karyawan sedang cuti panjang (> 3 hari)
        $cutiPanjang = Cuti::where('status', 'Disetujui')
            ->where('durasi_hari', '>', 3)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->with('user.departemen')
            ->take(2)
            ->get()
            ->map(fn($c) => [
                'nama' => $c->user->name ?? 'N/A',
                'departemen' => $c->user->departemen->nama ?? 'N/A',
                'badge' => 'Cuti Panjang',
                'badge_color' => 'blue',
                'keterangan' => 'Cuti ' . $c->durasi_hari . ' hari (' . \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M') . ' - ' . \Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y') . ')',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($cutiPanjang);

        // 2. Karyawan dengan status kontrak PKWT
        $karyawanPKWT = User::where('role', 'karyawan')
            ->where('status_kontrak', 'PKWT')
            ->with('departemen')
            ->limit(2)
            ->get()
            ->map(fn($u) => [
                'nama' => $u->name,
                'departemen' => $u->departemen->nama ?? 'N/A',
                'badge' => 'Status Kontrak',
                'badge_color' => 'yellow',
                'keterangan' => 'Karyawan kontrak (PKWT)',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($karyawanPKWT);

        // 3. Karyawan dengan sisa cuti rendah (< 3 hari)
        $sisaCutiRendah = User::where('role', 'karyawan')
            ->where('sisa_cuti', '<', 3)
            ->where('sisa_cuti', '>=', 0)
            ->with('departemen')
            ->limit(2)
            ->get()
            ->map(fn($u) => [
                'nama' => $u->name,
                'departemen' => $u->departemen->nama ?? 'N/A',
                'badge' => 'Sisa Cuti Rendah',
                'badge_color' => 'orange',
                'keterangan' => 'Sisa cuti: ' . ($u->sisa_cuti ?? 0) . ' hari',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($sisaCutiRendah);
        
        // Limit to 5 items total
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->take(5);

        // Aktivitas Terbaru (5 latest activities)
        $aktivitasTerbaru = collect();
        // Cuti/Lembur yang baru disetujui
        $cutiDisetujui = Cuti::where('status', 'Disetujui')
            ->whereNotNull('tanggal_persetujuan')
            ->with('user')
            ->latest('tanggal_persetujuan')
            ->take(2)
            ->get()
            ->map(fn($c) => [
                'jenis' => 'approved',
                'icon' => 'check',
                'color' => 'green',
                'judul' => 'Pengajuan cuti ' . ($c->user->name ?? 'N/A') . ' disetujui',
                'deskripsi' => $c->jenis . ' ' . $c->durasi_hari . ' hari - ' . \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M Y'),
                'waktu' => $c->tanggal_persetujuan ? \Carbon\Carbon::parse($c->tanggal_persetujuan)->diffForHumans() : 'N/A',
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($cutiDisetujui);

        $lemburDisetujui = Lembur::where('status', 'Disetujui')
            ->whereNotNull('tanggal_persetujuan')
            ->with('user')
            ->latest('tanggal_persetujuan')
            ->take(1)
            ->get()
            ->map(fn($l) => [
                'jenis' => 'approved',
                'icon' => 'check',
                'color' => 'green',
                'judul' => 'Pengajuan lembur ' . ($l->user->name ?? 'N/A') . ' disetujui',
                'deskripsi' => $l->durasi_jam . ' jam lembur - ' . \Carbon\Carbon::parse($l->tanggal)->format('d M Y'),
                'waktu' => $l->tanggal_persetujuan ? \Carbon\Carbon::parse($l->tanggal_persetujuan)->diffForHumans() : 'N/A',
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($lemburDisetujui);

        // Pengajuan pending terbaru
        $pengajuanPending = Cuti::where('status', 'Pending')
            ->with('user')
            ->latest('created_at')
            ->take(1)
            ->get()
            ->map(fn($c) => [
                'jenis' => 'pending',
                'icon' => 'clock',
                'color' => 'yellow',
                'judul' => 'Pengajuan cuti ' . ($c->user->name ?? 'N/A') . ' menunggu persetujuan',
                'deskripsi' => $c->jenis . ' ' . $c->durasi_hari . ' hari - mulai ' . \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M Y'),
                'waktu' => $c->created_at->diffForHumans(),
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($pengajuanPending);

        // Surat diterbitkan
        $suratDiterbitkanRecent = Surat::where('status', 'Diterbitkan')
            ->with('user')
            ->latest('updated_at')
            ->take(1)
            ->get()
            ->map(fn($s) => [
                'jenis' => 'surat',
                'icon' => 'document',
                'color' => 'blue',
                'judul' => 'Surat ' . ($s->jenis ?? 'Keterangan') . ' diterbitkan',
                'deskripsi' => ($s->user->name ?? 'N/A') . ' - ' . ($s->keperluan ?? 'Keperluan karyawan'),
                'waktu' => $s->updated_at->diffForHumans(),
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($suratDiterbitkanRecent);

        return [
            'totalKaryawan' => $totalKaryawan,
            'persentaseKehadiran' => $persentaseKehadiran,
            'cutiPending' => $cutiPending,
            'lemburPending' => $lemburPending,
            'suratPending' => $suratPending,
            'pendingApprovals' => $pendingApprovals,
            'suratDiterbitkan' => $suratDiterbitkan,
            'suratDikirimBulan' => $suratDikirimBulan,
            'statusKaryawan' => $statusKaryawan,
            'jenisSurat' => $jenisSurat,
            'pengajuanMenunggu' => $pengajuanMenunggu,
            'pengajuanPerBulan' => $pengajuanPerBulan,
            'totalPengajuan6' => $totalPengajuan6,
            'maxPengajuan' => $maxPengajuan,
            'departemenStats' => $departemenStats,
            'persetujuanSelesai' => $persetujuanSelesai,
            'ditolakBulan' => $ditolakBulan,
            'statusApproved' => $statusApproved,
            'statusPending' => $statusPending,
            'statusRejected' => $statusRejected,
            'statusTotal' => $statusTotal,
            'lemburPerDepartemen' => $lemburPerDepartemen,
            'maxLemburJam' => $maxLemburJam,
            'totalLemburBulanIni' => $totalLemburBulanIni,
            'hadirHariIni' => $hadirHariIni,
            'karyawanPerluPerhatian' => $karyawanPerluPerhatian,
            'aktivitasTerbaru' => $aktivitasTerbaru,
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

        // calculate attendance percentage (preserve view variable name)
        $totalHariKerja = now()->day;
        $totalAbsensi = Absensi::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->where('status', 'Hadir')
            ->count();
        $persentaseHadirHariIni = $totalKaryawan > 0 && $totalHariKerja > 0
            ? round(($totalAbsensi / ($totalKaryawan * $totalHariKerja)) * 100, 1)
            : 0;

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

        // pending counts (cuti + lembur)
        $cutiPending = $cutiPending ?? Cuti::where('status', 'Pending')->count();
        $lemburPending = $lemburPending ?? Lembur::where('status', 'Pending')->count();
        $totalPending = $cutiPending + $lemburPending;

        // Surat per status (Admin HRD cards)
        $suratPending = Surat::where('status', 'Draft')->count() + Surat::where('status', 'Menunggu Persetujuan')->count();
        $suratDisetujui = Surat::where('status', 'Disetujui')->count();
        $suratDiterbitkan = Surat::where('status', 'Diterbitkan')->count();
        $suratDitolak = Surat::where('status', 'Ditolak')->count();

        // Revisi / Ditolak (counts)
        $revisiCount = Cuti::where('status', 'Ditolak')->count() + Lembur::where('status', 'Ditolak')->count();

        // Surat menunggu (for card listing)
        $suratMenunggu = Surat::whereIn('status', ['Draft', 'Menunggu Persetujuan'])
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        // Karyawan Perlu Perhatian (Admin HRD)
        $karyawanPerluPerhatian = collect();
        
        // 1. Karyawan sedang cuti panjang (> 3 hari)
        $cutiPanjang = Cuti::where('status', 'Disetujui')
            ->where('durasi_hari', '>', 3)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->with('user.departemen')
            ->take(2)
            ->get()
            ->map(fn($c) => [
                'nama' => $c->user->name ?? 'N/A',
                'departemen' => $c->user->departemen->nama ?? 'N/A',
                'badge' => 'Cuti Panjang',
                'badge_color' => 'blue',
                'keterangan' => 'Cuti ' . $c->durasi_hari . ' hari (' . \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M') . ' - ' . \Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y') . ')',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($cutiPanjang);

        // 2. Karyawan dengan status kontrak PKWT
        $karyawanPKWT = User::where('role', 'karyawan')
            ->where('status_kontrak', 'PKWT')
            ->with('departemen')
            ->limit(2)
            ->get()
            ->map(fn($u) => [
                'nama' => $u->name,
                'departemen' => $u->departemen->nama ?? 'N/A',
                'badge' => 'Status Kontrak',
                'badge_color' => 'yellow',
                'keterangan' => 'Karyawan kontrak (PKWT)',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($karyawanPKWT);

        // 3. Karyawan dengan sisa cuti rendah (< 3 hari)
        $sisaCutiRendah = User::where('role', 'karyawan')
            ->where('sisa_cuti', '<', 3)
            ->where('sisa_cuti', '>=', 0)
            ->with('departemen')
            ->limit(2)
            ->get()
            ->map(fn($u) => [
                'nama' => $u->name,
                'departemen' => $u->departemen->nama ?? 'N/A',
                'badge' => 'Sisa Cuti Rendah',
                'badge_color' => 'orange',
                'keterangan' => 'Sisa cuti: ' . ($u->sisa_cuti ?? 0) . ' hari',
            ]);
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->merge($sisaCutiRendah);
        
        // Limit to 5 items total
        $karyawanPerluPerhatian = $karyawanPerluPerhatian->take(5);

        // Aktivitas Terbaru (Admin HRD)
        $aktivitasTerbaru = collect();
        $cutiDisetujui = Cuti::where('status', 'Disetujui')
            ->whereNotNull('tanggal_persetujuan')
            ->with('user')
            ->latest('tanggal_persetujuan')
            ->take(2)
            ->get()
            ->map(fn($c) => [
                'jenis' => 'approved',
                'icon' => 'check',
                'color' => 'green',
                'judul' => 'Pengajuan cuti disetujui',
                'deskripsi' => ($c->user->name ?? 'N/A') . ' - ' . $c->jenis . ' ' . $c->durasi_hari . ' hari',
                'waktu' => $c->tanggal_persetujuan ? \Carbon\Carbon::parse($c->tanggal_persetujuan)->diffForHumans() : 'N/A',
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($cutiDisetujui);

        $suratDiterbitkan = Surat::where('status', 'Diterbitkan')
            ->with('user')
            ->latest('updated_at')
            ->take(2)
            ->get()
            ->map(fn($s) => [
                'jenis' => 'surat',
                'icon' => 'document',
                'color' => 'blue',
                'judul' => 'Surat diterbitkan',
                'deskripsi' => ($s->user->name ?? 'N/A') . ' - ' . ($s->jenis ?? 'Surat Keterangan'),
                'waktu' => $s->updated_at->diffForHumans(),
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($suratDiterbitkan);

        $karyawanBaru = User::where('role', 'karyawan')
            ->latest('created_at')
            ->take(1)
            ->get()
            ->map(fn($u) => [
                'jenis' => 'new',
                'icon' => 'user-add',
                'color' => 'blue',
                'judul' => 'Karyawan baru ditambahkan',
                'deskripsi' => $u->name . ' - ' . ($u->departemen->nama ?? 'N/A'),
                'waktu' => $u->created_at->diffForHumans(),
            ]);
        $aktivitasTerbaru = $aktivitasTerbaru->merge($karyawanBaru);

        // Data pengajuan per bulan (6 bulan terakhir) - dynamic
        $pengajuanPerBulan = collect();
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->copy()->subMonths($i)->locale('id');
            $countCuti = Cuti::whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            $countLembur = Lembur::whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            // Format: Sep 25 atau Feb 26 (bulan + tahun 2 digit)
            $label = $bulan->isoFormat('MMM YY');
            $pengajuanPerBulan->push(['label' => $label, 'count' => $countCuti + $countLembur]);
        }
        $totalPengajuan6 = $pengajuanPerBulan->sum('count');
        $maxPengajuan = max(1, $pengajuanPerBulan->max('count'));

        // overall status counts for charts
        $statusApproved = Cuti::where('status','Disetujui')->count() + Lembur::where('status','Disetujui')->count() + Surat::where('status','Disetujui')->count();
        $statusPending = Cuti::where('status','Pending')->count() + Lembur::where('status','Pending')->count() + Surat::where('status','Pending')->count();
        $statusRejected = Cuti::where('status','Ditolak')->count() + Lembur::where('status','Ditolak')->count() + Surat::where('status','Ditolak')->count();
        $statusTotal = $statusApproved + $statusPending + $statusRejected;

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
            'pengajuanPerBulan' => $pengajuanPerBulan,
            'totalPengajuan6' => $totalPengajuan6,
            'maxPengajuan' => $maxPengajuan,
            'revisiCount' => $revisiCount,
            'statusApproved' => $statusApproved,
            'statusPending' => $statusPending,
            'statusRejected' => $statusRejected,
            'statusTotal' => $statusTotal,
            'karyawanPerluPerhatian' => $karyawanPerluPerhatian,
            'aktivitasTerbaru' => $aktivitasTerbaru,
            'karyawanPerluPerhatian' => $karyawanPerluPerhatian,
            'aktivitasTerbaru' => $aktivitasTerbaru,
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
