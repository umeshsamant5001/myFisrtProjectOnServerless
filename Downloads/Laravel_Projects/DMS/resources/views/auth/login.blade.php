<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> DMS - Document Management System </title>
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
    
 </head>
    <!------ Include the above in your HEAD tag ---------->
            <body>
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-5 col-xs-12" id="login">
                            <div class="card" style="padding:0;">
                              <div class="card-header">Login</div>
                                <div class="card-body">
                                  <div id="login-column" class="col-sm-12">
                              <div id="login-box" class="col-md-12">
                               @include('flash-message')
                               <form id="login-form" class="form" action="{{ url('login')}}" method="post">
                                @csrf
                                 <div class="form-group row">
                                                <label for="email_id" class="col-md-4 col-form-label text-md-right">Username:</label>

                                                <div class="col-md-7">
                                                    <input type="email" name="email_id" id="email_id"  class="form-control text-feild" required="">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                                                <div class="col-md-7">
                                                    <input type="password" id="password" name="password" class="form-control text-feild" required="">

                                                </div>
                                            </div>

                
                           <div class="form-group">
                            </label><div id="register-link" class="text-right">
                                <a href="{{route('register')}}" class="text-info"></a>
                            </div>
							</div>
							 <div class="form-group">
							 <div class="col-md-3 offset-md-5">
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
							</div>
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
</body>
