<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
        public function handle($request, Closure $next)
    {
        if (auth()->user()->its_admin != 1) {
            abort(403, 'Akses khusus admin');
        }

        return $next($request);
    }
}
