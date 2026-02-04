<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMagangRequest extends Model
{
    protected $fillable = [
        'sekolah_asal',
        'jumlah_siswa',
        'keterangan',
        'status',
        'tanggal_diminta',
    ];

    protected $casts = [
        'tanggal_diminta' => 'datetime',
    ];

    public function magangs()
    {
        return $this->hasMany(Magang::class, 'surat_magang_request_id');
    }
}
