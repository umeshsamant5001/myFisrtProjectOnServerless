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
<form method="post" action="{{url('/store-folder-category')}}/{{$doc->doc_category_id}}">
@csrf
<table id="myTable11" class="table">
<thead>
  <tr>
   <th></th>
   <th>Folders</th>
   <th>Remove</th>
  </tr>
  </thead>
  <tbody>
      @foreach($folder as $folder)
      <tr>
       <td><input  type="radio" name="addfolder" value="{{$folder->cabinet_id}}" {{($folder->cabinet_id == $doc->folder_id) ?  "checked" : "" }} ></td>
        <td><i class="fas fa-folder" style="color: #F8D775;"></i> {{$folder->cabinet_name}}</td>
        <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{ url('group-delete') }}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
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