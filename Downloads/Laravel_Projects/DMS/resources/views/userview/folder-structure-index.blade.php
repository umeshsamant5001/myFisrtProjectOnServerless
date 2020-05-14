@extends('layouts.master')

@section('body')
<div class="wrapper">

<div id="content" class="folderStructure viewList">
<div class="row justify-content-center">
@if($user_to_folder == '')
  <h1 class="nofolder">No Folder Assign to this User</h1>
@else
<div class="col-sm-12">
<div class="col-sm-2 col-xs-3"><button type="button" name="upload" value="upload" id="upload" class="btn btn-success btn-sm uploadfileBtn"><i class="fa fa-fw fa-upload"></i>Upload</button></div>
<div class="col-sm-10 col-xs-9 uploadfileSec">
  <div class="col-sm-6  p-4">
         @foreach(json_decode($cabinet_name, true) as $value)
         @endforeach
  <form method="POST" action="{{url('/upload-file')}}/{{$value['cabinet_name']}}" enctype="multipart/form-data">
      @csrf
    <div class="form-group">
      <div class="custom-file">
        <input type="file" name="upload_file" multiple class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
    </div>
     <input type="submit" name="submit" id="upload" class="btn btn-block btn-dark filesubmitBtn">
  </form>
  
</div>
</div>    
</div>    
<div class="tab col-sm-3 col-xs-12 nav nav-tabs nav-fill" id="nav-tab"  role="tablist">

<div class="tree well">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <span><i class="fas fa-folder-open"></i>Cabinets</span>
          
          @foreach(json_decode($cabinet_name, true) as $value)
          
             <ul class="nav nav-tabs">
                <li class="nav-item">
                   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#{{$value['cabinet_name']}}" role="tab" aria-controls="nav-home" aria-selected="true"><span><i class="fas fa-folder-open"></i>{{$value['cabinet_name']}}</span></a>
                 </li>
                </ul>
             
           @endforeach
            </ul>
        </li>
    </ul>
</div>
</div>

<div class="col-sm-9 col-xs-12">
<div class="tab-content profile-tab" id="myTabContent">
@foreach(json_decode($cabinet_name, true) as $value)
@endforeach
<div class="tab-pane fade tab-pane fade active in" id="{{$value['cabinet_name']}}" role="tabpanel" aria-labelledby="profile-tab">
                                       
   <div class="table-responsive fileStructure">
     <table id="myTable11" class="table" >
    <thead>
   
          <th>Name</th>
          <th>Date Modified</th>
          <th>Download</th>
          <th>View</th>
          <th>Delete</th>         
        </tr>
      
    </thead>
    <tbody>
        <?php 
         $files = Storage::files('cabinet_management/'.$value['cabinet_name'].'/');
            
        $files1 = preg_replace('/\\.[^.\\s]{3,4}$/', '', $files);
        
        ?>
          
  @foreach($files1 as $ff) 
  @foreach($f_name as $fil)
 
       @if($ff == ($fil->encrypt_file_name))
            <tr>
                
            <td><a class="file-img" href="">{{$fil->name}}</a></td>
            <td>10-12-2019 19:17</td>       
            <td><a class="" href="{{url('/files')}}/{{basename($fil->encrypt_file_name)}}"><i class="fas fa-download" aria-hidden="true"></i></a></td> 
            <td><a class="btn btn-success btn-sm" href="{{url('/viewfile')}}/{{basename($fil->encrypt_file_name)}}"><i class="fas fa-eye" aria-hidden="true"></i></a></td> 
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{url('/delete')}}/{{basename($fil->encrypt_file_name)}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>        
            
            </tr>
        @endif
   @endforeach   
   @endforeach 
     </tbody>
  </table>
  </div>       
</div>

</div>
</div>

 </div>
</div>
</div>  
</div> 
@endif
@endsection


