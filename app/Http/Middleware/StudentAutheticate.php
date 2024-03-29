<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAutheticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $guard = "student"): Response
    {
        if (!auth()->guard($guard)->check()) {
            return redirect(url('admin/dashboard'));
        }
        return $next($request);
    }
}
