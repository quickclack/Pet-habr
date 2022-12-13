<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->getRole();

            if ($role == 'Administrator' || $role == 'Moderator') {
                return $next($request);
            }
        }

        abort(404);
    }
}
