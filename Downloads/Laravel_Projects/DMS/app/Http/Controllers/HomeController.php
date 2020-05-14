<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $company = DB::table('mst_comp_setup')->get()->count();
        $right = DB::table('mst_rights')->get()->count();
        $user_total = DB::table('mst_users')->where('role_id', 2)->get()->count();
        $designation = DB::table('mst_designations')->get()->count();
        // Query modified to get Usercount equal to number of rows getting displayed on user-index page.
        // BT Issue - 0000029: To check Dashboard count of Users.  Umeshs
        //$usercount = DB::table('mst_users')->where('role_id', 3)->get()->count(); 
        $usercount = DB::table('mst_users')
        ->select('mst_users.user_id','mst_users.name', 'mst_users.username','mst_users.contact_no' ,'mst_users.email_id','mst_users.location','mst_designations.designation','mst_designations.designation_id' )
        ->join('mst_designations','mst_designations.designation','=','mst_users.designation')->where('role_id', 3)->orderBy("name")->get()->count();
        $groups = DB::table('mst_groups')->get()->count();
        $doc_cat = DB::table('mst_doc_category')->get()->count();
        $user = auth()->user();

        return view('home', ['company'=>$company, 'right'=>$right, 'user_total'=>$user_total, 'designation'=>$designation, 'usercount'=>$usercount, 'groups'=> $groups, 'doc_cat'=>$doc_cat, '$user'=>$user]);
    }

    public function changePassword(Request $request, $id){

        $company = DB::table('mst_comp_setup')->get()->count();
        $right = DB::table('mst_rights')->get()->count();
        $user_total = DB::table('mst_users')->where('role_id', 2)->get()->count();

       $data = ['password' => Hash::make($request->new_password) ];
      
       DB::table('mst_users')->where('user_id', $id)->update($data);

       return redirect('/login')->with('success', 'admin Updated Successfully!!');

    }

    public function admin(Request $req){
        return view('middleware')->withMessage("Admin");
    }
    public function super_admin(Request $req){
        return view('middleware')->withMessage("Super Admin");
    }
    public function user(Request $req){
        return view('middleware')->withMessage("User");
    }
}
