<?php include('template.php'); 
require '../db/db_con.php';
$id = $_GET['id'];
$sql = "select * from tipe_tamu where id = ".$id;
$result = mysqli_query($conn, $sql);

if ($result &&(mysqli_num_rows($result) !=0)){
    while($row = mysqli_fetch_assoc($result)) {
        $tipe = $row['tipe'];
        $parent = $row['parent'];
    }
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
                            Daftar Kategori Tamu
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post"  action="submit_tipe.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                         <div class="form-group row" style="padding-bottom:1rem;"> <!-- Institusi  -->
                                          <label class="control-label col-sm-4" for="tipe">Sub dari :</label>
                                          <div class="col-sm-8">  
                                             <select type="text" class="form-control inputsm" name="tipe" id="tipe" required    
                                            >
                                                <option name= 'tipe' value="-1" selected >-</option>
                                                <?php  
                                                $sql = "SELECT * FROM tipe_tamu";   
                                                $result_dep = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result_dep) > 0) {
                                                    // output data of each row
                                                    while($row = mysqli_fetch_assoc($result_dep)) {
                                                        if ($row['id']!= $id && $row['parent']!=$id){
                                                            if ($row['id']!= $parent )
                                                            echo "<option name= 'tipe' value=".$row['id']."  >".$row['tipe']."</option>";
                                                            else
                                                                echo "<option name= 'tipe' value=".$row['id']." selected >".$row['tipe']."</option>";
                                                    }}
                                                }
                                                ?>
                                            </select>

                                          </div></div>
                                          
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="nama">Nama kategori :</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="nama" id="nama" placeholder="Nama kategori" value = "<?php echo $tipe ?>"> 
                                          </div>
                                          </div>
                                        <input type="text" id ="is_edit" hidden name="is_edit" value="<?php echo $_GET['id'] ?>">
                                        <div class="col-sm-12 center"> 
                                           <button type="input" class="btn btn-primary" style="width: 50%">Submit</button>
                                           <a href="listtipetamu.php"><button type="button" class="btn btn-danger" style="width: 45%">Cancel</button></a>
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
