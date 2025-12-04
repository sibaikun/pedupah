<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->its_admin != 0) {
            abort(403, 'Akses khusus user');
        }

        return $next($request);
    }

}
