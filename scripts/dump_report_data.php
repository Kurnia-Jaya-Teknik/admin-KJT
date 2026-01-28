<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Cuti;

echo "Users with departemen:\n";
foreach (User::with('departemen')->limit(20)->get() as $u) {
    echo "ID: {$u->id} | Name: {$u->name} | Departemen: " . ($u->departemen?->nama ?? '(null)') . "\n";
}

$month = date('n'); $year = date('Y');
$items = Cuti::with('user','approver')->where('status','Disetujui')->whereYear('tanggal_mulai',$year)->whereMonth('tanggal_mulai',$month)->get();

echo "\nCuti rows for this month:\n";
foreach ($items as $c) {
    echo "ID: {$c->id} | User: " . ($c->user?->name ?? '(none)') . " | user->departemen: " . ($c->user?->departemen?->nama ?? '(null)') . " | jenis: {$c->jenis} | tanggal_mulai: {$c->tanggal_mulai}? | tanggal_selesai: {$c->tanggal_selesai}\n";
}

// show API-mapped structure for first 5
echo "\nAPI mapped items (first 5):\n";
$mapped = Cuti::with('user','approver')->where('status','Disetujui')->orderBy('tanggal_persetujuan','desc')->limit(5)->get()->map(function($c){
    $pel=[];
    if(is_array($c->dilimpahkan_ke) && count($c->dilimpahkan_ke)){
        $pel = \App\Models\User::whereIn('id',$c->dilimpahkan_ke)->get()->map(function($u){ return ['id'=>$u->id,'name'=>$u->name,'departemen'=>$u->departemen?->nama ?? null];});
    }
    return [
        'id'=>$c->id,
        'user'=> $c->user?->id ? ['id'=>$c->user->id,'name'=>$c->user->name,'departemen'=>$c->user->departemen?->nama ?? null] : null,
        'jenis'=>$c->jenis,
        'tanggal_mulai'=>$c->tanggal_mulai?->toDateString() ?? null,
        'tanggal_selesai'=>$c->tanggal_selesai?->toDateString() ?? null,
        'durasi_hari'=>$c->durasi_hari,
        'dilimpahkan_ke'=>$pel,
    ];
});
echo json_encode($mapped, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) . "\n";
