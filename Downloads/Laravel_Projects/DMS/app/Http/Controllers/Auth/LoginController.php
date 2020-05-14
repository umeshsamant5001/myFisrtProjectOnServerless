<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
  
    public function login(request $request){

    $email    = $request->input('email_id');
    $password = $request->input('password');
   
  
    if (Auth::attempt(['email_id'=>$email, 'password' =>$password])) 
    {
        $user = auth()->user();
   
        $path = storage_path().'/app/cabinet_management/Session_file/'.$user->name.'_'.$user->user_id;
    
        File::makeDirectory($path, $mode = 0777, true, true);
        
        return redirect()->intended('home');
    }
    else
    {
      return redirect()->back()->with('danger', 'Invalid Login Credentials !');
    }
  }
       public function logout(Request $request) {
           
       $user = auth()->user();
       
       $path = storage_path().'/app/cabinet_management/Session_file/'.$user->name.'_'.$user->user_id;
    
       $dd = File::deleteDirectory($path);
       
       Auth::logout();
       return redirect('/');
      }

}
