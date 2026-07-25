<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsEntreprise
{
    // "Entreprise" role — IdRole = 2 dans la table Roles
    private const ENTREPRISE_ROLE_ID = 2;

    public function handle(Request $request, Closure $next)
    {
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth('api');

        if (!$auth->check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        /** @var \App\Models\Users $user */
        $user = $auth->user();

        if ((int) $user->IdRole !== self::ENTREPRISE_ROLE_ID) {
            return response()->json([
                'message' => 'Cette action est reservee aux comptes entreprise.'
            ], 403);
        }

        return $next($request);
    }
}