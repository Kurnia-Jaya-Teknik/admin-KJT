<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Lembur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Times New Roman', serif;
            color: #000;
            line-height: 1.5;
            background: white;
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
        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            padding-bottom: 0;
        }
        .logo {
            width: 60px;
            height: auto;
            margin-bottom: 8px;
            flex-shrink: 0;
        }
        .company-info {
            text-align: center;
            width: 100%;
        }
        .company-info h1 {
            font-size: 13px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
        }
        .company-info p {
            font-size: 10px;
            margin: 2px 0 0 0;
            color: #000;
        }
        .title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            margin: 12px 0 14px 0;
        }
        /* Isi Surat */
        .letter-content {
            font-size: 13px;
            line-height: 1.4;
        }
        .letter-content p {
            margin: 0 0 6px 0;
        }
        .intro-text {
            margin-bottom: 8px;
        }
        .info-line {
            margin: 5px 0;
            font-size: 13px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .info-label {
            display: inline-block;
            width: 150px;
            font-weight: normal;
            flex-shrink: 0;
        }
        .info-value {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 210px;
            padding: 0 3px 2px 3px;
            min-height: 14px;
        }
        .info-value-short {
            width: auto;
            min-width: 150px;
        }
        .info-value-medium {
            width: auto;
            min-width: 100px;
        }
        .section-title {
            margin: 8px 0 5px 0;
            font-weight: normal;
            font-size: 13px;
        }
        /* Signature Section */
        .signature-section {
            margin-top: 18px;
        }
        .date-line {
            text-align: right;
            font-size: 11px;
            margin-bottom: 12px;
        }
        .date-line span {
            display: inline-block;
            min-width: 20px;
            border-bottom: 1px solid #000;
            text-align: center;
            margin: 0 2px;
        }
        .signature-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .signature-table {
            width: 95%;
            max-width: 500px;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 10px;
            border: 1px solid #000;
        }
        .signature-table td {
            border: 1px solid #000;
            text-align: center;
            width: 25%;
            vertical-align: bottom;
            font-size: 10px;
        }
        .sig-header {
            font-weight: normal;
            font-size: 10px;
            padding: 2px 8px;
            height: 14px;
        }
        .sig-footer {
            font-weight: normal;
            font-size: 10px;
            padding: 40px 8px 2px 8px;
            height: 50px;
        }
        /* Notes/Footer */
        .notes {
            font-size: 9px;
            color: #000;
            line-height: 1.3;
            margin-top: 10px;
        }
        .notes-title {
            font-weight: bold;
            margin-bottom: 3px;
        }
        .notes p {
            margin: 2px 0 2px 15px;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header dengan Logo dan Kop Surat -->
        <div class="header">
            <img src="{{ $logoPath }}" alt="Logo" class="logo">
            <div class="company-info">
                <h1>CV. KURNIA JAYA TEKNIK</h1>
                <p>Mechanical, Electrical And Automation System</p>
            </div>
        </div>

        <!-- Judul Surat -->
        <div class="title">FORMULIR LEMBUR</div>

        <!-- Isi Surat -->
        <div class="letter-content">
            <p class="intro-text">Yang bertanda tangan di bawah ini:</p>

            <!-- Data Identitas -->
            <div class="info-line">
                <span class="info-label">Nama</span>
                <span class="info-value">{{ $karyawan->name ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Jabatan/Devisi</span>
                <span class="info-value">{{ $karyawan->jabatan ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Tanggal Masuk ke Perusahaan</span>
                <span class="info-value">{{ $karyawan->tanggal_bergabung ? $karyawan->tanggal_bergabung->format('d/m/Y') : '' }}</span>
            </div>

            <p class="section-title">Melakukan Lembur Terhitung:</p>

            <div class="info-line">
                <span class="info-label">Tanggal Lembur</span>
                <span class="info-value">{{ $lembur->tanggal_lembur ? $lembur->tanggal_lembur->locale('id')->translatedFormat('d F Y') : '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Jam Mulai</span>
                <span class="info-value info-value-short">{{ $lembur->jam_mulai ?? '' }}</span>
                <span style="margin: 0 8px; font-size: 11px;">Jam Selesai</span>
                <span class="info-value info-value-short">{{ $lembur->jam_selesai ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Total Jam Lembur</span>
                <span class="info-value info-value-medium">{{ $lembur->total_jam ?? '' }} jam</span>
            </div>

            <div class="info-line">
                <span class="info-label">Keterangan</span>
                <span class="info-value">{{ $lembur->keterangan ?? '' }}</span>
            </div>

            <div class="info-line">
                <span class="info-label">Telp. Yang bisa dihubungi</span>
                <span class="info-value">{{ $karyawan->phone ?? '' }}</span>
            </div>

            <p style="margin-top: 10px; margin-bottom: 14px; font-size: 11px;">Demikian permohonan lembur ini saya sampaikan.</p>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="date-line">
                Pasuruan, {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <div class="signature-wrapper">
                <table class="signature-table">
                    <tr>
                        <td class="sig-header">Hormat Saya,</td>
                        <td class="sig-header">Verifikasi Lembur,</td>
                        <td class="sig-header"></td>
                        <td class="sig-header">Menyetujui,</td>
                    </tr>
                    <tr>
                        <td class="sig-footer">Pegawai</td>
                        <td class="sig-footer">HRD</td>
                        <td class="sig-footer">Atasan Langsung</td>
                        <td class="sig-footer">Direktur</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Notes/Footer -->
        <div class="notes">
            <div class="notes-title">Note:</div>
            <p>1. Lembur harus disetujui oleh atasan terlebih dahulu sebelum dilakukan.</p>
            <p>2. Permohonan lembur harus disampaikan ke HRD maksimal 1 hari sebelumnya.</p>
            <p>3. Persetujuan atasan dan HRD harus dilakukan dalam waktu maksimal 3 hari.</p>
            <p>4. Form ini harus diserahkan Kembali ke HRD untuk arsip.</p>
        </div>
    </div>
</body>
</html>
