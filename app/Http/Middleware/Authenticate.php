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
    protected $guards;


    public function handle($request, Closure $next, ... $guards)
    {
        $this->guards = $guards;
        $this->authenticate($request,$guards);

        return $next($request);
    }
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            foreach ($this->guards as $guard) {
                if (in_array($guard, ['admin', 'doctor', 'patient']) && auth()->guard($guard)->check()) {
                    return redirect()->route('dashboard');
                }
            }
            return redirect()->route('login');
        }

        return route('login'); // Rute login default
    }
}
