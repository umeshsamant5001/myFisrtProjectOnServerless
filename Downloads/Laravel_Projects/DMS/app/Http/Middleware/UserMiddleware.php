<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if($user && $user->role_id == 3){
        
          return $next($request);
      
        }
      
         return redirect('/');
    }
}
