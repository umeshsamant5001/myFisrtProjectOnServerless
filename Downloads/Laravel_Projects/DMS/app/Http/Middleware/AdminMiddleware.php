<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\Response;

class AdminMiddleware
{
  
    public function handle($request, Closure $next)
    {
        
        $user = auth()->user();

        
        if($user && $user->role_id == 2){
        
          return $next($request);
         
        }
       
        return redirect('/');
    }
}
