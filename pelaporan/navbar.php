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
                <a href="" class="nav-link" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal"><i
                        class="fa fa-fw fa-sign-out"></i>
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
                               with font-awesome or any other icon font library -->\
                    

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
                        <a href="#homeSubmenu"  aria-expanded="false" class="nav-link dropdown-toggle" data-toggle="collapse" >
                        <i class="nav-icon fa fa-file" aria-hidden="true" ></i>
                        <p>Pelaporan</p></a>
                            <div  id="homeSubmenu"  class="collapse navdrop" aria-labelledby="navbarDropdownMenuLink">
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
                    <li class="nav-item" >
                        <a href="bukutamu.php" class="nav-link">
                            <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                            <p>
                                Buku tamu
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="users.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                List tamu
                            </p>
                        </a>
                    </li>
                    <?php
                    // require "auth/check.php";
                    // echo check_super();
                    if (check_super()){
                    ?>
                      <li class="nav-item" >
                        <a href="listadmin.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                List admin
                            </p>
                        </a>
                        </li>
                        <li class="nav-item" >
                        <a href="listdepartemen.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                List departemen
                            </p>
                        </a>
                        </li>
                        
                       <li class="nav-item" >
                        <a href="daftaradmin.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Daftar admin baru
                            </p>
                        </a>
                        </li>
                        <li class="nav-item" >
                        <a href="daftardepartemen.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Daftar departemen baru
                            </p>
                        </a>
                        </li>
                       
                    <?php }?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
