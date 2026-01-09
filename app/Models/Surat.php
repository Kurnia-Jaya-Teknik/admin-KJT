<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'user_id',
        'jenis',
        'nomor_surat',
        'perihal',
        'isi_surat',
        'tanggal_surat',
        'status',
        'dibuat_oleh',
        'disetujui_oleh',
        'tanggal_persetujuan',
        'keterangan',
        'kop_surat_id',
        'generated_file_path',
        'generated_file_url',
        'generated_mime',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_persetujuan' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
