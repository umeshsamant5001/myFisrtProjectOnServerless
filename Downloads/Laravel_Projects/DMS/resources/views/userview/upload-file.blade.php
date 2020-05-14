@extends('layouts.master')

@section('body')
<div class="wrapper">

@include('layouts.sidebar')

<div id="content" class="folderStructure viewList">
<div class="row">
    <div class="col-md-6">
<form action="{{url('/new-file-upload')}}" method="post" enctype="multipart/form-data">
 @csrf 
 <input type="file" name="new_file">
  <input class="btn btn-success" type="submit" name="submit">
</form>
</div>
</div>
</div> 
@endsection
