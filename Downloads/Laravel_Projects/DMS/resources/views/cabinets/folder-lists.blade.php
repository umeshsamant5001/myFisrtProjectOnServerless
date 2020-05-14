@extends('layouts.master')
@section('body')
<!-- Sidebar  -->
<div class="wrapper">

 @include('layouts.sidebar')

<div id="content" class="folderStructure viewList" >
    <div class="row justify-content-center" id="menudiv" style="margin-bottom: 15px;">
        <ul class="topmenu">
            <li><a href="{{url('/folder-listadmin')}}"><i class="fas fa-home p-2"></i>Home</a></li>
            <li><a  onclick="LevelUpFolder()"><i class="fas fa-arrow-circle-up p-2" ></i>Up one level</a></li>
            <li><a data-title="view" data-toggle="modal" data-target="#create"><i class="fas fa-plus p-2"></i>Create folder</a></li>
            <li><a data-title="fileupload" data-toggle="modal" data-target="#fileupload"><i class="fas fa-file-upload p-2"></i>upload file</a></li>
        </ul>
    </div>
    <div>
        <label id="currentPath" name="currentPath" >cabinet root</label>
    </div>
<div class="tab col-sm-12 col-xs-12 nav nav-tabs nav-fill" id="nav-tab"  role="tablist">
   
        <ul class="list">
            
            <!-- <span><i class="fas fa-folder-open"></i>Cabinet_Management</span><a href=""></a> -->
                @foreach($folders as $folder)
               
                 <li>
                    <a onclick="loadFolders('{{$folder}}')"> <span><i class="fas fa-folder-open p-2"></i>{{$folder}}</span></a> 
                </li>
               
               @endforeach
        </ul>
    
</div>
<!-- <button class="btn btn-success btn-sm"><a data-title="view" data-toggle="modal" data-target="#create"><i class="fas fa-plus" aria-hidden="true"></i> Create SubFolder</a></button> -->
</div>
</div>

 
 <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Cabinet Details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>

		<div class="modal-body">
			<div class="row noPadMar">
				<div class="container viewcabinetdetail">
                    <form method="post" action="{{url('/cabinet-store')}}">
                                                 
                                          @csrf

                                          @include('flash-message')
                                            <div class="form-group row">
                                               
                                                <label for="name" class="col-md-4 col-form-label text-md-right"> Name :</label>

                                                <div class="col-md-6">
                                                    <input type="hidden" id="currentPath1" name="currentPath1" value="cabinet_management/"/> 
                                                    
                                                    <input type="text"  name="cabinet_name" class="form-control" placeholder="Enter Cabinet Name" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_size" class="col-md-4 col-form-label text-md-right">Size :</label>

                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" name="cabinet_size" placeholder="Enter Cabinet Size" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_description" class="col-md-4 col-form-label text-md-right">Description :</label>

                                                <div class="col-md-6">
                                                <textarea rows="4" type="text" class="form-control" value="" name="cabinet_description" placeholder="Enter Description"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
 </div>
 
 
  <div class="modal fade" id="fileupload" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Cabinet Details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>

		<div class="modal-body">
			<div class="row noPadMar">
				<div class="container viewcabinetdetail">
                    <form method="post" action="{{url('/upload-file-admin')}}" enctype="multipart/form-data">
                                                 
                                          @csrf

                                          @include('flash-message')
                                            <div class="form-group row">
                                               
                                                <label for="name" class="col-md-4 col-form-label text-md-right"> Name :</label>

                                                <div class="col-md-6">
                                                    <input type="" id="currentPath2" name="currentPath2" value="cabinet_management/"/> 
                                                    
                                                    <input type="file"  name="admin_file" class="form-control" placeholder="Enter Cabinet Name" required="">

                                                </div>
                                            </div>

                                        
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
 </div>
 
</div>


<script type="text/javascript">
$(document).ready(function() {
$(".uploadfileSec").hide();
$('#myTable12').DataTable();
});

$(function () {

    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            // $(this).attr('title', 'Expand this branch').find(' > i').addClass('fas fa-folder-open').removeClass('fas fa-folder-close');
        } else {
            children.show('fast');
            // $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fas fa-folder-open').removeClass('fas fa-folder-close');
        }
        e.stopPropagation();
    });
});

$(".uploadfileBtn").click(function(){
  $(this).hide();
  $(".uploadfileSec").show();

});
$(".filesubmitBtn").click(function(){
	 $(".uploadfileBtn").show();
	$(".uploadfileSec").hide();
});


$(".tree span i.fa-caret-right").click(function () {
    $(this).toggleClass("down");
});

  
   function loadFolders(foldernm){ 
    //alert(foldernm);
    var res = foldernm.replace(/-/g, ">");
    var res1 = foldernm.replace(/-/g, "/");
    if (res!=="root")
        {  
            $("#currentPath").html('cabinet root >'+res);
            $("#currentPath1").val('cabinet_management/'+res1 + '/');
        }   
     else
        {
            $("#currentPath").html('cabinet root >');
            $("#currentPath1").html('cabinet_management/');
        }    
       $.ajax({ 
            url  :"folderdetails/"+ foldernm, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
                $(".list").html("");
                $.each(data, function(i, item) {
                    if(item.is=="folder") 
                    {
                        $(".list").append('<li ><a onclick="loadFolders('+"'"+item.path+"'"+')"> <span><i class="fas fa-folder-open"></i> '+item.name+' </span></a> </li>');
                    }
                    else
                    {
                        if(item.is=="file")
                        {
                            $(".list").append('<li><a onclick="loadFolders('+item.path+')"> <span><i class="fas fa-file"></i> '+item.name+'</span></a> </li>');

                        }
                    else{
                        $(".list").append('<li> <span><i class="fas fa-file"></i> '+item.name+'</span></a> </li></ul>');
   
                        }
                    }    
                });     
            },
            error:function(data){
               
            }
        });
    }
    function LevelUpFolder()
    {
        actualPath=getPath();
           // actualPath=path.replace("cabinet root -"," ");
           // alert("actual path"+actualPath);
            if(actualPath=="")
            {
                actualPath="root";
            }
            loadFolders(actualPath.trim()); 
        
   
      
    }
    function getPath()
    {
        var p=String($("#currentPath").text());      
        var pos = p.lastIndexOf(">");
        var path=p.substring(0,pos);
        //alert("trimmed last"+path);
        p=path.replace("cabinet root"," ");
        //alert("replaced cabinet root"+p);
        path=p.replace(/>/g,"-");
        //alert("replaced > with -"+path);
        if(path!=="")
        {
            p=path.trim();
            path=p;
            if(path.slice(0, 1)=="-")
            {
                actualPath=path.slice(1);
            }
            else
            {
                actualPath=path;
            }
        }
        return actualPath;
    }    
</script>
@endsection