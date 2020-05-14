@extends('layouts.master')
@section('body')
<div class="wrapper">

                <div id="content">
                    <div class="col9bg">
                        <!--col9bg start>-->
                        <div class="userList">
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12"> -->
                            <div class="container-fluid pageContent">
                                <div class="row admin">
                                @if (Auth::user()->role_id==1)
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="{{url('/company-setup-index')}}">
                                        <div class="box bgPink">
                                            <div class="content">                                             
                                              <span class="format">{{$company}}</span>
                                                <br>
                                                <p class="textx">Company Setup</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-building"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 ">
                                     <a href="{{url('/right-index')}}">
                                        <div class="box bgViolet">
                                            <div class="content">
                                            <span class="format">{{$right}}</span>
                                                <br>
                                                <p class="textx">Rights</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><i class="fas fa-check-circle" aria-hidden="true" ></i></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="{{url('/admin-index')}}">
                                        <div class="box bgBlue">
                                            <div class="content">
                                            <span class="format">{{$user_total}}</span>
                                                <br>
                                                <p class="textx">Admins</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"> <i class="fas fa-user-plus" aria-hidden="true"></i></a>
											</div>
                                        </div>
                                     </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="box bggreen">
                                            <div class="content">
                                                
                                                <span class="format">100</span>
                                                <br>
                                                <p class="textx">Users</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><i class="fas fa-users" aria-hidden="true" ></i> </i></a>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row closing -->
								<div class="row superAdmin">

                                @elseif (Auth::user()->role_id==2)
                                <div class="col-lg-3 col-md-6 col-sm-12 ">
                                   <a href="{{url('/designation-index')}}">
                                        <div class="box bgBlue">
                                            <div class="content">
                                                <span class="format">{{$designation}}</span>
                                                <br>
                                                <p class="textx">Designation</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><i class="fas fa-check-circle" aria-hidden="true" ></i></a>
											</div>
                                        </div>
                                      </a>
                                    </div>
								  <div class="col-lg-3 col-md-6 col-sm-12">
                                     <a href="{{url('/user-index')}}">
                                        <div class="box bggreen">
                                            <div class="content">
                                                
                                                <span class="format">{{$usercount}}</span>
                                                <br>
                                                <p class="textx">Users</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"> <i class="fas fa-user-plus" aria-hidden="true"></i></a>
											</div>
                                        </div>
                                       </a> 
                                    </div>
									<div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="{{url('/group-index')}}">
                                        <div class="box bgOrange">
                                            <div class="content">
                                                
                                                <span class="format">{{$groups}}</span>
                                                <br>
                                                <p class="textx">Groups</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><i class="fas fa-users"></i></a>
										  </div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="{{url('/doc-category-index')}}">
                                        <div class="box bgPink">
                                            <div class="content">
                                                
                                                <span class="format">{{$doc_cat}}</span>
                                                <br>
                                                <p class="textx">Document Categories</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-file"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    @elseif (Auth::user()->role_id==3)
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="">
                                        <div class="box bgPink">
                                            <div class="content">
                                                
                                                <span class="format"></span>
                                                <br>
                                                <p class="textx">Folders</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-file"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="">
                                        <div class="box bggreen">
                                            <div class="content">
                                                
                                                <span class="format"></span>
                                                <br>
                                                <p class="textx">Folders</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-file"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="">
                                        <div class="box bgBlue">
                                            <div class="content">
                                                
                                                <span class="format"></span>
                                                <br>
                                                <p class="textx">Folders</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-file"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                      <a href="">
                                        <div class="box bgOrange">
                                            <div class="content">
                                                
                                                <span class="format"></span>
                                                <br>
                                                <p class="textx">Folders</p>
                                            </div>
											<div class="rightcontent">
											<a href="JavaScript:;" class="format"><span class="fas fa-file"></span></a>
											</div>
                                        </div>
                                        </a>
                                    </div>
                                  @endif
                              </div>
                          </div>
                     </div>
                </div>
          </div>
     </div>
@endsection


