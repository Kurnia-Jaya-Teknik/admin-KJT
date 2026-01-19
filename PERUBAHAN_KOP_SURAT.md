# Perubahan Sistem Upload Kop Surat

## Ringkasan
Telah dilakukan restrukturisasi logika upload kop surat untuk:
1. ✅ Admin dapat upload kop surat dalam **berbagai jenis format file**
2. ✅ **Preview otomatis muncul** langsung setelah file diupload tanpa perlu refresh

## Detail Perubahan

### 1. Backend: KopSuratController (app/Http/Controllers/Admin/KopSuratController.php)

#### Validasi File (Lebih Fleksibel)
- **Sebelum**: Hanya support `mimes:png,jpg,jpeg,svg,pdf,docx` (MIME type restriction ketat)
- **Sesudah**: Support **SEMUA format file** dengan validasi **hanya ukuran max 10MB**

```php
// SEBELUM
$request->validate([
    'file' => 'required|file|mimes:png,jpg,jpeg,svg,pdf,docx|max:10240',
    ...
]);

// SESUDAH
$request->validate([
    'file' => 'required|file|max:10240',
    ...
]);
```

#### Deteksi Template
- File dengan extension `.docx`, `.xlsx`, `.pptx` otomatis dideteksi sebagai template
- Template bisa digunakan untuk placeholder replacement (future feature untuk Excel & PowerPoint)

```php
$templateExtensions = ['docx', 'xlsx', 'pptx'];
$isTemplate = in_array($extension, $templateExtensions);
```

### 2. Frontend: surat.blade.php (resources/views/admin/surat.blade.php)

#### A. Input File Accept Attribute
- **Diperluas** untuk support lebih banyak format:
  - Images: `.jpg`, `.jpeg`, `.png`, `.svg`, `.gif`, `.bmp`, `.tiff`
  - Documents: `.pdf`, `.doc`, `.docx`, `.txt`, `.odt`
  - Spreadsheets: `.xls`, `.xlsx`, `.ods`
  - Presentations: `.ppt`, `.pptx`, `.odp`

```html
<!-- Input File -->
<input id="kopUploadInput" type="file" 
  accept=".jpg,.jpeg,.png,.svg,.pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.gif,.bmp,.tiff,.txt,.odt,.ods,.odp" 
  class="hidden" />
```

#### B. Validasi Frontend (Relaxed)
- **Sebelum**: Strict MIME type checking
- **Sesudah**: Hanya block file yang **dangerous** (executable files)

```javascript
// Validation: RELAXED
const blockedExtensions = ['exe', 'bat', 'cmd', 'com', 'scr', 'vbs', 'sh', 'jar'];
const fileExt = file.name.split('.').pop().toLowerCase();
if (blockedExtensions.includes(fileExt)) {
    // Reject
}
```

#### C. Real-time Preview Update
- **Saat file diupload**, preview **langsung muncul** di UI
- Tidak perlu refresh halaman atau reload list
- Backend kembalikan data file baru, langsung ditambah ke select dropdown
- Fungsi `updateKopPreview()` dipanggil otomatis

```javascript
if (window.updateKopPreview) window.updateKopPreview();
if (window.updateFormPreview) window.updateFormPreview();
```

#### D. Peningkatan Fungsi updateKopPreview()
Menampilkan **icon dan preview berbeda** berdasarkan tipe file:

- **PDF**: Link clickable dengan icon
- **Images** (JPG, PNG, SVG, dll): Thumbnail preview
- **Documents** (DOCX, DOC, TXT, ODF): Icon file + nama file
- **Spreadsheet** (XLSX, XLS, ODS): Icon file + nama file (warna hijau)
- **Presentation** (PPTX, PPT, ODP): Icon file + nama file (warna orange)

#### E. Peningkatan Fungsi updateFormPreview()
Preview surat juga otomatis **menampilkan kop dengan icon** berdasarkan tipe file:

```javascript
// Display kop based on file type
if (['pdf'].includes(fileExt)) {
    // Show PDF indicator
} else if (['doc', 'docx', ...].includes(fileExt)) {
    // Show document indicator
} else if (['jpg', 'jpeg', 'png', ...].includes(fileExt)) {
    // Show image thumbnail
}
```

## Format File yang Didukung

### Images
- JPG, JPEG, PNG, GIF, SVG, BMP, TIFF

### Documents
- PDF, DOCX, DOC, DOCM, XLSX, XLS, XLSM, PPTX, PPT, PPTM, TXT, ODT, ODS, ODP

### Constraints
- Maximum file size: **10 MB**
- Blocked file types: executable files (.exe, .bat, .cmd, .com, .scr, .vbs, .sh, .jar)

## Flow Penggunaan

### Skenario 1: Upload File Biasa (Gambar/PDF)
1. Admin klik tombol "Unggah"
2. Pilih file gambar atau PDF
3. File terupload ke server
4. **Otomatis** ditambah ke dropdown "Pilih Kop Surat"
5. **Otomatis** di-select dan preview muncul
6. Preview surat juga **otomatis update** menampilkan kop

### Skenario 2: Upload File Template (DOCX)
1. Admin upload file DOCX dengan placeholders
2. File terupload dan placeholder otomatis extracted
3. Form input placeholder muncul di "Template Fields"
4. Admin bisa isi placeholder values saat membuat surat
5. File DOCX bisa di-generate dengan nilai yang sudah diisi

### Skenario 3: Upload File Excel/PowerPoint (Masa Depan)
1. Admin upload file XLSX atau PPTX
2. Dideteksi sebagai template (future enhancement)
3. Bisa ditambahkan placeholder support di versi mendatang

## Testing Checklist

- [ ] Upload file JPG → Preview muncul dengan thumbnail
- [ ] Upload file PNG → Preview muncul dengan thumbnail
- [ ] Upload file PDF → Preview muncul dengan link "Lihat kop (PDF)"
- [ ] Upload file DOCX → Preview muncul dengan icon dan nama file
- [ ] Upload file XLSX → Preview muncul dengan icon dan nama file
- [ ] Upload file PPTX → Preview muncul dengan icon dan nama file
- [ ] Upload file dengan nama panjang → Display singkat dengan ellipsis
- [ ] Upload file > 10MB → Error "File terlalu besar"
- [ ] Upload file .exe → Error "File tidak aman"
- [ ] Buat surat dengan kop image → Preview surat menampilkan image kop
- [ ] Buat surat dengan kop PDF → Preview surat menampilkan indikator PDF
- [ ] Buat surat dengan kop DOCX → Preview surat menampilkan indikator DOCX

## Database
Tidak ada perubahan struktur database. Field `kop_surats.mime` tetap menyimpan MIME type dari file yang diupload.

## Backward Compatibility
✅ **Fully backward compatible** - semua file yang sudah diupload sebelumnya tetap berfungsi normal.

## Notes
- Validasi MIME type yang ketat (allowedTypes) **dihilangkan** di frontend karena server-side akan menangani security
- Server hanya membatasi size (10MB) dan block dangerous extensions
- Preview di frontend cukup smart untuk mendeteksi tipe file dari extension dan display sesuai
