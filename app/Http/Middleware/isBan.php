<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class isBan
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
      if(Auth::User()  == True){
      if(Auth::User()->ban == 0){
        return $next($request);
      }else{
        return redirect(route('ban'));
      }
    }else{
      return $next($request);
    }
    }
}
