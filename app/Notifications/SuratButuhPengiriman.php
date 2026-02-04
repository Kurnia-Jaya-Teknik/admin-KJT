<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Surat;

class SuratButuhPengiriman extends Notification
{
    use Queueable;

    protected $surat;

    public function __construct(Surat $surat)
    {
        $this->surat = $surat;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'type' => 'surat_butuh_pengiriman',
            'surat_id' => $this->surat->id,
            'perihal' => $this->surat->perihal,
            'user_id' => $this->surat->user_id,
        ]);
    }

    public function toMail($notifiable)
    {
        $url = url('/admin/surat');
        return (new MailMessage)
            ->subject('Surat menunggu pengiriman: ' . ($this->surat->perihal ?? ''))
            ->line('Ada surat baru yang harus dikirim ke karyawan.')
            ->line('Perihal: ' . ($this->surat->perihal ?? '-'))
            ->action('Buka Daftar Surat', $url)
            ->line('Silakan periksa dan kirim surat sesuai prosedur.');
    }
}
