# 🧪 TEST CHECKLIST - LOGIKA UPLOAD KOP SURAT

## A. Validation Tests

### A1. File Size Validation
- [ ] Upload file 5MB (OK) → Success message + preview muncul
- [ ] Upload file 10MB (borderline OK) → Success message + preview muncul  
- [ ] Upload file 11MB (FAIL) → Error "File terlalu besar. Maksimal 10MB."
- [ ] Upload file 15MB (FAIL) → Error "File terlalu besar. Maksimal 10MB."

### A2. File Type Validation (Dangerous Files)
- [ ] Upload file .exe (BLOCKED) → Error "File tidak aman."
- [ ] Upload file .bat (BLOCKED) → Error "File tidak aman."
- [ ] Upload file .cmd (BLOCKED) → Error "File tidak aman."
- [ ] Upload file .jar (BLOCKED) → Error "File tidak aman."
- [ ] Upload file .vbs (BLOCKED) → Error "File tidak aman."

### A3. File Type Support (Allowed Files)
- [ ] Upload file .jpg (OK) → Success
- [ ] Upload file .jpeg (OK) → Success
- [ ] Upload file .png (OK) → Success
- [ ] Upload file .svg (OK) → Success
- [ ] Upload file .gif (OK) → Success
- [ ] Upload file .bmp (OK) → Success
- [ ] Upload file .tiff (OK) → Success
- [ ] Upload file .pdf (OK) → Success
- [ ] Upload file .docx (OK) → Success
- [ ] Upload file .doc (OK) → Success
- [ ] Upload file .xlsx (OK) → Success
- [ ] Upload file .xls (OK) → Success
- [ ] Upload file .pptx (OK) → Success
- [ ] Upload file .ppt (OK) → Success
- [ ] Upload file .txt (OK) → Success
- [ ] Upload file .odt (OK) → Success
- [ ] Upload file .ods (OK) → Success
- [ ] Upload file .odp (OK) → Success

---

## B. Real-time Preview Tests

### B1. Upload Image File
- [ ] Upload JPG file
  - Expected: ✓ File immediately added to dropdown
  - Expected: ✓ File automatically selected
  - Expected: ✓ Thumbnail preview shows in "Kop Surat" section
  - Expected: ✓ Success message shows "✅ Kop berhasil diunggah."
  - Expected: ✓ NO page refresh needed

- [ ] Upload PNG file
  - Expected: ✓ Same as JPG - thumbnail appears immediately

- [ ] Upload GIF file
  - Expected: ✓ Same as JPG - thumbnail appears immediately

### B2. Upload PDF File
- [ ] Upload PDF file
  - Expected: ✓ File added to dropdown + selected
  - Expected: ✓ Preview shows link "Lihat kop (PDF)" instead of thumbnail
  - Expected: ✓ Link is clickable and opens PDF in new tab
  - Expected: ✓ Success message appears
  - Expected: ✓ NO page refresh

### B3. Upload Document File
- [ ] Upload DOCX file
  - Expected: ✓ File added + selected
  - Expected: ✓ Preview shows icon + filename (blue colored)
  - Expected: ✓ If DOCX is template → Template Fields appear below
  - Expected: ✓ Success message appears

- [ ] Upload DOC file
  - Expected: ✓ Same as DOCX preview display

- [ ] Upload TXT file
  - Expected: ✓ Same as DOCX preview display

### B4. Upload Spreadsheet File
- [ ] Upload XLSX file
  - Expected: ✓ File added + selected
  - Expected: ✓ Preview shows icon + filename (green colored)
  - Expected: ✓ Success message appears

- [ ] Upload XLS file
  - Expected: ✓ Same as XLSX

- [ ] Upload ODS file
  - Expected: ✓ Same as XLSX

### B5. Upload Presentation File
- [ ] Upload PPTX file
  - Expected: ✓ File added + selected
  - Expected: ✓ Preview shows icon + filename (orange colored)
  - Expected: ✓ Success message appears

- [ ] Upload PPT file
  - Expected: ✓ Same as PPTX

- [ ] Upload ODP file
  - Expected: ✓ Same as PPTX

---

## C. Integration Tests

### C1. Create Letter with Image Kop
- [ ] Upload JPG kop surat
- [ ] Create new letter
- [ ] Select the JPG kop from dropdown
- [ ] Fill in letter details (nomor, tanggal, jenis, etc.)
- [ ] Expected: Preview pane shows thumbnail of kop surat at top
- [ ] Expected: PDF generation includes the kop image

### C2. Create Letter with PDF Kop
- [ ] Upload PDF kop surat
- [ ] Create new letter
- [ ] Select PDF kop from dropdown
- [ ] Fill in letter details
- [ ] Expected: Preview shows "[Kop Surat: filename.pdf - PDF]"
- [ ] Expected: Form submits successfully

### C3. Create Letter with DOCX Kop (Template)
- [ ] Upload DOCX file with placeholders (e.g., {{COMPANY}}, {{DATE}})
- [ ] Create new letter
- [ ] Select DOCX kop from dropdown
- [ ] Expected: Template Fields section shows input fields
- [ ] Fill placeholder values
- [ ] Expected: Can submit and generate filled document

### C4. Create Letter with Multiple Kop Changes
- [ ] Upload 3 different kop files (image, PDF, docx)
- [ ] Create new letter
- [ ] Select first kop (image) → preview updates ✓
- [ ] Change to second kop (PDF) → preview updates ✓
- [ ] Change to third kop (docx) → preview updates ✓
- [ ] Expected: All changes reflected immediately without lag

---

## D. Database Tests

### D1. Data Persistence
- [ ] Upload kop file
- [ ] Refresh page
- [ ] Expected: Kop still available in dropdown
- [ ] Expected: Can still select and use it

### D2. Multiple Uploads
- [ ] Upload 10 different kop files
- [ ] Expected: All appear in dropdown with correct names
- [ ] Expected: Can select and use any of them
- [ ] Expected: No data loss or corruption

### D3. Template Flag Detection
- [ ] Upload DOCX file
- [ ] Expected: In database, `is_template = true`
- [ ] Upload XLSX file
  - Expected: In database, `is_template = true`
- [ ] Upload JPG file
  - Expected: In database, `is_template = false`

---

## E. Error Handling Tests

### E1. Upload Failures
- [ ] Network error during upload → Show error message
- [ ] Server error (500) → Show "Gagal mengunggah"
- [ ] Invalid file → Show appropriate error
- [ ] File input cleared after any error

### E2. Preview Fallback
- [ ] Corrupted image file → Show generic file icon
- [ ] Broken PDF → Still show PDF indicator
- [ ] Unknown file type → Show generic file icon

---

## F. UI/UX Tests

### F1. Button & Input Behavior
- [ ] Upload button tooltip updated to show all supported formats ✓
- [ ] File input accept filter shows correct extensions ✓
- [ ] Multiple rapid clicks on upload button handled gracefully ✓

### F2. Visual Feedback
- [ ] Status message shows during upload: "⏳ Mengunggah..."
- [ ] Success shows: "✅ Kop berhasil diunggah."
- [ ] Error shows: "❌ [error message]"
- [ ] Status clears after 3 seconds (optional)

### F3. Responsive Design
- [ ] On mobile (< 768px) → Preview display works correctly
- [ ] On tablet → All icons and text visible
- [ ] On desktop → Full preview with proper spacing

---

## G. Security Tests

### G1. File Upload Security
- [ ] Cannot upload executable files (.exe, .bat, .cmd, .jar, .vbs)
- [ ] Cannot upload files > 10MB
- [ ] File stored safely in `/storage/kop-surat/` directory
- [ ] File names properly escaped in preview

### G2. XSS Prevention
- [ ] Filename with special chars (<, >, ", ') properly escaped
- [ ] File name with HTML tags not rendered as HTML
- [ ] Dataset attributes properly encoded

---

## H. Browser Compatibility

- [ ] Chrome (latest)
  - [ ] Upload works
  - [ ] Preview renders correctly
  - [ ] No console errors

- [ ] Firefox (latest)
  - [ ] Upload works
  - [ ] Preview renders correctly
  - [ ] No console errors

- [ ] Safari (latest)
  - [ ] Upload works
  - [ ] Preview renders correctly
  - [ ] No console errors

- [ ] Edge (latest)
  - [ ] Upload works
  - [ ] Preview renders correctly
  - [ ] No console errors

---

## I. Performance Tests

- [ ] Upload 5MB file → Completes in < 5 seconds
- [ ] Preview updates immediately after upload
- [ ] No UI lag when selecting dropdown items
- [ ] Multiple rapid operations don't freeze UI
- [ ] Page doesn't consume excessive memory

---

## J. Regression Tests (Backward Compatibility)

- [ ] Old kop files (uploaded before changes) still work
- [ ] Can still create letters with old kop files
- [ ] PDF generation still works with all kop types
- [ ] Letter history still displays correctly
- [ ] No data loss on existing records

---

## ✅ Test Sign-off

| Test Category | Status | Notes |
|---------------|--------|-------|
| A. Validation | [ ] ✓ | |
| B. Real-time Preview | [ ] ✓ | |
| C. Integration | [ ] ✓ | |
| D. Database | [ ] ✓ | |
| E. Error Handling | [ ] ✓ | |
| F. UI/UX | [ ] ✓ | |
| G. Security | [ ] ✓ | |
| H. Browser Compat | [ ] ✓ | |
| I. Performance | [ ] ✓ | |
| J. Regression | [ ] ✓ | |

**Overall Status**: [ ] PASSED | [ ] FAILED | [ ] NEEDS FIXES

**Tester Name**: ________________  
**Test Date**: ________________  
**Notes**: 
```
[Add any additional notes here]
```

---

**Last Updated**: 2026-01-19  
**Status**: ✅ Ready for Testing
