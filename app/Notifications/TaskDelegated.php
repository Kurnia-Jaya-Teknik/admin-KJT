<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Cuti;

class TaskDelegated extends Notification implements ShouldQueue
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
            'type' => 'pelimpahan',
            'cuti_id' => $this->cuti->id,
            'from_user_id' => $this->cuti->user_id,
            'from_user_name' => $this->cuti->user->name ?? 'Karyawan',
            'message' => 'Anda dilimpahkan tugas sementara oleh ' . ($this->cuti->user->name ?? 'rekan kerja') . ' selama cuti mereka.',
            'url' => url('/karyawan/riwayat') . '?type=cuti&id=' . $this->cuti->id,
        ];
    }
}
