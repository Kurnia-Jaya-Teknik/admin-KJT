<p>{{ optional($cuti->tanggal_persetujuan)->format('d M Y') ?? now()->format('d M Y') }}</p>

<p>Kepada Yth.<br><strong>Direktur</strong><br>di Tempat</p>

<p><strong>Perihal:</strong> Persetujuan Cuti - {{ $cuti->user->name ?? '' }}</p>

<p>Dengan hormat,</p>

<p>Berdasarkan pengajuan cuti yang diajukan oleh <strong>{{ $cuti->user->name ?? '' }}</strong> pada tanggal
    {{ $cuti->created_at->format('d M Y') }}, bersama ini kami sampaikan bahwa pengajuan cuti tersebut telah
    <strong>disetujui</strong>. Berikut rincian cuti:</p>

<ul>
    <li><strong>Jenis Cuti:</strong> {{ $cuti->jenis }}</li>
    <li><strong>Durasi:</strong> {{ $cuti->durasi_hari }} hari ({{ $cuti->tanggal_mulai->format('d M Y') }} -
        {{ $cuti->tanggal_selesai->format('d M Y') }})</li>
    <li><strong>Alasan:</strong> {{ $cuti->alasan ?? '-' }}</li>
</ul>

<p>Demikian pemberitahuan ini kami sampaikan. Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.</p>

<p>Hormat kami,</p>
<p><strong>{{ $cuti->user->name ?? '' }}</strong></p>
