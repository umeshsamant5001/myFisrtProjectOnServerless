@extends('layouts.master')
<!-- " -->
@section('body')
<div class="wrapper">


<div id="content">
<div class="card-body viewList">
  <a class="btn btn-success btn-sm" href="{{url('/cabinet-create')}}">+ Add</a>
  <br>
  <br
  >
@include('flash-message')
<div class="table-responsive">
<table id="myTable11" class="table">
<thead>
  <tr>
   <th>Sr. No.</th>
   <th>Name</th>
   <th>Size</th>
   <th>Description</th>
   <!--<th>Create Folder</th>-->
   <!--<th>Folders</th>-->
   <th>Edit</th>
   <th>Delete</th>
  </tr>
  </thead>
  <tbody>
    @foreach($cabinet as $adm)
      <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{ $adm->cabinet_name}}</td>
            <td>{{ $adm->cabinet_size}}</td>
            <td>{{ $adm->cabinet_description}}</td>
            <!--<td><button class="btn btn-success btn-sm"><a onclick="addDetails('{{$adm->cabinet_id}}','add')"><i class="fas fa-plus" aria-hidden="true"></i> Create SubFolder</a></button></td>-->
            <!--<td><a class="btn btn-success btn-sm" href="{{url('/folder-list')}}/{{$adm->cabinet_id}}"><i class="fas fa-eye"></i></a></td>-->
            <td><a class="btn btn-info btn-sm"  onclick="loadDetails('{{$adm->cabinet_id}}','edit')"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('/subfolder-delete') }}/{{ $adm->cabinet_id}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        @endforeach
  </tbody>
  </table>
  </div>
 </div>
 </div>
 </div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4>&nbsp;&nbsp;Cabinet Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>

    <div class="modal-body">
      <div class="row noPadMar">
        <div class="container editcompanyDetail">
            <form method="post" id="editForm" action="{{url('/cabinet-update')}}">
               @csrf
                <input class="form-control hidden" type="text" name="cabinet_id" value="" disabled>
                   <div class="form-group row">
                                           <label for="cabinet_name" class="col-md-4 col-form-label text-md-right">Name :</label>
                                               <div class="col-md-6">
                                                   <input type="hidden" id="currentPath1" name="currentPath1" value="cabinet_management/"/>
                                                    <input type="text" class="form-control" name="cabinet_name" id="cabinet_name" value="" class="font-control" placeholder="Enter User Name" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cabinet_size" class="col-md-4 col-form-label text-md-right">Size :</label>

                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" value="" name="cabinet_size" id="cabinet_size" placeholder="Enter Contact No" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                                <div class="col-md-6">
                                                    <textarea rows="4" type="text" class="form-control" value="" name="cabinet_description" id="cabinet_description" placeholder="Enter Description"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" name="submit" class="btn btn-primary">
                                                        Update
                                   </button>
                               </div>
                        </div>
                </form>
        </div>
       </div>
      </div>
    <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
  </div>
      <!-- /.modal-dialog -->
 </div>


<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4>&nbsp;&nbsp;Cabinet Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>

    <div class="modal-body">
      <div class="row noPadMar">
        <div class="container editcompanyDetail">

            <form method="post" action="{{url('/subfolder-create')}}" id="addForm" >
               @csrf
                <input class="form-control hidden" type="text" id="cabinet_id" name="cabinet_id" value="">
                   <div class="form-group row">
                                           <label for="cabinet_name" class="col-md-4 col-form-label text-md-right">Name :</label>
                                               <div class="col-md-6">
                                                    <input type="text" class="form-control" name="cabinet_name"  class="font-control" placeholder="Enter User Name" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cabinet_size" class="col-md-4 col-form-label text-md-right">Size :</label>

                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" value="" name="cabinet_size"  placeholder="Enter Contact No" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cabinet_description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                                <div class="col-md-6">
                                                    <textarea rows="4" type="text" class="form-control" value="" name="cabinet_description" id="cabinet_description" placeholder="Enter Description"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                        <button type="submit" name="submit" class="btn btn-success"></button>Add
                        </button>
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



<script>

function loadDetails(cabinetid, modalnm){
   $.ajax({
      url  :"cabinetdetails/"+ cabinetid, //php page URL where we post this data to view from database
        type :'GET',
        dataType: 'json',
        success: function(data){
            $.each(data, function(i, item) {
                if(modalnm=="edit")
                {
                    $("#cabinet_name").val(item.cabinet_name);
                    $("#cabinet_size").val(item.cabinet_size);
                    $("#cabinet_description").val(item.cabinet_description);
                    actionlink="{{url('/cabinet-update')}}/"+cabinetid ;
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

function addDetails(cabinetid, modalnm){

$.ajax({
   url  :"subfolder/"+ cabinetid, //php page URL where we post this data to view from database
     type :'GET',
     dataType: 'json',
     success: function(data){
         $.each(data, function(i, item) {
             if(modalnm=="add")
             {

                 $("#cabinet_id").val(item.cabinet_id);
                 $("#cabinet_name").val(item.cabinet_name);
                 actionlink="{{url('/subfolder-create')}}/"+ cabinetid ;
                 $("#addForm").attr('action',actionlink);
                 $("#add").modal();
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


</script>
@endsection
