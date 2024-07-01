<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if (!Auth::Check())
      {
        return redirect('/login');
      }
      $user = Auth::user();
      if ($user->role=='admin')
      {
        return $next($request);
      }

      if ($user->role=='student')
      {
        return redirect('/student');
      }
      if ($user->role=='teacher')
      {
        return redirect('/teacher');
      }
    }
}
