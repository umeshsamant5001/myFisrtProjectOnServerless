<?php

namespace App\Http\Controllers;

use App\mst_right;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMstRightRequest;
use DB;

class MstRightController extends Controller
{

    public function index()
    {

    $right_edit = DB::table('mst_rights')->get();

    return view('rights.right-index', ['right_edit'=>$right_edit]);

    }

    public function rightCreate()
    {
        return view('rights.right-create');
    }

    public function rightStore(Request $request)
    {
       $user = auth()->user();

       $request->validate([

           'doc_category_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights',
           'workflow_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights',
           'cabinet_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights',
           'folders_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights',
           'folder_structure_level' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights',

       ]);

          $right = new mst_right();
          $right->doc_category_limit = $request->input('doc_category_limit');
          $right->workflow_limit = $request->input('workflow_limit');
          $right->cabinet_limit = $request->input('cabinet_limit');
          $right->folders_limit = $request->input('folders_limit');
          $right->folder_structure_level = $request->input('folder_structure_level');
          $right->created_by = $user->user_id;
          $right->created_date = date("Y-m-d");
          $right->created_time = date("H:i:s");
          $right->updated_by = $user->user_id;
          $right->updated_date = date("Y-m-d");
          $right->updated_time = date("H:i:s");
          $right->save();

         //DB::table('mst_rights')->insert($right);

        return redirect('/right-index')->with('success', 'Rights Added Successfully!!');
    }

    public function rightShow($id)
    {
        $right_show = DB::table('mst_rights')->where('rights_id', $id)->get();

        return view('rights.right-show',['right_show'=>$right_show]);
    }


    public function rightEdit($id)
    {
        $right_edit = DB::table('mst_rights')->where('rights_id', $id)->get();

        return view('rights.right-edit', ['right_edit'=> $right_edit]);
    }

   
    public function rightUpdate(Request $request, $id)
    {
        $user = auth()->user();


        $request->validate([

            'doc_category_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights,doc_category_limit,'.$id.',rights_id',
            'workflow_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights,workflow_limit,'.$id.',rights_id',
            'cabinet_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights,cabinet_limit,'.$id.',rights_id',
            'folders_limit' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights,folders_limit,'.$id.',rights_id',
            'folder_structure_level' => 'required|regex:/^[0-9]+$/|not_in:0|digits_between:1,10|unique:mst_rights,folder_structure_level,'.$id.',rights_id',
 
        ]);
        
           $right_update = Mst_right::find($id);
           dd($right_update);
           $right_update->doc_category_limit = $request->input('doc_category_limit');
           $right_update->workflow_limit = $request->input('workflow_limit');
           $right_update->cabinet_limit = $request->input('cabinet_limit');
           $right_update->folders_limit = $request->input('folders_limit');
           $right_update->folder_structure_level = $request->input('folder_structure_level');
           $right_update->created_by = $user->user_id;
           $right_update->created_date = date("Y-m-d");
           $right_update->created_time = date("H:i:s");
           $right_update->updated_by = $user->user_id;
           $right_update->updated_date = date("Y-m-d");
           $right_update->updated_time = date("H:i:s");
           $right_update->save();
         //dd($folder_structure_level); 


        return redirect('/right-index')->with('success', 'Rights Updated Successfully!!');


    }

    public function rightDelete($id)
    {
        DB::table('mst_rights')->where('rights_id', $id)->delete();

        return redirect('/right-index')->with('danger', 'Rights Deleted Successfully!!');
    }
}
