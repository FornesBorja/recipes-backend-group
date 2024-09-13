<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class customAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization') ?? $request->input('token');

        if (!$token) {
            return response()->json(['error' => 'Token not found, please login'], 401);
        }

        return $next($request);
    }
}
