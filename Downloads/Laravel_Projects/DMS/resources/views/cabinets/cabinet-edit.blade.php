@include('layouts.app')

@extends('dashboard.header')

<div class="container">
  <h2>Company Registration form</h2>
  <br>

  @foreach($cabinet_edit as $edit)
  @endforeach
  <form action="{{url('/cabinet-update')}}/{{$edit->cabinet_id}}" method="post">
  @csrf
 
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

    <div class="form-designation">
      <label for="cabinet_name"> Name :</label>
      <input type="text" class="form-control" value="{{$edit->cabinet_name}}" name="cabinet_name"  placeholder="Enter designation Name">
    </div>

    <div class="form-group">
      <label for="cabinet_size">Cabinet Size:</label>
      <input type="number" class="form-control"  value="{{$edit->cabinet_size}}" name="cabinet_size"  placeholder="Enter Cabinet Size">
    </div>

    <div class="form-group">
      <label for="cabinet_description">Cabinet Description:</label>
      <input type="text" class="form-control"  value="{{$edit->cabinet_description}}" name="cabinet_description"  placeholder="Enter Cabinet Description">
    </div>

   
    <button type="submit" class="btn btn-success">Update</button>
  </form>
</div>

