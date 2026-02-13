<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeterangan extends Model
{
    protected $fillable = [
        'user_id',
        'surat_keterangan_request_id',
        'nomor_surat',
        'tanggal_surat',
        'jabatan',
        'unit_kerja',
        'tanggal_mulai_kerja',
        'tanggal_selesai_kerja',
        'keterangan',
        'file_surat',
        'status',
        'is_sent',
        'sent_at',
        'sent_notes',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_mulai_kerja' => 'date',
        'tanggal_selesai_kerja' => 'date',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(SuratKeteranganRequest::class, 'surat_keterangan_request_id');
    }
}
