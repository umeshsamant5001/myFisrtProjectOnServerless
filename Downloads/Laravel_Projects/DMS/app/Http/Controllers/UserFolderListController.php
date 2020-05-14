<?php

namespace App\Http\Controllers;

use App\UserFolderList;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\Facades\FileVault;
use SoareCostin\FileVault\FileVaultServiceProvider;
use DB;
use Response;

class UserFolderListController extends Controller
{
  
    public function index()
    {
      $user = auth()->user();
       
      $user_to_folder = DB::table('mst_group_member')
      ->select('mst_cabinets.cabinet_name')
      ->join('mst_category_group', 'mst_category_group.group_id','=', 'mst_group_member.group_id')
      ->join('mst_doc_category', 'mst_doc_category.doc_category_id', '=', 'mst_category_group.doc_category_id')
      ->join('mst_cabinets', 'mst_cabinets.cabinet_id', '=', 'mst_doc_category.folder_id')
      ->where('mst_group_member.user_id', $user->user_id)
      ->distinct('mst_category_group.category_group_id')
      ->get();
      
      //dd($user_to_folder);
      
     $user_to_folder = json_encode($user_to_folder);
    
            
               
           $f_name = DB::table('file_encrypt')->get();

           
            $cabinet_name = $user_to_folder;
          

            $files = Storage::files('cabinet_management/'.$cabinet_name.'/');
            
    
            $files1 = preg_replace('/\\.[^.\\s]{3,4}$/', '', $files);
          
          
            return view('userview.folder-structure-index', ['cabinet_name'=>$cabinet_name,'user_to_folder'=>$user_to_folder,'f_name'=>$f_name,'files1'=>$files1]);
         
          
          // dd( $cabinet_name);
            
         // $folderlist = Storage::disk('local')->directories('cabinet_management/');
        
         // $cabinet =  DB::table('mst_cabinets')->get();
    
      
     
         return view('userview.folder-structure-index', ['user_to_folder'=>$user_to_folder]); 
        
        
    }

    public function uploadFile(Request $request, $folder)
    {
     
       $files = $request->file('upload_file');
       
     
        if(!empty($files)) :
          
     
         $upload_file = Storage::putFile('cabinet_management/'.$folder, $files);
        
       
          // Check to see if we have a valid file uploaded
          if ($upload_file) {
                
             $encrypt = FileVault::encrypt($upload_file);
    
          }
          
     
         $user = auth()->user();
      
         $data = [
          
          'name' => $request->file('upload_file')->getClientOriginalName(),
          'encrypt_file_name' => $upload_file,
          'created_by' => $user->user_id,
          'created_date' => date("Y-m-d"),
          'created_time' => date("H:i:s"),
          'updated_by' => $user->user_id,
          'updated_date' => date("Y-m-d"),
          'updated_time'=> date("H:i:s"),  
          
          ];
          
        $folder = Storage::putFile('cabinet_management/Session_file', $request->file('upload_file'));
        
       $insert = DB::table('file_encrypt')->insert($data);
       
      endif;
        
        return redirect('/folder-list')->with('success', 'File Uploaded Successfully!');
    }

      public function downloadFile($filename)
      {  
        $user = auth()->user();
       
        $user_to_folder = DB::table('mst_group_member')
       ->select('*')
       ->join('mst_category_group', 'mst_category_group.group_id','=', 'mst_group_member.group_id')
       ->join('mst_doc_category', 'mst_doc_category.doc_category_id', '=', 'mst_category_group.doc_category_id')
       ->join('mst_cabinets', 'mst_cabinets.cabinet_id', '=', 'mst_doc_category.folder_id')
       ->where('user_id', $user->user_id)
       ->first();

       $folder = $user_to_folder->cabinet_name;
         
      //  $folder = 'cabinet_management/'.$folder.'/';

      // Basic validation to check if the file exists and is in the user directory

     if (!Storage::has('cabinet_management/Sonali/'.$filename)) {
      abort(404);
     } else {
         
  $f_name = DB::table('file_encrypt')->get();
  
  return response()->file(function () use ($filename) {
      FileVault::streamDecrypt('cabinet_management/Sonali/'.$filename);
  }, Str::replaceLast('.enc', '', $filename));
  
     }

  }
      
      public function viewPdfFile(Request $request,$filename) 
      {
    
      return view('userview.view-file', ['filename'=>$filename]); 
  
      } 
      
     public function deleteFile($filename){
         
      
         $directory = 'cabinet_management/Sonali/'.$filename;
         
         $directory1 = 'cabinet_management/Session_file/'.$filename;
        
         Storage::delete($directory.'.enc');
         
         Storage::delete($directory1);
         
         return redirect('/folder-list')->with('success', 'File Download Successfully!');
         
     }
     
    
     public function manually(Request $request){
         
         $files = $request->file('new_file');
 
         if(!empty($files)) :
    
         $upload_file = Storage::putFile('cabinet_management/Session_file', $files);
         
          // Check to see if we have a valid file uploaded
          if ($upload_file) {
         
           Crypt::decrypt($upload_file);
          }
 
      endif;
     
     }
     
    
     
}
