<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Balasan Magang</title>
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
        /* Header */
        .header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #000;
        }
        .logo {
            width: 50px;
            height: auto;
            flex-shrink: 0;
        }
        .company-info {
            flex: 1;
        }
        .company-info h1 {
            font-size: 13px;
            font-weight: bold;
            margin: 0 0 2px 0;
            line-height: 1.2;
        }
        .company-info p {
            font-size: 11px;
            margin: 1px 0;
            color: #000;
        }
        .letter-meta {
            margin: 10px 0 12px 0;
            font-size: 11px;
            line-height: 1.6;
        }
        .meta-row {
            display: flex;
            margin: 3px 0;
        }
        .meta-label {
            width: 60px;
            font-weight: normal;
        }
        .meta-value {
            flex: 1;
        }
        .address-block {
            margin: 12px 0;
            font-size: 11px;
            line-height: 1.5;
        }
        /* Letter Content */
        .letter-content {
            font-size: 12px;
            line-height: 1.6;
        }
        .letter-content p {
            margin: 8px 0;
            text-align: justify;
        }
        .salutation {
            margin-bottom: 8px;
        }
        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 11px;
        }
        table thead tr {
            background-color: #f5f5f5;
        }
        table th {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .date-line {
            text-align: left;
            font-size: 11px;
        }
        .signature-block {
            text-align: center;
            width: 150px;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            height: 35px;
            margin-bottom: 2px;
        }
        .signature-name {
            font-size: 11px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <img src="{{ $logoPath }}" alt="Logo" class="logo">
            <div class="company-info">
                <h1>CV. KURNIA JAYA TEKNIK</h1>
                <p>Mechanical, Electrical And Automation System</p>
                <p style="margin-top: 2px;">Dsn. Kemuning RT/RW 10/04 Ds. Gambirikuning, Kraton</p>
                <div style="display: flex; gap: 30px; margin-top: 2px;">
                    <p>Pasuruan - Jawa Timur, 67151</p>
                    <p>Phone : 0343-5618810</p>
                    <p>Email : kurijayatek@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Letter Meta -->
        <div class="letter-meta">
            <div class="meta-row">
                <div class="meta-label">Nomor</div>
                <div class="meta-value">: {{ $magangList[0]->nomor_surat ?? '-' }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Lamp.</div>
                <div class="meta-value">: -</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Perihal</div>
                <div class="meta-value">: Balasan Permohonan Izin Magang</div>
            </div>
        </div>

        <!-- Address Block -->
        <div class="address-block">
            <p style="margin: 4px 0;"><strong>Kepada</strong></p>
            <p style="margin: 2px 0;">Yth. Kepala Sekolah/Rektor</p>
            <p style="margin: 2px 0;">{{ $magangList[0]->sekolah_asal }}</p>
            <p style="margin: 2px 0;">{{ $magangList[0]->jurusan }}</p>
            <p style="margin: 2px 0;">di {{ explode(',', $magangList[0]->sekolah_asal)[count(explode(',', $magangList[0]->sekolah_asal))-1] ?? 'Pasuruan' }}</p>
        </div>

        <!-- Letter Content -->
        <div class="letter-content">
            <p class="salutation">Dengan hormat,</p>

            <p>
                Sehubungan dengan surat dari {{ $magangList[0]->sekolah_asal }} Nomor <strong>{{ $magangList[0]->nomor_permohonan ?? '-' }}</strong> tanggal {{ $magangList[0]->tanggal_mulai->locale('id')->translatedFormat('d F Y') }} perihal <strong>Permohonan Izin Pelaksanaan Magang</strong>, dengan ini kami menyampaikan bahwa CV. Kurnia Jaya Teknik menerima dan menyetujui permohonan pelaksanaan magang mahasiswa Jurusan {{ $magangList[0]->jurusan }} {{ $magangList[0]->sekolah_asal }}. Adapun mahasiswa yang akan melaksanakan kegiatan magang adalah sebagai berikut:
            </p>

            <table>
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="45%">Nama</th>
                        <th width="50%">Program Studi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($magangList as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}.</td>
                        <td>{{ $peserta->nama_peserta }}</td>
                        <td>{{ $peserta->jurusan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <p>
                Pelaksanaan magang akan dilaksanakan sesuai dengan waktu yang telah ditentukan, yaitu mulai <strong>{{ $magangList[0]->tanggal_mulai->locale('id')->translatedFormat('d F Y') }}</strong> sampai dengan <strong>{{ $magangList[0]->tanggal_selesai->locale('id')->translatedFormat('d F Y') }}</strong>, dengan ketentuan mahasiswa mematuhi peraturan dan tata tertib yang berlaku di perusahaan kami.
            </p>

            <p>
                Demikian surat balasan ini kami sampaikan. Atas perhatian dan kerja sama yang baik, kami ucapkan terima kasih.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="date-line">
                <p style="margin: 0 0 20px 0;">Pasuruan, {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
                <p style="margin: 0;">CV. Kurnia Jaya Teknik</p>
                <p style="margin: 0;">Direktur,</p>
            </div>
            <div class="signature-block">
                <div class="signature-line"></div>
                <p class="signature-name" style="margin: 0; margin-top: 2px;">Muhammad Muwafiqur Romdlon</p>
            </div>
        </div>
    </div>
</body>
</html>
