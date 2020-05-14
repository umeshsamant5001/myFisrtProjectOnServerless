@extends('layouts.master')

@section('body')
<div class="wrapper">

                <div id="content">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Admin</div>
                                    <div class="card-body">
                                        <form method="post" action="{{url('/admin-store')}}">
                                          @csrf

                                          @include('flash-message')
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Full Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" name="name" maxlength="150" value="{{old('name')}}" class="form-control" placeholder="Enter User Name" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="contact_no" class="col-md-4 col-form-label text-md-right">Contact No.</label>

                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" maxlength="20" value="{{old('contact_no')}}" name="contact_no" placeholder="Enter Contact No" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email_id" class="col-md-4 col-form-label text-md-right">Email:</label>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" maxlength="150" value="{{old('email_id')}}" name="email_id" placeholder="Enter email" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">Username:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" maxlength="150" value="{{old('username')}}" name="username" placeholder="Enter Username" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                                                <div class="col-md-6">
                                                    <input type="password" class="form-control" maxlength="150" value="{{old('password')}}" name="password" placeholder="Enter password" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="location" class="col-md-4 col-form-label text-md-right">Location:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" maxlength="150" value="{{old('location')}}" name="location" placeholder="Enter Location">
                                                </div>
                                            </div>


                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button type="btn" class="btn btn-primary" data-dismiss="modal"><a style="color:white;" href="{{url('/admin-index')}}">Close</a></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                     </div>
                </div>
           </div>
@endsection