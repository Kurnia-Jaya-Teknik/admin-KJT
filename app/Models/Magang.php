<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $fillable = [
        'user_id',
        'nama_peserta',
        'sekolah_asal',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'keperluan',
        'status',
        'phone',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
