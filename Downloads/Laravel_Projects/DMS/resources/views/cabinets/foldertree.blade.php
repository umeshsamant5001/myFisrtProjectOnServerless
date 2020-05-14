@extends('layouts.master')
@section('body')
<!-- Sidebar  -->


<div class="row pt-2 pb-2 " style="background-color: #f6f6f6; pading-right:10px;">

    <div class="col-md-2"  >
        <button class="btn btn-primary btn-xs  createcabinet mt-0 mr-0" style="float:right">Create Cabinet</button>
    </div>
    <div class="col-md-10">
    <div class="col-md-1 inner-addon left-addon">
       <span class="glyphicon glyphicon-folder-open" style="color:#f8d775;float:left"> </span>
        </div>
        <div class="col-md-8">
  <input id="currentPath2" value=""/></a>
    </div>
        <div class="col-md-3" style="">
   
        <button  class="btn btn-success btn-xs uploadfile mt-0 mr-0" disabled="disabled" >Upload File</button>

        <button   class="btn btn-primary btn-xs  createfolder mt-0 mr-0" disabled="disabled" >Create folder</button>
       </div>
    </div>
</div>
    
        <div class="col-md-2" style="border-right: 1px dotted #999;">
            
            <br/>
            
            <div id="treeview">

            </div>
        </div>
        <div class="col-md-10 p-2">
        <table id="subfolders" class="table mt-1">
            <thead>
                <tr>
                    <th width="7%" > Sr No</th>
                    <th width="10%">Type</th>
                    <th width="41%">Name</th>
                    <th width="11%">Size</th>   
                    <th width="21%">Last Modified</th>   
                    <th width="10%">Actions</th>
                
                </tr>
            </thead>
            <tbody>
                <!-- folderlist goes here -->
              
            </tbody>
        </table>        
        
            <div>
                <!-- <button class="btn btn-success createfolder" >Create subfolder</button> -->
            </div>
        </div>
    </div>    
</div>    
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Folder Details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>

		<div class="modal-body">
			<div class="row noPadMar">
				<div class="container viewcabinetdetail">
                    <form method="post" id="subfold_form" >
                                                 
                                          @csrf
                                            <div class="form-group row">
                                               
                                                <label for="name" class="col-md-4 col-form-label text-md-right"> Name :</label>

                                                <div class="col-md-8">
                                                    <input type="text" id="currentPath1" name="currentPath1" value="root" hidden/> 
                                                    <input type="text" id="Parent_cabinet_id" name="Parent_cabinet_id" value="" hidden>
                                                    
                                                    <input type="text"  name="cabinet_name" class="form-control" placeholder="Enter Folder Name" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="cabinet_size" placeholder="Enter Cabinet Size" value=0 hidden>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_description" class="col-md-4 col-form-label text-md-right">Description :</label>

                                                <div class="col-md-8">
                                                <textarea rows="4" type="text" class="form-control" value="" name="cabinet_description" placeholder="Enter Folder Description"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" id="subfoldsubmit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button id="subcancel" class="btn btn-primary" >Cancel              </button>
                                                </div>
                                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="cabinet" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Cabinet Details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>

		<div class="modal-body">
			<div class="row noPadMar">
				<div class="container viewcabinetdetail">
                    <form method="post" id="cabinet_form" >
                                                 
                                          @csrf
                                            <div class="form-group row">
                                               
                                                <label for="name" class="col-md-4 col-form-label text-md-right"> Name :</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="currentPath1" name="currentPath1" value="" hidden/> 
                                                    <input type="text" id="Parent_cabinet_id" name="Parent_cabinet_id" value="" hidden>
                                                    
                                                    <input type="text"  name="cabinet_name" class="form-control" placeholder="Enter Cabinet Name" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_size" class="col-md-4 col-form-label text-md-right">Size :</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="cabinet_size" name="cabinet_size" placeholder="Enter Cabinet Size" required>

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
                                                    <button type="submit" id="cabinetsubmit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button id="cancel" class="btn btn-primary" >Cancel </button>
                                                </div>
                                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="uploadfilebox" tabindex="-1" role="dialog" aria-labelledby="upload file" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4>&nbsp;&nbsp;File details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>

		<div class="modal-body">
			<div class="row noPadMar">
				<div class="container viewcabinetdetail">
                    <form  id="file_form" action="{{url('/upload-file')}}" enctype="multipart/form-data" method="post" >
                                                 
                         @csrf
                          <div class="form-group row">           
                          <div class="form-check">
                           <label class="form-check-label" for="radio1">
                               <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Without document category <br>
                           </label>
                           </div>
                           
                           <div class="form-check">
                           <label class="form-check-label" for="radio2">
                               <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">With document category
                           </label>
                       </div>
                    </div>                         

                        <div class="form-group row" id="docCategory" >
                           <label for="docCat" class="col-md-4 form-check-label text-md-left ">Category :</label>

                             <input type="text" id="cPath" name="cPath" value="" hidden/> 
                               <input class="form-control" type="text" id="Pc_id" name="Pc_id" value="" hidden/>
                                                    
                               <select  name="docCat" id="docCat" class="form-control col-md-8" placeholder="Select document category" >
                               <option value=0 selected> Select document category</option>
                               </select>
                        </div>
                                           

                       <div class="form-group row">
                       <label for="fileupload" class="col-md-4 form-check-label text-md-left ">Select file :</label>
                        
                        <input type="file" name="filetoupload"  class=" form-control col-md-8" id="filetoupload">
                                                
                       </div>

                       <div class="form-group row">
                           <label for="description" class="col-md-4 form-check-label text-md-left">Description :</label>

                           <textarea rows="4" type="text" class="form-control col-md-8" value="" name="description" placeholder="Enter Description"></textarea>
                         
                       </div>

                       <div class="form-group row mb-0">
                           <div class="col-md-6 offset-md-4">
                               <button type="submit" id="uploadsubmit" class="btn btn-primary btn-xs">
                                upload
                               </button>
                               <button id="uploadcancel" class="btn btn-primary btn-xs" >Cancel</button>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>
<script>
 $(document).ready(function(){
     
    $('#subfolders').DataTable(
        {
            "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false,
                className: 'dt-body-right',
                className: 'dt-head-center'
            }],
            "paging":   false,
            "ordering": false,
        }
    );

    var slectedNodeId;
    var hasSelect=false;
    var nodeIdList=[];

  //fill_parent_cabinet();

  fill_treeview();
  $('#docCategory').hide();
  loadCategories();
  
  function loadCategories()
  {
    $.ajax({
    url:"doccategorylist/",
    async:false,
    success:function(data){
        itemlist=JSON.parse(data);
         $.each(itemlist, function(i, item){
           //// alert(item);
            $('#docCat').append('<option value="'+item.doc_category_id+'">'+item.doc_category_caption+'</option>'); 
            
        }); 
    }
    });
  }
  
  function fill_treeview()
  {
   $.ajax({
    url:"allcabinets/",
    
    dataType:"json",
    success:function(data){
      //  alert(data);
        $('#treeview').treeview({
            data:data,
            showBorder:false,
            nodeIcon:'fas fa-folder-open',
            expandIcon:'fas fa-caret-right',
            collapseIcon:'fas fa-caret-down',
            levels:1,
            
            onNodeSelected: function(event, node) {
                slectedNodeId=node.nodeId;
                var parentnode=$('#treeview').treeview('getParent', node);
                // if(parentnode.id!==undefined )
                // {   
                //     $("#Parent_cabinet_id").val(parentnode.id);
               
                // }
                // else
                // {
                //     $("#Parent_cabinet_id").val("0");
                // }
                $("#Parent_cabinet_id").val(node.id);
                $("#Pc_id").val(node.id);
                cPath=node.cpath;
                cPath1=node.cpath;
                path=cPath.replace(/>/g,"-");
                var pos = path.indexOf("-");
                 cPath=path.substring(pos+1);
                $("#currentPath1").val(cPath);
                $("#currentPath2").val(cPath1);
                $('#cPath').val(cPath);
                $('#subfolders > tbody').html(""); 
                if(node.nodes!=="") 
                {  
                    loadlist(node.id);
                    // $.each(node.nodes, function(i, cnode){
                    //     j=i+1;
                    //     $('#subfolders > tbody').append('<tr><td>'+j+'</td><td>'+cnode.text+'</td><td>'+'size'+'</td><td><a  data-id='+cnode.id+' ><span ><i class="fas fa-edit" aria-hidden="true" style="color:#46b8da;padding-left:7px;padding-right:7px;"></i></span></a><a   data-id='+cnode.id+'><span ><i class="fas fa-trash" aria-hidden="true" style="color:red; padding-left:7px;padding-right:7px;" ></i></span></a></td></tr>'); 
                    // }); 
                }
                $(this).treeview('unselectNode', [node.nodeId, { silent: false }]);
                $('#treeview').treeview('expandNode', [ node.nodeId, {  silent: true } ]);
                $(".uploadfile").prop('disabled', false);
                $(".createfolder").prop('disabled', false);
                $("#cancel").click();

               //var ancestnodes= $('#treeview').treeview('revealNode', [ node.nodeId, { silent: true } ]);
                //alert("hi");
        },    
        onNodeUnselected: function (event, node) {
            $(this).treeview('selectNode', [node.nodeId, { silent: true }]);
        },
        onNodeCollapsed:function(event, node){
            nodeIdList.push(node.nodeId);
            $.each(node.nodes, function(){ 
             if(this.state.selected){
                 $('#treeview').treeview('selectNode',[nodeIdList[0], { silent: true } ]);
                 hasSelect=true;
             }
            });     
            },
        onNodeExpanded:function(event, node){                    
             $.each(node.nodes, function(){ 
                 if((this.nodeId==slectedNodeId || nodeIdList.indexOf(this.nodeId)>-1) 
                && hasSelect)
                {
                     $('#treeview').treeview('selectNode',[ this.nodeId, { silent: true } ]);
                }
            });  
        }, 
        });
    }
   })

  }
 $(".createfolder").on("click", function(event){
    event.preventDefault();
    
    if(slectedNodeId==undefined)
    {
        alert("Please select Folder !");
    }
    else
    {
        event.preventDefault();
        $("#create").modal('show');
    }
 })
 
 $("#radio2").on("click", function(event){
    $('#docCategory').show();
 })

 $("#radio1").on("click", function(event){
    $('#docCategory').hide();
})

 $("#cancel").on("click", function(event){
    
    $("#create").modal('hide');
    
 })

 $(".createcabinet").on("click", function(event){
    event.preventDefault();
    
        $("#cabinet").modal('show');
    
 })
 $(".uploadfile").on("click", function(event){
    event.preventDefault();
    
        $("#uploadfilebox").modal('show');
    
 })
 $("#subcancel").on("click", function(event){
    
    $("#create").modal('hide');
    
 })

 $("#cancel").on("click", function(event){
    
    $("#cabinet").modal('hide');
    
 })
 $("#uploadcancel").on("click", function(event){
    
    $("#uploadfilebox").modal('hide');
    
 })
 $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $('#cabinet_form').on('submit', function(event){
    event.preventDefault();
    if ($("#Parent_cabinet_id").val()=="")
    {
        $("#Parent_cabinet_id").val(0);
    }
    $pid=$("#Parent_cabinet_id").val();
    $cp=$("#currentPath1").val();
   $.ajax({
     url:'cabinet-store',
     type:"POST",
     data:$(this).serialize(),
     success:function(data){
        if(data==0)
         { 
          alert("Cabinet created successfully!");
          fill_treeview();
         } 
       if(data==1)
       {
           alert("Cabinet already exists!")
       }


      $('#cabinet_form')[0].reset();
      $("#Parent_cabinet_id").val($pid);
      $("#currentPath1").val($cp);
      $("#cabinet").modal('hide');
//      alert(data);
    }
    })
//   });
 });

//  $('#file_form').on('submit', function(event){
//     event.preventDefault();

//   $.ajax({
//      url:'upload-file',
//      type:"POST",
//      data:new FormData(this),
//       cache: false,
//         contentType: false,
//         processData: false,
//      success:function(data){
//          alert(data);
//      }
//     });
// });

 $('#subfold_form').on('submit', function(event){
    event.preventDefault();
    if ($("#cabinet_size").val()=="")
    {
        $("#cabinet_size").val(0);
    }
    $pid=$("#Parent_cabinet_id").val();
    $cp=$("#currentPath1").val();
   $.ajax({
     url:'cabinet-store',
     type:"POST",
     data:$(this).serialize(),
     success:function(data){
        if(data==0)
         { 
          alert("Sub folder created successfully!");
          fill_treeview();
         } 
       if(data==1)
       {
           alert("Sub folder already exists!")
       }


      $('#cabinet_form')[0].reset();
      $("#Parent_cabinet_id").val($pid);
      $("#currentPath1").val($cp);
      $("#create").modal('hide');
//      alert(data);
    }
    })
//   });
 });

 function loadlist(cid)
 {
    $.ajax({
    url:"folderlist/"+cid,
    async:false,
    success:function(data){
        j=1;
        itemlist=JSON.parse(data);
         $.each(itemlist, function(i, item){
             // Code modified - (added launchPdf function)to launch file from Cabinate - folder : UmeshS
            $('#subfolders > tbody').append('<tr><td>'+j+'</td><td class="hide_column">'+item.type+'</td><td style="align:left;">'+item.name+'</td><td>'+item.size+'</td><td>'+item.lastmodified+'</td><td><a  data-id='+item.id+' ><span ><a class="btn btn-info btn-sm" onclick="launchPdf('+item.id+',\'' + item.name + '\')" ></a></span></a><span ><i class="fas fa-edit" aria-hidden="true" style="color:#46b8da;padding-left:7px;padding-right:7px;"></i></span><a   data-id='+item.id+'><span ><i class="fas fa-trash" aria-hidden="true" style="color:red; padding-left:7px;padding-right:7px;" ></i></span></a></td></tr>');
     
           j=j+1;
        }); 
       
      
    }
}); 
 }
})
   //  Added launchPdf function to launch file from Cabinate - folder : Umesh
   function launchPdf(itemId, itemName ){
    
    var protocol = location.protocol;
    var slashes = protocol.concat("//");
    var host = slashes.concat(window.location.hostname);
    var port = window.location.port;     
    var varcabinateId = decodeURI(itemId);
    var varfileName = decodeURI(itemName);
    var urlactual = host+":"+port+"/viewfile?"  ;
    //"http://127.0.0.1:8000/viewfile?";
    var urlcab =   "cabinateId="+reverseStr(varcabinateId);
    var urlfile = "&fileName="+reverseStr(varfileName); 
    var finalurl = urlactual+urlcab+urlfile;
    var win = window.open('', '_blank' ); 
    win.location.href = finalurl; 
    
  }
  // Added function to reverse url parameters : Umesh
  function reverseStr(str) {
    if(!str || str.length < 2 || typeof str !== "string") {
        return new Error("Not a valid input");
    }
    const backwards = [];
    for (let i = str.length; i > -1; i--) {
        backwards.push(str[i]);
    }
    return backwards.join('');
}
//
//})
</script>
@endsection

