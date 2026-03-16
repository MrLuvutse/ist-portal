<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
   public function handle(Request $request, Closure $next)
{
    if (auth()->check() && auth()->user()->role === 'student') {
        return $next($request);
    }

    abort(403, 'Unauthorized');
}
}