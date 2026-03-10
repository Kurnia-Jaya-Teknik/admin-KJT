<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratGeneratedNotification extends Notification implements ShouldQueue
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
            ->subject('Surat Cuti Anda Siap')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Surat cuti Anda telah disiapkan dan siap untuk diunduh.')
            ->line('Nomor Surat: ' . $this->cuti->nomor_surat)
            ->line('Jenis: ' . $this->cuti->jenis)
            ->line('Periode: ' . $this->cuti->tanggal_mulai->format('d M Y') . ' - ' . $this->cuti->tanggal_selesai->format('d M Y'))
            ->action('Unduh Surat', url('/pengajuan-cuti'))
            ->line('Terima kasih!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'surat_generated',
            'cuti_id' => $this->cuti->id,
            'message' => 'Surat cuti Anda dengan nomor ' . $this->cuti->nomor_surat . ' siap diunduh',
            'nomor_surat' => $this->cuti->nomor_surat,
        ];
    }
}
