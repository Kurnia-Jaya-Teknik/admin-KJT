<?php

namespace App\Console\Commands;

use App\Models\Departemen;
use Illuminate\Console\Command;

class CheckAllDepartemens extends Command
{
    protected $signature = 'check:all-departemens';
    protected $description = 'Check all departemens in database';

    public function handle()
    {
        $departemens = Departemen::all();
        
        $this->line('');
        $this->info('📊 Semua Departemen di Database:');
        $this->line('');
        
        foreach ($departemens as $dept) {
            $this->line('ID: ' . str_pad($dept->id, 3) . ' | Kode: ' . str_pad($dept->kode, 15) . ' | Nama: ' . $dept->nama);
        }
        
        $this->line('');
        $this->info('Total departemen: ' . $departemens->count());
    }
}
