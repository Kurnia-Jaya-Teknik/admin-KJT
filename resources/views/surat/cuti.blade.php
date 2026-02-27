<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Cuti</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            color: #000;
            line-height: 1.4;
            background: white;
<<<<<<< Updated upstream
            font-size: 12px;
        }
        @page {
            size: A4;
            margin: 15mm 15mm 15mm 15mm;
        }
        .page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 15mm;
            background: white;
        }
        /* Header dengan Logo dan Kop Surat */
         /* ================= HEADER ================= */
        .header-table {
            border-bottom: 2px solid #000;
            margin-bottom: 12px;
            padding-bottom: 6px;
        }
        .header-text {
            font-size: 9.5pt;
            font-weight: bold;
            line-height: 1.3;
        }


        .logo {
            width: 640px;
            height: auto;
            display: block;
            margin: 0 auto 5px auto;
        }

        .company-name {
            font-weight: bold;
=======
>>>>>>> Stashed changes
            font-size: 11pt;
        }

        @page {
            size: A4;
            margin: 20mm 20mm 20mm 20mm;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            background: white;
        }

        /* Header dengan Logo */
        .header-table {
            border-bottom: 3px solid #000;
            margin-bottom: 15px;
            padding-bottom: 8px;
        }

        .logo {
            width: 680px;
            display: block;
            margin: 0 auto 5px auto;
        }

        .header-text {
            font-size: 10pt;
            font-weight: bold;
            line-height: 1.4;
        }

        /* Judul Form */
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin: 15px 0;
            text-decoration: underline;
            letter-spacing: 1px;
        }

        /* Data Karyawan Section */
        .data-section {
            margin: 15px 0;
            font-size: 11pt;
        }

        .intro-text {
            margin-bottom: 12px;
<<<<<<< Updated upstream
            text-align: justify;
=======
            font-weight: normal;
>>>>>>> Stashed changes
        }

        /* Tabel Data Karyawan */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 10.5pt;
        }

        .data-table td {
            padding: 6px 8px;
            border: 1px solid #000;
            vertical-align: top;
        }

        .data-table .label-cell {
            width: 35%;
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .data-table .value-cell {
            width: 65%;
        }

        /* Checkbox untuk Jenis Cuti */
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 5px 0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .checkbox {
            width: 14px;
            height: 14px;
            border: 1.5px solid #000;
            display: inline-block;
            text-align: center;
            line-height: 12px;
            font-weight: bold;
            font-size: 10pt;
        }

        /* Tanda Tangan Section */
        .signature-section {
            margin-top: 25px;
            font-size: 10pt;
        }

        .sig-date {
            text-align: right;
            margin-bottom: 50px;
        }

        .sig-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .sig-table td {
            border: 1px solid #000;
            text-align: center;
            padding: 8px 5px;
            vertical-align: top;
            font-size: 9.5pt;
        }

        .sig-header {
            height: 30px;
            font-weight: bold;
        }

        .sig-space {
            height: 60px;
        }

        .sig-name {
            height: 30px;
            font-weight: normal;
        }

        /* Footer Notes */
        .notes {
            margin-top: 15px;
            font-size: 9pt;
            line-height: 1.5;
        }

        .notes .title-note {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .notes ol {
            margin-left: 20px;
            padding-left: 0;
        }

        .notes li {
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Header dengan Logo dan Info Perusahaan -->
        <table class="header-table">
            <tr>
                <td colspan="2" align="center">
                    <img src="{{ $logoPath }}" class="logo" alt="Logo Perusahaan">
                </td>
            </tr>
            <tr>
                <td width="65%" class="header-text" align="left">
                    Dsn. Kemuning RT/RW 10/04 Ds. Gambirikuning, Kraton<br>
                    Pasuruan – Jawa Timur, 67151
                </td>
                <td width="35%" class="header-text" align="right">
                    <div style="text-align:left; display:inline-block;">
                        Phone : 0343-5618810<br>
                        Email : kurniajayatek@gmail.com
                    </div>
                </td>
            </tr>
        </table>

<<<<<<< Updated upstream
        <!-- Judul Surat -->
        <div style="border-top: 2px solid #000; border-bottom: 1px solid #000; height: 4px; margin: 6px 0 15px 0;"></div>
        <div class="title" style="text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 10px;">SURAT PERMOHONAN CUTI</div>
=======
        <!-- Judul Formulir -->
        <div class="title">FORMULIR CUTI</div>
>>>>>>> Stashed changes

        <!-- Intro Text -->
        <div class="data-section">
            <p class="intro-text">Yang bertanda tangan di bawah ini:</p>

            <!-- Data Karyawan dalam Tabel -->
            <table class="data-table">
                <tr>
                    <td class="label-cell">Nama</td>
                    <td class="value-cell">{{ $karyawan->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Jabatan / Divisi</td>
                    <td class="value-cell">{{ $karyawan->jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Tanggal Masuk Perusahaan</td>
                    <td class="value-cell">
                        {{ $karyawan->tanggal_bergabung ? $karyawan->tanggal_bergabung->format('d/m/Y') : '-' }}
                    </td>
                </tr>
            </table>

            <!-- Jenis Cuti dengan Checkbox -->
            <p style="margin: 12px 0 8px 0; font-weight: bold;">Mengajukan Cuti:</p>
            <div class="checkbox-row" style="margin-left: 20px;">
                <div class="checkbox-item">
                    <span class="checkbox">{{ ($cuti->jenis ?? '') === 'Cuti Tahunan' ? '✓' : '' }}</span>
                    <span>Tahunan</span>
                </div>
                <div class="checkbox-item">
                    <span class="checkbox">{{ ($cuti->jenis ?? '') === 'Ijin Sakit' ? '✓' : '' }}</span>
                    <span>Sakit</span>
                </div>
                <div class="checkbox-item">
                    <span
                        class="checkbox">{{ !in_array($cuti->jenis ?? '', ['Cuti Tahunan', 'Ijin Sakit']) ? '✓' : '' }}</span>
                    <span>Lainnya: ________________</span>
                </div>
            </div>

<<<<<<< Updated upstream
            <div class="info-line">
                <span class="info-label">Jabatan/Devisi</span>
                <span class="info-value">{{ $karyawan->departemen->nama ?? $karyawan->jabatan ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Tanggal Masuk ke Perusahaan</span>
                <span class="info-value">{{ $karyawan->tanggal_bergabung ? \Carbon\Carbon::parse($karyawan->tanggal_bergabung)->format('d/m/Y') : '' }}</span>
            </div>

            <div class="options">
                <span>Mengajukan cuti : </span>
                <span>
                    @if($cuti->jenis === 'Cuti Tahunan')
                        &nbsp; ✓ a. Tahunan &nbsp; &nbsp; &nbsp; b. Lainnya _________________ 
                    @else
                        &nbsp; a. Tahunan &nbsp; &nbsp; &nbsp; ✓ b. {{ $cuti->jenis }} _________________ 
                    @endif
                </span>
            </div>

            <p class="section-title">Mengajukan Cuti Terhitung :</p>

            <div class="info-line">
                <span class="info-label">Mulai Tanggal</span>
                <span class="info-value info-value-short">{{ $cuti->tanggal_mulai ? \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d/m/Y') : '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Sampai Tanggal</span>
                <span class="info-value info-value-short">{{ $cuti->tanggal_selesai ? \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d/m/Y') : '' }}</span>
                <span style="margin-left: 6px; font-size: 12px;">Total Hari:</span>
                <span class="info-value info-value-medium">{{ $cuti->durasi_hari ?? '' }} hari</span>
            </div>

            <div class="info-line">
                <span class="info-label">Keperluan</span>
                <span class="info-value">{{ $cuti->alasan ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Pelimpahan Tugas Kepada</span>
                <span class="info-value">
                    @if($delegatedUsers && $delegatedUsers->count() > 0)
                        @foreach($delegatedUsers as $key => $user)
                            {{ $user->name }}@if(!$loop->last), @endif
                        @endforeach
                    @else
                        -
                    @endif
                </span>
            </div>

            <div class="info-line">
                <span class="info-label">Telp. Yang bisa dihubungi</span>
                <span class="info-value">{{ $karyawan->phone ?? '' }}</span>
            </div>

            <p style="margin-top: 10px; margin-bottom: 14px; font-size: 12px;">Demikian permohonan cuti ini saya sampaikan.</p>
=======
            <!-- Detail Cuti -->
            <p style="margin: 12px 0 8px 0; font-weight: bold;">Mengajukan Cuti Terhitung:</p>
            <table class="data-table">
                <tr>
                    <td class="label-cell">Mulai Tanggal</td>
                    <td class="value-cell">
                        {{ $cuti->tanggal_mulai ? $cuti->tanggal_mulai->locale('id')->translatedFormat('d F Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="label-cell">Sampai Tanggal</td>
                    <td class="value-cell">
                        {{ $cuti->tanggal_selesai ? $cuti->tanggal_selesai->locale('id')->translatedFormat('d F Y') : '-' }}
                        <strong style="margin-left: 15px;">Total Hari: {{ $cuti->durasi_hari ?? '0' }} hari</strong>
                    </td>
                </tr>
                <tr>
                    <td class="label-cell">Keperluan / Alasan</td>
                    <td class="value-cell">{{ $cuti->alasan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Pelimpahan Tugas Kepada</td>
                    <td class="value-cell">
                        @if (!empty($cuti->dilimpahkan_ke))
                            @php
                                $delegatedNames = is_array($cuti->dilimpahkan_ke)
                                    ? $cuti->dilimpahkan_ke
                                    : json_decode($cuti->dilimpahkan_ke, true);
                            @endphp
                            @if ($delegatedNames && count($delegatedNames) > 0)
                                {{ implode(', ', array_column($delegatedNames, 'name')) }}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label-cell">Telp. yang Bisa Dihubungi</td>
                    <td class="value-cell">{{ $karyawan->phone ?? '-' }}</td>
                </tr>
            </table>

            <!-- Penutup -->
            <p style="margin: 15px 0 10px 0;">
                Demikian permohonan cuti ini saya sampaikan untuk dapat dipertimbangkan.
                Atas perhatian dan persetujuannya, saya ucapkan terima kasih.
            </p>
>>>>>>> Stashed changes
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-section">
<<<<<<< Updated upstream
            <div class="date-line">
                Pasuruan, {{ now()->format('d/m/Y') }}
=======
            <div class="sig-date">
                Pasuruan, {{ now()->locale('id')->translatedFormat('d F Y') }}
>>>>>>> Stashed changes
            </div>

            <table style="width: 50%; margin-left: auto; border-collapse: collapse; border: 1px solid #000;">
                <tr>
                    <td
                        style="padding: 8px; border: 1px solid #000; text-align: center; background-color: #f5f5f5; font-weight: bold; height: 30px;">
                        Menyetujui,
                    </td>
                </tr>
                <tr>
                    <td
                        style="padding: 8px; border: 1px solid #000; text-align: center; height: 70px; vertical-align: bottom;">
                        <strong>( ________________ )</strong><br>
                        Direktur
                    </td>
                </tr>
            </table>
        </div>

        <!-- Catatan Penting -->
        <div class="notes">
            <div class="title-note">Catatan:</div>
            <ol>
                <li>Cuti paling lambat diajukan <strong>7 hari sebelumnya</strong> ke HRD.</li>
                <li>HRD akan melakukan verifikasi sisa cuti maksimal <strong>3 hari</strong> dan akan diberitahukan
                    kepada yang bersangkutan.</li>
                <li>Persetujuan atasan maksimal <strong>3 hari</strong> harus diberitahukan ke karyawan.</li>
                <li>Form ini harus <strong>diserahkan kembali ke HRD</strong> untuk arsip.</li>
            </ol>
        </div>
    </div>
</body>

</html>
