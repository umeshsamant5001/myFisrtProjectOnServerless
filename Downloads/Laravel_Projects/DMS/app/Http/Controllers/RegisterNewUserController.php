<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use DB;
use Session;

class RegisterNewUserController extends Controller
{
    public function index(){

        return view('register-new-user.register-new-user');
    }

    public function mailsendNewUser(Request $request) {

    $to_name = "Sonali Patil";
       
    $to_email = $request->email_address;
  
    Session::put('EmailId', $to_email);

    $data = array("name"=> "Sonal patil", "body" => "Test Mail");
   
    Mail::send('register-new-user.send-mail', $data, function($message) use ($to_name, $to_email){
        $message->to($to_email)
        ->subject('Send Registration Link');
    });

    echo "You have send Mail Please Check Email.";

    return redirect('/registration-new-user')->with('success', 'Registration Link send Successfully!!');

    }

    public function userRegistrationFrom(){

        $email_user = Session::get('EmailId');

        return view('register-new-user.user-registrationform', ['email_user'=>$email_user]);
    }

    public function registerNewUserStore(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'size:10'],
            'email_id' => ['required', 'string', 'email', 'max:150', 'unique:mst_users'],
            'username' => ['required', 'string', 'max:150','unique:mst_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'location' => ['string', 'max:100'],
            'designation' => ['integer', 'max:11'],
        ]);

        $user = auth()->user();
   
        $registration = [

            'name' => $request->input('name'),
            'contact_no' => $request->input('contact_no'),
            'email_id' => $request->input('email_id'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'location' => $request->input('location'),
            'designation' => $request->input('designation'),
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time' => date("H:i:s"),
        ];

        DB::table('mst_users')->insert($registration);
       
       return redirect('/registration-new-user')->with('success', 'User Registration Successfully Done!');
    }
}
