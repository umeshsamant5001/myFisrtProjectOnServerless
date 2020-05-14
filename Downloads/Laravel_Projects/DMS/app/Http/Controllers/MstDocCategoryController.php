<?php

namespace App\Http\Controllers;

use App\mst_doc_category;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class MstDocCategoryController extends Controller
{
   
    public function index()
    {
       $doccat_edit = DB::table("mst_doc_category")->orderBy("doc_category_caption")->get();
       
       return view('doc-category.doc-category-index', ['doccat_edit'=>$doccat_edit]);

    }

    public function doccategoryCreate()
    {
      return view('doc-category.doc-category-create');
    }

    public function doccategoryStore(Request $request)
    {
        $user = auth()->user();

        $request->validate([

            'doc_category_caption' => 'required|max:250|unique:mst_doc_category',
            'doc_category_name' => 'required|max:250|unique:mst_doc_category',
            'doc_category_desc' => 'max:500',
            'doc_category_type' => 'required|max:45',

        ]);

                // $string = strtolower(cc);
                // $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
                // $string = preg_replace("/[\s-]+/", " ", $string);
                // $string = preg_replace("/[\s_]/", "_", $string);

        
        $category = new mst_doc_category();

            $category->doc_category_caption = $request->input('doc_category_caption');
            $category->doc_category_name = $request->input('doc_category_name');
            $category->doc_category_desc = $request->input('doc_category_desc');
            $category->doc_category_type = $request->input('doc_category_type');
            $category->created_by = $user->user_id;
            $category->created_date = date("Y-m-d");
            $category->created_time = date("H:m:s");
            $category->updated_by = $user->user_id;
            $category->updated_date = date("Y-m-d");
            $category->updated_time = date("H:i:s");
            $category->save();
            
        $table_name = $category['doc_category_name'];
    
        $string = strtolower($table_name);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $table_name = preg_replace("/[\s_]/", "_", $string);
        
        
        //DB::table('mst_doc_category')->insert($category);

        return $this->createTable($table_name);
     
    }

    public function doccategoryShow($id)
    {
        $doc_show = DB::table('mst_doc_category')->where('doc_category_id', $id)->get();

        return view('doc-category.doc-category-show', ['doc_show'=>$doc_show]);
    }
   
    public function doccategoryEdit($id)
    {
        $doc_edit = DB::table('mst_doc_category')->where('doc_category_id', $id)->get();

        return view('doc-category.doc-category-edit', ['doc_edit'=>$doc_edit]);

    }
   
    public function doccategoryUpdate(Request $request, $id)
    {
        $user = auth()->user();

        $request->validate([

            'doc_category_caption' => 'required|max:250|unique:mst_doc_category,doc_category_caption,'.$id.',doc_category_id',
            //'doc_category_name' => 'required|max:250|regex:/^[a-zA-Z]+$/u|unique:mst_doc_category,doc_category_name,'.$id.',doc_category_id',
            'doc_category_desc' => 'max:500',
            'doc_category_type' => 'max:45',

        ]);
     
        $cat_update = [

            'doc_category_caption' => $request->input('doc_category_caption'),
            'doc_category_name' => $request->input('doc_category_name'),
            'doc_category_desc' => $request->input('doc_category_desc'),
            'doc_category_type' => $request->input('doc_category_type'),
            'created_by' => $user->user_id,
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time' => date("H:i:s"),

        ];
        
        DB::table('mst_doc_category')->where('doc_category_id', $id)->update($cat_update);

        return redirect('/doc-category-index')->with('success', 'Doc Category Updated Successfully!!');
    }

    
    public function doccategoryDelete($id)
    {
        DB::table('mst_doc_category')->where('doc_category_id', $id)->delete();

        return redirect('/doc-category-index')->with('danger', 'Doc Category Deleted Successfully!!');
    }

    public function createTable($table_name, $fields = [])
    {
        // check if table is not already exists
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($fields, $table_name) {
                $table->increments('id');
                // if (count($fields) > 0) {
                //     foreach ($fields as $field) {   
                //         $table->{$field['type']}($field['name'])->length($field['size']);
                //     }
                // }
                $table->timestamps();
            });

            return redirect('/doc-category-index')->with('success', 'Given table has been successfully created!');   
        }

        return redirect('/doc-category-index')->with('success', 'Given table is already exist.');
    }

    public function doccatData($id){

        $data = DB::table('mst_doc_category')->where('doc_category_id',$id)->get();

        return $data;
    }

    public function assignGroup(Request $request, $id)
    {   
        
       $group = DB::table('mst_groups')->get();
       
       $docs = DB::table('mst_doc_category')->where('doc_category_id', $id)->get();
      
       $users = DB::table('mst_users')->where('role_id', 3)->get();
       
       $assign_group = DB::table('mst_category_group')
       ->join('mst_groups', 'mst_groups.group_id', '=', 'mst_category_group.group_id')
       ->join('mst_doc_category', 'mst_doc_category.doc_category_id', '=', 'mst_category_group.doc_category_id')
       ->where('mst_doc_category.doc_category_id', $id)
       ->get();
      
      $assign_member =  DB::table('mst_group_member') 
        ->select('*')
        ->join('mst_users','mst_users.user_id', '=', 'mst_group_member.user_id')
        ->where('mst_group_member.flag', 'Show')
        ->get();
   
       return view('doc-category.assign-group', ['id'=>$id,'group'=>$group, 'users'=> $users, 'docs'=>$docs, 'assign_group'=>$assign_group, 'assign_member'=>$assign_member]);
    }

    public function storeGroupdDoc(Request $request, $id){
      
        $user = auth()->user();
        
          $request->validate([

            'doc_category_id'  => 'unique:mst_category_group, doc_category_id, group_id',
    

        ]);
        
        if($request->addgroup !== null) {
            

        for($i = 0; $i < count($request->addgroup); $i++){
    

        $data = [
            'doc_category_id' => $id,
            'group_id' => $request->addgroup[$i],
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:m:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time' => date("H:i:s"),
        ];
        
           DB::table('mst_category_group')->insert($data);
        
      }

    } else {
           return redirect()->back()->with('danger', 'Select Group!!');
          
      }
      return redirect('doc-category-index')->with('Success', 'Assign Group category Successfully!!');
    }

    public function assignFolder($id){
        
        $group = DB::table('mst_groups')->get();
        
        $docs = $docs = DB::table('mst_doc_category')->where('doc_category_id', $id)->get();

        $folder = DB::table('mst_cabinets')->where('Parent_cabinet_id','!=', 0)->get();

        $users = DB::table('mst_users')->where('role_id', 3)->get();
              
        return view('doc-category.assign-folder', ['id'=>$id,'group'=>$group, 'users'=> $users, 'docs'=>$docs, 'folder'=>$folder]);
        
    }

    public function storeFolderDoc(Request $request){
     
     $user = auth()->user();
    
      
        $data = [
            'doc_category_id'=>$request->doc_category_id,
            'folder_id' => $request->folder_id,
            'folder_path' => $request->folder_path,
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time' => date("H:i:s"),
        ];
           //dd($data);
        
        DB::table('mst_doc_category')->where('doc_category_id', $data['doc_category_id'])->update($data);
        
        return redirect()->back()->with('success', 'Assign Folder category Successfully!!');
        
    }
}
