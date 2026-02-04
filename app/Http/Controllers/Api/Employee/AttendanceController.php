<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        $abs = Absensi::firstOrNew([
            'user_id' => $user->id,
            'tanggal' => $today->toDateString(),
        ]);

        if ($abs->jam_masuk) {
            return response()->json(['message' => 'Anda sudah melakukan absen masuk hari ini.'], 422);
        }

        $abs->jam_masuk = Carbon::now()->format('H:i:s');
        $abs->status = 'Hadir';
        $abs->save();

        return response()->json(['message' => 'Absen masuk tercatat.', 'attendance' => $abs]);
    }

    public function checkOut(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        $abs = Absensi::where('user_id', $user->id)->whereDate('tanggal', $today)->first();
        if (!$abs || !$abs->jam_masuk) {
            return response()->json(['message' => 'Belum melakukan absen masuk hari ini.'], 422);
        }

        if ($abs->jam_keluar) {
            return response()->json(['message' => 'Anda sudah melakukan absen pulang hari ini.'], 422);
        }

        $abs->jam_keluar = Carbon::now()->format('H:i:s');
        $abs->status = 'Hadir';
        $abs->save();

        return response()->json(['message' => 'Absen pulang tercatat.', 'attendance' => $abs]);
    }
}
