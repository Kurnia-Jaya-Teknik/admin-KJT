## Admin/HRD System - Complete Documentation

### Overview
Sistem manajemen HR komprehensif untuk administrator dan HR manager dengan 9 halaman fungsional, dirancang dengan konsistensi layout Jetstream, soft color palette, dan struktur yang professional.

---

## 📋 Pages & Routes

### 1. **Dashboard Admin** 
- **Route**: `GET /admin/dashboard`
- **File**: `resources/views/admin/dashboard.blade.php`
- **Features**:
  - 4 stat cards (Total Karyawan, Cuti Pending, Lembur Pending, Surat Pending)
  - Aktivitas Terbaru section dengan 5 activity items
  - Aksi Cepat dengan 5 quick action buttons
  - Performance metrics (Ringkasan Status Cuti, Kehadiran)
  - Responsive grid layout

### 2. **Manajemen Karyawan** 
- **Route**: `GET /admin/karyawan`
- **File**: `resources/views/admin/karyawan.blade.php`
- **Features**:
  - Search bar + Filter (Departemen, Status)
  - Table dengan 5 data karyawan
  - 3 aksi per row: Edit, Reset Akses, Nonaktifkan
  - 3 Modals: Tambah, Edit, Konfirmasi
  - Pagination
  - Status badges (Aktif, Nonaktif, Cuti)

### 3. **Monitoring Pengajuan Cuti**
- **Route**: `GET /admin/cuti`
- **File**: `resources/views/admin/cuti.blade.php`
- **Features**:
  - Filter: Nama, Status, Periode
  - 4 stat cards (Total, Menunggu, Disetujui, Ditolak)
  - 6 card items dengan status
  - Detail view action
  - Read-only monitoring (tidak ada approval authority)

### 4. **Monitoring Pengajuan Lembur**
- **Route**: `GET /admin/lembur`
- **File**: `resources/views/admin/lembur.blade.php`
- **Features**:
  - Filter: Nama, Status, Periode
  - 5 stat cards (Total, Menunggu, Disetujui, Ditolak, Total Jam)
  - 6 card items dengan jam lembur
  - Timestamp untuk setiap pengajuan
  - Read-only monitoring

### 5. **Manajemen Surat** ⭐ (Core HR Function)
- **Route**: `GET /admin/surat`
- **File**: `resources/views/admin/surat.blade.php`
- **Features**:
  - 2 Tab: "Daftar Surat" & "Buat Surat Baru"
  - Tab 1 (Daftar):
    - Filter: Nama, Jenis Surat, Status
    - 4 stat cards
    - Table dengan 5 surat + aksi (Lihat, Hapus, Edit)
  - Tab 2 (Buat):
    - 3 Template selector buttons
    - Form CRUD lengkap
    - Tombol: "Simpan Draft" & "Siapkan untuk Cetak"

### 6. **Template Surat**
- **Route**: `GET /admin/template`
- **File**: `resources/views/admin/template.blade.php`
- **Features**:
  - Search + Filter Status
  - 3 stat cards (Total, Aktif, Digunakan)
  - 4 template cards (grid layout)
  - Aksi per card: Edit, Toggle Status, Hapus
  - 3 Modals: Tambah, Edit, Konfirmasi
  - Preview isi template

### 7. **Riwayat Surat & Arsip**
- **Route**: `GET /admin/riwayat-surat`
- **File**: `resources/views/admin/riwayat-surat.blade.php`
- **Features**:
  - Advanced filter: Jenis, Tanggal Dari/Sampai
  - Timeline grouped by month (Januari 2026, Desember 2025)
  - Card view dengan icon, status, timestamp
  - Aksi: Lihat, Unduh PDF
  - Pagination

### 8. **Notifikasi Admin**
- **Route**: `GET /admin/notifikasi`
- **File**: `resources/views/admin/notifikasi.blade.php`
- **Features**:
  - 5 Filter buttons (Semua, Belum Dibaca, Pengajuan, Surat, Sistem)
  - Unread indicators (blue dot)
  - 3 unread + 4 read notifications
  - Notification icons (amber, green, purple, red, blue)
  - Visual distinction read/unread

### 9. **Profil Admin**
- **Route**: `GET /admin/profil`
- **File**: `resources/views/admin/profil.blade.php`
- **Features**:
  - Left sidebar:
    - Profile card dengan avatar
    - Info pribadi (Status, Tanggal Bergabung, Departemen, Lokasi)
    - Stats card (Login, Last Login)
    - Recent Activity
  - Right main form (3 sections):
    - Informasi Pribadi (edit)
    - Keamanan (Password, 2FA, Sessions)
    - Preferensi Notifikasi (checkboxes)

---

## 🎨 Design Specifications

### Color Palette
- **Background**: `bg-gray-50/50` (main), `bg-white` (cards)
- **Headers**: `bg-gray-50` border `border-gray-200`
- **Primary Action**: `bg-indigo-600` hover `bg-indigo-700`
- **Secondary**: `border border-gray-300` text `text-gray-700`
- **Status Badges**:
  - Aktif/Disetujui: `bg-green-100 text-green-800`
  - Menunggu: `bg-amber-100 text-amber-800`
  - Ditolak: `bg-red-100 text-red-800`
  - Nonaktif: `bg-gray-100 text-gray-800`
  - Diambil: `bg-blue-100 text-blue-800`

### Layout Pattern
```blade
<x-app-layout>
    <x-slot name="header"><h2>Page Title</h2></x-slot>
    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')
        <div class="flex-1 p-8 bg-gray-50/50">
            <!-- Content here -->
        </div>
    </div>
</x-app-layout>
```

### Typography
- **Heading 1**: `text-3xl font-bold text-gray-900`
- **Heading 2**: `text-lg font-semibold text-gray-800`
- **Heading 3**: `text-sm font-semibold text-gray-800`
- **Body**: `text-sm text-gray-600`
- **Small**: `text-xs text-gray-500`

### Components
- **Cards**: `bg-white rounded-lg shadow-sm border border-gray-200 p-6`
- **Buttons**: `px-4 py-2 rounded-lg transition-colors font-medium`
- **Inputs**: `w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500`
- **Modals**: Fixed overlay with centered card

---

## 🛣️ Route Registration

All routes registered in `routes/web.php` under Admin middleware group:

```php
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', ...)->name('dashboard');
    Route::get('/karyawan', ...)->name('karyawan');
    Route::get('/cuti', ...)->name('cuti');
    Route::get('/lembur', ...)->name('lembur');
    Route::get('/surat', ...)->name('surat');
    Route::get('/template', ...)->name('template');
    Route::get('/riwayat-surat', ...)->name('riwayat-surat');
    Route::get('/notifikasi', ...)->name('notifikasi');
    Route::get('/profil', ...)->name('profil');
});
```

---

## 📊 Data Structure

### Admin Dashboard Stats
- Total Karyawan Aktif: 156 (+2 bulan ini)
- Cuti Menunggu: 8 (3 dari direktur)
- Lembur Menunggu: 5
- Surat Dalam Proses: 12 (2 draft, 10 siap cetak)

### Sample Data
- Karyawan: 5 sample records (NIK 2024001-2024005)
- Pengajuan Cuti: 6 items dengan berbagai status
- Pengajuan Lembur: 6 items
- Surat: 5 items dengan status berbeda
- Template: 4 templates (3 aktif, 1 nonaktif)
- Notifikasi: 7 items (3 unread, 4 read)

---

## 🔧 Features & Functionality

### CRUD Operations
- **Karyawan**: Tambah, Edit, Reset Akses, Nonaktifkan
- **Surat**: Buat, Edit, Lihat, Hapus, Unduh PDF
- **Template**: Buat, Edit, Toggle Status, Hapus

### Modals (JavaScript)
- Tambah/Edit dengan form fields
- Konfirmasi dengan warning icon
- Close on escape & outside click
- Responsive design

### Filters & Search
- Real-time search inputs
- Dropdown filters (Departemen, Status, Jenis, Periode)
- Date range filters
- Status-based filtering

### Status Management
- 5+ status types (Aktif, Menunggu, Disetujui, Ditolak, Draft, Siap Ambil, Diambil, Nonaktif)
- Color-coded badges
- Count aggregation

---

## 📁 File Structure

```
resources/views/admin/
├── dashboard.blade.php       (311 lines) - Main dashboard
├── karyawan.blade.php         (350+ lines) - CRUD + modals
├── cuti.blade.php            (280+ lines) - Monitoring read-only
├── lembur.blade.php          (280+ lines) - Monitoring read-only
├── surat.blade.php           (450+ lines) - CRUD + tabs + form
├── template.blade.php        (400+ lines) - CRUD + modals + grid
├── riwayat-surat.blade.php   (300+ lines) - Archive + timeline
├── notifikasi.blade.php      (200+ lines) - Notifications + filters
└── profil.blade.php          (400+ lines) - Profile + security + prefs
```

---

## 🚀 Next Steps (Optional Enhancements)

### Phase 1: Database Integration
- Create models: `Surat`, `TemplateSurat`
- Create controllers: `AdminController`, `SuratController`
- Create migrations for tables
- Wire up form submissions to backend

### Phase 2: Authorization & Middleware
- Create `admin_hrd` role check
- Implement policy for CRUD operations
- Add audit logging for sensitive actions

### Phase 3: Features
- PDF generation for surat (LaravelDompdf)
- Email notifications
- Export to Excel (Maatwebsite/Excel)
- Real-time dashboard updates

### Phase 4: Integration
- Connect Karyawan form to create User
- Link Cuti/Lembur approval workflow
- Template variable substitution system
- Dashboard metrics from real data

---

## ✅ Verification Checklist

- [x] All 9 pages created with proper structure
- [x] Sidebar integration on all pages
- [x] Soft color palette applied consistently
- [x] Responsive grid layouts
- [x] Status badges with proper colors
- [x] Modal dialogs with validation feedback
- [x] Search & filter functionality UI
- [x] Sample data populated
- [x] Routes registered in web.php
- [x] Cache cleared & views compiled
- [x] Professional, clean design (no emoji)
- [x] Jetstream layout compliance

---

## 🎯 Summary

Admin/HRD system is now complete with:
- **9 functional pages** covering all HR operations
- **Professional design** with consistent styling
- **Comprehensive CRUD** for karyawan & surat management
- **Monitoring interfaces** for cuti/lembur without approval authority
- **Template management** for document standardization
- **Archive & search** capabilities
- **Notification system** with status filtering
- **Personal profile** with security settings

All pages follow established layout patterns from karyawan system for consistency and maintainability.

**Routes**: `/admin/dashboard` through `/admin/profil`
**Status**: ✅ Ready for testing and backend integration

---

Generated: January 2026
Version: 1.0 - Complete Admin/HRD System
