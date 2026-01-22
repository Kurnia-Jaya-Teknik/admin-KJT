<?php

namespace App\Notifications;

use App\Models\Lembur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LemburStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $lembur;

    public function __construct(Lembur $lembur)
    {
        $this->lembur = $lembur;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $approver = $this->lembur->approver;
        return [
            'type' => 'lembur_status_changed',
            'lembur_id' => $this->lembur->id,
            'status' => $this->lembur->status,
            'tanggal' => $this->lembur->tanggal,
            'jam_mulai' => $this->lembur->jam_mulai,
            'jam_selesai' => $this->lembur->jam_selesai,
            'durasi_jam' => $this->lembur->durasi_jam,
            'approver_name' => $approver ? $approver->name : 'Admin',
            'message' => 'Pengajuan lembur Anda telah ' . ($this->lembur->status === 'Disetujui' ? 'disetujui' : 'ditolak'),
        ];
    }
}
