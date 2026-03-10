<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CutiApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cuti;

    public function __construct(Cuti $cuti)
    {
        $this->cuti = $cuti;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pengajuan Cuti Disetujui')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Pengajuan cuti Anda telah disetujui oleh direktur.')
            ->line('Jenis Cuti: ' . $this->cuti->jenis)
            ->line('Tanggal Mulai: ' . $this->cuti->tanggal_mulai->format('d M Y'))
            ->line('Tanggal Selesai: ' . $this->cuti->tanggal_selesai->format('d M Y'))
            ->line('Durasi: ' . $this->cuti->durasi_hari . ' hari')
            ->line('Silakan cek riwayat pengajuan Anda untuk detail selengkapnya.')
            ->action('Lihat Riwayat', url('/pengajuan-cuti'))
            ->line('Terima kasih!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'cuti_approved',
            'cuti_id' => $this->cuti->id,
            'message' => 'Pengajuan cuti Anda untuk ' . $this->cuti->tanggal_mulai->format('d M Y') . ' telah disetujui',
        ];
    }
}
