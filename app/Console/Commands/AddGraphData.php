<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Departemen;
use Illuminate\Console\Command;

class AddGraphData extends Command
{
    protected $signature = 'add:graph-data';
    protected $description = 'Add data for dashboard graphs for all months';

    public function handle()
    {
        $this->line('');
        $this->info('📊 Menambahkan data untuk grafik...');
        $this->line('');

        // Get all karyawan
        $karyawanList = User::where('role', 'karyawan')->get();
        $departemens = Departemen::all();

        // Add cuti for last 6 months
        for ($monthBack = 5; $monthBack >= 0; $monthBack--) {
            $month = now()->subMonths($monthBack);
            
            // Add 3-5 cuti per bulan
            $cutiCount = rand(3, 5);
            for ($i = 0; $i < $cutiCount; $i++) {
                $startDay = rand(1, 15);
                $startDate = $month->clone()->setDay($startDay);
                
                Cuti::create([
                    'user_id' => $karyawanList->random()->id,
                    'jenis' => ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat'][rand(0, 2)],
                    'durasi_hari' => rand(1, 5),
                    'tanggal_mulai' => $startDate,
                    'tanggal_selesai' => $startDate->clone()->addDays(rand(1, 4)),
                    'alasan' => 'Data grafik',
                    'status' => rand(0, 100) > 20 ? 'Disetujui' : 'Pending',
                    'tanggal_persetujuan' => rand(0, 100) > 20 ? $startDate->clone()->subDays(rand(1, 5)) : null,
                ]);
            }
        }
        $this->info('✅ Data cuti untuk 6 bulan ditambahkan');

        // Add lembur for last 6 months
        for ($monthBack = 5; $monthBack >= 0; $monthBack--) {
            $month = now()->subMonths($monthBack);
            $daysInMonth = $month->daysInMonth;
            
            // Add 2-4 lembur per bulan
            $lemburCount = rand(2, 4);
            for ($i = 0; $i < $lemburCount; $i++) {
                $day = rand(1, $daysInMonth);
                $tanggal = $month->clone()->setDay($day);
                
                Lembur::create([
                    'user_id' => $karyawanList->random()->id,
                    'tanggal' => $tanggal,
                    'jam_mulai' => '17:00:00',
                    'jam_selesai' => date('H:i:s', strtotime('17:00:00') + rand(2, 5) * 3600),
                    'durasi_jam' => rand(2, 5),
                    'keterangan' => 'Data grafik',
                    'status' => rand(0, 100) > 20 ? 'Disetujui' : 'Pending',
                    'tanggal_persetujuan' => rand(0, 100) > 20 ? $tanggal->clone()->subDays(rand(1, 3)) : null,
                ]);
            }
        }
        $this->info('✅ Data lembur untuk 6 bulan ditambahkan');

        // Add lembur per departemen untuk bulan ini
        foreach ($departemens as $dept) {
            $lemburJam = rand(10, 30); // 10-30 jam per divisi per bulan
            
            // Get karyawan in this department
            $karyawanDept = $karyawanList->where('departemen_id', $dept->id);
            
            if ($karyawanDept->count() > 0) {
                $user = $karyawanDept->random();
                
                Lembur::create([
                    'user_id' => $user->id,
                    'tanggal' => now()->subDays(rand(1, 10)),
                    'jam_mulai' => '17:00:00',
                    'jam_selesai' => date('H:i:s', strtotime('17:00:00') + ($lemburJam % 5) * 3600),
                    'durasi_jam' => $lemburJam,
                    'keterangan' => 'Data grafik divisi ' . $dept->nama,
                    'status' => 'Disetujui',
                    'tanggal_persetujuan' => now()->subDays(rand(5, 15)),
                ]);
            }
        }
        $this->info('✅ Data lembur per divisi untuk bulan ini ditambahkan');

        // Display summary
        $totalCuti = Cuti::count();
        $totalLembur = Lembur::count();
        $cutiThisMonth = Cuti::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $lemburThisMonth = Lembur::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count();

        $this->line('');
        $this->info('📈 Ringkasan Data:');
        $this->line('   Total Cuti: ' . $totalCuti);
        $this->line('   Total Lembur: ' . $totalLembur);
        $this->line('   Cuti Bulan Ini: ' . $cutiThisMonth);
        $this->line('   Lembur Bulan Ini: ' . $lemburThisMonth);
        $this->line('');
        $this->info('✅ Data grafik selesai ditambahkan! Refresh dashboard untuk melihat grafik dengan data lengkap.');
    }
}
