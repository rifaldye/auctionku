<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class checkSeller
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
      if(isset(Auth::User()->alamat)){
        if (isset(Auth::User()->toko)) {
          if (Auth::User()->toko->verif == 1) {
            return $next($request);
          }else{
            return redirect(route('penjualVerifKTP'));
          }
        }else{
          return redirect(route('penjualVerifToko'));
        }
      }else{
        return redirect(route('penjualVerifAlamat'));
      }
    }
}
