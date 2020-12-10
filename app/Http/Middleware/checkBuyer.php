<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;


class checkBuyer
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
        if(auth::check()){
          if(isset(Auth::User()->alamat)){
            return $next($request);
          }else{
            return redirect(route('profile'))->with('message','anda harus melengkapi profile sebelum memulai transaksi');
          }
        }else{
          return $next($request);
        }
    }
}
