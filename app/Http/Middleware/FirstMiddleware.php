<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirstMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Tanda middleware pertama jalan
        \Log::info("FirstMiddleware jalan");

        return $next($request);
    }
}
