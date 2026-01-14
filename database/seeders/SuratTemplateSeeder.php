<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratTemplate;
use Illuminate\Support\Str;

class SuratTemplateSeeder extends Seeder
{
    public function run()
    {
        if (SuratTemplate::count() > 0) return;

        SuratTemplate::create([
            'name' => 'Surat Keterangan Kerja - Default',
            'slug' => Str::slug('Surat Keterangan Kerja Default').'-'.Str::random(4),
            'jenis' => 'kerja',
            'content' => '<p>Yang bertanda tangan, menerangkan bahwa <strong>{{NAMA}}</strong> bekerja sebagai <strong>{{JABATAN}}</strong> sejak tanggal <strong>{{TANGGAL}}</strong>.</p>',
            'schema' => [
                ['key'=>'NAMA','label'=>'Nama Karyawan','type'=>'text'],
                ['key'=>'JABATAN','label'=>'Jabatan','type'=>'text'],
                ['key'=>'TANGGAL','label'=>'Tanggal Bergabung','type'=>'date'],
            ],
            'placeholders' => ['NAMA','JABATAN','TANGGAL'],
            'is_active' => true,
            'created_by' => 1,
        ]);
    }
}