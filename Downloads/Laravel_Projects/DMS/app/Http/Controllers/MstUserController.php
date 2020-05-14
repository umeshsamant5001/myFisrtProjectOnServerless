<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class MstUserController extends Controller
{
    public function index()
    {
        $us_admin = DB::table('mst_users')
        ->select('mst_users.user_id','mst_users.name', 'mst_users.username','mst_users.contact_no' ,'mst_users.email_id','mst_users.location','mst_designations.designation','mst_designations.designation_id' )
        ->join('mst_designations','mst_designations.designation','=','mst_users.designation')->where('role_id', 3)->orderBy("name")->get();
        $design = DB::table('mst_designations')->get();

       return view('users.user-index', ['us_admin'=> $us_admin],['design'=>$design]);
    }

    public function userCreate()
    {
        $designation = DB::table('mst_designations')->get();

        return view('users.user-create', ['designation' => $designation]);
    }

    public function userStore(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|regex:/^[0-9]+$/|size:10',
            'email_id' => 'required|string|email|max:150|unique:mst_users',
            'username' => 'required|string|max:150|unique:mst_users',
            'password' => 'required|string|min:8',
            'location' => 'string|max:100',
            'designation' => 'required',
        ]);

  
        $user = [
            'name' => $request->input('name'),
            'contact_no' =>$request->input('contact_no'),
            'email_id' => $request->input('email_id'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'location' => $request->input('location'),
            'designation' => $request->input('designation'),
            'role_id' => 3,
            'group_id' => 0,
            // 'created_by' => 0,
            // 'created_date' => date("Y-m-d"),
            // 'created_time' => date("H:i:s"),
            // 'updated_by' => 0,
            // 'updated_date' => date("Y-m-d"),
            // 'updated_time' => date("H:i:s"),
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time'=> date("H:i:s"),  
        ];

        DB::table('mst_users')->insert($user);

        return redirect('/user-index')->with('success', 'User Added Successfully!!');
    }

    public function userShow($id)
    {
        $user_show = DB::table('mst_users')->where('user_id', $id)->get();

        return view('users.user-show', ['user_show'=> $user_show]);
    }


    public function userEdit($id)
    {
        $user_edit = DB::table('mst_users')->where('user_id', $id)->get();

        return view('users.user-edit', ['user_edit'=>$user_edit]);
    }

    public function userUpdate(Request $request, $id)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|regex:/^[0-9]+$/|size:10',
            'email_id' => 'required|string|email|max:150|unique:mst_users,email_id,'.$id.',user_id',
            'username' => 'required|string|max:150|unique:mst_users,username,'.$id.',user_id',
            'location' => 'string|max:100',
            'designation' => 'required',
            
        ]);
            // dd($request);
        $user_update = [
            'name' => $request->input('name'),
            'contact_no' =>$request->input('contact_no'),
            'email_id' => $request->input('email_id'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'location' => $request->input('location'),
            'designation' => $request->input('designation'),
            'role_id' => 3,
            'group_id' => 0,
            // 'created_by' => 0,
            // 'created_date' => date("Y-m-d"),
            // 'created_time' => date("H:i:s"),
            // 'updated_by' => 0,
            // 'updated_date' => date("Y-m-d"),
            // 'updated_time' => date("H:i:s"),
            // 'created_by' => $user->user_id,
            // 'created_date' => date("Y-m-d"),
            // 'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time'=> date("H:i:s"),  
        ];
      
        DB::table('mst_users')->where('user_id', $id)->update($user_update);

        return redirect('/user-index')->with('success', 'User details Updated Successfully!!');
    }

    public function userDelete($id)
    {
        DB::table('mst_users')->where('user_id', $id)->delete();

        return redirect('/user-index')->with('danger', 'User Deleted Successfully!!');
    }

}
