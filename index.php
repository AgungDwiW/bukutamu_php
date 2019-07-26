<?php
	session_start();
	session_destroy();
	require "check.php";
?>

<!DOCTYPE html>
<html>

<head>
    
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    
  <meta name="generator" content="Mobirise v4.8.1, mobirise.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Google Font: Source Sans Pro -->

    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    
    <link rel="stylesheet" href= "index.css">

    <link rel="stylesheet" href= "assets/css/css.css">
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script> -->

   
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    
    
   
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <link href=""bukutamu/css/form.css" " rel="stylesheet"> -->
  
    
   
    <script src="assets/js/jquery.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
    
    <!------ Include the above in your HEAD tag ---------->
    <!------ Include the above in your HEAD tag ---------->
    <title>Index</title>
    <style type="text/css">
      body {
        background-size: cover;
      }
    </style>
    <section class="menu cid-qYTT5UNcri" once="menu" id="menu2-r">
    <nav
      class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm bg-color transparent">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </button>
      <div class="menu-logo">
        <div class="navbar-brand">
          <!-- <span class="navbar-logo">

            <img class="imglogo" src="assets/images/logo-100x100.png" alt="LOGO ITS KEWIRAUSAHAAN" title="">

          </span> -->
          <span class="navbar-caption-wrap"><a class="navbar-caption text-primary display-4" href="#top">TIV Pandaan<br></a></span>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-dropdown ml-auto" data-app-modern-menu="true">
		<?php if (check_login()){?>
		<li>
            <a  href="pelaporan/dashboard.php" class="nav-link link text-primary display-4"><i
                class="fa fa-fw fa-user"></i>Admin</a>
          </li>
		<?php } else {?>
          <li>
            <a  href="" class="nav-link link text-primary display-4" data-toggle="modal" data-target="#modalLoginForm"><i
                class="fa fa-fw fa-user"></i>Admin</a>
          </li>
		 <?php }?>
        </ul>
	
    </nav>

  </section>

  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">

        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body mx-3">
        <form method="POST" action='pelaporan/auth/login.php' >
          <div class="md-form mb-5">
            <i class="fa fa-envelope prefix grey-text"></i><label data-error="wrong" data-success="right" for="defaultForm-email">Nama User</label>
            <input type="ID" id="defaultForm-email " name = "id"  class="form-control validate">
            
          </div>

          <div class="md-form mb-4">
            <i class="fa fa-lock prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="defaultForm-pass">Kata sandi</label>
            <input type="password" id="defaultForm-pass" name="password" class="form-control validate">
            
          </div>
          <?php 
            if (isset($_GET['status'])){
              if($_GET['status']== 1)
                echo "Password atau username salah<br>";
              else
                echo "Anda harus login terlebih dahulu<br>";
            }
           ?>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>
</head>

<body style="background:url(assets/bg/indexbackground.jpg)  fixed center no-repeat;" id = "body">

    <section class="engine"><a href="https://mobiri.se/u">bootstrap website templates</a></section>
  <section class="cid-qYTIcKJYu9 mbr-fullscreen mbr-parallax-background" id="header2-b">
 
    <div class="mbr-overlay" style="opacity: 100; background-color: rgba(255, 255, 255, 0); background-image: url(assets/bg/indexbackground.jpg); background-size: cover;"></div>

    <div class="container align-center">
      <div class="row justify-content-md-center">
        <div class="mbr-white col-md-10">
          <a href="">
          <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
            Selamat Datang <br> Di TIV Pandaan</h1>


          </a>

          <div style="width:100%">
            <form method="POST" action="bukutamu/form.php" class="center" onsubmit="return validate()">
                <input style="width:50%;margin:auto;" class="form-control " autofocus required type="text" placeholder="Masukkan nomor id kartu" aria-label="Search" name="UID" id = "UID"> <br> 

				<input type="submit" class="btn btn-primary" value="Masuk"></a> 
            </form>
          </div>
        
          <br>
        </div>
      </div>
    </div>
<!--     <div class="mbr-arrow hidden-sm-down" aria-hidden="true" style="background:rgba(15, 118, 153, 0)">
      <a href="#next">
        <i class="mbri-down mbr-iconfont"></i>
      </a>
    </div>
 -->  </section>


    <?php include("bukutamu/footer.php") ; ?>
    <script src="index.js"></script>
    <script src="assets/js/jquery.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>
const input = document.getElementById("UID");
function validate(){
	if (!(/^\S{3,}$/.test(input.value))){
		alert("Nomor identitas tidak boleh mengandung spasi dan harus lebih dari 3 huruf/angka")
	}
	
	return (/^\S{3,}$/.test(input.value));
}
</script>
</html>