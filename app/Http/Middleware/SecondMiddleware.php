<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecondMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Tanda middleware kedua jalan
        \Log::info("SecondMiddleware jalan");

        return $next($request);
    }
}
