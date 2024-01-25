<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperatorMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user() == null)
        {
            return redirect()->route('auth.staff.login.index');
        }
        if(auth()->user()->role == User::ROLE_OPERATOR)
        {
            return $next($request);
        }
        abort(403, 'permission denied');
    }
}
