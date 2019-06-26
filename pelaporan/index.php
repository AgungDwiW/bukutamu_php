
<head>
   
    <link href="../assets/bootstrap/css/bootstrap.min.css"  rel="stylesheet" id="bootstrap-css">

    <link href="css/index.css"  rel="stylesheet">
    <script src="../assets/js/jquery.js" ></script>
    <script src="..assets/bootstrap/js/bootstrap.min.js" ></script>
    <?php 
     require "auth/check.php";
     if (check_login()){
      header('Location: dashboard.php');
     }
     ?>
    <title>Bukutamu</title>
</head>

<body background="../assets/bg/indexbackground.jpg"  >

    <div class="wrapper ">
      <div id="formContent">
        <div class=" ">
          <!-- Tabs Titles -->
          <br>

          <br>
          <!-- Icon -->
          
          <!-- Login Form -->
          <form method="POST" action='auth/login.php' >
        
          <div style="margin: auto;" class="">
            <input type="text" id="id" class="form-control" placeholder="ID" aria-label="Search" name = "id" required autofocus>
          
          </div>
          <br>
          <div style="margin: auto;"class="col-sm-11">
            <input type="password" name = "password" id="id_password" class="form-control pass" name="Password" placeholder="Password" aria-label="Search" style=" text-align: center ; background-color: #f6f6f6; border: none; " required>
          </div>
          <br>
            <?php 
            if (isset($_GET['status'])){
              if($_GET['status']== 1)
                echo "Password atau username salah<br>";
              else
                echo "Anda harus login terlebih dahulu<br>";
            }
           ?>
             <!-- {{form.username}}
             {{form.password}} -->
 <!--  {% if form.errors %}
      <script type="text/javascript">
        alert("Username atau password salah")
      </script>
    
  {% endif %}

  {% if next %}
    
      <script type="text/javascript">
        alert("Anda harus login terlebih dahulu")
      </script>
      
    
  {% endif %} -->

            <input style="margin-top: 20px" type="submit" class="" value="Log In">
            <a href="../index.php" style="margin-top: 40px; width: 40%; text-align: center;"><input type="button" name="back" id = "back" class="col-sm-11 center" value="back"></a>
          </form>

        </div>
      </div>
    </div>

    <?php include("footer.php") ; ?>
</body>