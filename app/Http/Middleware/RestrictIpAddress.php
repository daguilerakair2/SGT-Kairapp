<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $allowedIp = '123.456.789.000';

        if ($request->ip() != $allowedIp) {
            // If the IP doesn't match, you can return an error
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
