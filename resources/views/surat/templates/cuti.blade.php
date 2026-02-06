@php
    $kopSurat = \App\Models\KopSurat::where('is_template', true)->first();
@endphp

<div style="max-width: 210mm; margin: 0 auto; background: white; padding: 20mm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; color: #000;">
    
    <!-- KOP SURAT -->
    @if($kopSurat && $kopSurat->file_path)
        <div style="text-align: center; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px;">
            <img src="{{ asset('storage/' . $kopSurat->file_path) }}" alt="Kop Surat" style="max-width: 100%; height: auto; max-height: 120px;">
        </div>
    @else
        <div style="text-align: center; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px;">
            <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">PT. KURNIA JAYA TEKNIK</h2>
            <p style="margin: 5px 0; font-size: 10pt;">Jl. Contoh No. 123, Jakarta 12345</p>
            <p style="margin: 5px 0; font-size: 10pt;">Telp: (021) 12345678 | Email: info@kurniajayteknik.com</p>
        </div>
    @endif
    
    <!-- NOMOR SURAT -->
    <div style="margin-bottom: 30px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 20%; padding: 2px 0; border: none;">Nomor</td>
                <td style="width: 2%; padding: 2px 0; border: none;">:</td>
                <td style="padding: 2px 0; border: none;">{{ str_pad($cuti->id ?? 0, 3, '0', STR_PAD_LEFT) }}/CUTI/KJT/{{ now()->format('m/Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 0; border: none;">Lampiran</td>
                <td style="padding: 2px 0; border: none;">:</td>
                <td style="padding: 2px 0; border: none;">-</td>
            </tr>
            <tr>
                <td style="padding: 2px 0; border: none;">Perihal</td>
                <td style="padding: 2px 0; border: none;">:</td>
                <td style="padding: 2px 0; border: none;"><strong>{{ $cuti->jenis === 'Ijin Sakit' ? 'Pemberitahuan Ijin Sakit' : 'Persetujuan Cuti' }}</strong></td>
            </tr>
        </table>
    </div>
    
    <!-- TUJUAN SURAT -->
    <div style="margin-bottom: 30px;">
        <p style="margin: 0;">Kepada Yth.</p>
        <p style="margin: 5px 0;"><strong>{{ $cuti->user->name ?? '-' }}</strong></p>
        <p style="margin: 0;">Di Tempat</p>
    </div>
    
    <!-- ISI SURAT -->
    <div style="margin-bottom: 30px;">
        <p style="text-align: justify; text-indent: 50px; margin-bottom: 15px;">
            Dengan hormat,
        </p>
        
        @if($cuti->jenis === 'Ijin Sakit')
            <p style="text-align: justify; text-indent: 50px; margin-bottom: 15px;">
                Berdasarkan surat keterangan dokter yang telah diserahkan, bersama ini kami sampaikan bahwa Saudara/i <strong>{{ $cuti->user->name ?? '-' }}</strong> dinyatakan tidak dapat melaksanakan tugas karena sakit dan memerlukan istirahat.
            </p>
        @else
            <p style="text-align: justify; text-indent: 50px; margin-bottom: 15px;">
                Berdasarkan pengajuan cuti yang diajukan oleh <strong>{{ $cuti->user->name ?? '-' }}</strong> pada tanggal {{ $cuti->created_at->format('d F Y') }}, dengan ini kami sampaikan bahwa permohonan cuti telah <strong>DISETUJUI</strong>.
            </p>
        @endif
        
        <p style="margin-bottom: 10px;"><strong>Rincian {{ $cuti->jenis === 'Ijin Sakit' ? 'Ijin Sakit' : 'Cuti' }}:</strong></p>
        <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="width: 30%; padding: 5px 10px; border: 1px solid #000; background-color: #f5f5f5;"><strong>Jenis</strong></td>
                <td style="padding: 5px 10px; border: 1px solid #000;">{{ $cuti->jenis }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 10px; border: 1px solid #000; background-color: #f5f5f5;"><strong>Tanggal Mulai</strong></td>
                <td style="padding: 5px 10px; border: 1px solid #000;">{{ $cuti->tanggal_mulai->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 10px; border: 1px solid #000; background-color: #f5f5f5;"><strong>Tanggal Selesai</strong></td>
                <td style="padding: 5px 10px; border: 1px solid #000;">{{ $cuti->tanggal_selesai->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 10px; border: 1px solid #000; background-color: #f5f5f5;"><strong>Durasi</strong></td>
                <td style="padding: 5px 10px; border: 1px solid #000;">{{ $cuti->durasi_hari }} hari</td>
            </tr>
            @if($cuti->alasan)
            <tr>
                <td style="padding: 5px 10px; border: 1px solid #000; background-color: #f5f5f5;"><strong>{{ $cuti->jenis === 'Ijin Sakit' ? 'Diagnosa/Keterangan' : 'Alasan' }}</strong></td>
                <td style="padding: 5px 10px; border: 1px solid #000;">{{ $cuti->alasan }}</td>
            </tr>
            @endif
        </table>
        
        <p style="text-align: justify; text-indent: 50px;">
            Demikian surat ini dibuat untuk dapat digunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
        </p>
    </div>
    
    <!-- TTD -->
    <div style="margin-top: 50px;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; border: none;"></td>
                <td style="width: 50%; text-align: center; border: none;">
                    <p style="margin: 0;">{{ \Carbon\Carbon::parse($cuti->tanggal_persetujuan ?? now())->locale('id')->isoFormat('D MMMM Y') }}</p>
                    <p style="margin: 5px 0;"><strong>Direktur,</strong></p>
                    <div style="height: 80px;"></div>
                    <p style="margin: 0; border-top: 1px solid #000; display: inline-block; padding-top: 5px; min-width: 200px;">
                        <strong>{{ auth()->user()->name ?? 'Direktur' }}</strong>
                    </p>
                </td>
            </tr>
        </table>
    </div>
    
</div>
