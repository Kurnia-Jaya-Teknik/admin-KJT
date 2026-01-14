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

        $counts = [
            'cuti_pending' => Cuti::where('user_id', $user->id)->where('status', 'pending')->count(),
            'lembur_pending' => Lembur::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];

        $latest_requests = Cuti::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get();
        $latest_lembur = Lembur::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get();

        $latest_letters = Surat::where('user_id', $user->id)->orderBy('created_at','desc')->take(5)->get();

        return response()->json([
            'counts' => $counts,
            'latest_cuti' => $latest_requests,
            'latest_lembur' => $latest_lembur,
            'latest_letters' => $latest_letters,
        ]);
    }
}
