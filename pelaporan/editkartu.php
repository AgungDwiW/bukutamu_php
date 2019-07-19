<?php include('template.php'); 
require '../db/db_con.php';
if (!isset($_GET['id'])){
    header('Location: listkartu.php');
}

$sql = "select * from kartu_tamu where id = ".$_GET['id'];
$result = mysqli_query($conn, $sql);

if(!$result)
{
  header('Location: listkartu.php');
}
while($row = mysqli_fetch_assoc($result)) {
  $kartu = $row;  
}
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
                            Edit kartu
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="edit_kartu.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                         <div class="form-group row" style="padding-bottom:1rem;"> <!-- Institusi  -->
                                          <label class="control-label col-sm-4" for="tipe">Tipe kartu :</label>
                                          <div class="col-sm-8">  
                                             <select type="text" class="form-control inputsm" name="tipe" id="tipe" required    
                                            >
                                                
                                                <?php  
                                                $sql = "SELECT * FROM tipe_tamu";   
                                                $result_dep = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result_dep) > 0) {
                                                    // output data of each row
                                                    while($row = mysqli_fetch_assoc($result_dep)) {
                                                        if ($kartu['tipe_kartu']==$row['id']){
                                                        echo "<option name= 'tipe' value=".$row['id']." selected >".$row['tipe']."</option>";
                                                    }
                                                    else{
                                                        echo "<option name= 'tipe' value=".$row['id']."  >".$row['tipe']."</option>";
                                                    }
                                                    }
                                                }
                                                ?>
                                            </select>

                                          </div></div>
                                          
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Nomor kartu:</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="nomor" id="nomor" placeholder="Nomor kartu" value="<?php echo $kartu['nomor_kartu'] ?>"> 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">UID :</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="uid" id="uid" placeholder="UID kartu"  value="<?php echo $kartu['uid'] ?>"> 
                                          </div>
                                          
                                        </div>  

                                        <input type="text" name="id" id="id" value="<?php echo $_GET['id'] ?>" hidden>

                                        <div class="col-sm-12 center"> 
                                           <button type="input" class="btn btn-primary" style="width: 50%">Submit</button>
                                           <a href="listdepartemen.php"><button type="button" class="btn btn-danger" style="width: 45%">Cancel</button></a>
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
