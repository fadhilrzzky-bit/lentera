<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }
        return $next($request);
    }
}
