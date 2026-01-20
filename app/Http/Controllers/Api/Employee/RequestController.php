<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $q = Cuti::where('user_id', $user->id)->orderBy('created_at','desc');
        if ($request->has('status')) $q->where('status', $request->status);
        return response()->json($q->paginate(10));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'jenis' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'nullable|string|max:1000',
        ]);

        $data['user_id'] = $user->id;
        $data['durasi_hari'] = (new \DateTime($data['tanggal_selesai']))->diff(new \DateTime($data['tanggal_mulai']))->days + 1;
        $data['status'] = 'pending';

        $cuti = Cuti::create($data);
        return response()->json(['ok' => true, 'cuti' => $cuti], 201);
    }
}
