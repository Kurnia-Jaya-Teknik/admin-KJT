<?php

namespace App\Notifications;

use App\Models\SuratKeterangan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SuratKeteranganSent extends Notification
{
    use Queueable;

    public $surat;

    /**
     * Create a new notification instance.
     */
    public function __construct(SuratKeterangan $surat)
    {
        $this->surat = $surat;
    }

    /**
     * Get the notification's delivery channels.
     * Fokus ke database notification dulu, email bisa ditambah nanti
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'surat_id' => $this->surat->id,
            'nomor_surat' => $this->surat->nomor_surat,
            'jabatan' => $this->surat->jabatan,
            'unit_kerja' => $this->surat->unit_kerja,
            'tanggal_surat' => $this->surat->tanggal_surat?->format('d/m/Y'),
            'file_surat' => $this->surat->file_surat,
            'message' => 'Surat keterangan ' . $this->surat->nomor_surat . ' telah dikirim dan siap diunduh',
            'type' => 'surat_keterangan',
            'icon' => '📄',
        ];
    }
}
