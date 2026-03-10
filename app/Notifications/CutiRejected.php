<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CutiRejected extends Notification implements ShouldQueue
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
            ->subject('Pengajuan Cuti Ditolak')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Sayangnya, pengajuan cuti Anda telah ditolak.')
            ->line('Alasan: ' . ($this->cuti->keterangan_persetujuan ?? 'Tidak ada keterangan'))
            ->line('Anda dapat mengajukan pengajuan cuti kembali.')
            ->action('Lihat Riwayat', url('/pengajuan-cuti'))
            ->line('Terima kasih!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'cuti_rejected',
            'cuti_id' => $this->cuti->id,
            'message' => 'Pengajuan cuti Anda ditolak. Alasan: ' . $this->cuti->keterangan_persetujuan,
        ];
    }
}
