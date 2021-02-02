<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.home');
              }
              break;
            
            case 'seller':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('seller.home');
              }
              break;
            
            case 'store':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('store.home');
              }
              break;

            case 'member':
                if (Auth::guard($guard)->check()) {
                  return redirect()->route('member.home');
                }
                break;
        }

        return $next($request);
    }
}
