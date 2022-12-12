<?php

namespace App\Http\Middleware;

use Closure;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::query()
            ->findOrFail(auth()->id());

        foreach ($user->roles as $role) {
            if (auth()->check() && $role->name == 'Administrator' || $role->name == 'Moderator') {
                return $next($request);
            }
        }

        abort(404);
    }
}
