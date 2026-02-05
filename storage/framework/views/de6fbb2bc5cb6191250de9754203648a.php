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
            width: 675px;
            display: block;
            margin: 0 auto 4px auto;
        }

        .company-name {
            font-weight: bold;
            font-size: 11pt;
        }
        /* Isi Surat */
        .letter-content {
            font-size: 13px;
            line-height: 1.4;
            margin-left: 40px
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
        .options {
            margin-left: 150px;
            font-size: 12px;
            margin-bottom: 6px;
        }
        .section-title {
            margin: 8px 0 5px 0;
            font-weight: normal;
            font-size: 12px;
        }
        /* Signature Section */
        .signature-section {
            margin-top: 18px;
            margin-left: 20px;
            margin-right: 120px;
        }
        .date-line {
            text-align: right;
            font-size: 12px;
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
        <table class="header-table">
            <tr>
                <td colspan="2" align="center">
                    <img src="<?php echo e($logoPath); ?>" class="logo">
                </td>
            </tr>
            <tr>
                <td  width="65%" class="header-text" align="left">
                    Dsn. Kemuning RT/RW 10/04 Ds. Gambirikuning, Kraton<br>
                    Pasuruan – Jawa Timur, 67151<br>
                </td>
                <td width="35%" class="header-text" align="right">    
                    <div style="text-align:left; display:inline-block;">
                        Phone : 0343-5618810 <br>
                        Email : kurniajayatek@gmail.com <br>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Judul Surat -->
        <div class="title">FORMULIR CUTI</div>

        <!-- Isi Surat -->
        <div class="letter-content" >
            <p class="intro-text">Yang bertanda tangan di bawah ini:</p>

            <!-- Data Identitas -->
            <div class="info-line">
                <span class="info-label">Nama</span>
                <span class="info-value"><?php echo e($karyawan->name ?? ''); ?></span>
            </div>

            <div class="info-line">
                <span class="info-label">Jabatan/Devisi</span>
                <span class="info-value"><?php echo e($karyawan->departemen->nama ?? $karyawan->jabatan ?? ''); ?></span>
            </div>

            <div class="info-line">
                <span class="info-label">Tanggal Masuk ke Perusahaan</span>
                <span class="info-value"><?php echo e($karyawan->tanggal_bergabung ? $karyawan->tanggal_bergabung->format('d/m/Y') : ''); ?></span>
            </div>

            <div class="options">
                <span>Mengajukan cuti : </span>
                <span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cuti->jenis === 'Cuti Tahunan'): ?>
                        &nbsp; ✓ a. Tahunan &nbsp; &nbsp; &nbsp; b. Lainnya _________________ 
                    <?php else: ?>
                        &nbsp; a. Tahunan &nbsp; &nbsp; &nbsp; ✓ b. <?php echo e($cuti->jenis); ?> _________________ 
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>

            <p class="section-title">Mengajukan Cuti Terhitung :</p>

            <div class="info-line">
                <span class="info-label">Mulai Tanggal</span>
                <span class="info-value info-value-short"><?php echo e($cuti->tanggal_mulai ? $cuti->tanggal_mulai->locale('id')->translatedFormat('d F Y') : ''); ?></span>
            </div>

            <div class="info-line">
                <span class="info-label">Sampai Tanggal</span>
                <span class="info-value info-value-short"><?php echo e($cuti->tanggal_selesai ? $cuti->tanggal_selesai->locale('id')->translatedFormat('d F Y') : ''); ?></span>
                <span style="margin-left: 6px; font-size: 12px;">Total Hari:</span>
                <span class="info-value info-value-medium"><?php echo e($cuti->durasi_hari ?? ''); ?> hari</span>
            </div>

            <div class="info-line">
                <span class="info-label">Keperluan</span>
                <span class="info-value"><?php echo e($cuti->alasan ?? ''); ?></span>
            </div>

            <div class="info-line">
                <span class="info-label">Pelimpahan Tugas Kepada</span>
                <span class="info-value">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($delegatedUsers && $delegatedUsers->count() > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $delegatedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($user->name); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>, <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php else: ?>
                        -
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>

            <div class="info-line">
                <span class="info-label">Telp. Yang bisa dihubungi</span>
                <span class="info-value"><?php echo e($karyawan->phone ?? ''); ?></span>
            </div>

            <p style="margin-top: 10px; margin-bottom: 14px; font-size: 12px;">Demikian permohonan cuti ini saya sampaikan.</p>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="date-line">
                Pasuruan, <?php echo e(now()->locale('id')->translatedFormat('d F Y')); ?>

            </div>

            <div class="signature-wrapper">
                <table class="signature-table">
                    <tr>
                        <style> padding: 12px 8px 2px 8px; text-align: center; height: 30px;</style>
                        <td class="sig-header">Hormat Saya,</td>
                        <td class="sig-header">Verifikasi Cuti,</td>
                        <td class="sig-header"></td>
                        <td class="sig-header">Menyetujui,</td>
                    </tr>
                    <tr>
                        <td class="sig-footer">Pegawai</td>
                        <td class="sig-footer">HRD</td>
                        <td class="sig-footer">Yang Dilimpahkan Tugas</td>
                        <td class="sig-footer">Direktur</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Notes/Footer -->
        <div class="notes">
            <div class="notes-title">Note:</div>
            <p>1. Cuti paling lambat diajukan 7 hari sebelumnya ke HRD.</p>
            <p>2. HRD akan melakukan verifikasi sisa cuti maksimal 3 hari dan akan diberitahukan kepada yang bersangkutan.</p>
            <p>3. Persetujuan atasan maksimal 3 hari harus diberitahukan ke karyawannya.</p>
            <p>4. Form ini harus diserahkan Kembali ke HRD untuk arsip.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp5\htdocs\admin-KJT\resources\views/surat/cuti.blade.php ENDPATH**/ ?>