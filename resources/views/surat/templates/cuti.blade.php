@php
    $kopSurat = \App\Models\KopSurat::where('is_template', true)->first();
@endphp

<div
    style="max-width: 210mm; margin: 0 auto; background: white; padding: 20mm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.4; color: #000;">

    <!-- KOP SURAT -->
    @if ($kopSurat && $kopSurat->file_path)
        <div style="text-align: center; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px;">
            <img src="{{ asset('storage/' . $kopSurat->file_path) }}" alt="Kop Surat"
                style="max-width: 100%; height: auto; max-height: 120px;">
        </div>
    @else
        <div style="text-align: center; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px;">
            <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">PT. KURNIA JAYA TEKNIK</h2>
            <p style="margin: 5px 0; font-size: 10pt;">Jl. Contoh No. 123, Jakarta 12345</p>
            <p style="margin: 5px 0; font-size: 10pt;">Telp: (021) 12345678 | Email: info@kurniajayteknik.com</p>
        </div>
    @endif

    <!-- JUDUL FORMULIR -->
    <div style="text-align: center; margin-bottom: 25px;">
        <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-decoration: underline;">FORMULIR PERMOHONAN CUTI
        </h3>
    </div>

    <!-- NOMOR SURAT -->
    <div style="margin-bottom: 20px;">
        <table style="width: 100%; border: none; border-collapse: collapse;">
            <tr>
                <td style="width: 20%; padding: 3px 0; border: none;">Nomor</td>
                <td style="width: 2%; padding: 3px 0; border: none;">:</td>
                <td style="padding: 3px 0; border: none;">
                    {{ str_pad($cuti->id ?? 0, 3, '0', STR_PAD_LEFT) }}/CUTI/KJT/{{ now()->format('m/Y') }}
                </td>
            </tr>
        </table>
    </div>

    <!-- DATA KARYAWAN & PERMINTAAN CUTI -->
    <div style="margin-bottom: 25px;">
        <table class="data-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <tr>
                <td
                    style="width: 30%; padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">
                    Nama Lengkap</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">
                    Departemen</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->user->departemen->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">Jabatan
                </td>
                <td style="padding: 8px; border: 1px solid #000;">{{ ucfirst($cuti->user->role ?? '-') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">Tanggal
                    Pengajuan</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->created_at->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- JENIS CUTI (CHECKBOX) -->
    <div style="margin-bottom: 25px;">
        <p style="margin: 0 0 10px 0; font-weight: bold;">Jenis Cuti/Ijin:</p>
        <table style="width: 100%; border: none; border-collapse: collapse;">
            <tr>
                <td style="width: 33%; padding: 5px; border: none;">
                    <span
                        style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; text-align: center; line-height: 14px; margin-right: 5px;">{!! $cuti->jenis === 'Cuti Tahunan' ? '&#10003;' : '' !!}</span>
                    Cuti Tahunan
                </td>
                <td style="width: 33%; padding: 5px; border: none;">
                    <span
                        style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; text-align: center; line-height: 14px; margin-right: 5px;">{!! $cuti->jenis === 'Ijin Sakit' ? '&#10003;' : '' !!}</span>
                    Ijin Sakit
                </td>
                <td style="width: 34%; padding: 5px; border: none;">
                    <span
                        style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; text-align: center; line-height: 14px; margin-right: 5px;">{!! !in_array($cuti->jenis, ['Cuti Tahunan', 'Ijin Sakit']) ? '&#10003;' : '' !!}</span>
                    Lainnya:
                    {{ !in_array($cuti->jenis, ['Cuti Tahunan', 'Ijin Sakit']) ? $cuti->jenis : '___________' }}
                </td>
            </tr>
        </table>
    </div>

    <!-- DETAIL CUTI -->
    <div style="margin-bottom: 25px;">
        <table class="data-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <tr>
                <td
                    style="width: 30%; padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">
                    Tanggal Mulai</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->tanggal_mulai->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">Tanggal
                    Selesai</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->tanggal_selesai->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold;">Jumlah
                    Hari</td>
                <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->durasi_hari }} hari</td>
            </tr>
            @if ($cuti->alasan)
                <tr>
                    <td
                        style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold; vertical-align: top;">
                        {{ $cuti->jenis === 'Ijin Sakit' ? 'Diagnosa/Keterangan' : 'Alasan' }}</td>
                    <td style="padding: 8px; border: 1px solid #000;">{{ $cuti->alasan }}</td>
                </tr>
            @endif
            @if (
                $cuti->pelimpahan_tugas &&
                    is_array($pelimpahan = json_decode($cuti->pelimpahan_tugas, true)) &&
                    count($pelimpahan) > 0)
                <tr>
                    <td
                        style="padding: 8px; border: 1px solid #000; background-color: #f5f5f5; font-weight: bold; vertical-align: top;">
                        Pelimpahan Tugas</td>
                    <td style="padding: 8px; border: 1px solid #000;">
                        @foreach ($pelimpahan as $index => $userId)
                            @php
                                $delegatedUser = \App\Models\User::find($userId);
                            @endphp
                            @if ($delegatedUser)
                                {{ $index + 1 }}. {{ $delegatedUser->name }}
                                ({{ $delegatedUser->departemen->nama ?? '-' }})
                                <br>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endif
        </table>
    </div>

    <!-- TANDA TANGAN -->
    <div style="margin-top: 40px; margin-bottom: 25px;">
        <table style="width: 50%; margin-left: auto; border-collapse: collapse; border: 1px solid #000;">
            <tr>
                <td
                    style="padding: 8px; border: 1px solid #000; text-align: center; background-color: #f5f5f5; font-weight: bold;">
                    Direktur</td>
            </tr>
            <tr>
                <td
                    style="padding: 8px; border: 1px solid #000; text-align: center; height: 80px; vertical-align: bottom;">
                    @if ($cuti->direktur_status === 'Disetujui')
                        <strong>{{ $cuti->direktur_name ?? '-' }}</strong><br>
                        <small>{{ $cuti->tanggal_persetujuan ? \Carbon\Carbon::parse($cuti->tanggal_persetujuan)->format('d/m/Y') : '-' }}</small>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- CATATAN -->
    <div style="margin-top: 25px; font-size: 10pt;">
        <p style="margin: 0 0 5px 0; font-weight: bold;">Catatan:</p>
        <ol style="margin: 0; padding-left: 20px;">
            <li>Formulir ini harus diisi lengkap dan diajukan minimal 3 hari sebelum cuti dimulai (kecuali ijin sakit)
            </li>
            <li>Persetujuan cuti bergantung pada kebutuhan operasional dan kebijakan perusahaan</li>
            <li>Untuk ijin sakit lebih dari 2 hari wajib melampirkan surat keterangan dokter</li>
            <li>Karyawan yang sedang cuti harus dapat dihubungi dalam keadaan darurat</li>
        </ol>
    </div>

</div>
