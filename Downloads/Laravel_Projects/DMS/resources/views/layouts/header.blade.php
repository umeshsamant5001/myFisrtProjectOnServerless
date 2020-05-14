<!DOCTYPE html>
<html>
<head>
<!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!--<link rel="icon" href="images/favicon.png">-->
    <!-- core CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/responsive.css')}}" rel="stylesheet">

    <link href="{{asset('/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/css/mediaquery.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9f216c388.js" crossorigin="anonymous"></script>
    <script defer src="https://pro.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

</head>
<body>
<header id="header">
	<nav class="navbar">
				<div class="col-sm-2 col-xs-12"> 
				<div class="logo"><h1>Nexa Docs</h1></div>
				</div>
                <div class="col-sm-5 col-xs-12"> 
                    <button type="button" id="sidebarCollapse" class="toggle col-sm-1 col-xs-2" style="text-align: left;">
                        <i class="fa fa-bars" style="font-weight:400;"></i>
                    </button>
                   <h1>Document Management System</h1>
				</div>   
               <div class="info col-sm-5 col-xs-12">
               
                    <img src="{{asset('images/person_icon.png')}}"></a>
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">{{ Auth::user()->name }} <span class="caret"></span></button>
                        <div id="myDropdown" class="dropdown-content">
                          <a data-toggle="modal" data-target="#myAccount">Profile <i class="fa fa-user"></i></a>
                          <!-- <a href="{{ url('logout') }}">Log Out <i class="fas fa-sign-out-alt"></i></a> -->
                          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} 
                                        <i class="fas fa-sign-out-alt"></i>    </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                         </form>
                        </div>
                      </div>
                 </div>       
            </nav>
      </header>
<!-- close header  -->