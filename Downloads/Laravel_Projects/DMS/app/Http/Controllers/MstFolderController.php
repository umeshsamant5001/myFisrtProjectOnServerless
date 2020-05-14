<?php

namespace App\Http\Controllers;

use App\mst_folder;
use Illuminate\Http\Request;
use DB;

class MstFolderController extends Controller
{
    public function index()
    {
       $folder = DB::table('mst_folders')->get();
             
       return view('folders.folder-index', ['folder'=>$folder]);
    }

    public function folderCreate()
    {
        return view('folders.folder-create');
    }

    public function folderStore(Request $request)
    {
        $user = auth()->user();

        $request->validate([

            'folder_name' => 'required|unique:mst_folders|max:150',
            'folder_size' => 'required|max:11',

        ]);

        $folder = [

            'folder_name'=>$request->input('folder_name'),
            'folder_size'=>$request->input('folder_size'),
            'folder_description'=>$request->input('folder_description'),
            'created_by' => $user->user_id,
            'created_date' => date("Y-m-d"),
            'created_time' => date("H:i:s"),
            'updated_by' => $user->user_id,
            'updated_date' => date("Y-m-d"),
            'updated_time'=> date("H:i:s"),  

        ];

        DB::table('mst_folders')->insert($folder);

        return redirect('/folder-index')->with('success', 'folder Added Successfully!!');
    }

    public function folderShow($id)
    {
        $folder_show = DB::table('mst_folders')->where('folder_id', $id)->get();

        return view('folders.folder-show', ['folder_show'=> $folder_show]);
    }


    public function folderEdit($id)
    {
        $folder_edit = DB::table('mst_folders')->where('folder_id', $id)->get();

        return view('folders.folder-edit', ['folder_edit'=>$folder_edit]);
    }

    public function folderUpdate(Request $request, $id)
    {
        $user = auth()->user();

        $request->validate([
            'folder_name'=> 'required|max:150|unique:mst_folders,folder_name,'.$id.',folder_id',
            'folder_size' => 'required|max:11',
        ]);

        $folder_update = [

            'folder_name'=> $request->input('folder_name'),
            'folder_size'=>$request->input('folder_size'),
            'folder_description'=>$request->input('folder_description'),
            'updated_by' => $user->user_id,
            'updated_date'=> date("Y-m-d"),
            'updated_time'=> date("H:i:s"),

        ];

        DB::table('mst_folders')->where('folder_id', $id)->update($folder_update);

        return redirect('/folder-index')->with('success', 'folder Updated Successfully!!');
    }

    public function folderDelete($id)
    {
        DB::table('mst_folders')->where('folder_id', $id)->delete();

        return redirect('/folder-index')->with('danger', 'folder Deleted Successfully!!');
    }
}
