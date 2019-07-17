<?php include('template.php'); ?> 
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
                            Daftar Area
                        </div>
                        <div class="card-body">
                                <!-- Grid -->

                            <div class="col-sm-12" style="overflow-x: scroll">

                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">No.</th>
                                        <th style="width:55%;">Nama area</th>
                                        <th style="width:20%;">Edit</th>
                                        <th style="width:20%;">Hapus</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php  
                                        require "../db/db_con.php";
                                            $sql = "SELECT * FROM area order by nama_area";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                              
                                        ?>

                                        <tr>
                                         <td style="vertical-align:middle;"><?php echo $no; $no+=1; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['nama_area']; ?></td>
                                        <td>
                                            <a  onclick="edit(<?php echo $row['id'].",'".$row['nama_area']."'" ?>)" class="nav-link" style="color: DodgerBlue;"><i class="fa fa-pencil-square-o"></i>

                                            <span class="nav-link-text" >Edit</span></a>
                                         </td>
                                         <td>
                                            <a href="" class="nav-link" onclick="document.getElementById('link').href =  '<?php echo "hapusarea.php?id=".$row["id"]; ?>'" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal2" ><i
                                                class="fa fa-fw fa-trash"></i>
                                            <span class="nav-link-text" >Hapus</span></a>
                                         </td>
                                         </tr>

                                        <?php
                                        }}

                                        ?>



                                </tbody>
                               
                            </table>
                            </div>
                        
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_area.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama area:</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="nama" id = "nama" class = "form-control inputsm" required placeholder="Nama area baru"></div>
                                            <div class="col-sm-5 center"> 
                                            <input type="hidden"  hidden name="is_edit" id = "is_edit" class = "form-control inputsm" required value ="-1">
                                            <button type="button" onclick="canc()" id = "cancel" class="col-sm-5" hidden >cancel</button>
                                            <input type="submit"  name="submit" id = "submit" class="col-sm-10" value="Tambah Area">
                                            
                                        </div>
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
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan tombol hapus untuk mengkonfirmasi penghapusan!</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" id = "link" href="hapustipe.php">hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php include("footer.php") ; ?>
</body>
<script >

    const t = $('#example1').DataTable({
                
            });

function canc(){
    console.log("aaa");
    document.getElementById("is_edit").value = -1;
    document.getElementById("submit").value = "Tambah area";
    document.getElementById("submit").classList.remove("col-sm-5");
    document.getElementById("submit").classList.add("col-sm-10");
    document.getElementById("cancel").hidden = true;
}

function edit(id, nama){
    document.getElementById("nama").value = nama;
    document.getElementById("is_edit").value = id;
    document.getElementById("submit").value = "Edit";
    document.getElementById("submit").classList.remove("col-sm-10");
    document.getElementById("submit").classList.add("col-sm-5");
    document.getElementById("cancel").hidden = false;
}
</script>
