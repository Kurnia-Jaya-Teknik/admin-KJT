<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        // compute entitlement & used
        $cutiEntitlement = config('leave.cuti_tahunan_default', 20);
        $cutiRemaining = (int) ($user->sisa_cuti ?? 0);
        $cutiUsed = max(0, $cutiEntitlement - $cutiRemaining);

        // pending counts
        $pendingCuti = \App\Models\Cuti::where('user_id', $user->id)->where('status', 'Pending')->count();
        $pendingLembur = \App\Models\Lembur::where('user_id', $user->id)->where('status', 'Pending')->count();
        $pendingRequests = $pendingCuti + $pendingLembur;

        $data = $user->toArray();
        $data['cuti_entitlement'] = (int) $cutiEntitlement;
        $data['sisa_cuti'] = (int) $cutiRemaining;
        $data['cuti_used'] = (int) $cutiUsed;
        $data['pending_requests'] = (int) $pendingRequests;

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'departemen_id' => 'nullable|integer',
            'jabatan' => 'nullable|string|max:255',
        ]);

        $user->fill($data);
        $user->save();

        return response()->json($user);
    }
}
