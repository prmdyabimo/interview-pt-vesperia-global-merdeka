<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $clientKey = $request->header('X-API-KEY');

        if ($clientKey !== config('app.api_key')) {
            return response()->json([
                'meta' => [
                    'code' => 401,
                    'status' => 'unauthorized',
                    'message' => 'Invalid API key',
                ],
                'data' => null,
            ], 401);
        }

        return $next($request);
    }
}