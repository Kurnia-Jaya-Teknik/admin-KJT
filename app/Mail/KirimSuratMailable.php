<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Surat;

class KirimSuratMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $surat;

    public function __construct(Surat $surat)
    {
        $this->surat = $surat;
    }

    public function build()
    {
        $subject = $this->surat->perihal ?? 'Surat Resmi';
        return $this->subject($subject)
                    ->view('emails.kirim_surat')
                    ->with(['surat' => $this->surat]);
    }
}
