@extends('layouts.master')

@section('body')
<div class="wrapper">

                <div id="content">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Doc. Category</div>
                                    <div class="card-body">
                                    
                                        <form method="post" action="{{url('/doc-category-store')}}">
                                          @csrf

                                          @include('flash-message')

                                          <div class="form-group row">
                                                <label for="doc_category_caption" class="col-md-4 col-form-label text-md-right">Caption :</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="doc_category_caption" placeholder="Enter Doc. Category Caption" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="doc_category_name" class="col-md-4 col-form-label text-md-right"> Name :</label>

                                                <div class="col-md-6">
                                                    <input type="text" name="doc_category_name" class="form-control" placeholder="Enter Doc. Category Name" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="doc_category_desc" class="col-md-4 col-form-label text-md-right"> Description :</label>

                                                <div class="col-md-6">
                                                <textarea rows="4" type="text" class="form-control" value="" name="doc_category_desc" placeholder="Enter Doc. Category Description"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="doc_category_type" class="col-md-4 col-form-label text-md-right">Type :</label>

                                                <div class="col-md-6">
                                                    <select type="text" name="doc_category_type" class="form-control" placeholder="Enter Doc. Category Type" required="">
                                                    <option value="">Select Document Type</option>
                                                    <option value="Simple">Simple</option>
                                                    <option value="Workflow">Workflow</option>
                                                    <option value="Document Template">Document Template</option>
                                                    </select>

                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-5">
                                                    <button type="submit" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button type="btn" class="btn btn-primary" data-dismiss="modal"><a style="color:white;" href="{{url('/doc-category-index')}}">Close</a></button>
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
