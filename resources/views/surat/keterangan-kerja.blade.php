<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Kerja</title>

<style>
body {
    font-family: "Times New Roman", serif;
    font-size: 12pt;
    line-height: 1.6;
    color: #000;
}

@page {
    size: A4;
    margin: 25mm;
}

/* ===== HEADER ===== */
.header {
    text-align: center;
    margin-bottom: 10px;
}

.logo {
    width: 640px;
    margin-bottom: 5px;
}

.double-line {
    border-top: 2px solid #000;
    border-bottom: 1px solid #000;
    height: 4px;
    margin: 6px 0 20px 0;
}

/* ===== TITLE ===== */
.title {
    text-align: center;
    font-weight: bold;
    font-size: 14pt;
    margin-bottom: 5px;
}

.subtitle {
    text-align: center;
    margin-bottom: 25px;
}

/* ===== CONTENT ===== */
.content p {
    text-align: justify;
    margin-bottom: 10px;
}

.identity {
    margin: 15px 0 20px 0;
}

.identity table {
    width: 100%;
    border-collapse: collapse;
}

.identity td {
    padding: 3px 0;
    vertical-align: top;
}

.identity td:first-child {
    width: 30%;
}

.identity td:nth-child(2) {
    width: 5%;
}

.identity td:last-child {
    width: 65%;
}

/* ===== FOOTER ===== */
.footer {
    margin-top: 40px;
    width: 100%;
}

.footer .right {
    width: 40%;
    float: right;
    text-align: left;
}

.signature-space {
    height: 70px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <img src="{{ $logoPath }}" class="logo">
</div>

<div class="double-line"></div>

<!-- TITLE -->
<div class="title">SURAT KETERANGAN KERJA</div>
<div class="subtitle">
    Nomor: {{ $surat['nomor_surat'] ?? '01/HRD/I/2026' }}
</div>

<!-- CONTENT -->
<div class="content">
    <p>Dengan surat ini kami dari CV. Kurnia Jaya Teknik menyatakan bahwa:</p>

    <div class="identity">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $karyawan->name }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $surat['jabatan'] }}</td>
            </tr>
            <tr>
                <td>Unit Kerja/Instansi</td>
                <td>:</td>
                <td>CV. Kurnia Jaya Teknik</td>
            </tr>
        </table>
    </div>

    <p>
        Dinyatakan benar telah bekerja di CV. Kurnia Jaya Teknik terhitung sejak
        <strong>{{ \Carbon\Carbon::parse($surat['tanggal_mulai_kerja'])->translatedFormat('d F Y') }}</strong>
        sampai dengan
        <strong>{{ \Carbon\Carbon::parse($surat['tanggal_selesai_kerja'])->translatedFormat('d F Y') }}</strong>
        dengan jabatan terakhir <strong>{{ $surat['jabatan'] }}</strong>.
    </p>

    <p>
        Selama menjadi karyawan kami, Sdr. <strong>{{ $karyawan->name }}</strong>
        telah menunjukkan dedikasi, loyalitas, dan kualitas kinerja yang tinggi
        terhadap perusahaan. Adapun proses penghentian hubungan kerja ini datang
        atas dasar berakhirnya kontrak kerja/PKWT saudara dengan CV. Kurnia Jaya Teknik.
    </p>

    <p>
        Kami berterima kasih dan berharap semoga saudara dapat meraih karier yang
        lebih baik di masa yang akan datang.
    </p>
</div>

<!-- FOOTER -->
<div class="footer">
    <div class="right">
        <p>Pasuruan, {{ now()->translatedFormat('d F Y') }}</p>
        <p>HRD,</p>
        <div class="signature-space"></div>
        <strong>Putri Meli Handayani</strong>
    </div>
</div>

</body>
</html>
