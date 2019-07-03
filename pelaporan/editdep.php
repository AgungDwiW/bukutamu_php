<?php 
if (!isset($_GET['id']))
  header('Location: users.php');
else
  $id = $_GET['id'];

require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
$sql = "SELECT * FROM departemen where id = ".$id;
$result = mysqli_query($conn, $sql);
if(!$result)
{
  header('Location: users.php');
}
while($row = mysqli_fetch_assoc($result)) {
  $tamu = $row;  
}
include('template.php'); 
?> 
<body class="hold-transition sidebar-mini">
    <br>
    <br>
    <div class="content-wrapper" style="background: #fbfbfb !important;">
                    <!-- Content Header (Page header) -->
                    
                    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col">
                            
                    <div class="card table-responsive" style="border-radius: 0px !important;">
                        <!-- /.card-header -->
                        <div class="card-header">                              
                            Daftar Departemen
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" action="edit_departemen.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-4" for="nama">Nama departemen:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama" id = "nama" class = "form-control inputsm" required placeholder="Nama departemen" value="<?php echo($tamu['nama_departemen'])?>"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Penanggung jawab:</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="tanggung" id="tanggung" placeholder="Penanggung jawab" value="<?php echo($tamu['penanggungjawab'])?>"> 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Email penanggung jawab :</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="email" id="email" placeholder="Email" value="<?php echo($tamu['email'])?>"> 
                                          </div>
                                          
                                        </div>  
                                        <input type="text" hidden required class="form-control inputsm" name="id" id="id" value="<?php echo($tamu['id'])?>"> 

                                        <div class="col-sm-12 center"> 
                                            <input type="submit" name="submit" id = "submit" class="col-sm-12">
                                        </div>
                        
                                </fieldset>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
                    <!-- /.content -->
    </div>

    <?php include("footer.php") ; ?>
</body>
<script type="text/javascript">

</script>
