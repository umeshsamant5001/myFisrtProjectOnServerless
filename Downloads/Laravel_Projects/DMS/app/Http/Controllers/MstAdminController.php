<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class MstAdminController extends Controller
{
    public function index()
    {
       $admin = DB::table('mst_users')->where('role_id', 2)->get();

       $designation = DB::table('mst_designations')->get();

       return view('admin.admin-index', ['admin'=>$admin, 'designation'=>$designation]);
    }

    public function adminCreate()
    {
        $designation = DB::table('mst_designations')->get();

        return view('admin.admin-create', ['designation'=>$designation]);
    }

    public function adminStore(Request $request)
    {
      
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            'contact_no' => 'required|regex:/^[0-9]+$/|size:10',
            'email_id' => 'required|string|email|max:150|unique:mst_users',
            'username' => 'required|string|regex:/^[a-zA-Z]+$/u|max:150|unique:mst_users',
            'password' => 'required',
            'location' =>'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:100',
        ]);
        
        $admin = [
            'name' => $request->input('name'),
            'contact_no' =>$request->input('contact_no'),
            'email_id' => $request->input('email_id'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'location' => $request->input('location'),
            'role_id' => 2,
            'designation'=> 0,
            'group_id' => 0,
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time'=> date("H:i:s"),  
        ];


        DB::table('mst_users')->insert($admin);
       
        return redirect('/admin-index')->with('success', 'Admin Added Successfully!!');
    }

    public function adminShow($id)
    {
        $admin_show = DB::table('mst_users')->where('user_id', $id)->get();

        return view('admin.admin-show', ['admin_show'=> $admin_show]);
    }


    public function adminEdit($id)
    {   
       
        $admin = DB::table('mst_users')->where('user_id', $id)->get();

        $designation = DB::table('mst_designations')->get();

        return view('admin.admin-index', ['admin'=>$admin , 'designation'=>$designation]);
    }

    public function adminUpdate(Request $request, $id)
    {
      
        $user = auth()->user();
      
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            'contact_no' => 'required|regex:/^[0-9]+$/|size:10',
            'email_id' => 'required|string|email|max:150|unique:mst_users,email_id,'.$id.',user_id',
            'username' => 'required|string|regex:/^[a-zA-Z]+$/u|max:150|unique:mst_users,username,'.$id.',user_id',
            // 'password' => 'required',
            'location' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:100',
    
        ]);
       
        $admin_update = [
            'name' => $request->input('name'),
            'contact_no' =>$request->input('contact_no'),
            'email_id' => $request->input('email_id'),
            'username' => $request->input('username'),
            // 'password' => Hash::make($request->input('password')),
            'location' => $request->input('location'),
            'role_id' => 2,
            'group_id' => 0,
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time'=> date("H:i:s"),  
        ];

        DB::table('mst_users')->where('user_id', $id)->update($admin_update);

        return redirect('/admin-index')->with('success', 'admin Updated Successfully!!');
    }

    public function adminDelete($id)
    {
        DB::table('mst_users')->where('user_id', $id)->delete();

        return redirect('/admin-index')->with('danger', 'Admin Deleted Successfully!!');
    }

    public function userData($user_id){
       
        $data =  DB::table('mst_users')
        ->select('mst_users.user_id','mst_users.name', 'mst_users.username','mst_users.contact_no' ,'mst_users.email_id','mst_users.location','mst_designations.designation' )
        ->join('mst_designations','mst_designations.designation','=','mst_users.designation')
        ->where('user_id', $user_id)->get();
 
        return $data;
     }

     public function adminData($id) {

        $data = DB::table('mst_users')->where('user_id',$id)->get();

        return $data;
     }

}
