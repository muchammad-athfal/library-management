<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json([
                'statusCode' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        if ($apiKey !== config('services.api_key')) {
            return response()->json([
                'statusCode' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
