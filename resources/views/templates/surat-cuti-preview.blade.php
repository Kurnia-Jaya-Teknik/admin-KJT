<style>
    .preview-container {
        font-family: 'Times New Roman', serif;
        color: #000;
        line-height: 1.6;
        font-size: 12pt;
        padding: 20px;
        background: #fff;
    }

    .preview-header {
        border-bottom: 3px solid #000;
        margin-bottom: 15px;
        padding-bottom: 10px;
        text-align: center;
    }

    .preview-logo {
        width: 100%;
        max-width: 600px;
        margin: 0 auto 10px auto;
        display: block;
    }

    .preview-title {
        text-align: center;
        font-weight: bold;
        font-size: 16pt;
        margin: 20px 0;
        text-decoration: underline;
    }

    .preview-table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }

    .preview-table td {
        padding: 8px;
        border: 1px solid #000;
    }

    .preview-label {
        width: 40%;
        background-color: #f5f5f5;
        font-weight: bold;
    }

    .preview-signature {
        margin-top: 30px;
        text-align: right;
    }

    .preview-sig-box {
        display: inline-block;
        border: 1px solid #000;
        padding: 0;
        width: 250px;
        text-align: center;
    }

    .preview-sig-header {
        background-color: #f5f5f5;
        font-weight: bold;
        padding: 10px;
        border-bottom: 1px solid #000;
    }

    .preview-sig-space {
        padding: 50px 10px 10px 10px;
    }

    .preview-notes {
        margin-top: 20px;
        padding: 15px;
        background-color: #fffdf0;
        border: 1px solid #e5e5e5;
        border-radius: 5px;
    }

    .preview-notes-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .preview-notes ol {
        margin-left: 20px;
    }

    .preview-notes li {
        margin-bottom: 5px;
    }
</style>

<div class="preview-container">
    <!-- Header -->
    <div class="preview-header">
        <img src="{{ asset('img/logo-kjt.png') }}" alt="Logo" class="preview-logo">
        <div style="font-size: 10pt;">
            <strong>PT. KURNIA JAYA TEKNIK</strong><br>
            Dsn. Kemuning RT/RW 10/04 Ds. Gambirikuning, Kraton<br>
            Pasuruan – Jawa Timur, 67151<br>
            Phone: 0343-5618810 | Email: kurniajayatek@gmail.com
        </div>
    </div>

    <!-- Title -->
    <div class="preview-title">FORMULIR CUTI</div>

    <!-- Employee Data -->
    <p style="margin: 15px 0 10px 0;">Yang bertanda tangan di bawah ini:</p>

    <table class="preview-table">
        <tr>
            <td class="preview-label">Nama</td>
            <td>{{ $cuti->user->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="preview-label">Jabatan / Divisi</td>
            <td>{{ $cuti->user->jabatan ?? '-' }} / {{ $cuti->user->departemen->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="preview-label">NIK</td>
            <td>{{ $cuti->user->nik ?? '-' }}</td>
        </tr>
    </table>

    <!-- Cuti Type -->
    <p style="margin: 15px 0 10px 0; font-weight: bold;">Mengajukan Cuti: {{ $cuti->jenis }}</p>

    <!-- Cuti Details -->
    <table class="preview-table">
        <tr>
            <td class="preview-label">Mulai Tanggal</td>
            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="preview-label">Sampai Tanggal</td>
            <td>
                {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
                <strong style="margin-left: 15px;">Total: {{ $cuti->durasi }}</strong>
            </td>
        </tr>
        <tr>
            <td class="preview-label">Keperluan / Alasan</td>
            <td>{{ $cuti->alasan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="preview-label">Pelimpahan Tugas Kepada</td>
            <td>
                @if (!empty($cuti->dilimpahkan_ke))
                    @php
                        $delegatedIds = is_array($cuti->dilimpahkan_ke)
                            ? $cuti->dilimpahkan_ke
                            : json_decode($cuti->dilimpahkan_ke, true);
                        $delegatedUsers = [];
                        if (is_array($delegatedIds)) {
                            foreach ($delegatedIds as $userId) {
                                $user = \App\Models\User::find($userId);
                                if ($user) {
                                    $delegatedUsers[] = $user->name;
                                }
                            }
                        }
                    @endphp
                    @if (count($delegatedUsers) > 0)
                        {{ implode(', ', $delegatedUsers) }}
                    @else
                        -
                    @endif
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td class="preview-label">Telp. yang Bisa Dihubungi</td>
            <td>{{ $cuti->user->phone ?? '-' }}</td>
        </tr>
    </table>

    <!-- Closing -->
    <p style="margin: 20px 0;">
        Demikian permohonan cuti ini saya sampaikan untuk dapat dipertimbangkan.
        Atas perhatian dan persetujuannya, saya ucapkan terima kasih.
    </p>

    <!-- Signature -->
    <div class="preview-signature">
        <p style="margin-bottom: 10px;">Pasuruan,
            {{ \Carbon\Carbon::parse($cuti->tanggal_persetujuan ?? now())->locale('id')->translatedFormat('d F Y') }}
        </p>

        <div class="preview-sig-box">
            <div class="preview-sig-header">Menyetujui,</div>
            <div class="preview-sig-space">
                <strong>{{ $approver ? '( ' . $approver->name . ' )' : '( ________________ )' }}</strong><br>
                Direktur
            </div>
        </div>
    </div>

    <!-- Notes -->
    <div class="preview-notes">
        <div class="preview-notes-title">Catatan:</div>
        <ol>
            <li>Cuti paling lambat diajukan <strong>7 hari sebelumnya</strong> ke HRD.</li>
            <li>HRD akan melakukan verifikasi sisa cuti maksimal <strong>3 hari</strong> dan akan diberitahukan kepada
                yang bersangkutan.</li>
            <li>Persetujuan atasan maksimal <strong>3 hari</strong> harus diberitahukan ke karyawan.</li>
            <li>Form ini harus <strong>diserahkan kembali ke HRD</strong> untuk arsip.</li>
        </ol>
    </div>
</div>
