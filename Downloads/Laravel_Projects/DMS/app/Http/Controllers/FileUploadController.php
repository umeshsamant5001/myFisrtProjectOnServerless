<?php

namespace App\Http\Controllers;

use App\FileUpload;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\Facades\FileVault;
use SoareCostin\FileVault\FileVaultServiceProvider;
use DB;
use Response;
use File;
class FileUploadController extends Controller
{
    public function uploadFile1(Request $request)
    {   
       
        if ($request->hasFile('filetoupload') && $request->file('filetoupload')->isValid()) {

            $currentfiles = DB::table('filedetails')
             ->where([['cabinet_id',$request->Pc_id],['name',$request->file('filetoupload')->getClientOriginalName()]])
             ->get();
          
            if(count($currentfiles)==0)      
            {  
                $filePath="cabinet_management/".str_replace('-', '/', $request->cPath);
                
               
          
                $upload_file= Storage::putFileAs($filePath, $request->file('filetoupload'),$request->file('filetoupload')->getClientOriginalName());
                
               

                if ($upload_file) {
                
                  $encrypt = FileVault::encrypt($upload_file);

                  
                    $user = auth()->user();
                    $size=   $request->file('filetoupload')->getSize();
                    
                    $data = [
                 
                        'name' => $request->file('filetoupload')->getClientOriginalName(),
                        'efilename' => $upload_file,
                        'description'=>$request->description,
                        'size'=>$request->file('filetoupload')->getSize(),
                        'cabinet_id'=>$request->Pc_id,
                        'doc_category_id'=>$request->docCat,
                        'uploaded_by' => $user->user_id,
                        'uploaded_date' => date("Y-m-d"),
                        'uploaded_time' => date("H:i:s"),
                        'updated_by' => $user->user_id,
                        'updated_date' => date("Y-m-d"),
                        'updated_time'=> date("H:i:s"),   
                        
                        ];
                //return json_encode($data);
                 $insert = DB::table('filedetails')->insert($data);
                 
                 $result=1; //success
                }
                else
                {
                    $result=2; //error in uploading file
                }
            }
            else
            {
                $result=3; // file already exist
            }
        }
        else{
            $result=0;  //empty file or file error
        }
        
        return $result;
    }
    public function categories()
    {
        $doccat = DB::table("mst_doc_category")
        ->select('doc_category_caption','doc_category_id')
        ->get();
        return json_encode($doccat);
    }
    
    
    
    public function uploadFile(Request $request)
    {
          $currentfiles = DB::table('filedetails')
             ->where([['cabinet_id',$request->Pc_id],['name',$request->file('filetoupload')->getClientOriginalName()]])
             ->get();
             
          $pdf = DB::table('filedetails')->get();
          
          if(count($currentfiles)==0)      
            {  
        
        $filePath="cabinet_management/".str_replace('-', '/', $request->cPath);
        
        $files = $request->file('filetoupload');
       
     
        if(!empty($files)) :
          
     
         $upload_file = Storage::putFileAs($filePath, $request->file('filetoupload'),$request->file('filetoupload')->getClientOriginalName());
        
       
          // Check to see if we have a valid file uploaded
          if ($upload_file) {
                
             $encrypt = FileVault::encrypt($upload_file);
    
          }
          
     
         $user = auth()->user();
      
         $data = [
          
          
          
          
                        'name' => $request->file('filetoupload')->getClientOriginalName(),
                        'efilename' => $upload_file,
                        'description'=>$request->description,
                        'size'=>$request->file('filetoupload')->getSize(),
                        'cabinet_id'=>$request->Pc_id,
                        'doc_category_id'=>$request->docCat,
                        'uploaded_by' => $user->user_id,
                        'uploaded_date' => date("Y-m-d"),
                        'uploaded_time' => date("H:i:s"),
                        'updated_by' => $user->user_id,
                        'updated_date' => date("Y-m-d"),
                        'updated_time'=> date("H:i:s"), 
          
          ];
          
       
          
       // $folder = Storage::putFile('cabinet_management/Session_file', $request->file('filetoupload'));
       // Added new code Umeshs FileUploadController
      ///  $folder = Storage::putFileAs('cabinet_management/Session_file', $request->file('filetoupload'),$request->file('filetoupload')->getClientOriginalName());
        $insert = DB::table('filedetails')->insert($data);
       
        endif;
           
        return redirect('/cabinet-index')->with('success', 'File Uploaded Successfully!');
    }
    }
    
     public function viewPdfFile(Request $request, $file_pdf) 
      {
    
      return view('cabinets.view-pdf-file'); 
  
     } 

     public function pdfviewThaklo(){

        $filename = 'hdpe-pipes.pdf';
        //echo $filename;
         //$path = storage_path($filename);
        // $path = storage_path('cabinet_management/nexasoftware/BDA/');
         $path = storage_path().'/app/cabinet_management/nexasoftware/BDA/'.$filename;
        // echo $path;
        //$encode = chunk_split(base64_encode(file_get_contents($path)));
        //echo $encode;
       
       //echo storage_path();
      // echo Storage::url($path);

       $pdfcontent = file_get_contents($path);
       $pdfBase64 = base64_encode($pdfcontent);
       echo 'data:application/pdf;base64,' . $pdfBase64;
      //  echo $pdfcontent;
        

     }
     // Code modified to launch file from Cabinate - folder : UmeshS
     public function pdfview(Request $request){
        
        $cabinateId = strrev($request->cabinateId); // $paramArray[0];
        $filename =  strrev($request->fileName);  //$paramArray[1];
        $fileDetails = DB::table('filedetails')
        ->select('filedetails.efilename', 'filedetails.size')->where('name', $filename)->where('cabinet_id', $cabinateId)->get();
        $eFilesize = $fileDetails[0]->size; 
        //echo  $eFilesize;
        $eFileName = $fileDetails[0]->efilename;   // folder with file extenstion in DB
        $extension = explode(".", $eFileName);
        //echo  $extension[1];
        $eFileNameWOExt = Str::replaceLast($extension[1], '', $eFileName);
        // echo $eFileNameWOExt;
        $fileAtLocation = storage_path().'/app/' .$eFileName.'.enc';
        $user = auth()->user();
        $fileAtPathTo = storage_path().'/app/cabinet_management/Session_file/'.$user->name.'_'.$user->user_id.'/'.$filename.'.enc';
        //echo  $fileAtPathTo;
        copy($fileAtLocation, $fileAtPathTo);  
        if ($fileAtPathTo) {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="'. $filename .'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            
            $encryptedFile = 'cabinet_management/Session_file/'.$user->name.'_'.$user->user_id.'/'. $filename.'.enc';
            // echo $encryptedFile;

            // Below Code Also works fine
            //$file = file(FileVault::streamDecrypt($sws),  
            // Str::replaceLast('.enc', '', $sws)); 
            // $file = file(FileVault::streamDecrypt($sws),
            // Str::replaceLast('.enc', '', $sws));
            // readfile($file);  
          
            return response()->file(
                FileVault::streamDecrypt($encryptedFile),
                Str::replaceLast('.enc', '', $encryptedFile));
           
        }

    }

    public function downloadFile($filename)
    {
        // Basic validation to check if the file exists and is in the user directory
        if (!Storage::has('files/' . auth()->user()->id . '/' . $filename)) {
            abort(404);
        }

        return response()->streamDownload(function () use ($filename) {
            FileVault::streamDecrypt('cabinet_management/nexasoftware/BDA/' . $filename);
        }, Str::replaceLast('.enc', '', $filename));
    }
}    