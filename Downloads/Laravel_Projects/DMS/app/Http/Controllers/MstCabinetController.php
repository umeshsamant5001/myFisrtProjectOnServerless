<?php

namespace App\Http\Controllers;

use App\mst_cabinet;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
class MstCabinetController extends Controller
{
    public function index()
    {
       $cabinet = DB::table('mst_cabinets')->where('Parent_cabinet_id', 0)->get();

       $fileList = glob('cabinet_management/*');

       return view('cabinets.cabinet-index', ['cabinet'=>$cabinet]);
    }

    public function cabinetCreate()
    {
        return view('cabinets.cabinet-create');
    }

    public function cabinetStore(Request $request)
    {
        $user = auth()->user();

        $request->validate([

              'cabinet_name' => 'required|max:150',
              'cabinet_size' => 'regex:/(^[A-Za-z0-9 ]+$)+/|max:11',
             

        ]);
        if($request->input('Parent_cabinet_id')=="" || $request->input('Parent_cabinet_id')==" ")
        {
            $pid=0;
        }
        else
        {
            $pid=$request->input('Parent_cabinet_id');
        }
        if($request->input('cabinet_size')=="")
        {
            $cs=0;
        }
        else
        {
            $cs=$request->input('cabinet_size');
        }
        $currentcabinets=DB::table('mst_cabinets')
        ->where([
            ['cabinet_name', '=', $request->input('cabinet_name')],
            ['Parent_cabinet_id', '=', $pid],
        ])
        ->first();
        //return json_encode($currentcabinets);
        if(!($currentcabinets))    
        {
            
            $cabinet = [
                
                
                'cabinet_name'=>$request->input('cabinet_name'),
                'cabinet_size'=>$cs,
                'cabinet_description'=>$request->input('cabinet_description'),
                'Parent_cabinet_id'=>$pid,
                'created_by' => $user->user_id,
                'created_date' => date("Y-m-d"),
                'created_time' => date("H:i:s"),
                'updated_by' => $user->user_id,
                'updated_date' => date("Y-m-d"),
                'updated_time'=> date("H:i:s"),

            ];
            $reqPath=$request->input('currentPath1');
            if($reqPath=="")
               {
                   $folderName=$cabinet['cabinet_name'];
               } 
            else
            {   
             $folderName =str_replace('-', '/', $reqPath) ."/".$cabinet['cabinet_name'];
            }
           // return $folderName;

            // folder create by cabinet name

            $path = storage_path().'/app/cabinet_management/'.$folderName;

            File::makeDirectory($path, 0777, true, true);

            $inserted=DB::table('mst_cabinets')->insert($cabinet);
            if($inserted)
              {$data=0;}
              else{ $data=2;}
           
        }
        else
        { //return "error";
            $data=1;
           
        }  
        return $data ;  
    }


    public function cabinetId($id)
    {

        $data = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        return $data;

    }
    public function createSubfolder(Request $request, $id)
    {

        $user = auth()->user();


        $request->validate([

              'cabinet_name' => 'required|max:150',
              'cabinet_size' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|not_in:0|max:11',

        ]);

        $root_folder = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        $path = $root_folder[0]->cabinet_name;

            $cabinet = new mst_cabinet();
            $cabinet->cabinet_name = $request->input('cabinet_name');
            $cabinet->cabinet_size = $request->input('cabinet_size');
            $cabinet->cabinet_description = $request->input('cabinet_description');
            $cabinet->subfolder_id = $id;
            $cabinet->created_by = $user->user_id;
            $cabinet->created_date = date("Y-m-d");
            $cabinet->created_time = date("H:i:s");
            $cabinet->updated_by = $user->user_id;
            $cabinet->updated_date = date("Y-m-d");
            $cabinet->updated_time = date("H:i:s");
            $cabinet->save();

         $folderName = $path.'/'.$cabinet['cabinet_name'];

         $path = $folderName;

         $path = storage_path().'/app/cabinet_management/'.$path;

         File::makeDirectory($path, $mode = 0777, true, true);

        //DB::table('mst_cabinets')->insert($cabinet);

        return redirect('/cabinet-index')->with('success', 'Cabinet Added Successfully!!');
    }

    public function cabinetShow($id)
    {
        $cabinet_show = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        return view('cabinets.cabinet-show', ['cabinet_show'=> $cabinet_show]);
    }

    public function cabinetEdit($id)
    {
        $cabinet_edit = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        return view('cabinets.cabinet-edit', ['cabinet_edit'=>$cabinet_edit]);
    }

    public function cabinetUpdate(Request $request, $id)
    {
        $user = auth()->user();

        $request->validate([
            'cabinet_name'=> 'required|max:150|unique:mst_cabinets,cabinet_name,'.$id.',cabinet_id',
            'cabinet_size' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|not_in:0|max:11',
        ]);

        $cabinet_update = [

            'cabinet_name'=> $request->input('cabinet_name'),
            'cabinet_size'=>$request->input('cabinet_size'),
            'cabinet_description'=>$request->input('cabinet_description'),
            'updated_by' => $user->user_id,
            'updated_date'=> date("Y-m-d"),
            'updated_time'=> date("H:i:s"),

        ];

        DB::table('mst_cabinets')->where('cabinet_id', $id)->update($cabinet_update);

        return redirect('/cabinet-index')->with('success', 'Cabinet Updated Successfully!!');
    }

    public function cabinetDelete($id)
    {
        $folder = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        $folder = $folder[0]->cabinet_name;

        DB::table('mst_cabinets')->where('cabinet_id', $id)->delete();

        File::deleteDirectory(storage_path('app/cabinet_management/'.   $folder));

        return redirect('/cabinet-index')->with('danger', 'Cabinet Deleted Successfully!!');
    }

    public function cabinetData($id)
    {

        $data = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        return $data;

    }

    public function viewFolder($id)
    {
        
        $data = DB::table('mst_cabinets')->where('subfolder_id', $id)->get();

        return $data;
    }
    
     public function folderlist($id)
     {


        $data = DB::table('mst_cabinets')->where('subfolder_id', $id)->get();
        

        return view('cabinets.folder-list', ['data'=>$data]);
    }
    
      public function deleteFolder($id)
      {


        // $folder = DB::table('mst_cabinets')->where('cabinet_id', $id)->get();

        // $folder = $folder[0]->cabinet_name;

        DB::table('mst_cabinets')->where('cabinet_id', $id)->delete();

        // File::deleteDirectory(storage_path('app/cabinet_management/'. $folder));

        return redirect('/cabinet-index')->with('danger', 'Cabinet Deleted Successfully!!');
    }
    
    
    public function makeFolder()
    {
 
   //$directory = 'app/cabinet_management/';
 
   $root = Storage::directories();
 
    $root = $root[0];

        if($root) {
            
             $sub_root = Storage::directories($root);
             
              for($i=0; $i < count($sub_root); $i++) 
              {
         
               
               $sub_folder = Storage::directories($sub_root[$i]);
               
                for($i=0; $i < count($sub_folder); $i++) 
                {
                    
                $sub_w = Storage::directories($sub_folder[$i]);
                
                
                $folders = DB::table('mst_cabinets')->get();
          
                
            return view('cabinets.folder-structure', ['folders'=>$folders,'root' => $root, 'sub_root'=>$sub_root, 'sub_folder'=>$sub_folder, 'sub_w'=>$sub_w]);
        }
       }
     }
  }
  
  public function newFolderList()
  {

        $folder = DB::table('mst_cabinets')->where('subfolder_id', '=', 0)->get();

          for($i=0; $i < count($folder); $i++){

                $sub = $folder[$i]->cabinet_id;

                $allFolders = DB::table('mst_cabinets')->where('subfolder_id','=',$sub)->get();

                for($i=0; $i < count($allFolders); $i++){

                $sub_to = $allFolders[$i]->cabinet_id;

                $next = DB::table('mst_cabinets')->where('subfolder_id','=', $sub_to)->get();

            return view('cabinets.folder-structure', ['next'=>$next, 'folder'=>$folder,'allFolders' => $allFolders]);
            }
           return view('cabinets.folder-structure', ['folder'=>$folder,'allFolders' => $allFolders]);
          }
        return view('cabinets.folder-structure', ['folder'=>$folder]);
    }
    public function loadCabinets()
    {
        $cabinets = DB::table('mst_cabinets')->get();
        //dd($cabinets);
        foreach($cabinets as $cabinet)
        {
            $parent_cabinet_id=0;
            $data = $this->get_node_data($parent_cabinet_id,"");
        }
        
        $allcabinets=json_encode(array_values($data)); 

        //dd($allcabinets);
        return view('cabinets.foldertree');
    }
    public function allCabinets()
    {
        $cabinets = DB::table('mst_cabinets')->get();
        
        foreach($cabinets as $cabinet)
        {
            $parent_cabinet_id=0;
            
            $data = $this->get_node_data($parent_cabinet_id,"");
        }
        //dd(json_encode(array_values($data)));
        return json_encode(array_values($data));

    }
  
    private function get_node_data($parent_cabinet_id,$cPath)
    { 
        $tempPath=$cPath;
        $cabinets = DB::table('mst_cabinets')->where('Parent_cabinet_id','=',$parent_cabinet_id)->get();        

     $output = array();
    
     foreach($cabinets as $cabinet)
     { 
      $cPath=$cPath.">".$cabinet->cabinet_name;   
      $sub_array = array();
      $sub_array['id']=$cabinet->cabinet_id;
      $sub_array['text'] = $cabinet->cabinet_name;
      $sub_array['cpath']=$cPath;
      
      $sub_array['nodes'] = array_values($this->get_node_data($cabinet->cabinet_id,$cPath));
      $cPath=$tempPath;
      if (empty($sub_array['nodes']))
      {
          $sub_array['nodes']==null;
      }
      $output[] = $sub_array;
     
     }
     
     return $output;
     
    }
    
      public function folders($cabinetid)
    {  $i=1;
    
        $cabinets = DB::table('mst_cabinets')->where('Parent_cabinet_id','=',$cabinetid)->orderBy('cabinet_name')->get(); 
         
        // dd($cabinets2);
        $output=array();
        foreach($cabinets as $cabinet)
        { $folderlist=array();
          $folderlist['id']=$cabinet->cabinet_id;
          $folderlist['name']=$cabinet->cabinet_name;
          $folderlist['lastmodified']=$cabinet->updated_date ;
          $files=DB::table('filedetails')->where('cabinet_id','=',$cabinet->cabinet_id)->get(); 
          //dd($files);
          $size=0;
          foreach($files as $file)
          {
              $size=$size+$file->size;
          }
          $folderlist['size']=$size;
          $folderlist['type']="0";
          $output[]=$folderlist;
          
        }
        $files=DB::table('filedetails')->where('cabinet_id','=',$cabinetid)->orderBy('name')->get(); 
        foreach($files as $file)
        {
          $folderlist=array();
          $folderlist['id']=$file->cabinet_id;
          $folderlist['name']=$file->name;
          $folderlist['lastmodified']=$file->updated_date . ' '.$file->updated_time;
          $folderlist['size']=$file->size;
          $folderlist['type']="1";
          $output[]=$folderlist;   
        }
        
        //dd($folderlist);
        return json_encode(array_values($output));
    }

    public function myassignedFolders()
    {
        $cabinets=DB::table('mst_group_member')
        ->select('mst_cabinets.cabinet_name')->distinct()
        ->join('mst_groups' ,'mst_group_member.group_id','=','mst_groups.group_id')
        ->join('mst_category_group','mst_groups.group_id','=','mst_category_group.group_id') 
        ->join('mst_doc_category','mst_category_group.doc_category_id','=','mst_doc_category.doc_category_id')
        ->join('mst_cabinets','mst_doc_category.folder_id','=','mst_cabinets.cabinet_id')
        ->get();

        $folders=Storage::alldirectories('cabinet_management');    
       
        $i=0;
        foreach($folders as $f)
        
        {  
            foreach($cabinets as $c)
            { 
                if(class_basename($f)==$c->cabinet_name)
                {
                    
                    $myfolders[$i]=$c->cabinet_name;
                    $i=$i+1;                
                }
            }
            
        }    
     
        return $myfolders;
    }
    public function assignedFolders()
    {
        $user = auth()->user();
        $myfolders=  $this->myassignedFolders();
        
        return view('cabinets.folder-lists', ['folders'=>$myfolders]);
    }
    
    public function folderData($foldernm)
    { 
        if($foldernm=='root')
        {
            //return json_encode($this->assignedFolders());
            $folderlist= $this->myassignedFolders();
           
            //dd($folderlist);
            //$folderlist = Storage::directories('cabinet_management/'); 
        }
        else
        {
            $fnm=Str::replaceArray('-', ['/'], $foldernm);
            $folderlist = Storage::directories('cabinet_management/'.$fnm);
        }
//  dd($folderlist);
        $i=0;
        if(empty($folderlist))
        {
            $folderdetails[$i]['path']=$foldernm;
            $folderdetails[$i]['name']="No files or folders...";
            $folderdetails[$i]['is']="error";
        }
        else
        {
            
            foreach($folderlist as $f)
            {       
                    $path=Str::replaceArray('cabinet_management/', [''], $f);
                    
                    $folderdetails[$i]['path']=str_replace('/', '-', $path);
                    
                    $folderdetails[$i]['name']=class_basename($f);
                    $folderdetails[$i]['is']='folder';
                    $i=$i+1;
            }

            $filelist=Storage::allFiles('cabinet_management/'.$foldernm);
            foreach($filelist as $f)
            { 
                $path=Str::replaceArray('cabinet_management/', [''], $f);
                $folderdetails[$i]['path']=Str::replaceArray('/', ['-'], $path);
                $folderdetails[$i]['name']=class_basename($f);
                $folderdetails[$i]['is']='file';
                $i=$i+1;               
            }
        }
        
      //dd($folderdetails);
      return json_encode($folderdetails);  
    }
    
    
}
