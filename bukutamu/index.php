
<head>
    <?php include("meta.php") ?>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="css/index.css" rel="stylesheet">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    
    <!------ Include the above in your HEAD tag ---------->
    <title>Buku tamu</title>
    <style type="text/css">
      body {
        background-size: cover;
      }
    </style>
</head>

<body style="background:url(../assets/bg/indexbackground.jpg)  fixed center no-repeat; margin:0 auto; height:auto" id = "body">
    <div class="wrapper ">
      <div id="formContent">
        <!-- Tabs Titles -->
        <br>

        <br>
        <!-- Icon -->
        
        <!-- Login Form -->
        <form method="POST" action="form.php" class="center ">
			       
          <input type="text" id="UID" class="form-control" name="UID" placeholder="ID" required autofocus>
          
            
          <input style="margin-top: 40px; width: 40%; text-align: center;" type="submit" class="col-sm-12" value="Log In">
           <a href="../index.php" style="margin-top: 40px; width: 40%; text-align: center;"><input type="button" name="back" id = "back" class="col-sm-11 center" value="back"></a>
            
         
         
          

    
      </div>
    </div>

    <?php include("footer.php") ; ?>
</body>