<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header('Location: index.php');
  }
  $id = $_SESSION['id'];
  $id_tamu = $_SESSION['id_tamu'];
  $flag = $_SESSION['flag'];
  session_destroy();

?>
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
        <form method="POST" action="submit2.php" class="center" onsubmit="return validate()">
			
          <input type="text" id="tip" class="form-control" name="tip" placeholder="Tipe kartu" disabled>
          <input type="text" id="no" class="form-control" name="no" placeholder="Nomor kartu" disabled >
          <input type="text" id="uid" class="form-control" name="uid" placeholder="Masukkan ID kartu tamu"
           required  autofocus="">
           <p id = "hidme" hidden>Id kartu tidak terdaftar</p>
          <input type="text" hidden name="id" id="id" value="<?php echo $id ?>">
          <input type="text" hidden name="id_kartu" id="id_kartu" >
          <input type="text" hidden name="id_tamu" id="id_tamu" value="<?php echo $id_tamu ?>">
          <br>
          <input type="checkbox" required>  Saya bersedia menaati dan melaksanakan seluruh peraturan Danone
          <br>
          
<!-- Icon -->

        <!-- THIS IS FLAG! -->
        <?php if ($flag) {?>
			<input type="checkbox" required>  Saya bersedia untuk tidak memasuki area produksi<br>
          <input style="margin-top: 10px; width: 87%; text-align: center;" type="submit" class="col-sm-12 btn btn-danger" value="Log In">
        <?php } else { ?>
          <input style="margin-top: 10px; width: 87%; text-align: center;" type="submit" class="col-sm-12 btn btn-primary" value="Log In">
        <?php } ?>
          </div>
    </div>

    <?php include("footer.php") ; ?>

    <script type="text/javascript">
      var valid = 0;
      const uid = document.getElementById("uid");
      uid.addEventListener("keyup", 
        function (event) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText)
                cur = JSON.parse(this.responseText)

                get_kartu(cur);

            }
            };
            event.preventDefault();
                xhttp.open("GET", "ajax/get_kartu.php?uid='" + uid.value+"'", true);
                xhttp.send();
                return false;
        
        });
        function get_kartu(cur){

            if (cur['error']){
                if (cur['error'] == 1){
                  document.getElementById('hidme').innerHTML = "Id kartu tidak terdaftar";  
                }
                else{
                 document.getElementById('hidme').innerHTML = "Kartu terdaftar pada tamu yang sedang didalam pabrik";   
                }
                document.getElementById('hidme').hidden = false;
                document.getElementById('tip').value ="";
                document.getElementById('no').value = "";   
                document.getElementById('id_kartu').value = "";
                $("#uid").addClass('is-invalid')
   
                valid = false;
                return false;
            }
          
            document.getElementById('hidme').hidden = true;
            document.getElementById('tip').value = cur['tipe_kartu'];
            document.getElementById('no').value = cur['nomor_kartu'];
            document.getElementById('id_kartu').value = cur['id'];
            $("#uid").removeClass('is-invalid')
            valid =true;

        };
        function validate(){
          return valid;
        }
    </script>
</body>

