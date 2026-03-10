<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SuratHasBeenGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cuti;

    public function __construct(Cuti $cuti)
    {
        $this->cuti = $cuti;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'surat_generated_report',
            'cuti_id' => $this->cuti->id,
            'message' => 'Surat cuti untuk ' . $this->cuti->user->name . ' dengan nomor ' . $this->cuti->nomor_surat . ' telah dibuat',
            'nomor_surat' => $this->cuti->nomor_surat,
            'karyawan' => $this->cuti->user->name,
            'tanggal_dibuat' => $this->cuti->tanggal_surat_dibuat,
        ];
    }
}
