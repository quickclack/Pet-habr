<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Banned
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth('sanctum')->user();

        if (isset($user->banned->banned)) {
            return response()->json([
                'message' => 'Ваш аккаунт заблокирован'
            ]);
        }

        return $next($request);
    }
}
