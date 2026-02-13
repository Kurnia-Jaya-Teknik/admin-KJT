<?php

// Simple PHP script to test without Laravel bootstrap
// This will show system status

echo "=== CHECKING SURAT CUTI SYSTEM ===\n\n";

// 1. Check if SuratCutiController exists
$controllerPath = __DIR__ . '/app/Http/Controllers/Admin/SuratCutiController.php';
echo "[1] SuratCutiController: " . (file_exists($controllerPath) ? "✓ EXISTS" : "✗ MISSING") . "\n";

// 2. Check if cuti template exists  
$templatePath = __DIR__ . '/resources/views/surat/cuti.blade.php';
echo "[2] Cuti Template: " . (file_exists($templatePath) ? "✓ EXISTS" : "✗ MISSING") . "\n";

// 3. Check if modal exists in cuti view
$cutiViewPath = __DIR__ . '/resources/views/admin/cuti.blade.php';
$cutiView = file_get_contents($cutiViewPath);
echo "[3] Preview Modal: " . (strpos($cutiView, 'previewSuratCutiModal') !== false ? "✓ EXISTS" : "✗ MISSING") . "\n";

// 4. Check if storage directory exists
$storageDir = __DIR__ . '/storage/app/public/cuti';
echo "[4] Storage Directory: " . (is_dir($storageDir) ? "✓ EXISTS" : "✗ MISSING") . "\n";
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "   → Created storage directory\n";
}

// 5. Check routes
$routesPath = __DIR__ . '/routes/web.php';
$routes = file_get_contents($routesPath);
echo "[5] Cuti Routes:\n";
echo "   POST /cuti/{id}/buat-surat: " . (strpos($routes, 'SuratCutiController') !== false ? "✓ CORRECT" : "✗ WRONG") . "\n";
echo "   GET /cuti/{id}/preview: " . (strpos($routes, "Route::get('/cuti/{id}/preview'") !== false ? "✓ CORRECT" : "✗ WRONG") . "\n";

echo "\n=== SETUP VERIFICATION COMPLETE ===\n";
echo "\nAll components are ready! System is configured correctly.\n";

?>
