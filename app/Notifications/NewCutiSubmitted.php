<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCutiSubmitted extends Notification implements ShouldQueue
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
        return [
            'type' => 'cuti',
            'cuti_id' => $this->cuti->id,
            'user_id' => $this->cuti->user_id,
            'user_name' => $this->cuti->user->name ?? 'Karyawan',
            'jenis' => $this->cuti->jenis,
            'tanggal_mulai' => $this->cuti->tanggal_mulai,
            'tanggal_selesai' => $this->cuti->tanggal_selesai,
            'durasi_hari' => $this->cuti->durasi_hari,
            'message' => 'Pengajuan cuti baru dari ' . ($this->cuti->user->name ?? 'Karyawan'),
        ];
    }
}
