<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageObat
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user adalah admin atau dokter
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'dokter'])) {
            return $next($request);
        }

        // Jika bukan admin atau dokter, kembalikan halaman error atau redirect
        abort(403, 'Unauthorized access');
    }
}
