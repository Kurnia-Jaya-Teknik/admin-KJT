<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // build role-specific payload
        $payload = [];

        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->subMonths($i);
            $months[] = [
                'label' => $m->format('M'),
                'year' => $m->year,
                'month' => $m->month,
            ];
        }

        if ($user->role === 'karyawan') {
            $sisa = $user->sisa_cuti ?? 0;
            $cutiPending = Cuti::where('user_id', $user->id)->where('status', 'Pending')->count();
            $cutiApprovedYear = Cuti::where('user_id', $user->id)->whereYear('tanggal_mulai', now()->year)->where('status','Disetujui')->sum('durasi_hari');
            $lemburThisMonth = Lembur::where('user_id', $user->id)->whereYear('tanggal', now()->year)->whereMonth('tanggal', now()->month)->sum('durasi_jam');

            // monthly submissions for this user
            $monthly = [];
            foreach ($months as $m) {
                $start = \Carbon\Carbon::create($m['year'], $m['month'], 1)->startOfMonth();
                $end = (clone $start)->endOfMonth();
                $count = Cuti::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count()
                    + Lembur::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count()
                    + Surat::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count();
                $monthly[] = ['label' => $m['label'], 'count' => $count];
            }

            // status counts for user
            $statusCounts = [
                'approved' => Cuti::where('user_id',$user->id)->where('status','Disetujui')->count() + Lembur::where('user_id',$user->id)->where('status','Disetujui')->count() + Surat::where('user_id',$user->id)->where('status','Disetujui')->count(),
                'pending' => Cuti::where('user_id',$user->id)->where('status','Pending')->count() + Lembur::where('user_id',$user->id)->where('status','Pending')->count() + Surat::where('user_id',$user->id)->where('status','Menunggu Persetujuan')->count(),
                'rejected' => Cuti::where('user_id',$user->id)->where('status','Ditolak')->count() + Lembur::where('user_id',$user->id)->where('status','Ditolak')->count() + Surat::where('user_id',$user->id)->where('status','Ditolak')->count(),
            ];

            // Attendance: compute per-working-day status for current month
            $startMonth = now()->startOfMonth();
            $endMonth = now()->endOfMonth();
            $period = \Carbon\CarbonPeriod::create($startMonth, $endMonth);
            $absensis = \App\Models\Absensi::where('user_id', $user->id)->whereBetween('tanggal', [$startMonth, $endMonth])->get()->keyBy(function($a) { return $a->tanggal->format('Y-m-d'); });

            $attendanceDays = [];
            $presentCount = 0;
            $workingDays = 0;
            foreach ($period as $d) {
                // count only weekdays as working days
                if ($d->isWeekend()) continue;
                $workingDays++;
                $key = $d->format('Y-m-d');
                $a = $absensis->get($key);
                $status = $a ? $a->status : 'Alpa';
                if ($status === 'Hadir') $presentCount++;
                $attendanceDays[] = [
                    'day' => $d->day,
                    'status' => $status,
                    'date' => $key,
                    'jam_masuk' => $a ? $a->jam_masuk : null,
                    'jam_keluar' => $a ? $a->jam_keluar : null,
                ];
            }

            $payload = [
                'counts' => [
                    'cuti_pending' => $cutiPending,
                    'lembur_pending' => Lembur::where('user_id', $user->id)->where('status','Pending')->count(),
                    'sisa_cuti' => $sisa,
                    'cuti_used_year' => $cutiApprovedYear,
                    'cuti_entitlement' => config('leave.cuti_tahunan_default', 20),
                    'total_lembur_month' => $lemburThisMonth,
                    // per-status counts for cuti
                    'cuti_approved_count' => Cuti::where('user_id', $user->id)->where('status','Disetujui')->whereYear('tanggal_persetujuan', now()->year)->count(),
                    'cuti_pending_count' => Cuti::where('user_id', $user->id)->where('status','Pending')->count(),
                    'cuti_rejected_count' => Cuti::where('user_id', $user->id)->where('status','Ditolak')->count(),
                ],
                'latest_cuti' => Cuti::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get(),
                'latest_lembur' => Lembur::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get(),
                'latest_letters' => Surat::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get(),
                'monthly_submissions' => $monthly,
                'status_counts' => $statusCounts,                'attendance' => [
                    'days' => $attendanceDays,
                    'present' => $presentCount,
                    'working_days' => $workingDays,
                    'month_label' => now()->locale('id')->isoFormat('MMMM YYYY'),
                ],                'attendance' => [
                    'days' => $attendanceDays,
                    'present' => $presentCount,
                    'working_days' => $workingDays,
                ],
            ];
        } else {
            // admin or director overview
            $monthly = [];
            foreach ($months as $m) {
                $start = \Carbon\Carbon::create($m['year'], $m['month'], 1)->startOfMonth();
                $end = (clone $start)->endOfMonth();
                $count = Cuti::whereBetween('created_at', [$start, $end])->count()
                    + Lembur::whereBetween('created_at', [$start, $end])->count()
                    + Surat::whereBetween('created_at', [$start, $end])->count();
                $monthly[] = ['label' => $m['label'], 'count' => $count];
            }

            $statusCounts = [
                'approved' => Cuti::where('status','Disetujui')->count() + Lembur::where('status','Disetujui')->count() + Surat::where('status','Disetujui')->count(),
                'pending' => Cuti::where('status','Pending')->count() + Lembur::where('status','Pending')->count() + Surat::where('status','Menunggu Persetujuan')->count(),
                'rejected' => Cuti::where('status','Ditolak')->count() + Lembur::where('status','Ditolak')->count() + Surat::where('status','Ditolak')->count(),
            ];

            $payload = [
                'counts' => [
                    'total_employees' => \App\Models\User::where('role','karyawan')->count(),
                    'cuti_pending' => Cuti::where('status','Pending')->count(),
                    'lembur_pending' => Lembur::where('status','Pending')->count(),
                    'surat_pending' => Surat::where('status','Menunggu Persetujuan')->count(),
                ],
                'latest_cuti' => Cuti::orderBy('created_at','desc')->take(5)->get(),
                'latest_lembur' => Lembur::orderBy('created_at','desc')->take(5)->get(),
                'latest_letters' => Surat::orderBy('created_at','desc')->take(5)->get(),
                'monthly_submissions' => $monthly,
                'status_counts' => $statusCounts,
            ];
        }

        return response()->json($payload);
    }
}
