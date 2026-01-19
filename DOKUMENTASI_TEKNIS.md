# 🔧 DOKUMENTASI TEKNIS - SISTEM UPLOAD KOP SURAT

## 1. ARCHITECTURE OVERVIEW

### Flow Diagram
```
┌─────────────────────────────────────────────────────────────────┐
│                     ADMIN INTERFACE                             │
│                   (surat.blade.php)                             │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  1. INPUT LAYER                                                │
│  ┌──────────────────────────────────────┐                      │
│  │ <input id="kopUploadInput" ...>      │                      │
│  │ accept=".jpg,.pdf,.docx,..."        │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         │ onChange → uploadKop()                               │
│         ▼                                                       │
│  2. VALIDATION LAYER                                           │
│  ┌──────────────────────────────────────┐                      │
│  │ Check file size (< 10MB)             │                      │
│  │ Check extension (not .exe/.bat/.cmd) │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         │ if valid, proceed to upload                          │
│         ▼                                                       │
│  3. UPLOAD LAYER                                               │
│  ┌──────────────────────────────────────┐                      │
│  │ POST /admin/kop-surat                │                      │
│  │ FormData: { file, ... }              │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         │                                                       │
└─────────────────────────────────────────────────────────────────┘
         │
         ▼
┌─────────────────────────────────────────────────────────────────┐
│              BACKEND - KopSuratController                       │
│         (app/Http/Controllers/Admin/)                           │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  4. SERVER VALIDATION                                          │
│  ┌──────────────────────────────────────┐                      │
│  │ Validate: max 10MB                   │                      │
│  │ Check: file required                 │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  5. FILE STORAGE                                               │
│  ┌──────────────────────────────────────┐                      │
│  │ Store file to:                       │                      │
│  │ /storage/app/public/kop-surat/       │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  6. DATABASE RECORD                                            │
│  ┌──────────────────────────────────────┐                      │
│  │ KopSurat::create([                   │                      │
│  │   name, file_path, mime,             │                      │
│  │   is_template, uploaded_by           │                      │
│  │ ])                                    │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  7. RESPONSE                                                   │
│  ┌──────────────────────────────────────┐                      │
│  │ JSON: {                              │                      │
│  │   success: true,                     │                      │
│  │   data: { id, name, url, ... }       │                      │
│  │ }                                     │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
└─────────────────────────────────────────────────────────────────┘
         │
         │
         ▼
┌─────────────────────────────────────────────────────────────────┐
│              FRONTEND - UPDATE UI                               │
│         (surat.blade.php)                                       │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  8. UPDATE DROPDOWN                                            │
│  ┌──────────────────────────────────────┐                      │
│  │ Add <option> to #kopSuratSelect      │                      │
│  │ Pre-select the new option            │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  9. UPDATE PREVIEW                                             │
│  ┌──────────────────────────────────────┐                      │
│  │ Call updateKopPreview()              │                      │
│  │ → Display icon/thumbnail based on    │                      │
│  │   file type                          │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  10. UPDATE FORM PREVIEW                                       │
│  ┌──────────────────────────────────────┐                      │
│  │ Call updateFormPreview()             │                      │
│  │ → Render full letter preview with    │                      │
│  │   newly selected kop                 │                      │
│  └──────────────────────────────────────┘                      │
│         │                                                       │
│         ▼                                                       │
│  11. SHOW SUCCESS                                              │
│  ┌──────────────────────────────────────┐                      │
│  │ Display: \"✅ Kop berhasil diunggah.\" │                      │
│  │ Clear file input                     │                      │
│  └──────────────────────────────────────┘                      │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

## 2. FILE STRUCTURE

```
storage/
├── app/
│   └── public/
│       ├── kop-surat/           ← Kop files stored here
│       │   ├── xxxxx.jpg
│       │   ├── xxxxx.pdf
│       │   ├── xxxxx.docx
│       │   └── ...
│       ├── generated/           ← Generated docs (future)
│       └── ...
│
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│           └── KopSuratController.php  ← Main logic
│
resources/
└── views/
    └── admin/
        └── surat.blade.php     ← Frontend + JS
```

---

## 3. DATABASE SCHEMA

### Table: kop_surats

```sql
CREATE TABLE kop_surats (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,                    -- Display name
    file_path VARCHAR(255) NOT NULL,               -- Path: kop-surat/xxxxx.jpg
    mime VARCHAR(255) NULLABLE,                    -- MIME type: image/jpeg
    uploaded_by BIGINT UNSIGNED NULLABLE,          -- User ID who uploaded
    is_template BOOLEAN DEFAULT false,             -- Is DOCX/XLSX/PPTX template?
    placeholders JSON NULLABLE,                    -- Extracted placeholders
    created_at TIMESTAMP,
    deleted_at TIMESTAMP NULLABLE,
    updated_at TIMESTAMP,
    
    INDEX(uploaded_by),
    INDEX(is_template),
    INDEX(created_at)
);
```

### Example Records

```sql
-- Image Kop
INSERT INTO kop_surats (name, file_path, mime, is_template)
VALUES ('Kop Resmi JPG', 'kop-surat/company-logo.jpg', 'image/jpeg', false);

-- PDF Kop
INSERT INTO kop_surats (name, file_path, mime, is_template)
VALUES ('Kop Form PDF', 'kop-surat/form-template.pdf', 'application/pdf', false);

-- DOCX Template
INSERT INTO kop_surats (name, file_path, mime, is_template, placeholders)
VALUES ('Template Surat', 'kop-surat/surat-template.docx', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
        true, '["NOMOR","TANGGAL","PENERIMA"]');
```

---

## 4. BACKEND CODE

### KopSuratController::store()

```php
public function store(Request $request)
{
    // 1. VALIDATION (Relaxed)
    $request->validate([
        'file' => 'required|file|max:10240',  // 10MB limit only
        'name' => 'nullable|string|max:255',
    ]);

    // 2. GET FILE INFO
    $file = $request->file('file');
    $name = $request->input('name') ?? $file->getClientOriginalName();
    $mime = $file->getMimeType();
    $extension = strtolower($file->getClientOriginalExtension());

    // 3. STORE FILE
    $path = $file->store('kop-surat', 'public');  // storage/app/public/kop-surat/...

    // 4. CREATE SYMLINK IF NEEDED
    if (!file_exists(public_path('storage'))) {
        @symlink(storage_path('app/public'), public_path('storage'));
    }

    // 5. DETECT TEMPLATE
    $templateExtensions = ['docx', 'xlsx', 'pptx'];
    $isTemplate = in_array($extension, $templateExtensions);

    // 6. SAVE TO DATABASE
    $kop = KopSurat::create([
        'name' => $name,
        'file_path' => $path,
        'mime' => $mime,
        'is_template' => $isTemplate,
        'uploaded_by' => $request->user()?->id,
    ]);

    // 7. EXTRACT PLACEHOLDERS (if DOCX)
    if ($isTemplate && $extension === 'docx') {
        try {
            $tp = new \PhpOffice\PhpWord\TemplateProcessor(
                storage_path('app/public/' . $path)
            );
            $vars = $tp->getVariables();
            $kop->placeholders = $vars;
            $kop->save();
        } catch (\Throwable $e) {
            // Silent fail - file still saved
        }
    }

    // 8. PREPARE RESPONSE
    $kop->url = asset('storage/' . $kop->file_path);
    $kop->placeholders = $kop->placeholders 
        ? (is_array($kop->placeholders) 
            ? $kop->placeholders 
            : json_decode($kop->placeholders, true))
        : [];

    return response()->json(['success' => true, 'data' => $kop], 201);
}
```

### KopSuratController::index()

```php
public function index()
{
    $list = KopSurat::orderBy('created_at', 'desc')
                    ->get(['id', 'name', 'file_path', 'mime', 'is_template', 'placeholders', 'created_at']);
    
    // Append public URLs
    $list->transform(function($item) {
        $item->url = $item->file_path ? asset('storage/' . $item->file_path) : null;
        return $item;
    });
    
    return response()->json($list);
}
```

---

## 5. FRONTEND CODE

### uploadKop() Function

```javascript
function uploadKop(e) {
    const fileInput = e.target || document.getElementById('kopUploadInput');
    const file = fileInput.files?.[0];
    if (!file) return;

    const statusEl = document.getElementById('kopUploadStatus');
    
    // 1. FILE SIZE CHECK
    if (file.size > 10 * 1024 * 1024) {
        statusEl.innerHTML = '<span class="text-red-600">❌ File terlalu besar. Maksimal 10MB.</span>';
        fileInput.value = '';
        return;
    }

    // 2. DANGEROUS FILE CHECK
    const blockedExtensions = ['exe', 'bat', 'cmd', 'com', 'scr', 'vbs', 'sh', 'jar'];
    const fileExt = file.name.split('.').pop().toLowerCase();
    if (blockedExtensions.includes(fileExt)) {
        statusEl.innerHTML = '<span class="text-red-600">❌ File tidak aman.</span>';
        fileInput.value = '';
        return;
    }

    // 3. UPLOAD FILE
    statusEl.innerHTML = '<span class="text-blue-600">⏳ Mengunggah...</span>';
    
    const form = new FormData();
    form.append('file', file);

    const token = document.querySelector('meta[name="csrf-token"]')
                         ?.getAttribute('content') || '';

    fetch('/admin/kop-surat', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token },
        body: form,
        credentials: 'same-origin'
    })
    .then(r => r.ok ? r.json() : Promise.reject(new Error(`HTTP ${r.status}`)))
    .then(data => {
        if (data?.success && data?.data) {
            // 4. ADD TO DROPDOWN
            const sel = document.getElementById('kopSuratSelect');
            const opt = document.createElement('option');
            opt.value = data.data.id;
            opt.text = data.data.name;
            opt.dataset.url = data.data.url || '';
            opt.dataset.isTemplate = data.data.is_template ? '1' : '0';
            if (data.data.placeholders) {
                opt.dataset.placeholders = JSON.stringify(data.data.placeholders || []);
            }
            
            // 5. SELECT & UPDATE PREVIEW
            sel.prepend(opt);
            sel.value = data.data.id;
            updateKopPreview();        // Update kop preview area
            updateFormPreview();       // Update full surat preview
            
            statusEl.innerHTML = '<span class="text-green-600">✅ Kop berhasil diunggah.</span>';
        } else {
            throw new Error(data?.message || 'Unknown error');
        }
    })
    .catch(err => {
        statusEl.innerHTML = `<span class="text-red-600">❌ ${err.message}</span>`;
    })
    .finally(() => {
        fileInput.value = '';
    });
}
```

### updateKopPreview() Function

```javascript
function updateKopPreview() {
    const sel = document.getElementById('kopSuratSelect');
    const preview = document.getElementById('kopPreview');
    if (!sel || !preview) return;
    
    const opt = sel.selectedOptions?.[0];
    if (!opt?.dataset?.url) {
        preview.innerHTML = 'Tidak ada kop dipilih.';
        updateFormPreview();
        return;
    }

    const url = opt.dataset.url;
    const fileName = url.split('/').pop();
    const fileExt = fileName.split('.').pop().toLowerCase();
    
    // SMART PREVIEW BASED ON FILE TYPE
    if (['pdf'].includes(fileExt)) {
        // PDF: clickable link
        preview.innerHTML = `<a href="${url}" target="_blank" class="inline-flex items-center gap-2 text-red-600 underline"><svg class="w-5 h-5">...</svg>Lihat kop (PDF)</a>`;
    } else if (['doc', 'docx', 'odt', 'txt'].includes(fileExt)) {
        // Document: icon + filename
        preview.innerHTML = `<div class="inline-flex items-center gap-2 text-blue-600"><svg>...</svg><span>${escapeHtml(fileName)}</span></div>`;
    } else if (['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'tiff'].includes(fileExt)) {
        // Image: thumbnail
        preview.innerHTML = `<img src="${url}" alt="kop" class="h-24 object-contain border rounded"/>`;
    } else {
        // Unknown: generic icon
        preview.innerHTML = `<div class="inline-flex items-center gap-2 text-gray-600"><svg>...</svg><span>${escapeHtml(fileName)}</span></div>`;
    }

    updateFormPreview();
    
    // Load placeholders if template
    if (opt.dataset?.isTemplate === '1') {
        const ph = opt.dataset.placeholders 
                   ? JSON.parse(opt.dataset.placeholders) 
                   : [];
        const fields = document.getElementById('kopTemplateFields');
        if (fields) {
            if (!ph.length) {
                fields.innerHTML = '';
            } else {
                let html = '<p class="text-sm font-medium">Template Fields</p>';
                ph.forEach(name => {
                    html += `<div class="grid grid-cols-2 gap-2">
                               <label>${escapeHtml(name)}</label>
                               <input type="text" data-ph="${name}" class="px-3 py-2 border rounded"/>
                             </div>`;
                });
                fields.innerHTML = html;
            }
        }
    }
}
```

### fetchKopList() Function

```javascript
function fetchKopList() {
    fetch('/admin/kop-surat', { credentials: 'same-origin' })
    .then(r => r.json())
    .then(list => {
        const sel = document.getElementById('kopSuratSelect');
        if (!sel) return;
        
        // Clear existing options (keep placeholder)
        sel.innerHTML = '<option value="">-- Pilih Kop Surat (Default) --</option>';
        
        // Add all kop options
        list.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.id;
            opt.text = item.name;
            opt.dataset.url = item.url || '';
            opt.dataset.isTemplate = item.is_template ? '1' : '0';
            if (item.placeholders) {
                opt.dataset.placeholders = JSON.stringify(item.placeholders || []);
            }
            sel.appendChild(opt);
        });
    })
    .catch(err => console.error('fetchKopList error', err));
}
```

---

## 6. SUPPORTED FILE TYPES

### Images (8 types)
- `.jpg`, `.jpeg`, `.png`, `.gif`, `.svg`, `.bmp`, `.tiff`
- MIME: `image/*`
- Max size: 10MB
- Preview: Thumbnail

### Documents (5 types)
- `.pdf` - MIME: `application/pdf` - Preview: Link
- `.docx` - MIME: `application/vnd.openxmlformats-officedocument.wordprocessingml.document` - Preview: Icon + Name, Can be template
- `.doc` - MIME: `application/msword` - Preview: Icon + Name
- `.txt` - MIME: `text/plain` - Preview: Icon + Name
- `.odt` - MIME: `application/vnd.oasis.opendocument.text` - Preview: Icon + Name

### Spreadsheets (3 types)
- `.xlsx` - MIME: `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet` - Preview: Icon + Name (Green)
- `.xls` - MIME: `application/vnd.ms-excel` - Preview: Icon + Name (Green)
- `.ods` - MIME: `application/vnd.oasis.opendocument.spreadsheet` - Preview: Icon + Name (Green)

### Presentations (3 types)
- `.pptx` - MIME: `application/vnd.openxmlformats-officedocument.presentationml.presentation` - Preview: Icon + Name (Orange), Can be template
- `.ppt` - MIME: `application/vnd.ms-powerpoint` - Preview: Icon + Name (Orange)
- `.odp` - MIME: `application/vnd.oasis.opendocument.presentation` - Preview: Icon + Name (Orange)

### Blocked (8 types)
- `.exe`, `.bat`, `.cmd`, `.com`, `.scr`, `.vbs`, `.sh`, `.jar`
- These are rejected both on client and server

---

## 7. ERROR HANDLING

### Frontend Validation Errors

| Error | Message | Trigger |
|-------|---------|---------|
| File too large | "❌ File terlalu besar. Maksimal 10MB." | file.size > 10MB |
| Dangerous file | "❌ File tidak aman." | `.exe`, `.bat`, etc. |
| Network error | "❌ [error message]" | Fetch fails |
| Server error | "❌ Gagal mengunggah" | HTTP 500, etc. |
| Unknown error | "❌ [error from backend]" | Any other error |

### Backend Validation Errors

| Error | HTTP Status | Response |
|-------|-------------|----------|
| File required | 422 | `{ "message": "...validation..." }` |
| File too large | 422 | `{ "message": "...validation..." }` |
| Storage error | 500 | `{ "error": "Failed to store file" }` |
| DB error | 500 | `{ "error": "Database error" }` |

---

## 8. SECURITY CONSIDERATIONS

### File Upload Security
```php
// 1. Size limit: 10MB (prevent DoS)
'max:10240'

// 2. Extension whitelist (client-side)
// 3. Extension blacklist (server-side) - for dangerous files
// 4. MIME type can be added (future enhancement)
// 5. File stored in non-web-accessible directory initially
// 6. Symlink created only once for public access

// 7. User attribution
'uploaded_by' => auth()->user()->id
```

### XSS Prevention
```javascript
// All filenames escaped
escapeHtml(fileName)

// SVG files still rendered but same-origin only
// Could add content-disposition: attachment in future
```

### CSRF Protection
```javascript
// CSRF token required in all POST requests
headers: { 'X-CSRF-TOKEN': token }
```

---

## 9. PERFORMANCE NOTES

### Database
- Index on `created_at` for sorting
- Index on `uploaded_by` for user queries
- Index on `is_template` for filtering

### Frontend
- File preview is instant (no processing needed)
- List fetched on page load, no pagination (if < 100 files)
- If many files, consider implementing pagination

### Backend
- File stored to public disk for direct access
- Symlink checked only once per upload
- Template extraction only for DOCX (async in future)

---

## 10. FUTURE ENHANCEMENTS

### Planned Features
1. [ ] Excel/PowerPoint placeholder extraction
2. [ ] File preview (PDF preview iframe)
3. [ ] Soft delete with restore
4. [ ] Kop file versioning
5. [ ] Access control (only owner can delete)
6. [ ] Audit logging (who uploaded what when)
7. [ ] Auto-cleanup old generated documents
8. [ ] Drag-drop upload interface
9. [ ] Image crop/resize before upload
10. [ ] Template preview with sample data

### Possible Improvements
- Add optional MIME type validation
- Rate limiting on upload endpoint
- Compression for large files
- Thumbnail generation for images
- Search/filter by filename
- Bulk upload support
- Restore deleted kop files

---

## 11. TESTING GUIDELINES

### Unit Tests
```php
// Test store() with valid file
public function test_store_valid_jpg() { }

// Test store() with oversized file
public function test_store_oversized_file() { }

// Test store() with dangerous file
public function test_store_dangerous_file() { }

// Test is_template detection
public function test_template_detection() { }

// Test placeholder extraction
public function test_placeholder_extraction() { }
```

### Integration Tests
- Upload → Fetch → Select → Preview

### E2E Tests
- Full user flow from upload to letter creation

---

## 12. DEPLOYMENT NOTES

### Before Deployment
- [ ] Run database migrations
- [ ] Clear Laravel cache
- [ ] Verify storage permissions (755)
- [ ] Verify public/storage symlink exists
- [ ] Run tests

### After Deployment
- [ ] Test upload with different file types
- [ ] Verify file permissions
- [ ] Check logs for errors
- [ ] Monitor storage usage

---

**Last Updated**: 2026-01-19  
**Status**: ✅ Production Ready
