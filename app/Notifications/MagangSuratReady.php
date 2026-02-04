<?php

namespace App\Notifications;

use App\Models\Magang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MagangSuratReady extends Notification
{
    use Queueable;

    public Magang $magang;
    public string $fileName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Magang $magang, string $fileName)
    {
        $this->magang = $magang;
        $this->fileName = $fileName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Surat Magang Sudah Siap - ' . $this->magang->sekolah_asal)
            ->greeting('Assalamu\'alaikum ' . $notifiable->name)
            ->line('Permintaan surat magang Anda telah diproses oleh Admin HRD.')
            ->line('**Informasi Surat:**')
            ->line('- Institusi: ' . $this->magang->sekolah_asal)
            ->line('- Peserta: ' . $this->magang->nama_peserta)
            ->line('- Nomor Surat: ' . ($this->magang->nomor_surat_dibuat ?? '-'))
            ->line('- Tanggal Surat: ' . optional($this->magang->tanggal_surat_dibuat)->format('d/m/Y') ?? '-')
            ->action('Lihat Surat', route('direktur.persetujuan-surat'))
            ->line('Terima kasih telah menggunakan sistem HR kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Surat Magang Siap',
            'message' => 'Surat magang untuk ' . $this->magang->sekolah_asal . ' (' . $this->magang->nama_peserta . ') sudah siap diunduh',
            'type' => 'success',
            'icon' => 'check-circle',
            'magang_id' => $this->magang->id,
            'file_name' => $this->fileName,
            'file_url' => asset('storage/' . $this->magang->file_surat),
        ];
    }
}
