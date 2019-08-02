<?php 
header('Location: ../index.php');
?>
<head>
   
    <link href="../assets/bootstrap/css/bootstrap.min.css"  rel="stylesheet" id="bootstrap-css">

    <link href="css/index.css"  rel="stylesheet">
    <script src="../assets/js/jquery.js" ></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js" ></script>
    
    <title>Bukutamu</title>
</head>

<body style="background:url(../assets/bg/indexbackground.jpg)  fixed center no-repeat;" id = "body" >

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

            <div class="center" style="display: inline-grid; grid-template-columns: auto auto auto">
            <div class="grid-item">
              <input  style="margin-top: 20px;  text-align: center;"  type="submit"  value="Masuk">
            </div>
            <div class="grid-item">
            <a  href="../index.php"  ><input style="margin-top: 20px;  text-align: center;" type="button" name="back" id = "back" class="center" value="Kembali"></a>
            </div>
          </div>  
          </form>

        </div>
      </div>
    </div>

    <?php include("../bukutamu/footer.php") ; ?>
</body>