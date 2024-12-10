<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

       // Tambahkan logika untuk role tertentu
        if (Auth::check() && Auth::user()->role === 'admin') {
            return route('admin.dashboard');
        }

        return route('login'); // Rute login default
    }
}