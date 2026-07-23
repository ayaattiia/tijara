<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    // "Admin" role — single canonical row after Roles table cleanup
    private const ADMIN_ROLE_ID = 3;

    public function handle(Request $request, Closure $next)
    {
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();

        if (!$auth->check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = $auth->user();

        if ((int) $user->IdRole !== self::ADMIN_ROLE_ID) {
            return response()->json([
                'message' => 'This action is unauthorized.'
            ], 403);
        }

        return $next($request);
    }
}
