<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KopSurat;
use Illuminate\Support\Facades\Storage;

class KopSuratController extends Controller
{
    public function index()
    {
        $list = KopSurat::orderBy('created_at','desc')->get(['id','name','file_path','mime','is_template','placeholders','created_at']);
        // append url
        $list->transform(function($item){
            $item->url = $item->file_path ? asset('storage/'.$item->file_path) : null;
            return $item;
        });
        return response()->json($list);
    }

    public function placeholders($id)
    {
        $kop = KopSurat::findOrFail($id);
        if (!$kop->is_template) {
            return response()->json(['placeholders' => []]);
        }
        // try stored placeholders first
        if ($kop->placeholders) {
            return response()->json(['placeholders' => $kop->placeholders]);
        }
        // fallback: extract from docx
        try {
            $full = storage_path('app/public/'.$kop->file_path);
            $tp = new \PhpOffice\PhpWord\TemplateProcessor($full);
            $vars = $tp->getVariables();
            // cache
            $kop->placeholders = $vars;
            $kop->save();
            return response()->json(['placeholders' => $vars]);
        } catch (\Throwable $e) {
            return response()->json(['placeholders' => []]);
        }
    }

    public function fill(Request $request, $id)
    {
        $kop = KopSurat::findOrFail($id);
        if (!$kop->is_template) {
            return response()->json(['error' => 'Not a template'], 422);
        }

        $payload = $request->all(); // mapping of placeholders

        try {
            $full = storage_path('app/public/'.$kop->file_path);
            $tp = new \PhpOffice\PhpWord\TemplateProcessor($full);
            // replace placeholders if present
            foreach ($payload as $k => $v) {
                // Only replace scalar values
                if (is_scalar($v)) {
                    $tp->setValue($k, $v);
                }
            }

            // save new docx
            $outName = 'surat_filled_'.time().'.docx';
            $outPath = storage_path('app/public/generated/'.$outName);
            if (!file_exists(dirname($outPath))) mkdir(dirname($outPath), 0755, true);
            $tp->saveAs($outPath);

            $url = asset('storage/generated/'.$outName);
            return response()->json(['success' => true, 'url' => $url, 'path' => 'generated/'.$outName]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Failed to generate document', 'message' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        // Validasi: file required dan max 10MB
        // Relax MIME type restrictions - support semua format file yang umum
        $request->validate([
            'file' => 'required|file|max:10240',
            'name' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $name = $request->input('name') ?? $file->getClientOriginalName();
        $mime = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());

        // Store file with explicit public disk
        $path = $file->store('kop-surat', 'public');

        // Ensure storage link exists
        if (!file_exists(public_path('storage'))) {
            @symlink(storage_path('app/public'), public_path('storage'));
        }

        // Detect if it's a template based on extension
        // Support template processing untuk: docx, xlsx, pptx
        $templateExtensions = ['docx', 'xlsx', 'pptx'];
        $isTemplate = in_array($extension, $templateExtensions);

        $kop = KopSurat::create([
            'name' => $name,
            'file_path' => $path,
            'mime' => $mime,
            'is_template' => $isTemplate,
            'uploaded_by' => $request->user() ? $request->user()->id : null,
        ]);

        // If docx/xlsx/pptx template, try to extract placeholders and save to placeholders column
        if ($isTemplate) {
            try {
                $full = storage_path('app/public/' . $path);
                if ($extension === 'docx') {
                    $tp = new \PhpOffice\PhpWord\TemplateProcessor($full);
                    $vars = $tp->getVariables();
                    $kop->placeholders = $vars;
                    $kop->save();
                }
                // Untuk xlsx/pptx bisa ditambahkan processing di masa depan
            } catch (\Throwable $e) {
                // ignore extraction failure - file tetap tersimpan
            }
        }

        $kop->url = asset('storage/' . $kop->file_path);
        
        // Ensure placeholders is an array
        $kop->placeholders = $kop->placeholders ? (is_array($kop->placeholders) ? $kop->placeholders : json_decode($kop->placeholders, true)) : [];

        return response()->json(['success' => true, 'data' => $kop], 201);
    }
}
