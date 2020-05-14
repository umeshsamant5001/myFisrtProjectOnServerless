<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta Content-Type='application/pdf'>
<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <?php
  $url=$_SERVER['REQUEST_URI'];
   $url; ?>
   <?php $url=$_SERVER['REQUEST_URI']; ?>
   
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
    <link href="{{asset('/css/multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap-treeview.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css">
    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> 
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9f216c388.js" crossorigin="anonymous"></script>
    <script defer src="https://pro.fontawesome.com/releases/v5.1.0/js/all.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

</head>
<body>
<header id="header">
	<nav class="navbar">
				<div class="col-sm-2 col-xs-12"> 
				<div class="logo"><img src="{{asset('/images/nexadocs_logo.jpeg')}}" style='height:50px;width:200px;'></div>
				</div>
                <div class="col-sm-3 col-xs-12"> 
                
                <h1>Document Management System</h1>
                
				</div> 
				
			     @if(Auth::user()->role_id==1) 
				
			    	<div class="info col-sm-2 col-xs-12">
				    <a href="{{url('/company-setup-index')}}" <?php if($url=='/dms/company-setup-index'){ ?>class="active" <?php } ?>> Comapany Setup </a>
				    </div>
				    
				     <div class="info col-sm-1 col-xs-12">
				    <a href="{{url('/right-index')}}" <?php if($url=='/dms/right-index'){ ?>class="active" <?php } ?>> Rights </a>
				    </div>
				    
				    <div class="info col-sm-1 col-xs-12">
				    <a href="{{url('/admin-index')}}" <?php if($url=='/dms/admin-index'){ ?>class="active" <?php } ?>> Admins  </a>
				    </div>
			     
			      @elseif(Auth::user()->role_id==2)
			      <div class="info col-sm-1 col-xs-12">
				    
				    </div>
				     <div class="info col-sm-1 col-xs-12">
				    
				    </div>
				    
			       <div class="info col-sm-1 col-xs-12">
				   <div class="dropdown">
                     <button onclick="myFunction1()" class="dropbtn">Masters <span class="caret"></span></button>
                        <div id="myDropdown1" class="dropdown-content">
                          <a href="{{url('/designation-index')}}" <?php if($url=='/dms/designation-index'){ ?>class="active" <?php } ?>> Designation </a>
                          <a href="{{url('/user-index')}}" <?php if($url=='/dms/user-index'){ ?>class="active" <?php } ?>> Users </a>
                         
                        <a href="{{url('/group-index')}}" <?php if($url=='/dms/group-index'){ ?>class="active" <?php } ?>> Groups  </a>
                    
                       </div>
                    </div>
				  
				    </div>
				    
				 
				    
				    <div class="info col-sm-1 col-xs-12">
				    <a href="{{url('/doc-category-index')}}" <?php if($url=='/dms/doc-category-index'){ ?>class="active" <?php } ?>> Document Categories </a>
				    </div>
				    
				     <div class="info col-sm-1 col-xs-12">
				    <a href="{{url('/cabinet-index')}}" <?php if($url=='/dms/cabinet-index'){ ?>class="active" <?php } ?>> Cabinets </a>
				    </div>
				    
				    @endif
                <div class="info col-sm-2 col-xs-12">
                 <img src="{{asset('/images/person_icon.png')}}"></a>
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">{{ Auth::user()->name }} <span class="caret"></span></button>
                        <div id="myDropdown" class="dropdown-content">
                          <a data-toggle="modal" data-target="#myAccount">Profile <i class="fa fa-user"></i></a>
                          
                          <a data-title="changepwd" data-toggle="modal" data-target="#changepwd">Change Password <i class="fas fa-edit"></i></a>
                          
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

@yield('body')



<div class="modal fade" id="changepwd" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
   <div class="modal-dialog">
   <form method="post" action="{{url('/password-change')}}/{{Auth::user()->user_id}}">
   @csrf
    <div class="modal-content">
		<div class="modal-header">
			<h4><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Change Password</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>  
		<div class="modal-body">
			<div class="row noPadMar">				
				<div class="container viewgroupdetail">
       
          <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                      
						<div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="old_password" required="" autocomplete="new-password">
             </div>
            </div>

						<div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm password</label>
              <div class="col-md-6">
              <input id="password" type="password" class="form-control " name="new_password" required="" autocomplete="new-password">
              </div>
             </div>
          
        </div>
			</div>
   </div>
  <div class="modal-footer">
  <button type="submit" name="submit" class="btn btn-primary">Submit </button>
  <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>
 </div>
 </div><!-- /.modal-content -->
 </form>
 </div><!-- /.modal-dialog -->
 </div>



   <div id="footer">
     <div class="row">
         <div class="col-sm-5 col-xs-12 footerLeft">
            Copyright © 2020 All Rights Reserved <a href="{{url('/')}}"> - Document Management System</a>
         </div>
          <div class="col-sm-2 col-xs-12" ></div>
         <div class="col-sm-5 col-xs-12 footerRight">
            Powered by <a href="https://www.nexasoftware.com/">Nexa Software</a>
         </div>
        </div>
      </div>
    </div>
      
  
    <script>
   /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      
      }
      function myFunction1() {
     
        document.getElementById("myDropdown1").classList.toggle("show");
      }

      // Close the dropdown if the user clicks outside of it
      window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        }
      }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $( ".faq-links1" ).hide();
            $('#sidebarCollapse').on('click', function () {
              $('#content').toggleClass('active')
                $('#sidebar').toggleClass('active');
            });
            
            $("#btnPlus").click(function(){
               $( "#sidebar ul ul" ).toggleClass("collapse show  collapse in");
               $( ".faq-links" ).hide();
                $( ".faq-links1" ).show();
            });
    
            $("#btnMinus").click(function(){
                $( "#sidebar ul ul" ).toggleClass("collapse show  collapse in");
                     $( ".faq-links" ).show();
                     $( ".faq-links1" ).hide();
               });
           });
          
          $('#sidebar ul li a').click(function(){
              $(this).addClass("active");
              $('#sidebar ul li a').removeClass("active");
          });
</script>
<script src="{{asset('js/jquery.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script>
  $(document).ready(function() { 
            

             
     $('#myTable11').DataTable();


        }); 
      </script>
       

        <script type="text/javascript">

$(document).ready(function () {
   $('#other').hide();
        $('#types').change(function () {
            if ($('#types').val() == 'No') {
                $('#other').hide();
            
            }
            else  {
                $('#other').show();
            }
        });
    });

$(document).ready(function () {
   $('#other_value').hide();
        $('#type_value').change(function () {
            if ($('#type_value').val() == 'no') {
                $('#other_value').hide();
            
            }
            else  {
                $('#other_value').show();
            }
        });
    });
    

     /* Variables */
     var p = $("#participants").val();
        var row = $(".participantRow");

        /* Functions */
        function getP() {
            p = $("#participants").val();
        }

        function addRow() {
            row.clone(true, true).appendTo("#participantTable");
        }

        function removeRow(button) {
            button.closest("tr").remove();
        }
        /* Doc ready */
        $(".add").on('click', function() {
            getP();
            if ($("#participantTable tr").length < 17) {
                addRow();
                var i = Number(p) + 1;
                $("#participants").val(i);
            }
            $(this).closest("tr").appendTo("#participantTable");
            if ($("#participantTable tr").length === 2) {
                $(".remove").hide();
            } else {
                $(".remove").show();
            }
        });
        $(".remove").on('click', function() {
            getP();
            if ($("#participantTable tr").length === 2) {
                //alert("Can't remove row.");
                $(".remove").hide();
            } else if ($("#participantTable tr").length - 1 == 2) {
                $(".remove").hide();
                removeRow($(this));
                var i = Number(p) - 1;
                $("#participants").val(i);
            } else {
                removeRow($(this));
                var i = Number(p) - 1;
                $("#participants").val(i);
            }
        });
        $("#participants").change(function() {
            var i = 0;
            p = $("#participants").val();
            var rowCount = $("#participantTable tr").length - 2;
            if (p > rowCount) {
                for (i = rowCount; i < p; i += 1) {
                    addRow();
                }
                $("#participantTable #addButtonRow").appendTo("#participantTable");
            } else if (p < rowCount) {}
        });

</script>

<script>
window.onscroll = function() {myFunctionsticky()};

var navbar = document.getElementById("header");
var sticky = navbar.offsetTop;

function myFunctionsticky() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

<script>
$(document).ready(function() {               
$('#myTable12').DataTable();
        });
$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            // $(this).attr('title', 'Expand this branch').find(' > i').addClass('fas fa-folder-open').removeClass('fas fa-folder-close');
        } else {
            children.show('fast');
            // $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fas fa-folder-open').removeClass('fas fa-folder-close');
        }
        e.stopPropagation();
    });
});

</script>

<script>
$(".uploadfileSec").hide(); 
$(document).ready(function() {   
$(".uploadfileSec").hide();            

  });
  
$(".uploadfileBtn").click(function(){
  $(this).hide();
  $(".uploadfileSec").show();

});
$(".filesubmitBtn").click(function(){
$(".uploadfileBtn").show();
$(".uploadfileSec").hide();  
});

</script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/js/multiselect.js')}}"></script>
    <script src="{{asset('/js/bootstrap-treeview.js')}}"></script>
</body>
</html>