<?php

namespace App\Http\Controllers;

use App\MstDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validate;
use DB;

class MstDesignationController extends Controller
{
    public function index()
    {
       $designation = DB::table('mst_designations')->get();
             
       return view('designations.designation-index', ['designation'=>$designation]);
    }

    public function designationCreate()
    {
        return view('designations.designation-create');
    }

    public function designationstore(Request $request)
    {
      
        $user = auth()->user();

        $request->validate([
              'designation' => 'required|regex:/^[a-zA-Z]+$/u|unique:mst_designations|max:150',
        ]);
     
            $designation = new MstDesignation();
            $designation->designation = $request->input('designation');
            $designation->created_by = $user->user_id;
            $designation->created_date = date("Y-m-d");
            $designation->created_time = date("H:i:s");
            $designation->updated_by = $user->user_id;
            $designation->updated_date = date("Y-m-d");
            $designation->updated_time = date("H:i:s"); 
            $designation->save();
    
       // DB::table('mst_designations')->insert($designation);

        return redirect('/designation-index')->with('success', 'Designation Added Successfully!!');
    }

    public function designationshow($id)
    {
        $designation_show = DB::table('mst_designations')
        ->select('*')
        ->join('mst_users', 'mst_users.user_id', '=', 'mst_designations.created_by')
        ->where('designation_id', $id)->get();

        return view('designations.designation-show', ['designation_show'=> $designation_show]);
    }


    public function designationEdit($id)
    {
        $designation_edit = DB::table('mst_designations')->where('designation_id', $id)->get();

        return view('designations.designation-edit', ['designation_edit'=>$designation_edit]);
    }

    public function designationUpdate(Request $request, $id)
    {
        $user = auth()->user();

        $request->validate([
            
            'designation'=> 'required|regex:/^[a-zA-Z]+$/u|max:150|unique:mst_designations,designation,'.$id.',designation_id',
        ]);

        $designation_update = [

            'designation'=> $request->input('designation'),
            // 'created_by'=> $user->user_id,
            // 'created_date'=> date("Y-m-d"),
            // 'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date'=> date("Y-m-d"),
            'updated_time'=> date("H:i:s"),

        ];

        DB::table('mst_designations')->where('designation_id', $id)->update($designation_update);

        return redirect('/designation-index')->with('success', 'Designation Updated Successfully!!');
    }

    public function designationDelete($id)
    {
        
        DB::table('mst_designations')->where('designation_id', $id)->delete();
      
        return redirect('/designation-index')->with('danger', 'Designation Deleted Successfully!!');
    }

    public function desiData($id){
       
        $data =  DB::table('mst_designations')->where('designation_id', $id)->get();
     
       return $data;
     }
}
