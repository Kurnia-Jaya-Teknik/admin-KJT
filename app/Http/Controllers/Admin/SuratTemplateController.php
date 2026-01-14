<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTemplate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SuratTemplateController extends Controller
{
    protected function ensureAdminHRD()
    {
        if (Auth::user()->role !== 'admin_hrd') abort(403);
    }

    public function index()
    {
        $list = SuratTemplate::orderBy('created_at','desc')->get();
        return response()->json(['data' => $list]);
    }

    public function show($id)
    {
        $t = SuratTemplate::findOrFail($id);
        return response()->json(['data' => $t]);
    }

    public function store(Request $request)
    {
        $this->ensureAdminHRD();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'content' => 'nullable|string',
            'schema' => 'nullable|array',
            'schema.*.key' => 'required_with:schema|string|max:100',
            'schema.*.label' => 'required_with:schema|string|max:150',
            'schema.*.type' => 'required_with:schema|in:text,textarea,date,select',
            'schema.*.options' => 'nullable|array',
            'schema.*.required' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $content = $request->input('content','');
        $schema = $request->input('schema', []);

        // collect placeholders from content and schema field keys
        $placeholders = SuratTemplate::extractPlaceholdersFromContent($content);
        if (!empty($schema) && is_array($schema)) {
            foreach ($schema as $f) {
                if (!empty($f['key'])) $placeholders[] = strtoupper($f['key']);
            }
        }
        $placeholders = array_values(array_unique($placeholders));

        $tpl = SuratTemplate::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')).'-'.Str::random(4),
            'jenis' => $request->input('jenis'),
            'content' => $content,
            'schema' => $schema,
            'placeholders' => $placeholders,
            'is_active' => $request->input('is_active', true),
            'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'data' => $tpl], 201);
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdminHRD();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'content' => 'nullable|string',
            'schema' => 'nullable|array',
            'schema.*.key' => 'required_with:schema|string|max:100',
            'schema.*.label' => 'required_with:schema|string|max:150',
            'schema.*.type' => 'required_with:schema|in:text,textarea,date,select',
            'schema.*.options' => 'nullable|array',
            'schema.*.required' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $tpl = SuratTemplate::findOrFail($id);
        $tpl->name = $request->input('name');
        $tpl->jenis = $request->input('jenis');
        $tpl->content = $request->input('content','');
        $tpl->schema = $request->input('schema', []);
        $tpl->is_active = $request->input('is_active', true);
        // merge placeholders from content and schema
        $placeholders = SuratTemplate::extractPlaceholdersFromContent($tpl->content);
        if (!empty($tpl->schema) && is_array($tpl->schema)) {
            foreach ($tpl->schema as $f) {
                if (!empty($f['key'])) $placeholders[] = strtoupper($f['key']);
            }
        }
        $tpl->placeholders = array_values(array_unique($placeholders));
        $tpl->save();

        return response()->json(['success' => true, 'data' => $tpl]);
    }

    public function destroy($id)
    {
        $this->ensureAdminHRD();
        $tpl = SuratTemplate::findOrFail($id);
        $tpl->delete();
        return response()->json(['success' => true]);
    }
}