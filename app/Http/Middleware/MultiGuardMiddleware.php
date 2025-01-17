<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MultiGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $guards = ['admin', 'doctor', 'patient']; // Daftar guard yang valid
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::setDefaultDriver($guard);

                Log::info('Guard Detected', [
                    'user_id' => Auth::guard($guard)->id(),
                    'role' => Auth::guard($guard)->user()->role ?? 'N/A',
                    'guard' => $guard,
                    'ip_address' => $request->ip(),
                    'url' => $request->fullUrl(),
                ]);

                return $next($request);
            }
        }

        // Log akses gagal
        Log::warning('Unauthorized access attempt', [
            'ip_address' => $request->ip(),
            'time' => now(),
            'url' => $request->fullUrl(),
        ]);

        return redirect()->route('login'); // Redirect ke login jika tidak terautentikasi
    }
}
