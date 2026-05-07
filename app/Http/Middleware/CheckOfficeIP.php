<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckOfficeIP
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // =========================
        // AMBIL IP USER ASLI DARI RAILWAY
        // =========================

        $ipUser = trim(
            explode(',', $request->header('X-Forwarded-For'))[0]
        );

        // =========================
        // IZINKAN LOCALHOST
        // =========================

        if (
            $ipUser === '127.0.0.1' ||
            $ipUser === '::1'
        ) {
            return $next($request);
        }

        // =========================
        // AMBIL IP KANTOR DARI SETTINGS
        // =========================

        $ipKantor = Setting::where('key', 'ip_kantor')
            ->value('value');

        // jika setting belum ada
        if (!$ipKantor) {

            return back()->with(
                'error',
                'IP kantor belum diatur admin'
            );
        }

        // =========================
        // VALIDASI IP
        // =========================

        if (
            substr($ipUser, 0, strlen($ipKantor))
            !==
            $ipKantor
        ) {

            return back()->with(
                'error',
                'Harus menggunakan WiFi kantor'
            );
        }

        return $next($request);
    }
}