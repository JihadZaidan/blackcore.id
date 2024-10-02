<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek apakah user yang mengakses memiliki role admin
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }
        if (Auth::user()->role == 'admin') {
            // jika iya, maka lanjutkan request
            return $next($request);
        }
        
        // jika tidak, maka redirect ke halaman lain atau tampilkan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
