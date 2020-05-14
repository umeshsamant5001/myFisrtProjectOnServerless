<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use DB;
use Illuminate\Contracts\Auth\Guard;

class SuperAdminMiddleware
{
    
    protected $auth;

  
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
       
        if($user && $user->role_id == 1){
            
      return $next($request);
           
        }
      
        return redirect('/');
    }
}
