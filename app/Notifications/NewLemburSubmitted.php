<?php

namespace App\Notifications;

use App\Models\Lembur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLemburSubmitted extends Notification implements ShouldQueue
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
        return [
            'type' => 'lembur',
            'lembur_id' => $this->lembur->id,
            'user_id' => $this->lembur->user_id,
            'user_name' => $this->lembur->user->name ?? 'Karyawan',
            'tanggal' => $this->lembur->tanggal,
            'jam_mulai' => $this->lembur->jam_mulai,
            'jam_selesai' => $this->lembur->jam_selesai,
            'durasi_jam' => $this->lembur->durasi_jam,
            'message' => 'Pengajuan lembur baru dari ' . ($this->lembur->user->name ?? 'Karyawan'),
            'url' => url('/direktur/persetujuan-cuti-lembur') . '?type=lembur&id=' . $this->lembur->id,
        ];
    }
}
