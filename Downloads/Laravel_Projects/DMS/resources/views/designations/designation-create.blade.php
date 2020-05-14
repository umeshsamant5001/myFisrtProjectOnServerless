@extends('layouts.master')

@section('body')
<div class="wrapper">

                <div id="content">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Designation</div>
                                    <div class="card-body">
                                        <form method="post" action="{{url('/designation-store')}}">
                                          @csrf

                                          @include('flash-message')

                                            <div class="form-group row">
                                                <label for="designation" class="col-md-4 col-form-label text-md-right">Designation Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="designation" placeholder="Enter designation Name" required="">

                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-primary btn-xs">
                                                        Save
                                                    </button>
                                                   <button type="btn" class="btn btn-primary btn-xs" data-dismiss="modal"><a style="color:white;" href="{{url('/designation-index')}}">Close</a></button>
                                                </div>
                                            </div>
                                        </form>
                                         </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
           </div>
@endsection