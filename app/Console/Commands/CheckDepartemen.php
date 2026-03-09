<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckDepartemen extends Command
{
    protected $signature = 'check:departemen';
    protected $description = 'Check departemen for all users';

    public function handle()
    {
        $users = User::where('role', 'karyawan')->with('departemen')->get();
        
        $this->line('');
        $this->info('📊 Departemen untuk karyawan:');
        $this->line('');
        
        foreach ($users as $user) {
            $deptName = $user->departemen?->nama ?? 'NULL';
            $deptId = $user->departemen_id ?? 'NULL';
            $this->line('ID: ' . str_pad($user->id, 4) . ' | Nama: ' . str_pad($user->name, 25) . ' | Dept: ' . str_pad($deptName, 15) . ' | Dept ID: ' . $deptId);
        }
        
        $this->line('');
        $this->info('Total karyawan: ' . $users->count());
    }
}
