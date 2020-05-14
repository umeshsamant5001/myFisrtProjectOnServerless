@extends('layouts.master')
@section('body')
<div class="wrapper">



<div id="content">
<div class="card-body viewList" style="padding-left: 10%; padding-right: 10%;">
  <a class="btn btn-success btn-sm" href="{{url('/designation-create')}}">+ Add</a>
  <br>
  <br>
@include('flash-message')
<table id="myTable11" class="table">
<thead>
  <tr>
   <th width='4%'>Sr. No.</th>
   <th width='20%'>Designation</th>
   <th width='5%'>Edit</th>
   <th width='5%'>Delete</th>
  </tr>
  </thead>
  <tbody>
      @foreach($designation  as $adm)
      <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$adm->designation}}</td>
            <!--<td><a class="btn btn-success btn-sm" onclick="loadDetails('{{$adm->designation_id}}','view')"><i class="fas fa-eye" aria-hidden="true"></i></a></td> -->
            <td><a class="btn btn-info btn-sm" onclick="loadDetails('{{$adm->designation_id}}','edit')"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
            <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('designation-delete') }}/{{$adm->designation_id}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
        </tr>
        @endforeach  
  </tbody>
  </table>
 </div>
 </div>
 </div>
@foreach($designation  as $edit)
@endforeach
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Designation Details</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>
      
		<div class="modal-body">
			<div class="row noPadMar">				
				<div class="container viewdesignationdetail">
            <form method="post">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="row">
                               <div class="col-md-6">
                                   <label for="designation">Designation:</label>
                                </div>
                                <div class="col-md-6">
                                  <label id="dn"></label>
                                 </div>
                              </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
			</div>
   </div>
  <div class="modal-footer">
 <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>
 </div>
 </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
 </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Edit Designation  Details</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
    </div> 
    <div class="modal-body">
      <div class="row noPadMar">        
        <div class="container editcompanyDetail">
            <form method="post" id="editForm" action="">
            @csrf
            <input class="form-control hidden" type="text" name="designation_id" id="designation_id" value="" disabled>
               <div class="form-group row">
                 <label for="designation" class="col-md-4 col-form-label text-md-right">Designation Name:</label>
                   <div class="col-md-6">
                     <input type="text" class="form-control" value="" name="designation" id="designation" placeholder="Enter designation name" required="">
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
 </div>
</div>
</div>


<script>
  $(document).ready(function() {            
	  $('#myTable12').DataTable();
  }); 
  
    function loadDetails(designationid,modalnm){
 
      
       $.ajax({
            
            url  :"desidetails/"+ designationid, //php page URL where we post this data to view from database
            type :'GET',
            dataType: 'json',
            success: function(data){
              
                $.each(data, function(i, item) {
                 
                    if(modalnm=="edit") 
                    {
                        $("#designation").val(item.designation);          
                        $("#designation_id").val(item.designation_id)              
                        actionlink="{{url('/designation-update')}}/"+designationid ;
                        $("#editForm").attr('action',actionlink);
                        $("#edit").modal();
                    }    
                    else
                    {
                        $("#dn").text(item.designation);
                        $("#view").modal();
                    }
                });
                
            }
        });
    
    }
 
 
</script>
@endsection