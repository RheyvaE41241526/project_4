<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekRouteProfile
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->named('profile')) {
            return response("Kamu sedang mengakses route bernama: profile");
        }

        return $next($request);
    }
}
