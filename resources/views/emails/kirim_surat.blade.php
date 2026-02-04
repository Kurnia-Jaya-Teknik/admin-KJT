<div style="font-family:sans-serif; color:#222;">
    <h2>{{ $surat->perihal ?? 'Surat Resmi' }}</h2>
    <p>Yth. <strong>Direktur</strong>,</p>
    <div style="margin-top:1rem;">
        {!! $surat->isi_surat ?? '' !!}
    </div>
    @php
        // Try to resolve the original requester (e.g., Cuti) to sign as karyawan
        $signer = null;
        if (!empty($surat->referensi_type) && !empty($surat->referensi_id)) {
            try {
                $refClass = $surat->referensi_type;
                $ref = $refClass::find($surat->referensi_id);
                if ($ref && isset($ref->user)) {
                    $signer = $ref->user->name;
                }
            } catch (\Throwable $e) {
                /* ignore */
            }
        }
        if (!$signer) {
            $signer = $surat->user->name ?? ($surat->creator->name ?? config('app.name'));
        }
    @endphp
    <p style="margin-top:1rem;">Hormat kami,<br /><strong>{{ $signer }}</strong></p>
</div>
