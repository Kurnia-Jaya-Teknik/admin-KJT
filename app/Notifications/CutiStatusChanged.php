<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CutiStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cuti;

    public function __construct(Cuti $cuti)
    {
        $this->cuti = $cuti;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $approver = $this->cuti->approver;
        return [
            'type' => 'cuti_status_changed',
            'cuti_id' => $this->cuti->id,
            'status' => $this->cuti->status,
            'jenis' => $this->cuti->jenis,
            'tanggal_mulai' => $this->cuti->tanggal_mulai,
            'tanggal_selesai' => $this->cuti->tanggal_selesai,
            'durasi_hari' => $this->cuti->durasi_hari,
            'approver_name' => $approver ? $approver->name : 'Admin',
            'message' => 'Pengajuan cuti Anda telah ' . ($this->cuti->status === 'Disetujui' ? 'disetujui' : 'ditolak'),
        ];
    }
}
