
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

<body style="background:url(../assets/bg/indexbackground.jpg)  fixed center no-repeat;" id = "body">
    <div class="wrapper ">
      <div id="formContent">
        <!-- Tabs Titles -->
        <br>

        <br>
        <!-- Icon -->
        
        <!-- Login Form -->
        <form method="POST" action="form.php" class="center">
			       
          <input type="text" id="UID" class="form-control" name="UID" placeholder="ID" required autofocus>
          
          <div class="center" style="display: inline-grid; grid-template-columns: auto auto auto">
            <div class="grid-item">
              <input  style="margin-top: 20px;  text-align: center;"  type="submit"  value="Masuk">
            </div>
            <div class="grid-item">
            <a  href="../index.php"  ><input style="margin-top: 20px;  text-align: center;" type="button" name="back" id = "back" class="center" value="Kembali"></a>
            </div>
          </div>   
         
         
          

    
      </div>
    </div>

    <?php include("footer.php") ; ?>
</body>