<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Balasan Izin Magang</title>

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

table {
    width: 100%;
    border-collapse: collapse;
}

/* ===== HEADER ===== */
.header-table {
    border-bottom: 2px solid #000;
    margin-bottom: 18px;
    padding-bottom: 6px;
}

.logo {
    width: 320px; /* disesuaikan dengan template */
    display: block;
    margin: 0 auto 6px auto;
}

.header-text {
    font-size: 10pt;
    font-weight: bold;
    line-height: 1.3;
}

/* ===== META ===== */
.meta-table td {
    vertical-align: top;
    font-size: 11pt;
}

/* ===== ISI ===== */
.text-justify {
    text-align: justify;
}

/* ===== TABEL MAHASISWA ===== */
.student-table th,
.student-table td {
    border: 1px solid #000;
    padding: 6px;
    font-size: 11pt;
}

.student-table th {
    text-align: center;
    font-weight: bold;
}
</style>
</head>

<body>

<!-- ===== HEADER ===== -->
<table class="header-table">
<tr>
    <td colspan="2" align="center">
        <img src="{{ $logoPath }}" class="logo">
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

<!-- ===== NOMOR / TANGGAL / TUJUAN ===== -->
<table class="meta-table">
<tr>
    <td width="55%">
        Nomor&nbsp;&nbsp;&nbsp;: {{ $nomor_surat ?? '-' }}<br>
        Lamp.&nbsp;&nbsp;&nbsp;&nbsp;: -<br>
        Perihal&nbsp;&nbsp;: Balasan Permohonan Izin Magang
    </td>
    <td width="45%" align="right">
        <div style="text-align:left; display:inline-block;">
            Pasuruan,
            @if(!empty($tanggal_surat))
                {{ \Carbon\Carbon::parse($tanggal_surat)->locale('id')->translatedFormat('d F Y') }}
            @else
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            @endif
            <br><br>

            Kepada.<br>
            Yth. {{ $magangList[0]->jabatan_tujuan ?? 'Wakil Direktur I' }}<br>
            {{ $magangList[0]->sekolah_asal }}<br>
            {{ $magangList[0]->jurusan }}<br>
            di {{ $magangList[0]->kota ?? 'Malang' }}
        </div>
    </td>
</tr>
</table>

<br>

<!-- ===== ISI SURAT ===== -->
Dengan hormat,<br><br>

<p class="text-justify">
Sehubungan dengan surat dari {{ $magangList[0]->sekolah_asal }} Nomor
<strong>{{ $nomor_surat ?? '-' }}</strong>
tanggal
<strong>{{ \Carbon\Carbon::parse($magangList[0]->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</strong>
perihal <em>Permohonan Izin Pelaksanaan Magang</em>, dengan ini kami menyampaikan
bahwa <strong>CV. Kurnia Jaya Teknik menerima dan menyetujui</strong> permohonan
pelaksanaan magang mahasiswa Jurusan {{ $magangList[0]->jurusan }}
{{ $magangList[0]->sekolah_asal }}. Adapun mahasiswa yang akan melaksanakan
kegiatan magang adalah sebagai berikut:
</p>

<!-- ===== TABEL MAHASISWA ===== -->
<table class="student-table">
<thead>
<tr>
    <th width="5%">No.</th>
    <th width="40%">Nama</th>
    <th width="20%">NIM</th>
    <th width="35%">Program Studi</th>
</tr>
</thead>
<tbody>
@foreach($magangList as $i => $mhs)
<tr>
    <td align="center">{{ $i + 1 }}.</td>
    <td>{{ $mhs->nama_peserta }}</td>
    <td align="center">{{ $mhs->nim_nis ?? '-' }}</td>
    <td>{{ $mhs->jurusan }}</td>
</tr>
@endforeach
</tbody>
</table>

<br>

<p class="text-justify">
Pelaksanaan magang akan dilaksanakan sesuai dengan waktu yang telah ditentukan,
yaitu mulai <strong>{{ \Carbon\Carbon::parse($magangList[0]->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</strong>
sampai dengan <strong>{{ \Carbon\Carbon::parse($magangList[0]->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}</strong>,
dengan ketentuan mahasiswa mematuhi peraturan dan tata tertib yang berlaku di
perusahaan kami.
</p>

<p class="text-justify">
Demikian surat balasan ini kami sampaikan. Atas perhatian dan kerja sama yang baik,
kami ucapkan terima kasih.
</p>

<br><br>

<!-- ===== TANDA TANGAN ===== -->
<div style="width:40%; float:right; text-align:left;">
    Pasuruan,
    @if(!empty($tanggal_surat))
        {{ \Carbon\Carbon::parse($tanggal_surat)->locale('id')->translatedFormat('d F Y') }}
    @else
        {{ now()->locale('id')->translatedFormat('d F Y') }}
    @endif
    <br>
    CV. Kurnia Jaya Teknik<br>
    Direktur,<br><br><br>

    <strong>Muhammad Muwafiqur Romdlon</strong>
</div>

</body>
</html>
