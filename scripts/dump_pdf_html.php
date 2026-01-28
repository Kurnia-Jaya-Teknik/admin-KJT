<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;

$month = 1; $year = 2026;
$items = Cuti::with('user','approver')->where('status','Disetujui')->whereYear('tanggal_mulai',$year)->whereMonth('tanggal_mulai',$month)->orderBy('tanggal_persetujuan','desc')->get();

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
});

$html = view('direktur.laporan-cuti-pdf', ['rows' => $rows->toArray(), 'period'=>'January 2026','query'=>'','kop_logo'=>null])->render();
file_put_contents(storage_path('app/public/tmp_laporan_cuti.html'), $html);
echo "Wrote storage/app/public/tmp_laporan_cuti.html\n";