@extends('layouts.master')
@section('body')
<div class="wrapper">

<div id="content">
<div class="card-body viewList">
  <a class="btn btn-success btn-sm" href="{{url('/group-create')}}">+ Add</a>
  <br>
  <br>
@include('flash-message')
<table id="myTable11" class="table">
<thead>
  <tr>
   <th>Sr. No.</th>
   <th>group</th>
   <th>Edit</th>
   <th>Member List</th>
   <th>Delete</th>
  </tr>
  </thead>
  <tbody>
      @foreach($group as $adm)
      <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$adm->group_name}}</td>
            <td><a class="btn btn-info btn-sm" onclick="loadDetails('{{$adm->group_id}}','edit')"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
            <!-- <td><a class="btn btn-warning btn-sm" onclick="loadDetails12('{{$adm->group_id}}','view')"><i class="fas fa-users" aria-hidden="true"></i></a></td> -->
			      <td><a class="btn btn-success btn-sm" href="{{url('/group-member-list')}}/{{$adm->group_id}}"><i class="fas fa-users" aria-hidden="true"></i></a></td> 
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('group-delete') }}/{{$adm->group_id}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
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
      <h4>Group  Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div> 
    <div class="modal-body">
      <div class="row noPadMar">        
        <div class="container editcompanyDetail">
            <form method="post" id="editForm" action="{{url('/group-update')}}">
            @csrf
            
            <input class="form-control hidden" type="text" name="group_id" id="group_id" value="" disabled>
               <div class="form-group row">
                 <label for="group" class="col-md-4 col-form-label text-md-right">Group Name:</label>
                   <div class="col-md-6">
                     <input type="text" class="form-control" value="" name="group_name" id="group_name" placeholder="Enter Group name" required="">
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
       <div class="modal-footer"> 
       </div>
     </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
 </div>


 <div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
 <form  id="addmemberform" action="{{url('add-user')}}" method="post">
    @csrf
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Add Member</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
      
   <div class="modal-body">
    <div class="row noPadMar">        
    <div class="container editgroupDetail">
    
        <table id="myTable12" class="table" >
         <thead>
          <tr>
           <th>Sr. No.</th>
           <th>User Name</th>
           <th>Delete</th>
          </tr>
         </thead>
       <tbody>
       @foreach($users as $use)
     
           <tr>
            <td>{{$loop->index+1}}</td>
            <td>

               <div class="form-check form-check-inline">
                <input class="form-control hidden" type="text" name="group_id" id="group_id" value="" disabled>
                 <input class="form-check-input" type="checkbox" name="adduser[]" value="{{$use->user_id}}" id="inlineCheckbox1">
                 <label class="form-check-label" for="inlineCheckbox1">{{$use->name}}</label>
               </div>
       
           </td>
         <td><a class="btn btn-danger btn-sm" href=""><i class="fas fa-trash" aria-hidden="true"></i></a></td> 
        </tr>
       @endforeach
	   </tbody>
   </table>
  </div>
</div>
 </div>
     <div class="modal-footer">
      <button type="submit" name="submit" class="btn btn-primary">Add</button>
      <button class="btn btn-primary" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
     </div>
   </div><!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
  </form>
    </div>
   </div>
  </div>
</div>

<script>
  $(document).ready(function() {            
	  $('#myTable12').DataTable();
  }); 

  function loadDetails(groupid,modalnm){
        // alert(groupid);
     $.ajax({
           url :"groupdetails/"+ groupid, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
                $.each(data, function(i, item) {
                    if(modalnm=="edit") 
                    {
                        $("#group_name").val(item.group_name);  
                        actionlink="{{url('/group-update')}}/"+groupid ;
                        $("#editForm").attr('action',actionlink);
                        $("#edit").modal();
                    }   
                    else
                    {
                        $("#group_id").val(item.group_id);
                        actionlink="{{url('/add-user')}}/"+groupid;
                        $("#addmemberform").attr('action',actionlink);
                        $("#addmember").modal();
                    }
                });
                
            }
        });
    
    }

//     function loadDetails12(groupid,modalnm){
      
//       $.ajax({
//         alert(groupid);  
//             url  :"group-list/"+ groupid, //php page URL where we post this data to view from database
//             type :'GET',
//             dataType: 'json',
//             success: function(data){
            
//                 $.each(data, function(i, item) {
//                     if(modalnm =="users") 
//                     {
//                         $("#groupnm").text(item.group_name);
//                         actionlink="{{url('/group-list')}}/"+groupid ;
//                         $("#viewForm").attr('action',actionlink);  
//                         $("#view").modal();
//                     }   
//                     else
//                     {
//                         $("#groupnm").text(item.group_name);
//                         $("#view").modal();
//                     }
//                 });
                
//             }
//         });
    
//     }
 
 </script>

@endsection