<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Return a short-lived API token for JS that uses session auth (Sanctum)
     */
    public function token(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Create a token scoped to session use. Token name can be same for simplicity.
        $token = $user->createToken('session-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
