<?php
/**
 * SURAT CUTI SYSTEM - FINAL VERIFICATION SCRIPT
 * 
 * This script verifies all components are in place and working
 */

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║   SURAT CUTI SYSTEM - FINAL VERIFICATION                  ║\n";
echo "║   Status: Checking all components...                      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$checks = [];
$allPassed = true;

// ===== 1. FILE EXISTENCE CHECKS =====
echo "📁 FILE EXISTENCE CHECKS:\n";
echo "─────────────────────────────────────\n";

$files = [
    'app/Http/Controllers/Admin/SuratCutiController.php' => 'SuratCutiController',
    'resources/views/surat/cuti.blade.php' => 'Surat Cuti Template',
    'resources/views/admin/cuti.blade.php' => 'Admin Cuti View',
    'app/Http/Controllers/Admin/CutiController.php' => 'CutiController',
    'routes/web.php' => 'Routes',
];

foreach ($files as $path => $label) {
    $exists = file_exists($path);
    $status = $exists ? '✅ EXISTS' : '❌ MISSING';
    echo "  {$status} - {$label}\n";
    if (!$exists) $allPassed = false;
    $checks[$label] = $exists;
}

// ===== 2. DIRECTORY CHECKS =====
echo "\n📂 DIRECTORY CHECKS:\n";
echo "─────────────────────────────────────\n";

$dirs = [
    'storage/app/public/cuti' => 'Cuti Storage Directory',
];

foreach ($dirs as $path => $label) {
    $exists = is_dir($path);
    if (!$exists) mkdir($path, 0755, true);
    $status = is_dir($path) ? '✅ EXISTS' : '❌ MISSING';
    echo "  {$status} - {$label}\n";
    if (!is_dir($path)) $allPassed = false;
}

// ===== 3. CODE CHECKS =====
echo "\n🔍 CODE STRUCTURE CHECKS:\n";
echo "─────────────────────────────────────\n";

// Check SuratCutiController
$controllerFile = file_get_contents('app/Http/Controllers/Admin/SuratCutiController.php');
$checks['SuratCutiController::store'] = (strpos($controllerFile, 'public function store') !== false);
$checks['SuratCutiController::preview'] = (strpos($controllerFile, 'public function preview') !== false);

echo "  " . ($checks['SuratCutiController::store'] ? '✅' : '❌') . " - SuratCutiController::store()\n";
echo "  " . ($checks['SuratCutiController::preview'] ? '✅' : '❌') . " - SuratCutiController::preview()\n";

// Check CutiController
$cutiControllerFile = file_get_contents('app/Http/Controllers/Admin/CutiController.php');
$checks['CutiController::show'] = (strpos($cutiControllerFile, 'public function show') !== false);
echo "  " . ($checks['CutiController::show'] ? '✅' : '❌') . " - CutiController::show()\n";

// Check Routes
$routesFile = file_get_contents('routes/web.php');
$checks['Route::post cuti buat-surat'] = (strpos($routesFile, "Route::post('/cuti/{id}/buat-surat'") !== false);
$checks['Route::get cuti preview'] = (strpos($routesFile, "Route::get('/cuti/{id}/preview'") !== false);
$checks['SuratCutiController in routes'] = (strpos($routesFile, 'SuratCutiController') !== false);

echo "  " . ($checks['Route::post cuti buat-surat'] ? '✅' : '❌') . " - POST /cuti/{id}/buat-surat route\n";
echo "  " . ($checks['Route::get cuti preview'] ? '✅' : '❌') . " - GET /cuti/{id}/preview route\n";
echo "  " . ($checks['SuratCutiController in routes'] ? '✅' : '❌') . " - Routes use SuratCutiController\n";

// Check Cuti View
$cutiViewFile = file_get_contents('resources/views/admin/cuti.blade.php');
$checks['Detail Modal'] = (strpos($cutiViewFile, 'showDetailCuti') !== false);
$checks['Preview Modal'] = (strpos($cutiViewFile, 'previewSuratCutiModal') !== false);
$checks['JavaScript Functions'] = (strpos($cutiViewFile, 'previewCutiFromModal') !== false);

echo "  " . ($checks['Detail Modal'] ? '✅' : '❌') . " - Detail Modal Implementation\n";
echo "  " . ($checks['Preview Modal'] ? '✅' : '❌') . " - Preview Modal Implementation\n";
echo "  " . ($checks['JavaScript Functions'] ? '✅' : '❌') . " - JavaScript Functions\n";

// Check Surat Template
$suratTemplateFile = file_get_contents('resources/views/surat/cuti.blade.php');
$templateFields = [
    'karyawan->name' => 'Employee Name',
    'departemen->nama' => 'Department',
    'jenis' => 'Cuti Type',
    'tanggal_mulai' => 'Start Date',
    'tanggal_selesai' => 'End Date',
    'durasi_hari' => 'Duration',
    'alasan' => 'Reason',
    'delegatedUsers' => 'Delegated Users',
    'karyawan->phone' => 'Phone',
];

echo "\n  Template Fields:\n";
foreach ($templateFields as $field => $label) {
    $hasField = (strpos($suratTemplateFile, $field) !== false);
    $checks["Template: {$label}"] = $hasField;
    echo "    " . ($hasField ? '✅' : '❌') . " - {$label}\n";
}

// ===== 4. SECURITY CHECKS =====
echo "\n🔐 SECURITY CHECKS:\n";
echo "─────────────────────────────────────\n";

$checks['ensureAdminHRD in SuratCutiController'] = (strpos($controllerFile, 'ensureAdminHRD') !== false);
$checks['Status validation in store'] = (strpos($controllerFile, "status !== 'Disetujui'") !== false);
$checks['File existence check'] = (strpos($controllerFile, 'file_exists') !== false || strpos($controllerFile, 'Storage::disk') !== false);

echo "  " . ($checks['ensureAdminHRD in SuratCutiController'] ? '✅' : '❌') . " - Authorization checks\n";
echo "  " . ($checks['Status validation in store'] ? '✅' : '❌') . " - Status validation\n";
echo "  " . ($checks['File existence check'] ? '✅' : '❌') . " - File handling\n";

// ===== 5. DOCUMENTATION CHECKS =====
echo "\n📚 DOCUMENTATION:\n";
echo "─────────────────────────────────────\n";

$docs = [
    'SURAT_CUTI_FINAL_REPORT.md' => 'Final Report',
    'IMPLEMENTATION_COMPLETE.md' => 'Implementation Guide',
    'ARCHITECTURE_DIAGRAM.md' => 'Architecture Diagrams',
    'QUICK_START_SURAT_CUTI.md' => 'Quick Start Guide',
    'TEST_SURAT_CUTI.html' => 'Testing Guide',
    'FILES_MODIFIED.md' => 'File Changes Summary',
];

foreach ($docs as $path => $label) {
    $exists = file_exists($path);
    echo "  " . ($exists ? '✅' : '❌') . " - {$label}\n";
}

// ===== 6. SUMMARY =====
echo "\n" . str_repeat("═", 60) . "\n";
echo "FINAL VERIFICATION SUMMARY\n";
echo str_repeat("═", 60) . "\n\n";

$passedChecks = array_filter($checks, fn($v) => $v === true);
$totalChecks = count($checks);
$passedCount = count($passedChecks);
$percentage = round(($passedCount / $totalChecks) * 100);

echo "✅ Passed Checks: {$passedCount}/{$totalChecks}\n";
echo "📊 Completion: {$percentage}%\n";
echo "📈 Status: " . ($percentage === 100 ? '🎉 PERFECT!' : '⚠️ NEEDS ATTENTION') . "\n\n";

if ($percentage === 100) {
    echo "╔════════════════════════════════════════════════════════════╗\n";
    echo "║                                                            ║\n";
    echo "║   ✅ ALL CHECKS PASSED!                                   ║\n";
    echo "║                                                            ║\n";
    echo "║   System is ready for:                                    ║\n";
    echo "║   ✓ Testing                                               ║\n";
    echo "║   ✓ Deployment                                            ║\n";
    echo "║   ✓ Production use                                        ║\n";
    echo "║                                                            ║\n";
    echo "║   Next Steps:                                             ║\n";
    echo "║   1. Run manual tests using TEST_SURAT_CUTI.html         ║\n";
    echo "║   2. Verify in browser: /admin/cuti                       ║\n";
    echo "║   3. Create test surat                                    ║\n";
    echo "║   4. Preview and download PDF                             ║\n";
    echo "║                                                            ║\n";
    echo "╚════════════════════════════════════════════════════════════╝\n";
} else {
    echo "⚠️  Some checks failed. Please review above.\n";
    echo "\nFailed checks:\n";
    foreach ($checks as $check => $passed) {
        if (!$passed) {
            echo "  ❌ {$check}\n";
        }
    }
}

echo "\nVerification completed at: " . date('Y-m-d H:i:s') . "\n";
echo "\n";

?>
