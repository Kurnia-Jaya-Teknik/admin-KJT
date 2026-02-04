<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Lembur;
use Illuminate\Http\Request;

class DirekturController extends Controller
{
    public function persetujuanCutiLembur(Request $request)
    {
        // Get filter parameters
        $jenis = $request->query('jenis');
        $status = $request->query('status');
        $periode = $request->query('periode');

        // Start query for Cuti
        $cutiQuery = Cuti::with('user')
            ->where('status', '!=', null);

        // Filter by status
        if ($status) {
            $statusMap = [
                'menunggu' => 'Pending',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ];
            $cutiStatus = $statusMap[strtolower($status)] ?? null;
            if ($cutiStatus) {
                $cutiQuery->where('status', $cutiStatus);
            }
        }

        // Filter by periode
        if ($periode) {
            $cutiQuery->whereYear('tanggal_mulai', explode('-', $periode)[0])
                ->whereMonth('tanggal_mulai', explode('-', $periode)[1]);
        }

        $cutiRequests = $cutiQuery->orderBy('created_at', 'desc')->get();
        
        // Enrich cuti with delegated users
        $cutiRequests->each(function ($cuti) {
            if (!empty($cuti->dilimpahkan_ke) && is_array($cuti->dilimpahkan_ke)) {
                $cuti->delegated_users = \App\Models\User::whereIn('id', $cuti->dilimpahkan_ke)
                    ->select('id', 'name', 'email')
                    ->get();
            } else {
                $cuti->delegated_users = collect();
            }
        });

        // Start query for Lembur
        $lemburQuery = Lembur::with('user')
            ->where('status', '!=', null);

        // Filter by status
        if ($status) {
            $statusMap = [
                'menunggu' => 'Pending',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ];
            $lemburStatus = $statusMap[strtolower($status)] ?? null;
            if ($lemburStatus) {
                $lemburQuery->where('status', $lemburStatus);
            }
        }

        // Filter by periode
        if ($periode) {
            $lemburQuery->whereYear('tanggal', explode('-', $periode)[0])
                ->whereMonth('tanggal', explode('-', $periode)[1]);
        }

        $lemburRequests = $lemburQuery->orderBy('created_at', 'desc')->get();

        // Merge and sort by creation date
        $all = collect([...$cutiRequests, ...$lemburRequests])->sortByDesc('created_at')->values();

        // Manual pagination for the merged collection
        $page = (int) $request->query('page', 1);
        $perPage = (int) $request->query('per_page', 10);
        $total = $all->count();
        $items = $all->slice(($page - 1) * $perPage, $perPage)->values();

        $requests = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('direktur.persetujuan-cuti-lembur', compact('requests'));
    }

    public function persetujuanSurat()
    {
        return view('direktur.persetujuan-surat');
    }

    public function ringkasanKaryawan()
    {
        // Get all employees (excluding direktur)
        $karyawan = \App\Models\User::with('departemen')
            ->whereIn('role', ['karyawan', 'admin_hrd', 'magang'])
            ->get();
        
        // Separate admin_hrd
        $adminHrd = $karyawan->where('role', 'admin_hrd');
        $countAdminHrd = $adminHrd->count();
        
        // Count by status
        $totalKaryawan = $karyawan->count();
        $pkwtt = $karyawan->where('status_kepegawaian', 'PKWTT')->count();
        $pkwt = $karyawan->where('status_kepegawaian', 'PKWT')->count();
        $magang = $karyawan->where('role', 'magang')->count();
        
        // Get departemen distribution (only karyawan role)
        $departemens = \App\Models\Departemen::withCount(['users' => function($query) {
            $query->where('role', 'karyawan');
        }])->get();
        
        // Get karyawan tanpa divisi (excluding admin_hrd)
        $karyawanTanpaDivisi = $karyawan->where('role', 'karyawan')->whereNull('departemen_id');
        $countTanpaDivisi = $karyawanTanpaDivisi->count();
        
        return view('direktur.ringkasan-karyawan', compact(
            'karyawan',
            'totalKaryawan',
            'pkwtt',
            'pkwt',
            'magang',
            'departemens',
            'karyawanTanpaDivisi',
            'countTanpaDivisi',
            'adminHrd',
            'countAdminHrd'
        ));
    }

    public function kelolaKaryawan()
    {
        $users = \App\Models\User::with('departemen')
            ->whereIn('role', ['karyawan', 'admin_hrd', 'magang'])
            ->orderBy('name')
            ->get();
        
        $departemens = \App\Models\Departemen::orderBy('nama')->get();
        
        return view('direktur.kelola-karyawan', compact('users', 'departemens'));
    }

    public function updateUser(Request $request, $id)
    {
        // Log incoming data for debugging
        \Log::info('updateUser payload', ['id' => $id, 'payload' => $request->all()]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|in:karyawan,admin_hrd,magang',
                'departemen_id' => 'nullable|exists:departemen,id',
                'status_kepegawaian' => 'nullable|in:PKWTT,PKWT'
            ]);

            $user = \App\Models\User::findOrFail($id);
            
            // Prevent changing direktur account
            if ($user->role === 'direktur') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat mengubah akun direktur'
                ], 403);
            }

            // Clear status_kepegawaian if role is magang or admin_hrd
            if (in_array($validated['role'], ['magang', 'admin_hrd'])) {
                $validated['status_kepegawaian'] = null;
            }

            // Remove any fields that do not exist in users table to avoid SQL errors
            $validForUpdate = [];
            foreach ($validated as $key => $value) {
                if (\Illuminate\Support\Facades\Schema::hasColumn('users', $key)) {
                    $validForUpdate[$key] = $value;
                } else {
                    \Log::debug('Skipping non-existent user column on update', ['column' => $key]);
                }
            }

            \Log::info('update_attempt', ['id' => $id, 'validated' => $validated, 'validForUpdate' => $validForUpdate]);

            $updated = $user->update($validForUpdate);

            // Explicitly ensure status_kepegawaian is set if provided (defensive)
            if (array_key_exists('status_kepegawaian', $validForUpdate)) {
                $user->status_kepegawaian = $validForUpdate['status_kepegawaian'];
                $user->save();
            }

            $user->refresh();

            \Log::info('update_result', ['updated' => $updated, 'user_after' => $user->toArray()]);

            // Include attempted update and raw request in response when local to help debugging
            $response = [
                'success' => true,
                'message' => 'Data user berhasil diperbarui',
                'user' => $user->load('departemen')
            ];

            if (app()->environment('local')) {
                $response['attempt'] = $validForUpdate;
                $response['raw'] = $request->all();
            }

            return response()->json($response);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('updateUser validation failed', ['errors' => $e->errors()]);
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('updateUser exception', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if (app()->environment('local')) {
                return response()->json(['success' => false, 'message' => 'Exception: ' . $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
            }
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server saat memperbarui data'], 500);
        }
    }

    public function resetPassword(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent resetting direktur password
        if ($user->role === 'direktur') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat mereset password direktur'
            ], 403);
        }

        // Reset password to default: password123
        $user->update([
            'password' => \Hash::make('password123')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset ke "password123"'
        ]);
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent deactivating direktur account
        if ($user->role === 'direktur') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menonaktifkan akun direktur'
            ], 403);
        }

        // Toggle status (aktif/nonaktif)
        $newStatus = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'message' => 'Status akun berhasil diubah menjadi ' . $newStatus,
            'status' => $newStatus
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent deleting direktur account
        if ($user->role === 'direktur') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun direktur'
            ], 403);
        }

        // Check if user has pending requests
        $hasPendingCuti = \App\Models\Cuti::where('user_id', $id)
            ->whereIn('status', ['Menunggu', 'Disetujui Admin'])
            ->exists();
        
        $hasPendingLembur = \App\Models\Lembur::where('user_id', $id)
            ->whereIn('status', ['Menunggu', 'Disetujui Admin'])
            ->exists();

        if ($hasPendingCuti || $hasPendingLembur) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun dengan pengajuan yang masih pending'
            ], 400);
        }

        $userName = $user->name;
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun ' . $userName . ' berhasil dihapus'
        ]);
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }

    // New: dedicated cuti report page
    public function laporanCuti()
    {
        return view('direktur.laporan-cuti');
    }

    public function laporanAbsensi()
    {
        return view('direktur.laporan-absensi');
    }

    public function laporanLembur()
    {
        return view('direktur.laporan-lembur');
    }

    public function laporanCutiPdf(Request $request)
    {
        // Accepts month, year, period_by, q (search)
        $month = (int) $request->query('month', now()->month);
        $year = (int) $request->query('year', now()->year);
        $periodBy = $request->query('period_by', 'tanggal_mulai');
        $q = trim((string) $request->query('q', ''));

        $query = \App\Models\Cuti::with('user', 'approver')
            ->where('status', 'Disetujui');

        if ($periodBy === 'tanggal_persetujuan') {
            $query->whereYear('tanggal_persetujuan', $year)
                  ->whereMonth('tanggal_persetujuan', $month);
        } else {
            $query->whereYear('tanggal_mulai', $year)
                  ->whereMonth('tanggal_mulai', $month);
        }

        if ($q !== '') {
            $query->where(function($qbuilder) use ($q) {
                $like = '%' . $q . '%';
                $qbuilder->whereHas('user', function($u) use ($like) { $u->where('name', 'like', $like); })
                    ->orWhere('jenis', 'like', $like)
                    ->orWhere('alasan', 'like', $like)
                    ->orWhere('telp', 'like', $like);
            });
        }

        $items = $query->orderBy('tanggal_persetujuan', 'desc')->get();

        // Map to simpler array for view
        $rows = $items->map(function($c){
            $pel = [];
            if (is_array($c->dilimpahkan_ke) && count($c->dilimpahkan_ke)) {
                $users = \App\Models\User::whereIn('id', $c->dilimpahkan_ke)->get();
                $pel = $users->map(function($u){ return $u->name . ($u->departemen ? ' — ' . $u->departemen->nama : ''); })->toArray();
            }
            return [
                'id' => $c->id,
                'nama' => $c->user ? $c->user->name : '-',
                'divisi' => $c->user && $c->user->departemen ? $c->user->departemen->nama : '',
                'jenis' => $c->jenis,
                'tanggal_mulai' => $c->tanggal_mulai ? $c->tanggal_mulai->toDateString() : '',
                'tanggal_selesai' => $c->tanggal_selesai ? $c->tanggal_selesai->toDateString() : '',
                'durasi' => $c->durasi_hari,
                'pelimpahan' => implode(', ', $pel),
                'telp' => $c->telp,
                'alasan' => $c->alasan,
                'tanggal_persetujuan' => $c->tanggal_persetujuan ? $c->tanggal_persetujuan->toDateString() : '',
                'approved_by' => $c->approver ? $c->approver->name : ''
            ];
        })->toArray();

        $periodLabel = monthName($month) . ' ' . $year;

        // attempt to find kop surat (logo) for Kurnia Jaya Teknik, fallback to first available
        $kopLogoData = null;
        try {
            $kop = \App\Models\KopSurat::where('name', 'like', '%Kurnia%')->first();
            if (! $kop) {
                $kop = \App\Models\KopSurat::where('is_template', true)->first() ?: \App\Models\KopSurat::first();
            }

            if ($kop && $kop->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($kop->file_path)) {
                $content = \Illuminate\Support\Facades\Storage::disk('public')->get($kop->file_path);
                $mime = $kop->mime ?: (\Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $kop->file_path)) ?: 'image/png');
                $kopLogoData = 'data:' . $mime . ';base64,' . base64_encode($content);
            }

            // fallback: if we didn't find a KopSurat DB record, try any file in storage/kop-surat
            if (empty($kopLogoData)) {
                try {
                    $files = \Illuminate\Support\Facades\Storage::disk('public')->files('kop-surat');
                    if (!empty($files)) {
                        $first = $files[0];
                        $content = \Illuminate\Support\Facades\Storage::disk('public')->get($first);
                        $mime = \Illuminate\Support\Facades\File::mimeType(storage_path('app/public/' . $first)) ?: 'image/png';
                        $kopLogoData = 'data:' . $mime . ';base64,' . base64_encode($content);
                    }
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        } catch (\Throwable $e) {
            // ignore; fallback to text header
        }

        // debug log whether we found a kop and its source
        try {
            \Illuminate\Support\Facades\Log::info('laporanCutiPdf kop status', [
                'kop_present' => !empty($kopLogoData),
            ]);
        } catch (\Throwable $e) {
            // ignore logging failures
        }

        $html = view('direktur.laporan-cuti-pdf', ['rows' => $rows, 'period' => $periodLabel, 'query' => $q, 'kop_logo' => $kopLogoData])->render();

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="laporan_cuti_' . str_replace(' ', '_', $periodLabel) . '.pdf"');
    }

    public function persetujuanLembur(Request $request)
    {
        $status = $request->query('status');
        $periode = $request->query('periode');

        $query = Lembur::with('user')->where('status','!=', null);

        if ($status) {
            $statusMap = [
                'menunggu' => 'Pending',
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
            ];
            $st = $statusMap[strtolower($status)] ?? null;
            if ($st) $query->where('status', $st);
        }

        if ($periode) {
            $query->whereYear('tanggal', explode('-', $periode)[0])
                ->whereMonth('tanggal', explode('-', $periode)[1]);
        }

        $requests = $query->orderBy('created_at','desc')->get();

        return view('direktur.persetujuan-lembur', compact('requests'));
    }

    public function riwayatPersetujuan()
    {
        return view('direktur.riwayat-persetujuan');
    }
}
