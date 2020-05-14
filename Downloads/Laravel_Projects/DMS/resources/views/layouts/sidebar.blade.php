
<?php $url=$_SERVER['REQUEST_URI']; ?>
<nav id="sidebar">
    <ul class="list-unstyled components">
    @if(Auth::user()->role_id==1) 
        <li class="collapseAll">
            <a href="{{url('/home')}}" <?php if($url=='/dms/home'){ ?> class="active" <?php } ?> ><span class="glyphicon glyphicon-th"></span><span class="nav-text">Dashboard</span></a>
        </li>
        <li>
            <a href="{{url('/company-setup-index')}}" <?php if($url=='/dms/company-setup-index'){ ?>class="active" <?php } ?>>
                <span class="fas fa-building"></span><span class="nav-text">Company Setup</span>
            </a>
            <!--<ul class="list-unstyled collapse in" id="patient">
                        <li>
                          <a href="newpatient.html"> <i class="fas fa-user-plus"></i>New Patient</a>
                        </li>
                        <li>
                            <a href="patientvisit.html"><i class="fas fa-briefcase-medical"></i>Patient Visit</a>
                        </li>
                        <li>
                            <a href="newpatientlist.html"><i class="fas fa-user-md"></i>Patient List</a>
                        </li>
                </ul>-->
        </li>
        <li>
            <a href="{{url('right-index')}}"  <?php if($url=='/dms/right-index'){ ?> class="active" <?php } ?> >
                <i class="fas fa-check-circle"></i><span class="nav-text"> Rights</span>
            </a>
        </li>
        <li>
            <a href="{{url('admin-index')}}" <?php if($url=='/dms/admin-index'){ ?> class="active" <?php } ?> >
                <span class="fa fa-user"></span><span class="nav-text">Create Admin</span>
            </a>    
        </li>

        @elseif (Auth::user()->role_id==2)
        <li class="collapseAll">
            <a href="{{url('/home')}}" <?php if($url=='/dms/home'){ ?> class="active" <?php } ?>><span class="glyphicon glyphicon-th"></span><span class="nav-text">Dashboard</span></a>
        </li>
        <li>
            <a href="{{url('/designation-index')}}" <?php if($url=='/dms/designation-index'){ ?> class="active" <?php } ?>> <i class="fas fa-tasks"></i><span class="nav-text">Designation</span></a>
        </li>
        <li>
            <a href="{{url('/user-index')}}" <?php if($url=='/dms/user-index'){ ?> class="active" <?php } ?>> <i class="fas fa-user-plus"></i><span class="nav-text">Users</span></a>
        </li>
        <li>
            <a href="{{url('/group-index')}}" <?php if($url=='/dms/group-index'){ ?> class="active" <?php } ?>><i class="fas fa-users"></i><span class="nav-text">Groups</span></a>
        </li>
        <li>
            <a href="{{url('/doc-category-index')}}" <?php if($url=='/dms/doc-category-index'){ ?> class="active" <?php } ?>> <i class="fas fa-file"></i><span class="nav-text">Document Categories</span></a>
        </li>
        <li>
            <a href="{{url('/cabinet-index')}}" <?php if($url=='/dms/cabinet-index'){ ?> class="active" <?php } ?>> <i class="fas fa-folder"></i><span class="nav-text">Cabinet</span></a>
        </li>
        <li>
          <a href="{{url('/foldertree')}}" <?php if($url=='/dms/folder-listadmin'){ ?> class="active" <?php } ?>> <i class="fas fa-file"></i><span class="nav-text">Folders Tree</span></a>
        </li>
        @elseif (Auth::user()->role_id==3)
        <li class="collapseAll">
         <a href="{{url('/home')}}" <?php if($url=='/dms/home'){ ?> class="active" <?php } ?>><span class="glyphicon glyphicon-th"></span><span class="nav-text">Dashboard</span></a>
        </li>
        <li>
          <a href="{{url('/folder-list')}}" <?php if($url=='/dms/folder-list'){ ?> class="active" <?php } ?>> <i class="fas fa-file"></i><span class="nav-text">Folders</span></a>
        </li>
        @endif
    </ul>

</nav>
<script>
$('#sidebar li a').click(function(){
    $(this).addClass("active");
    $('#sidebar li a').removeClass("active");
});
</script>