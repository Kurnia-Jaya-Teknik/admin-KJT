# Alur Surat Keterangan Kerja

## Ringkasan Fitur

Sistem telah dikonfigurasi untuk menangani permintaan dan pembuatan Surat Keterangan Kerja (Work Certificate) dengan alur sebagai berikut:

## 1. Alur Permintaan (Karyawan/Direktur)

### Akses Fitur
- **URL**: `http://localhost/admin-KJT/karyawan/surat-keterangan-request`
- **User**: Karyawan atau Direktur yang login
- **Menu**: Sidebar → Permintaan Surat → Surat Keterangan Kerja

### Proses Submit Permintaan
1. Karyawan/Direktur mengakses halaman "Surat Keterangan Kerja"
2. Klik tombol "Ajukan Permintaan"
3. Isi form:
   - **Alasan**: Alasan meminta surat (contoh: "Pengajuan pinjaman bank")
   - **Keperluan**: Detail kebutuhan surat (contoh: "Untuk proses verifikasi dokumen pembiayaan rumah")
   - **Tanggal Diminta**: Tanggal diperlukan (harus >= hari ini + 1 hari)
4. Klik "Kirim Permintaan"
5. Permintaan disimpan dengan status: **Pending**

**Database**: Disimpan di table `surat_keterangan_requests` dengan:
- `user_id` - ID karyawan yang membuat request
- `alasan` - Alasan permintaan
- `keperluan` - Detail keperluan
- `tanggal_diminta` - Tanggal yang diminta
- `status` - 'Pending', 'Approved', 'Rejected', 'Completed'

---

## 2. Tab Permintaan (Admin HRD)

### Akses Fitur
- **URL**: `http://localhost/admin-KJT/admin/surat-keterangan`
- **User**: Admin HRD
- **Menu**: Sidebar → Kelola Surat → Surat Keterangan Kerja

### Tab 1: Permintaan Surat (Pending)
Menampilkan daftar permintaan yang status-nya masih "Pending"

#### Kolom Informasi:
- **Karyawan**: Nama dan email peminta
- **Alasan**: Alasan permintaan surat
- **Keperluan**: Detail kebutuhan surat
- **Tanggal Diminta**: Kapan surat diperlukan
- **Aksi**: Tombol "Lihat Detail"

#### Aksi Admin:
1. Klik tombol **"Lihat Detail"** pada permintaan yang ingin diproses
2. Modal akan terbuka menampilkan:
   - Detail lengkap permintaan
   - Informasi karyawan (nama, email, posisi, unit kerja)
   - Form untuk membuat surat dengan field:
     - Nomor Surat
     - Tanggal Surat
     - Jabatan (pre-filled dari data karyawan)
     - Unit Kerja (pre-filled dari data karyawan)
     - Tanggal Mulai Kerja
     - Tanggal Selesai Kerja (opsional, jika karyawan sudah resign)
     - Keterangan tambahan
3. Isi form dan klik **"Buat Surat"**
4. Sistem akan:
   - Generate PDF surat keterangan
   - Menyimpan data surat ke table `surat_keterangan`
   - Auto set status request ke **"Approved"**
   - Menampilkan preview PDF
   - **Auto pindah ke tab "Surat yang Dibuat"**
5. Admin bisa download atau share PDF

---

## 3. Tab Surat yang Dibuat

### Tampilan Surat Selesai
Menampilkan tabel semua surat yang sudah dibuat dengan:

#### Kolom Informasi:
- **Karyawan**: Nama karyawan penerima surat
- **Nomor Surat**: Nomor yang diberikan
- **Tanggal Surat**: Tanggal pembuatan
- **Tanggal Dibuat**: Kapan surat dibuat
- **Aksi**: Tombol "Lihat Surat" dan "Download"

#### Fitur:
- Sorting otomatis (terbaru dulu)
- Pagination untuk daftar panjang
- Download PDF surat
- Preview surat

---

## 4. Notification System (Optional)

### Konsep Notifikasi:
1. **Untuk Admin HRD**: Notification ketika ada permintaan surat baru dari karyawan
   - Toast notification: "Ada permintaan surat baru dari [Nama Karyawan]"
   - Badge di menu dengan jumlah pending requests
   
2. **Untuk Karyawan**: Notification ketika surat sudah selesai dibuat
   - Email notifikasi (optional)
   - Status update di halaman "Riwayat Permintaan"
   - Tombol download surat

### Status Flow:
```
[Karyawan Request] 
    ↓ (submit)
[Pending] (waiting for admin)
    ↓ (admin buat surat)
[Approved] + [Surat Dibuat]
    ↓
[Karyawan dapat notif]
```

---

## 5. Test Data

### Data yang Sudah Dibuat:
Sudah ada **8 test permintaan surat keterangan** dengan berbagai alasan:

1. **Wasis Marpaung** - Perpanjangan visa kerja ke luar negeri
2. **Vanesa Keisha Nasyiah S.Pt** - Melamar pekerjaan di perusahaan lain
3. **Uli Violet Hassanah S.Pt** - Pendaftaran program sertifikasi internasional
4. **Safina Wulandari** - Pengajuan pinjaman bank
5. **Yuni Rahayu** - Pendaftaran tempat tinggal resmi (KTP)
6. **Reksa Bakiman Ardianto** - Pembukaan rekening tabungan baru
7. **Dasa Sihotang S.Farm** - Mengikuti program pelatihan eksternal
8. **Halima Pertiwi** - Pendaftaran beasiswa lanjut studi

### Cara Testing:
1. Login sebagai **Admin HRD**
2. Akses: Sidebar → Kelola Surat → Surat Keterangan Kerja
3. Klik tab "📋 Permintaan Surat (Pending)"
4. Akan terlihat 8 permintaan yang menunggu
5. Klik "Lihat Detail" pada salah satu permintaan
6. Isi form dan buat surat
7. Surat akan auto tampil di tab "✓ Surat yang Dibuat"

---

## 6. Fitur Pending Implementation

### Belum Diimplementasikan (Optional):
- [ ] Notification badge di navbar untuk pending requests
- [ ] Email notifikasi ke karyawan saat surat selesai
- [ ] SMS notification (jika ada integasi)
- [ ] Dashboard notifikasi real-time
- [ ] Approval workflow (multi-level approval jika diperlukan)

---

## 7. Database Tables

### `surat_keterangan_requests`
```
id, user_id, alasan, keperluan, tanggal_diminta, status, created_at, updated_at
```

### `surat_keterangan`
```
id, user_id, surat_keterangan_request_id, nomor_surat, tanggal_surat,
jabatan, unit_kerja, tanggal_mulai_kerja, tanggal_selesai_kerja,
keterangan, file_surat, status, created_at, updated_at
```

---

## 8. API Endpoints

### Admin Routes:
- `GET /admin/surat-keterangan` - List surat yang dibuat
- `GET /admin/surat-keterangan/requests/pending` - Get pending requests (JSON)
- `GET /admin/surat-keterangan/requests/{id}` - Get detail request
- `POST /admin/surat-keterangan/requests/{id}/create-surat` - Create surat
- `POST /admin/surat-keterangan/requests/{id}/approve` - Approve request
- `POST /admin/surat-keterangan/requests/{id}/reject` - Reject request
- `GET /admin/surat-keterangan/create` - Create form page

### Karyawan Routes:
- `GET /karyawan/surat-keterangan-request` - List permintaan user
- `POST /karyawan/surat-keterangan-request` - Submit permintaan baru
- `POST /karyawan/surat-keterangan-request/{id}/cancel` - Cancel permintaan

---

## 9. Tracking & Feedback

### Sudah Selesai ✅:
- Model `SuratKeterangan` dan `SuratKeteranganRequest`
- Controller untuk Admin dan Karyawan
- View untuk Permintaan (Tab 1)
- View untuk Surat Dibuat (Tab 2)
- API endpoint untuk pending requests
- Form modal untuk create surat
- Test data (8 permintaan)
- JavaScript untuk load & render requests
- PDF generation menggunakan DOMPDF

### Ready to Test:
Akses halaman: `http://localhost/admin-KJT/admin/surat-keterangan`

