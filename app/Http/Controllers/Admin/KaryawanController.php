<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Get list of all karyawan (employees)
     */
    public function index(Request $request)
    {
        $this->ensureAdminHRD();

        $query = User::where('role', 'karyawan');

        // Search by name or NIK
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter by departemen
        if ($request->has('departemen') && $request->departemen) {
            $dept = Departemen::where('nama', 'like', '%' . $request->departemen . '%')->first();
            if ($dept) {
                $query->where('departemen_id', $dept->id);
            }
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $karyawan = $query->with('departemen')->orderBy('name')->get();

        if ($request->wantsJson()) {
            return response()->json($karyawan);
        }

        return view('admin.karyawan', [
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Get single karyawan data
     */
    public function show($id)
    {
        $this->ensureAdminHRD();
        
        $karyawan = User::where('role', 'karyawan')->findOrFail($id);
        
        return response()->json($karyawan);
    }

    /**
     * Store a new karyawan
     */
    public function store(Request $request)
    {
        $this->ensureAdminHRD();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nik' => 'required|string|unique:users|max:50',
            'jabatan' => 'required|string|max:255',
            'departemen_id' => 'required|exists:departemen,id',
            'phone' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_bergabung' => 'required|date',
        ]);

        // Generate temporary password
        $tempPassword = 'Temp' . random_int(100000, 999999) . '!';

        $karyawan = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nik' => $validated['nik'],
            'jabatan' => $validated['jabatan'],
            'departemen_id' => $validated['departemen_id'],
            'phone' => $validated['phone'],
            'alamat' => $validated['alamat'] ?? null,
            'tanggal_bergabung' => $validated['tanggal_bergabung'],
            'role' => 'karyawan',
            'password' => Hash::make($tempPassword),
            'status' => 'aktif',
            'email_verified_at' => now(),
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil ditambahkan',
            'karyawan' => $karyawan,
            'temp_password' => $tempPassword, // Send this via email in real implementation
        ], 201);
    }

    /**
     * Update karyawan data
     */
    public function update(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($id)],
            'nik' => ['sometimes', 'string', 'max:50', Rule::unique('users')->ignore($id)],
            'jabatan' => 'sometimes|string|max:255',
            'departemen_id' => 'sometimes|exists:departemen,id',
            'phone' => 'sometimes|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_bergabung' => 'sometimes|date',
        ]);

        $karyawan->update($validated);

        return response()->json([
            'ok' => true,
            'message' => 'Data karyawan berhasil diperbarui',
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Deactivate karyawan
     */
    public function deactivate(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        $karyawan->update([
            'status' => 'nonaktif',
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil dinonaktifkan',
        ]);
    }

    /**
     * Activate karyawan
     */
    public function activate(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        $karyawan->update([
            'status' => 'aktif',
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil diaktifkan',
        ]);
    }

    /**
     * Tandai karyawan sedang cuti
     */
    public function setLeave(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        $karyawan->update([
            'status' => 'cuti',
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil ditandai cuti',
        ]);
    }

    /**
     * Kembalikan karyawan dari cuti
     */
    public function returnFromLeave(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        $karyawan->update([
            'status' => 'aktif',
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil kembali dari cuti',
        ]);
    }

    /**
     * Reset password karyawan
     */
    public function resetPassword(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        // Generate new temporary password
        $tempPassword = 'Temp' . random_int(100000, 999999) . '!';

        $karyawan->update([
            'password' => Hash::make($tempPassword),
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Password berhasil direset',
            'temp_password' => $tempPassword, // Send via email in real implementation
        ]);
    }

    /**
     * Delete karyawan
     */
    public function destroy($id)
    {
        $this->ensureAdminHRD();

        $karyawan = User::where('role', 'karyawan')->findOrFail($id);

        // Optionally: you can prevent deletion if there's related data
        // or just soft delete instead

        $karyawan->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Karyawan berhasil dihapus',
        ]);
    }

    /**
     * Get stats for dashboard
     */
    public function getStats()
    {
        $this->ensureAdminHRD();

        return response()->json([
            'total' => User::where('role', 'karyawan')->count(),
            'aktif' => User::where('role', 'karyawan')->where('status', 'aktif')->count(),
            'cuti' => User::where('role', 'karyawan')->where('status', 'cuti')->count(),
            'nonaktif' => User::where('role', 'karyawan')->where('status', 'nonaktif')->count(),
        ]);
    }
}
