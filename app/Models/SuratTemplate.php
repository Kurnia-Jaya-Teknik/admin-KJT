<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTemplate extends Model
{
    use HasFactory;

    protected $table = 'surat_templates';

    protected $fillable = [
        'name', 'slug', 'jenis', 'content', 'schema', 'placeholders', 'is_active', 'created_by'
    ];

    protected $casts = [
        'schema' => 'array',
        'placeholders' => 'array',
        'is_active' => 'boolean',
    ];

    public static function extractPlaceholdersFromContent($content)
    {
        // Find placeholders in form [NAME] or {{NAME}} or %NAME% - common patterns
        preg_match_all('/\[([A-Z0-9_\-]+)\]/i', $content, $m);
        $found = $m[1] ?? [];
        // normalize to unique uppercase
        $found = array_values(array_unique(array_map(function($s){ return strtoupper($s); }, $found)));
        return $found;
    }
}