<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lembur;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewLemburSubmitted;

class LemburController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $q = Lembur::where('user_id', $user->id)->orderBy('created_at', 'desc');
        if ($request->has('status')) $q->where('status', $request->status);
        $result = $q->paginate(10);

        $result->getCollection()->transform(function ($lembur) {
            $lembur->approver = $lembur->approver ? $lembur->approver->only(['id','name','email']) : null;
            return $lembur;
        });

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => ['required','date_format:H:i'],
            'jam_selesai' => ['required','date_format:H:i','after:jam_mulai'],
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            // compute duration in hours (decimal allowed)
            $start = \DateTime::createFromFormat('H:i', $data['jam_mulai']);
            $end = \DateTime::createFromFormat('H:i', $data['jam_selesai']);
            $diff = ($end->getTimestamp() - $start->getTimestamp()) / 3600;
            $diff = $diff > 0 ? $diff : 0;
            $durasi = round($diff, 2);

            if ($durasi <= 0) {
                return response()->json(['message' => 'Jam selesai harus lebih besar dari jam mulai.'], 422);
            }

            if ($durasi > 3) {
                return response()->json(['message' => 'Durasi lembur maksimal 3 jam per hari.'], 422);
            }

            $payload = [
                'user_id' => $user->id,
                'tanggal' => $data['tanggal'],
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
                'durasi_jam' => $durasi,
                'keterangan' => $data['keterangan'] ?? null,
                'status' => 'Pending',
            ];

            \Log::info('Storing lembur', $payload);

            $lembur = Lembur::create($payload);

            // notify directors & admin HRD
            $directors = \App\Models\User::whereIn('role', ['direktur','admin_hrd'])->get();
            if ($directors->isNotEmpty()) {
                Notification::send($directors, new NewLemburSubmitted($lembur));
            }

            return response()->json(['ok' => true, 'lembur' => $lembur], 201);
        } catch (\Throwable $e) {
            \Log::error('Lembur store exception: ' . $e->getMessage(), ['payload' => $data]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, Lembur $lembur)
    {
        $user = $request->user();
        if ($lembur->user_id !== $user->id) return response()->json(['message' => 'Unauthorized'], 403);
        if ($lembur->status !== 'Pending') return response()->json(['message' => 'Tidak dapat mengubah pengajuan yang sudah diproses'], 422);

        $data = $request->validate([
            'tanggal' => 'sometimes|date',
            'jam_mulai' => ['sometimes','date_format:H:i'],
            'jam_selesai' => ['sometimes','date_format:H:i'],
            'keterangan' => 'nullable|string|max:1000',
        ]);

        if (isset($data['jam_mulai']) && isset($data['jam_selesai'])) {
            $start = \DateTime::createFromFormat('H:i', $data['jam_mulai']);
            $end = \DateTime::createFromFormat('H:i', $data['jam_selesai']);
            $diff = ($end->getTimestamp() - $start->getTimestamp()) / 3600;
            $durasi = round($diff, 2);
            if ($durasi <= 0) return response()->json(['message' => 'Jam selesai harus lebih besar dari jam mulai.'], 422);
            if ($durasi > 3) return response()->json(['message' => 'Durasi lembur maksimal 3 jam per hari.'], 422);
            $data['durasi_jam'] = $durasi;
        }

        $lembur->fill($data);
        $lembur->save();

        return response()->json(['ok' => true, 'lembur' => $lembur], 200);
    }

    public function destroy(Request $request, Lembur $lembur)
    {
        $user = $request->user();
        if ($lembur->user_id !== $user->id) return response()->json(['message' => 'Unauthorized'], 403);
        if ($lembur->status !== 'Pending') return response()->json(['message' => 'Tidak dapat menghapus pengajuan yang sudah diproses'], 422);

        $lembur->delete();
        return response()->json(['ok' => true], 200);
    }
}
