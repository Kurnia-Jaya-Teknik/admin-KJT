<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $fillable = [
        'user_id',
        'surat_magang_request_id',
        'nama_peserta',
        'nim_nis',
        'sekolah_asal',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'keperluan',
        'status',
        'phone',
        'nomor_surat_diminta',
        'tanggal_surat_diminta',
        'nomor_surat_dibuat',
        'tanggal_surat_dibuat',
        'file_surat',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_surat_diminta' => 'date',
        'tanggal_surat_dibuat' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suratMagangRequest()
    {
        return $this->belongsTo(SuratMagangRequest::class, 'surat_magang_request_id');
    }
}
