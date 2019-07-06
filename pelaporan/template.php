<!DOCTYPE html>
<html>

<head>
<?php  
        require "auth/login_middleware.php"
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pelaporan</title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
     <link href="../assets/MDB/css/mdb.min.css" rel="stylesheet">
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/brands.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/solid.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

  
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script> -->

   
    <link href="../assets/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">

    
    
    <script href="../assets/MDB/js/mdb.js"></script>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <link href=""bukutamu/css/form.css" " rel="stylesheet"> -->
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            background-color: #f4f6f9 !important;
            margin: auto;
            width: 60%;
            min-width: 25rem;
            height: 5rem;
        }

        .dropdown:hover > .dropdown-menu {
            display: block;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            width: 25%;
            height: 5rem;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #41b3f9;
            color: white;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #41b3f9;
            color: white;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            -webkit-animation: fadeEffect 1s;
            animation: fadeEffect 1s;
        }
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                color: #A7ACB4;
                background-color: #343A40;
            }
            
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link:hover {
                color: #fff;
                background-color: #494E53;
            }

            .nav-pills .nav-link:not(.active):hover {
                color: #fff;
                background-color: #494E53;
            }
        /* Fade in tabs */
        @-webkit-keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
        
    </style>
    
    <?php include('navbar.php'); ?> 
</head>

<body class="hold-transition sidebar-mini">
    
<!-- Footer -->
    

    <footer class="main-footer" style="text-align:center;">
        <!-- <strong>Copyright &copy; 2019 SI Lomba Mahasiswa.</strong>
        All rights reserved. -->
        <!-- Scroll to Top Button-->
        

        <!-- Modal Logout -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda benar benar ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan tombol logout untuk mengakhiri sesi anda!</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="auth/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- Control Sidebar -->
    <!-- Control sidebar content goes here -->

    <!-- /.control-sidebar -->
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Morris.js charts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <script src="../assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../assets/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
    <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script href="../assets/MDB/js/mdb.js"></script>
    <script type="text/javascript" src="../assets/MDB/js/mdb.min.js" ></script>
