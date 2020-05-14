@extends('layouts.master')
@section('body')
<div class="wrapper">

<div id="content">
<div class="card-body viewList">
  <a class="btn btn-success btn-sm" href="{{url('/doc-category-create')}}">+ Add</a>
  <br>
  <br>
@include('flash-message')
<table id="myTable11" class="table">
<thead>
  <tr>
  <th>Sr. No.</th>
   <th>Doc. Category Caption</th>
   <th>Doc. Category Name</th>
   <!-- <th>Doc. Category Description</th> -->
   <th>Doc. Category Type</th>
   <th>Edit</th>
   <th>Delete</th>
   <th>Add Columns</th>
   <th>Groups</th>
   <th>Folders</th>
  </tr>
  </thead>
  <tbody>
     @foreach($doccat_edit as $doc)
      <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$doc->doc_category_caption}}</td>
            <td>{{$doc->doc_category_name}}</td>
            
            <?php 
              $string = strtolower($doc->doc_category_name);
              $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
              $string = preg_replace("/[\s-]+/", " ", $string);
              $table_name = preg_replace("/[\s_]/", "_", $string);
              
            ?>
            
            <!-- <td>{{$doc->doc_category_desc}}</td> -->
            <td>{{$doc->doc_category_type}}</td>
            
            <td><a class="btn btn-info btn-sm"  onclick="loadDetails('{{$doc->doc_category_id}}','edit')"><i class="fas fa-edit" aria-hidden="true"></i></a></td>   
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('/doc-category-delete') }}/{{$doc->doc_category_id}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
            <td><button class="btn btn-success btn-sm"><a href="{{ url('/tran-doc-cat-index') }}/{{$doc->doc_category_id}}" style="color:white;">+ Add Columns</a></button></td>
            <td><button class="btn btn-success btn-sm"><a href="{{ url('/assign-group-index') }}/{{$doc->doc_category_id}}" style="color:white;">+ Groups</a></button></td>  
           @if($doc->folder_path == "")
            <td><button class="btn btn-success btn-sm" onclick="loadDetails2('{{$doc->doc_category_id}}','folderassignForm')"><a class="btn-sm" data-title="view" data-toggle="modal" data-target="#folderassignForm"><i style="color:#f8d775" class="fas fa-folder" aria-hidden="true"></i> Assign Folder</a></button></td>  
           @else
           <td><button class="btn btn-default btn-sm" onclick="loadDetails2('{{$doc->doc_category_id}}','folderassignForm')"><a class="btn-sm" data-title="view" data-toggle="modal" data-target="#folderassignForm"><i style="color:#f8d775" class="fas fa-folder" aria-hidden="true"></i>{{$doc->folder_path}}</a></button></td>
        @endif
        </tr>
        @endforeach  
  </tbody>
  </table>
 </div>
 </div>
 </div>

 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4>&nbsp;&nbsp;Doc Category Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
      
    <div class="modal-body">
      <div class="row noPadMar">        
        <div class="container editcompanyDetail">
            
            <form method="post" id="editForm" action="{{url('/store-folder-category')}}">
               @csrf
                <input class="form-control hidden" type="text" name="doc_category_id" value="" disabled>
                   <div class="form-group row">
                                           <label for="doc_category_caption" class="col-md-4 col-form-label text-md-right">Caption :</label>
                                               <div class="col-md-6">
                                                    <input type="text" class="form-control" name="doc_category_caption" id="doc_category_caption" value="" class="font-control" placeholder="Enter Doc. Category Caption" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="doc_category_name" class="col-md-4 col-form-label text-md-right">Name :</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="" name="doc_category_name" id="doc_category_name" placeholder="Enter Doc. Category Name" required="" readonly>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="doc_category_desc" class="col-md-4 col-form-label text-md-right">Description:</label>

                                                <div class="col-md-6">
                                                    <textarea rows="4" type="text" class="form-control" value="" name="doc_category_desc" id="doc_category_desc" placeholder="Enter Doc. Category Description">
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="doc_category_type" class="col-md-4 col-form-label text-md-right">Type :</label>

                                                <div class="col-md-6">
                                                    <select type="text" name="doc_category_type" id="doc_category_type" class="form-control" placeholder="Enter Doc. Category Type" required="">
                                                    <option value="">Select Document Type</option>
                                                    <option value="Simple">Simple</option>
                                                    <option value="Workflow">Workflow</option>
                                                    <option value="Document Template">Document Template</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                               <div class="offset-md-4">
                                               <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                               <button type="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
                                           </div>
                        </div>
                </form>
           </div>
       </div>
      </div>
     <div class="modal-footer"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div>
  
  
  
   <div class="modal fade" id="folderassignForm" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true" width:"90%";>
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4>&nbsp;&nbsp;Assign Folder :</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
      
    <div class="modal-body">
      <div class="row noPadMar">        
        <div class="container editcompanyDetail">
           <div class="col-md-6" style="border-right: 1px dotted #999;">
        
            <div id="treeview" >
            
            </div>
            
           </div>
           <div class="col-md-6">
               <form method="post" id="folderassignForm" action="{{url('/store-folder-category')}}">
                @csrf
                <input class="form-control hidden" type="text" name="doc_category_id" id="doc_category_id" value="" >
                   <div class="form-group row">
                       
                    <label for="doc_category_caption" class="col-md-12 col-form-label text-md-left">Assign Folder Path :</label>
                    <div class="col-md-12">
                    <input type="text" class="form-control hidden" name="folder_id" id="Parent_cabinet_id" value="" class="font-control" placeholder="Folder Id" required="">
                    
                    <input type="text" class="form-control" name="folder_path" id="cPath" value="" class="font-control" placeholder="Folder Path" required="" Readonly="">
                    </div>
                    </div>
                    
                    <div class="form-group row mb-0">
                      <div class="offset-md-1" >
                         <button type="submit" name="submit" class="btn btn-primary btn-xs">Assign</button>
                          <button type="submit" class="btn btn-primary btn-xs" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                </form> 
           </div>
       </div>
      </div>
     <div class="modal-footer"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div>
      </div>
      
      
      
      
 <script>
   function loadDetails(doccatid, modalnm){ 

       $.ajax({ 
            url  :"doccatdetails/"+ doccatid, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
                $.each(data, function(i, item) {
                    if(modalnm=="edit") 
                    {
                        $("#doc_category_caption").val(item.doc_category_caption);
                        $("#doc_category_name").val(item.doc_category_name);
                        $("#doc_category_desc").val(item.doc_category_desc);
                        $("#doc_category_type").val(item.doc_category_type);
                        actionlink="{{url('/doc-category-update')}}/"+ doccatid ;
                        $("#editForm").attr('action',actionlink);
                        $("#edit").modal();
                    }    
                    else
                    {
                        $("#nm").text(item.name);
                        $("#no").text(item.contact_no);
                        $("#email").text(item.email_id);
                        $("#unm").text(item.username);
                        $("#loc").text(item.location);
                        $("#desi").text(item.designation)
                 
                    }
                });     
            }
        });
    }
    
    
 function loadDetails2(doccatid, modalnm){ 

       $.ajax({ 
            url  :"doccatdetails/"+ doccatid, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
                $.each(data, function(i, item) {
                    if(modalnm=="folderassignForm") 
                    {
                        $("#doc_category_id").val(item.doc_category_id);
                        $("#cPath").val(item.folder_path);
                        $("#doc_category_caption").val(item.doc_category_caption);
                        $("#doc_category_name").val(item.doc_category_name);
                        $("#doc_category_desc").val(item.doc_category_desc);
                        $("#doc_category_type").val(item.doc_category_type);
                        actionlink="{{url('/doc-category-update')}}/"+ doccatid ;
                        $("#editForm").attr('action',actionlink);
                        $("#folderassignForm").modal();
                    }    
                    else
                    {
                        $("#nm").text(item.name);
                        $("#no").text(item.contact_no);
                        $("#email").text(item.email_id);
                        $("#unm").text(item.username);
                        $("#loc").text(item.location);
                        $("#desi").text(item.designation)
                 
                    }
                });     
            }
        });
    }   
    
   
   
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
             //alert(item);
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
                path=cPath.replace(/>/g,"/");
                var pos = path.indexOf("/");
                 cPath=path.substring(pos+1);
                $("#currentPath1").val(cPath);
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

 $('#file_form').on('submit', function(event){
    event.preventDefault();

   $.ajax({
     url:'upload-file',
     type:"POST",
     data:new FormData(this),
      cache: false,
        contentType: false,
        processData: false,
     success:function(data){
         alert(data);
     }
    });
});

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
             //alert(item);
            $('#subfolders > tbody').append('<tr><td>'+j+'</td><td class="hide_column">'+item.type+'</td><td style="align:left;">'+item.name+'</td><td>'+item.size+'</td><td>'+item.lastmodified+'</td><td><a  data-id='+item.id+' ><span ><i class="fas fa-edit" aria-hidden="true" style="color:#46b8da;padding-left:7px;padding-right:7px;"></i></span></a><a   data-id='+item.id+'><span ><i class="fas fa-trash" aria-hidden="true" style="color:red; padding-left:7px;padding-right:7px;" ></i></span></a></td></tr>'); 
            j=j+1;
        }); 
       
      
    }
}); 
 }
})
  </script>
@endsection