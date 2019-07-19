 <nav class="main-header navbar-default navbar navbar-inverse navbar-expand bg-white navbar-light border-bottom fixed-top" >
      <div class="container-fluid">
              <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
           
             </li>
           
        
        </ul>

        <!-- SEARCH FORM -->

        <!-- Right navbar links -->
        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item">
                <a href="" class="nav-link" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-arrow-right"></i>
                    <span class="nav-link-text">Keluar</span></a>
            </li>
        </ul>
    </div>
         

    </nav>
   
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 450px !important;">
        <a href="dashboard.php" class="brand-link">   
            <img src="../assets/img/logo.png"  alt="Logo Aqua" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Pelaporan</span>
        </a>
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                    

                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fa  fa-area-chart" aria-hidden="true"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <div class="" >
                        <a href="#pelaporSubmenu"  aria-expanded="false" class="dropdown-toggle nav-link " data-toggle="collapse" >
                        <i class="nav-icon fa fa-file" aria-hidden="true" ></i>
                        <p>Pelaporan</p></a>
                            <div  id="pelaporSubmenu"  class="collapse" aria-labelledby="navbarDropdownMenuLink">
                                <a href="pelaporan.php" class="dropdown-item nav-link navdrop">
                                    
                                    <p>
                                        Form Pelaporan
                                    </p>
                                </a>
                                <a href="listpelaporan.php" class=" nav-link ">
                                    
                                    <p>
                                        List Pelaporan
                                    </p>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="" >
                        <a href="#homeSubmenu"  aria-expanded="false" class="dropdown-toggle nav-link " data-toggle="collapse" >
                        <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                        <p>Tamu</p></a>
                            <div  id="homeSubmenu"  class="collapse" aria-labelledby="navbarDropdownMenuLink">
                                <a href="listbukutamu.php" class="dropdown-item nav-link navdrop">
                                    
                                    <p>
                                        Buku Tamu
                                    </p>
                                </a>
                                <a href="listtamu.php" class="dropdown-item  nav-link ">
                                    
                                    <p>
                                        List tamu
                                    </p>
                                </a>
                            </div>
                        </div>
                    </li>

                                        <li class="nav-item">
                        <div class="" >
                        <a href="#resSubmenu"  aria-expanded="false" class="dropdown-toggle nav-link " data-toggle="collapse" >
                        <i class="nav-icon fa fa-user-times" aria-hidden="true"></i>
                        <p>Reset</p></a>
                            <div  id="resSubmenu"  class="collapse" aria-labelledby="navbarDropdownMenuLink">
                                <a href="pengampunan.php" class="nav-link">
                                    <p>
                                        Form Reset
                                    </p>
                                </a>
                                <a href="listpengampunan.php" class="nav-link">
                                    <p>
                                        List reset
                                    </p>
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="listpengampunan.php" class="nav-link">
                            <i class="nav-icon fa fa-picture-o" aria-hidden="true"></i>
                            <p>
                                List reset
                            </p>
                        </a>
                    </li>
                      <li class="nav-item">

                        <a href="downloadcsv.php" class="nav-link">
                            <i class="nav-icon fa fa-download" aria-hidden="true"></i>
                            <p>
                                Download
                            </p>
                        </a>
                    </li>
                    
                    <?php
                    // require "auth/check.php";
                    // echo check_super();
                    if (check_super()){
                    ?>
                    
                     
                    
                    <li class="nav-item">
                        <div class="" >
                        <a href="#setSubmenu"  aria-expanded="false" class="dropdown-toggle nav-link " data-toggle="collapse" >
                        <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
                        <p>Setting</p></a>
                            <div  id="setSubmenu"  class="collapse" aria-labelledby="navbarDropdownMenuLink">
                                <a href="listadmin.php" class="dropdown-item  nav-link ">
                                    
                                    <p>
                                        Admin
                                    </p>
                                </a>
                                
                                <a href="listdepartemen.php" class="dropdown-item  nav-link ">   
                                    <p>
                                        Departemen
                                    </p>
                                </a>
                                
                                <a href="listarea.php" class="nav-link">
                                    <p>
                                        Area
                                    </p>
                                </a>
                                <a href="daftarkaryawan.php" class="nav-link">
                                    <p>
                                        Karyawan
                                    </p>
                                </a>
                                <a href="listtipetamu.php" class="nav-link">
                                    <p>
                                        Tipe tamu
                                    </p>
                                </a>
                                
                                <a href="setting.php" class="nav-link">
                                    <p>
                                        Other
                                    </p>
                                </a>
                                
                            </div>
                        </div>
                    </li>  
                    
                    <?php }?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
