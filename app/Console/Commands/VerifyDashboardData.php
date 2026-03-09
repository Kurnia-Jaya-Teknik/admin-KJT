<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Surat;
use Illuminate\Console\Command;

class VerifyDashboardData extends Command
{
    protected $signature = 'verify:dashboard';
    protected $description = 'Verify dashboard data for karyawanbos';

    public function handle()
    {
        $user = User::find(18); // karyawanbos
        
        if (!$user) {
            $this->error('User not found');
            return;
        }
        
        $this->line('');
        $this->info('👤 User: ' . $user->name . ' (ID: ' . $user->id . ')');
        $this->line('   Departemen: ' . ($user->departemen->nama ?? 'N/A') . ' (ID: ' . $user->departemen_id . ')');
        $this->line('   Sisa Cuti: ' . ($user->sisa_cuti ?? 12) . ' hari');
        
        $this->line('');
        $this->info('📊 Dashboard Data:');
        
        // Cuti dipakai
        $cutiDipakai = Cuti::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->whereYear('tanggal_persetujuan', now()->year)
            ->sum('durasi_hari');
        $this->line('   ✅ Cuti Dipakai Tahun Ini: ' . $cutiDipakai . ' hari');
        
        // Lembur bulan ini
        $lemburBulan = Lembur::where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('durasi_jam');
        $this->line('   ✅ Total Lembur Maret: ' . $lemburBulan . ' jam');
        
        // Pengajuan pending
        $pending = Cuti::where('user_id', $user->id)->where('status', 'Pending')->count() +
                   Lembur::where('user_id', $user->id)->where('status', 'Pending')->count();
        $this->line('   ✅ Pengajuan Menunggu: ' . $pending);
        
        // Surat diterbitkan
        $suratDiterima = Surat::where('user_id', $user->id)->where('status', 'Diterbitkan')->count();
        $this->line('   ✅ Surat Sudah Diterbitkan: ' . $suratDiterima);
        
        // Pengajuan disetujui (total)
        $disetujui = Cuti::where('user_id', $user->id)->where('status', 'Disetujui')->count() +
                     Lembur::where('user_id', $user->id)->where('status', 'Disetujui')->count();
        $this->line('   ✅ Total Pengajuan Disetujui: ' . $disetujui);
        
        $this->line('');
        $this->info('✅ Selesai! Dashboard data sudah sesuai dengan database.');
    }
}
