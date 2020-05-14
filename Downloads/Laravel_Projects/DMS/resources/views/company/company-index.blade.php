@extends('layouts.master')
@section('body')  
  <div class="wrapper">
   
       @if(count($edit_data) == 0)
        <div id="content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Company Setup</div>
                           
                                <div class="card-body">
                                     @include('flash-message')
                                    <form method="post" action="{{url('/company-setup-store')}}">
                                        @csrf
                                            <div class="form-group row">
                                                <label for="comp_name" class="col-md-4 col-form-label text-md-right">Company Name:</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" value="{{old('comp_name')}}" name="comp_name" placeholder="Enter Company Name" value="" required>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="contact_no" class="col-md-4 col-form-label text-md-right">Contact No.</label>

                                                <div class="col-md-6">
                                                    <input id="contact_no" type="number" class="form-control" value="{{old('contact_no')}}" name="contact_no" value="" placeholder="Enter Contact No" required>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email_id" class="col-md-4 col-form-label text-md-right">Email:</label>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" placeholder="Enter email" value="{{old('email_id')}}" name="email_id" value="" required="" autocomplete="email_id">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>

                                                <div class="col-md-6">
                                                    <textarea rows="3" type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Enter Address"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pwd" class="col-md-4 col-form-label text-md-right">Password Reset:</label>

                                                <div class="col-md-6">
                                                    <select type="password" class="form-control" name="password_reset" placeholder="Enter password" id="types">
                                                        <option>Select One</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="other">
                                                <label for="days" class="col-md-4 col-form-label text-md-right">After No Of Days :</label>

                                                <div class="col-md-6">
                                                    <select type="number" class="form-control" name="after_no_of_days" placeholder="Enter No Of Days">
                                                        <option value="">Select Days</option>
                                                        <option value="30">30 Days</option>
                                                        <option value="60">60 Days</option>
                                                        <option value="90">90 Days</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="app_name" class="col-md-4 col-form-label text-md-right">Application Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="{{old('app_name')}}" name="app_name" placeholder="Enter Application Name" required>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="db_name" class="col-md-4 col-form-label text-md-right">Database Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="{{old('db_name')}}" name="db_name" placeholder="Enter Database Name">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" name="sumbit" class="btn btn-primary">
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
                @elseif(count($edit_data) == 1)
                @foreach($edit_data as $edit)
                @endforeach
                <div id="content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Company Setup</div>
                                <div class="card-body">
                                     @include('flash-message')
                                    <form method="post" action="{{url('/company-setup-update')}}/{{$edit->comp_id}}">
                                        @csrf
                                            <div class="form-group row">
                                                <label for="comp_name" class="col-md-4 col-form-label text-md-right">Company Name:</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" value="{{$edit->comp_name}}" name="comp_name" placeholder="Enter Company Name" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="contact_no" class="col-md-4 col-form-label text-md-right">Contact No.</label>

                                                <div class="col-md-6">
                                                    <input id="contact_no" type="number" class="form-control" value="{{$edit->contact_no}}" name="contact_no" value="" placeholder="Enter Contact No" required>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email_id" class="col-md-4 col-form-label text-md-right">Email:</label>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" placeholder="Enter email" value="{{$edit->email_id}}" name="email_id" value="" required="" autocomplete="email_id">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>

                                                <div class="col-md-6">
                                                    <textarea rows="3" type="text" class="form-control" value="{{$edit->address}}" name="address" placeholder="Enter Address">{{$edit->address}}</textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pwd" class="col-md-4 col-form-label text-md-right">Password Reset:</label>
                                                 <div class="col-md-6">
                                                    <select type="password" class="form-control" name="password_reset" placeholder="Enter password" id="types">
                                                        <option value="{{$edit->password_reset}}">{{$edit->password_reset}}</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                        @if($edit->password_reset == 'Yes')
                                            <div class="form-group row" id="other">
                                                <label for="days" class="col-md-4 col-form-label text-md-right">After No Of Days :</label>

                                                <div class="col-md-6">
                                                    <select type="number" class="form-control" name="after_no_of_days" placeholder="Enter No Of Days">
                                                        <option value="{{$edit->after_no_of_days}}">{{$edit->after_no_of_days}}</option>
                                                        <option value="30">30 Days</option>
                                                        <option value="60">60 Days</option>
                                                        <option value="90">90 Days</option>
                                                    </select>

                                                </div>
                                            </div>
                                        @else
                                        <div class="form-group row" id="other">
                                                <label for="days" class="col-md-4 col-form-label text-md-right">After No Of Days :</label>

                                                <div class="col-md-6">
                                                    <select type="number" class="form-control" name="after_no_of_days" placeholder="Enter No Of Days">
                                                        <option value="">Select After No Of Days</option>
                                                        <option value="30">30 Days</option>
                                                        <option value="60">60 Days</option>
                                                        <option value="90">90 Days</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group row">
                                                <label for="app_name" class="col-md-4 col-form-label text-md-right">Application Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="{{$edit->app_name}}" name="app_name" placeholder="Enter Application Name" required>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="db_name" class="col-md-4 col-form-label text-md-right">Database Name:</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" value="{{$edit->db_name}}" name="db_name" placeholder="Enter Database Name">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" name="submit" class="btn btn-primary">
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

 




