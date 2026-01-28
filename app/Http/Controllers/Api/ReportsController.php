<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\User;

class ReportsController extends Controller
{
    public function cuti(Request $request)
    {
        $month = (int) $request->query('month', now()->month);
        $year = (int) $request->query('year', now()->year);
        $periodBy = $request->query('period_by', 'tanggal_mulai'); // 'tanggal_mulai' or 'tanggal_persetujuan'

        $query = Cuti::with('user', 'approver')
            ->where('status', 'Disetujui');

        if ($periodBy === 'tanggal_persetujuan') {
            $query->whereYear('tanggal_persetujuan', $year)
                  ->whereMonth('tanggal_persetujuan', $month);
        } else {
            // default: filter by tanggal_mulai
            $query->whereYear('tanggal_mulai', $year)
                  ->whereMonth('tanggal_mulai', $month);
        }

        // debug: log counts so we can verify requests
        try {
            \Log::info('ReportsController::cuti', ['period_by' => $periodBy, 'month' => $month, 'year' => $year, 'candidate_count' => $query->count()]);
        } catch (\Throwable $e) {
            // ignore logging failures
        }

        $items = $query->orderBy('tanggal_persetujuan', 'desc')->orderBy('tanggal_mulai', 'desc')->get()->map(function ($c) {
            $pel = [];
            if (is_array($c->dilimpahkan_ke) && count($c->dilimpahkan_ke)) {
                $users = User::whereIn('id', $c->dilimpahkan_ke)->get()->map(function ($u) {
                    return [
                        'id' => $u->id,
                        'name' => $u->name,
                        'departemen' => $u->departemen ? $u->departemen->nama : null,
                    ];
                })->values();

                $pel = $users;
            }

            return [
                'id' => $c->id,
                'user' => $c->user ? ['id' => $c->user->id, 'name' => $c->user->name, 'departemen' => $c->user->departemen ? $c->user->departemen->nama : null] : null,
                'jenis' => $c->jenis,
                'tanggal_mulai' => $c->tanggal_mulai ? $c->tanggal_mulai->toDateString() : null,
                'tanggal_selesai' => $c->tanggal_selesai ? $c->tanggal_selesai->toDateString() : null,
                'durasi_hari' => $c->durasi_hari,
                'telp' => $c->telp,
                'alasan' => $c->alasan,
                'dilimpahkan_ke' => $pel,
                'tanggal_persetujuan' => $c->tanggal_persetujuan ? $c->tanggal_persetujuan->toDateTimeString() : null,
                'disetujui_oleh' => $c->approver ? ['id' => $c->approver->id, 'name' => $c->approver->name] : null,
            ];
        });

        return response()->json(['data' => $items, 'count' => $items->count()]);
    }
}
