<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirekturController extends Controller
{
    public function persetujuanCutiLembur()
    {
        return view('direktur.persetujuan-cuti-lembur');
    }

    public function persetujuanSurat()
    {
        return view('direktur.persetujuan-surat');
    }

    public function ringkasanKaryawan()
    {
        return view('direktur.ringkasan-karyawan');
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }

    public function riwayatPersetujuan()
    {
        return view('direktur.riwayat-persetujuan');
    }
}
