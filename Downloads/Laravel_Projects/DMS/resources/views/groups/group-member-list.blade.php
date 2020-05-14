@extends('layouts.master')
<!-- " -->
@section('body')
<div class="wrapper">

<div id="content">
<div class="card-body viewList">


	<div class="row noPadMar">        
        <div class="container editgroupDetail">
        <form method="post" action="{{url('/add-member')}}/{{$id}}">
        @csrf
  <div class="form-group row groupSelectbox">
    <label for="group_name" class="col-md-6 col-xs-5 col-form-label noPadMar">Group Name: <b> {{$group_name}}</b></label>
       <div class="col-sm-5 col-xs-6">
				  <label for="add_member" class="col-form-label col-sm-4 selectboxmar">Add Member :</label> 
						<select id="multiple-checkboxes" name="adduser[]" class="dropdown" multiple="multiple">
              @foreach($users_list as $use)
              <option value="{{$use->user_id}}">{{$use->name}}</option>
            @endforeach
    </select>
  </div>
	<div class="col-sm-1 col-xs-1 noPadMar">
	<button type="submit" class="btn btn-primary noPadMar" style="float:right;width:80px;padding:6px;">Add</button>
	</div>
</div>                                        
 </form>
<br>
<br>
  
 @include('flash-message')
  <table id="myTable12" class="table" >
    <thead>
        <tr>
          <th>Sr. No.</th>
          <th>User Name</th>
          <th>Remove</th>  
        </tr>
    </thead>
    <tbody>
      @foreach($user_data as $use_da)  
        <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$use_da->name}}</td>
     <td><button class="btn btn-danger btn-sm"><a  style="color:white;" href="{{url('/delete-group-member')}}/{{$use_da->group_member_id}}"><span class="glyphicon glyphicon-remove"></span> Remove</a></button></td> 
     </tr>
     @endforeach
  </tbody>
</table>
     
<script>
  $(document).ready(function() {            
	  $('#myTable12').DataTable();
	   $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
        });
</script>
 
</div>
 </div>
 </div>
 </div>

@endsection