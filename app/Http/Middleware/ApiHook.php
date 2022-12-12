<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiHook
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() !== config('app.api_hook_token')) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
