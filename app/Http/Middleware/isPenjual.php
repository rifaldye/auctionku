<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class isPenjual
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
      if(Auth::User() == True){
      if (Auth::User()->role->role_name == 'penjual') {
        return $next($request);
      }else{
        abort(403);
      }
    }else{
      return redirect(route('login'));
    }
    }
}
