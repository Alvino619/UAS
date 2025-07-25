<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403, 'Not authenticated');
        }

        if (auth()->user()->role !== $role) {
            abort(403, 'Insufficient permissions');
        }

        return $next($request);
    }
}