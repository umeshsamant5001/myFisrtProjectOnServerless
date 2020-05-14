@extends('layouts.master')
<!-- " -->
@section('body')
<div class="wrapper">


<div id="content">
<div class="card-body viewList">
  <a class="btn btn-success btn-sm" href="{{url('/user-create')}}">+ Add</a>
  <br>
  <br>
@include('flash-message')
<div class="table-responsive">
<table id="myTable11" class="table">
<thead>
  <tr>
   <th>Sr. No.</th>
   <th>Full Name</th>
   <th>Designaion</th>
   <th>Contact No</th>
   <th>Email ID</th>
   
   <th>Location</th>
   
   <th>Edit</th>
   <th>Delete</th>
  </tr>
  </thead>
  <tbody>
    @foreach($us_admin as $adm)
      <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{ $adm->name}}</td>
            <td>{{ $adm->designation}}</td>
            <td>{{ $adm->contact_no}}</td>
            <td>{{ $adm->email_id}}</td>
            <td>{{ $adm->location}}</td>
            <td><a class="btn btn-info btn-sm"  onclick="loadDetails('{{$adm->user_id}}','edit')"><i class="fas fa-edit" aria-hidden="true"></i></a></td>   
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('user-delete') }}/{{ $adm->user_id}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
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
      <h4>User Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
      
    <div class="modal-body">
      <div class="row noPadMar">        
        <div class="container editcompanyDetail">
            <form method="post" id="editForm" action="">
               @csrf
                <input class="form-control hidden" type="text" name="user_id" value="" disabled>
                   <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="name" id="name" value="" class="font-control" placeholder="Enter User Name" required="">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="contact_no" class="col-md-4 col-form-label text-md-right">Contact No.</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="" name="contact_no" id="contact_no" placeholder="Enter Contact No" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email_id" class="col-md-4 col-form-label text-md-right">Email:</label>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" value="" name="email_id" id="email_id" placeholder="Enter email" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">Username:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="" name="username" id="username" placeholder="Enter Username" required="">

                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                                                <div class="col-md-6">
                                                    <input type="password" class="form-control" value="" name="password" placeholder="Enter password">

                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label for="location" class="col-md-4 col-form-label text-md-right">Location:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="" name="location" id="location" placeholder="Enter Location">
                                                </div>
                                            </div>

                                              <div class="form-group row">
                                                <label for="designation" class="col-md-4 col-form-label text-md-right">Designation :</label>

                                                <div class="col-md-6">
                                                    <select type="text" name="designation" id="designation" class="form-control" placeholder="Enter Doc. Category Type" required="">
                                                  
                                                     @foreach($design as $desig)
                                                            <option value="{{$desig->designation}}" >{{$desig->designation}}</option>
                                                     @endforeach
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


  <script>

    function loadDetails(userid, modalnm){        
       $.ajax({
            
            url  :"details/"+userid, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
                $.each(data, function(i, item) {
                    if(modalnm=="edit") 
                    {
                        $("#name").val(item.name);
                        $("#contact_no").val(item.contact_no);
                        $("#email_id").val(item.email_id);
                        $("#username").val(item.username);
                        $("#designation").val(item.designation);
                        $("#location").val(item.location);
                        actionlink="{{url('/user-update')}}/"+userid;
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
 
  </script>
@endsection