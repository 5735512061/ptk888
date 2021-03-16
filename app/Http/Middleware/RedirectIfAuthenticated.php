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
              return redirect()->route('admin.login');
            }
            break;
            
            case 'seller':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('seller.login');
              }
              break;
            
            case 'store':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('store.login');
              }
              break;

            case 'member':
                if (Auth::guard($guard)->check()) {
                  return redirect()->route('member.login');
                }
                break;
        }
        return $next($request);
    }
}
