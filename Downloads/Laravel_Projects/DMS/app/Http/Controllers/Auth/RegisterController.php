<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'size:10'],
            'email_id' => ['required', 'string', 'email', 'max:150', 'unique:mst_users'],
            'username' => ['required', 'string', 'max:150','unique:mst_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'location' => ['string', 'max:100'],
            //'designation' => ['integer', 'max:11'],
            'role_id' => ['integer', 'max:11'],
        ]);
    }

    
    protected function create(array $data)
    {
        //dd($data);
        return User::create([
            'name' => $data['name'],
            'contact_no' => $data['contact_no'],
            'email_id' => $data['email_id'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'location' => $data['location'],
            'designation' => $data['designation'],
            'role_id' => $data['role_id'],
            'group_id' => 0,
            'created_by' => 0,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => 0,
            'updated_date' => date("Y-m-d"),
            'updated_time' => date("H:i:s"),
        ]);
    }
}
