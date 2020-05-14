@extends('layouts.master')
@section('body')
<div class="wrapper">

<div id="content">
<div class="card-body viewList">
@foreach($docs as $doc)
@endforeach 
<label for="group_name" class="col-md-6 col-xs-5 col-form-label noPadMar">Doc Category: <b> {{$doc->doc_category_name}}</b></label>

<br>
<br>  
@include('flash-message')
<form method="post" action="{{url('/store-group-category')}}/{{$doc->doc_category_id}}">
@csrf
<table id="myTable11" class="table">
<thead>
  <tr>
   <th style="text-align:center;" width="10%">Sr.No.</th>
   <th style="text-align:center;" width="20%"> Groups</th>
   <th style="text-align:center;" width="70%">Member Assigned</th>
 
  </tr>
  </thead>
  <tbody>

 
 @foreach($group as $adm)
 
     <tr>
           <td>
           <input  type="checkbox" name="addgroup[]" value="{{$adm->group_id}}"  @foreach($assign_group as $ass) {{($adm->group_id == $ass->group_id)?'checked="checked"':''}} @endforeach>
           </td>
          
           <td>{{$adm->group_name}}</td>
          <td>
<?php  

$assign_member =  DB::table('mst_group_member') 
        ->select('*')
        ->join('mst_users','mst_users.user_id', '=', 'mst_group_member.user_id')
        ->where('mst_group_member.group_id', '=', $adm->group_id)
        ->where('mst_group_member.flag', 'Show')
        ->get();
        
?>
    
@foreach($assign_member as $ass)
{{$ass->name}},
@endforeach   
      </td> 
     </tr>
 
  @endforeach
  </tbody>
  
  </table>
  <button class="btn btn-success" type="submit" name="submit">Save</button>
</form>
 </div>
 </div>
 </div>
@endsection


<script>
    $(".popper").hover(function(){
    //.load should be here
    $('#pop2').fadeIn(8);
    
  },function(){
  $("#pop2").fadeOut(8);
});
</script>