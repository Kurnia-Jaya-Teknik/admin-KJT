<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Departemen;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Surat;
use Illuminate\Console\Command;

class AddKaryawanData extends Command
{
    protected $signature = 'add:karyawan-data';
    protected $description = 'Add test data for karyawanbos user';

    public function handle()
    {
        $user = User::where('email', 'karyawanbos@test.com')
            ->orWhere('name', 'karyawanbos')
            ->first();

        if (!$user) {
            $this->error('User karyawanbos not found');
            return;
        }

        $this->info('Found user: ' . $user->name . ' (ID: ' . $user->id . ')');

        // Update departemen if empty
        if (!$user->departemen_id) {
            $elektrik = Departemen::where('nama', 'Elektrik')->first();
            if ($elektrik) {
                $user->update(['departemen_id' => $elektrik->id]);
                $this->info('✅ Departemen updated to: ' . $elektrik->nama);
            }
        }

        // Add cuti disetujui
        $startDate = now()->subDays(20);
        $cutiAdded = 0;
        for ($i = 0; $i < 3; $i++) {
            if (!Cuti::where('user_id', $user->id)->where('jenis', ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat'][$i])->exists()) {
                Cuti::create([
                    'user_id' => $user->id,
                    'jenis' => ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat'][$i],
                    'durasi_hari' => 2 + $i,
                    'tanggal_mulai' => $startDate->clone()->addDays($i * 5),
                    'tanggal_selesai' => $startDate->clone()->addDays(($i * 5) + 2 + $i),
                    'alasan' => 'Test data',
                    'status' => 'Disetujui',
                    'tanggal_persetujuan' => $startDate->clone()->addDays($i * 5)->subDays(5),
                ]);
                $cutiAdded++;
            }
        }
        $this->info('✅ ' . $cutiAdded . ' data cuti disetujui ditambahkan');

        // Delete old lembur for this user
        Lembur::where('user_id', $user->id)->delete();
        
        // Add lembur disetujui bulan ini (March)
        $lemburAdded = 0;
        for ($i = 0; $i < 2; $i++) {
            $tanggalLembur = now()->subDays(5 + $i * 3); // Dalam bulan ini
            Lembur::create([
                'user_id' => $user->id,
                'tanggal' => $tanggalLembur,
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '20:00:00',
                'durasi_jam' => 3,
                'keterangan' => 'Test lembur',
                'status' => 'Disetujui',
                'tanggal_persetujuan' => $tanggalLembur->clone()->subDays(3),
            ]);
            $lemburAdded++;
        }
        $this->info('✅ ' . $lemburAdded . ' data lembur disetujui ditambahkan');

        // Add surat diterbitkan
        $suratAdded = 0;
        $suratJenis = ['Surat Keterangan', 'Surat Rekomendasi'];
        for ($i = 0; $i < 2; $i++) {
            $nomorSurat = 'SK-' . now()->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT) . '-' . rand(100, 999);
            if (!Surat::where('user_id', $user->id)->where('nomor_surat', $nomorSurat)->exists()) {
                Surat::create([
                    'user_id' => $user->id,
                    'jenis' => $suratJenis[$i],
                    'nomor_surat' => $nomorSurat,
                    'perihal' => 'Test data - ' . $suratJenis[$i],
                    'isi_surat' => 'Ini adalah surat test untuk ' . $suratJenis[$i],
                    'tanggal_surat' => now()->subDays(5 + $i),
                    'dibuat_oleh' => 19,
                    'status' => 'Diterbitkan',
                    'tanggal_persetujuan' => now()->subDays(5 + $i)->subDays(2),
                    'disetujui_oleh' => 20,
                    'dikirim_at' => now()->subDays(3 + $i),
                ]);
                $suratAdded++;
            }
        }
        $this->info('✅ ' . $suratAdded . ' surat diterbitkan ditambahkan');

        // Display summary
        $cutiDipakai = Cuti::where('user_id', $user->id)->where('status', 'Disetujui')->sum('durasi_hari');
        $lemburBulan = Lembur::where('user_id', $user->id)->where('status', 'Disetujui')->whereMonth('tanggal', now()->month)->sum('durasi_jam');
        $suratDiterima = Surat::where('user_id', $user->id)->where('status', 'Diterbitkan')->count();

        $this->line('');
        $this->info('📊 Data sekarang:');
        $this->line('   Cuti dipakai tahun ini: ' . $cutiDipakai . ' hari');
        $this->line('   Lembur bulan ini: ' . $lemburBulan . ' jam');
        $this->line('   Surat diterbitkan: ' . $suratDiterima);
        $this->line('');
        $this->info('✅ Selesai! Refresh dashboard untuk melihat perubahan.');
    }
}
