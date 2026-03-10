<?php

namespace App\Notifications;

use App\Models\Cuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratNeedsToBeGenerated extends Notification implements ShouldQueue
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
            ->subject('Ada Pengajuan Cuti yang Membutuhkan Surat')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Pengajuan cuti dari ' . $this->cuti->user->name . ' telah disetujui oleh direktur.')
            ->line('Anda dibutuhkan untuk membuat surat cuti.')
            ->line('Karyawan: ' . $this->cuti->user->name)
            ->line('Periode: ' . $this->cuti->tanggal_mulai->format('d M Y') . ' - ' . $this->cuti->tanggal_selesai->format('d M Y'))
            ->action('Buat Surat', url('/admin/approvals'))
            ->line('Terima kasih!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'surat_needs_generation',
            'cuti_id' => $this->cuti->id,
            'message' => 'Pengajuan cuti dari ' . $this->cuti->user->name . ' membutuhkan surat',
            'karyawan' => $this->cuti->user->name,
        ];
    }
}
