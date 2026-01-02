<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  array<int|string>  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // If there is no authenticated user or the role is not in the allowed list, block access.
        if (! $user || ! in_array((string) $user->role, array_map('strval', $roles), true)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
