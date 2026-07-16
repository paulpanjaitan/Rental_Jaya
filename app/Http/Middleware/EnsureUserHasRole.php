<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Memeriksa apakah user sudah login dan apakah role-nya sesuai (misal: 'admin')
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika user biasa mencoba masuk ke menu mobil admin, tolak dan alihkan ke form rental
        return redirect()->route('transaksi.create')->with('error', 'Akses ditolak! Halaman tersebut hanya untuk Admin.');
    }
}