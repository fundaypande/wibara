<?php

namespace App\Http\Middleware;

use Closure;

class AdminStafMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = $request -> user();

      if($user){
        if($user->isAdmin() || $user->isStaf()){
          return $next($request);
        }
      } else{
        return redirect('/login')->with('warning', 'Silahkan login untuk menakses halaman ini');
      }


      return redirect('/home');
    }
}
