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

        // Validate first so Laravel returns 422 on validation errors (not caught as 500)
        $data = $request->validate([
            'jenis' => 'required|in:Cuti Tahunan,Cuti Sakit,Cuti Darurat',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:1000',
            'dilimpahkan_ke' => 'nullable|array',
            'dilimpahkan_ke.*' => 'exists:users,id',
        ]);

        try {
            \Log::info('Cuti store payload', $data);

            $data['user_id'] = $user->id;
            $data['durasi_hari'] = (new \DateTime($data['tanggal_selesai']))->diff(new \DateTime($data['tanggal_mulai']))->days + 1;
            $data['status'] = 'Pending';

            // ensure empty array becomes null so DB stores null if none
            if (isset($data['dilimpahkan_ke']) && is_array($data['dilimpahkan_ke'])) {
                // remove self if present
                $data['dilimpahkan_ke'] = array_values(array_filter($data['dilimpahkan_ke'], fn($id) => intval($id) !== intval($user->id)));
                if (empty($data['dilimpahkan_ke'])) $data['dilimpahkan_ke'] = null;
            }

            $cuti = Cuti::create($data);

            // notify directors / HRD
            $directors = \App\Models\User::whereIn('role', ['direktur','admin_hrd'])->get();
            if ($directors->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($directors, new \App\Notifications\NewCutiSubmitted($cuti));
            }

            // notify delegated users (pelimpahan tugas)
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $delegated = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get();
                if ($delegated->isNotEmpty()) {
                    \Illuminate\Support\Facades\Notification::send($delegated, new \App\Notifications\TaskDelegated($cuti));
                }
            }

            return response()->json(['ok' => true, 'cuti' => $cuti], 201);
        } catch (\Throwable $e) {
            // write a dedicated error dump file (easier to read during debugging)
            try {
                $dump = '[' . now()->toDateTimeString() . '] Cuti store exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString() . "\nPayload: " . json_encode($data) . "\n\n";
                file_put_contents(storage_path('logs/cuti_errors.log'), $dump, FILE_APPEND);
            } catch (\Throwable $_) {
                // ignore any errors while writing dump
            }

            \Log::error('Cuti store exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString(), ['payload' => $data]);

            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, Cuti $cuti)
    {
        $user = $request->user();
        if ($cuti->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($cuti->status !== 'Pending') {
            return response()->json(['message' => 'Tidak dapat mengubah pengajuan yang sudah diproses'], 422);
        }

        $data = $request->validate([
            'jenis' => 'sometimes|in:Cuti Tahunan,Cuti Sakit,Cuti Darurat',
            'tanggal_mulai' => 'sometimes|date',
            'tanggal_selesai' => 'sometimes|date|after_or_equal:tanggal_mulai',
            'alasan' => 'sometimes|string|max:1000',
            'dilimpahkan_ke' => 'nullable|array',
            'dilimpahkan_ke.*' => 'exists:users,id',
        ]);

        \Log::info('Update Cuti - ID: ' . $cuti->id . ', Current jenis: ' . $cuti->jenis . ', New jenis: ' . ($data['jenis'] ?? 'none'));

        if (isset($data['tanggal_mulai']) && isset($data['tanggal_selesai'])) {
            $data['durasi_hari'] = (new \DateTime($data['tanggal_selesai']))->diff(new \DateTime($data['tanggal_mulai']))->days + 1;
        } elseif (isset($data['tanggal_mulai'])) {
            $data['durasi_hari'] = (new \DateTime($cuti->tanggal_selesai))->diff(new \DateTime($data['tanggal_mulai']))->days + 1;
        } elseif (isset($data['tanggal_selesai'])) {
            $data['durasi_hari'] = (new \DateTime($data['tanggal_selesai']))->diff(new \DateTime($cuti->tanggal_mulai))->days + 1;
        }

        // handle dilimpahkan_ke normalization
        if (isset($data['dilimpahkan_ke']) && is_array($data['dilimpahkan_ke'])) {
            $data['dilimpahkan_ke'] = array_values(array_filter($data['dilimpahkan_ke'], fn($id) => intval($id) !== intval($user->id)));
            if (empty($data['dilimpahkan_ke'])) $data['dilimpahkan_ke'] = null;
        }

        $cuti->fill($data);
        $saved = $cuti->save();
        
        \Log::info('Update Cuti - Saved: ' . ($saved ? 'YES' : 'NO') . ', New jenis: ' . $cuti->jenis);

        // notify newly delegated users (if provided)
        if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
            $delegated = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)->get();
            if ($delegated->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($delegated, new \App\Notifications\TaskDelegated($cuti));
            }
        }

        return response()->json(['ok' => true, 'cuti' => $cuti], 200);
    }

    public function destroy(Request $request, Cuti $cuti)
    {
        $user = $request->user();
        if ($cuti->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($cuti->status !== 'Pending') {
            return response()->json(['message' => 'Tidak dapat menghapus pengajuan yang sudah diproses'], 422);
        }

        $cuti->delete();
        return response()->json(['ok' => true], 200);
    }
}
