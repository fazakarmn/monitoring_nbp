<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDireksi
{
    /**
     * Handle an incoming request.
     * Hanya user dengan peran 'Direksi' yang diizinkan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'Direksi') {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Akses ditolak. Hanya Direksi yang dapat mengubah peran pengguna.');
    }
}
