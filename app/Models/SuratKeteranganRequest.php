<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeteranganRequest extends Model
{
    protected $fillable = [
        'user_id',
        'alasan',
        'keperluan',
        'tanggal_diminta',
        'status',
    ];

    protected $casts = [
        'tanggal_diminta' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
