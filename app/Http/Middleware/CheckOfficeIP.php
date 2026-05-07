<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOfficeIP
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
{
    $ip = $request->ip();

    // IZINKAN LOCALHOST
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return $next($request);
    }

    if (!str_starts_with($ip, '103.56.80.')) {
        return back()->with('error', 'Harus pakai WiFi kantor');
    }

    return $next($request);
}
}
