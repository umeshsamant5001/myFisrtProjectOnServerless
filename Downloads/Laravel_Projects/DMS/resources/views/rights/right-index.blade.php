@extends('layouts.master')

@section('body')
<div class="wrapper">
  
     @if(count($right_edit) == 0)
     <div id="content">
     
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rights</div>
                <div class="card-body">
                  
                    <form method="post" action="{{url('right-store')}}">
                      @csrf
                       @include('flash-message')
                        <div class="form-group row">
                            <label for="doc_category_limit" class="col-md-4 col-form-label text-md-right">Document Category Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{old('doc_category_limit')}}" name="doc_category_limit" placeholder="Enter Doc. Category Limit">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="workflow_limit" class="col-md-4 col-form-label text-md-right">Work-Flow Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{old('workflow_limit')}}" name="workflow_limit" placeholder="Enter Work-Flow Limit" required="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cabinet_limit" class="col-md-4 col-form-label text-md-right">Cabinet Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{old('cabinet_limit')}}" name="cabinet_limit" placeholder="Enter Cabinet Limit" required="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="folders_limit" class="col-md-4 col-form-label text-md-right">Folder Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{old('folders_limit')}}" name="folders_limit" placeholder="Enter Folder LImit">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="folder_structure_level" class="col-md-4 col-form-label text-md-right">Folder Structure Level:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{old('folder_structure_level')}}" name="folder_structure_level" placeholder="Enter Folder Structure Level">

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
  </div>
 </div>
 </div>
  @elseif(count($right_edit) == 1)
  @foreach($right_edit as $edit)
  @endforeach
    <div id="content">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rights</div>
                <div class="card-body">
                    <form method="post" action="{{url('/right-update')}}/{{$edit->rights_id}}">
                    @csrf
                     @include('flash-message')
                        <div class="form-group row">
                            <label for="doc_category_limit" class="col-md-4 col-form-label text-md-right">Document Category Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{$edit->doc_category_limit}}" name="doc_category_limit" placeholder="Enter Doc. Category Limit">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="workflow_limit" class="col-md-4 col-form-label text-md-right">Work-Flow Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{$edit->workflow_limit}}" name="workflow_limit" placeholder="Enter Work-Flow Limit" required="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cabinet_limit" class="col-md-4 col-form-label text-md-right">Cabinet Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{$edit->cabinet_limit}}" name="cabinet_limit" placeholder="Enter Cabinet Limit" required="">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="folders_limit" class="col-md-4 col-form-label text-md-right">Folder Limit:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{$edit->folders_limit}}" name="folders_limit" placeholder="Enter Folder LImit">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="folder_structure_level" class="col-md-4 col-form-label text-md-right">Folder Structure Level:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" value="{{$edit->folder_structure_level}}" name="folder_structure_level" placeholder="Enter Folder Structure Level">

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                  Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endif
@endsection






