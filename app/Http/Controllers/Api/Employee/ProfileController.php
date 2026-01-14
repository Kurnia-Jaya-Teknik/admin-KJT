<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'departemen_id' => 'nullable|integer',
            'jabatan' => 'nullable|string|max:255',
        ]);

        $user->fill($data);
        $user->save();

        return response()->json($user);
    }
}
