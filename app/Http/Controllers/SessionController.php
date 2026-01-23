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
        // Debugging: log cookies and session id to help diagnose 401 when called from JS
        \Log::debug('[session-token] request cookies', $request->cookies->all());
        \Log::debug('[session-token] session id', ['session_id' => $request->session()->getId()]);

        $user = $request->user();
        if (!$user) {
            \Log::warning('[session-token] unauthorized - no user', ['cookies' => $request->cookies->all()]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        \Log::debug('[session-token] user', ['id' => $user->id]);
        // Create a token scoped to session use. Token name can be same for simplicity.
        $token = $user->createToken('session-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
