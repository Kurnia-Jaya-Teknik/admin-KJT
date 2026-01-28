<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratCutiReady extends Notification
{
    use Queueable;

    public $surat;

    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $downloadUrl = asset($this->surat->generated_file_url);
        
        return (new MailMessage)
            ->subject('Surat Cuti Anda Sudah Siap Download')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Surat cuti Anda untuk periode ' . $this->surat->tanggal_surat->format('d/m/Y') . ' sudah siap dan dapat didownload.')
            ->action('Download Surat', $downloadUrl)
            ->line('Nama File: ' . basename($this->surat->generated_file_url))
            ->line('Terima kasih telah menggunakan sistem ini.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Surat Cuti Siap Download',
            'message' => 'Surat cuti Anda sudah siap dapat didownload',
            'surat_id' => $this->surat->id,
            'file_url' => $this->surat->generated_file_url,
            'file_name' => basename($this->surat->generated_file_url),
        ];
    }
}
