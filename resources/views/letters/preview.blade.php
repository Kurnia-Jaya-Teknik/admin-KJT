<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pratayang Surat</title>
    <style>
        body { font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif; color:#111; padding: 40px; }
        .kop { text-align: center; margin-bottom: 12px; }
        .kop img { max-height: 120px; object-fit: contain; }
        .meta { margin-top: 6px; margin-bottom: 16px; }
        .nomor { margin-bottom: 6px; font-weight: 600; }
        .perihal { margin-bottom: 18px; }
        .kepada { margin-bottom: 8px; }
        .content { margin-top: 12px; line-height: 1.6; }
        .ttd { margin-top: 60px; text-align: right; }
    </style>
</head>
<body>
    <div class="kop">
        @if(!empty($kop) && $kop->file_path && \Illuminate\Support\Str::endsWith($kop->file_path, ['.png','.jpg','.jpeg','.svg']))
            <img src="{{ asset('storage/'.$kop->file_path) }}" alt="kop" />
        @else
            <div style="font-weight:700; font-size:16px">KOP SURAT PERUSAHAAN</div>
            <div style="font-size:12px">Alamat Perusahaan - Telepon - Email</div>
        @endif
    </div>

    <div class="meta">
        <div class="nomor">Nomor: {{ $nomor ?? '-' }} &nbsp; &nbsp; Tanggal: {{ 
            \Illuminate\Support\Carbon::parse($tanggal ?? now())->format('d F Y') }}</div>
        <div class="perihal">Perihal: <strong>{{ $tujuan ?? '-' }}</strong></div>
    </div>

    <div class="kepada">
        <p>Kepada Yth.,</p>
        <p><strong>{{ $karyawan }}</strong></p>
        @if(!empty($jabatan ?? null))<p>{{ $jabatan }}</p>@endif
    </div>

    <div class="content">{!! $isi !!}</div>

    <div class="ttd">
        <div>Hormat kami,</div>
        <br><br><br>
        <div>__________________________</div>
        <div>Admin HRD</div>
    </div>
</body>
</html>