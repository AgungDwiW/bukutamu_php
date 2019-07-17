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
                            Daftar admin
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_admin.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-4" for="nama">ID:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id" id = "id" class = "form-control inputsm" required placeholder="ID"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Password:</label>
                                          <div class="col-sm-8">  
                                            <input type="password" required class="form-control inputsm" name="password" id="password" placeholder="Password"> 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Masukkan kembali password:</label>
                                          <div class="col-sm-8">  
                                            <input type="password" required class="form-control inputsm" name="password2" id="password2" placeholder="Password"  > 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Supervisor :</label>
                                          <div class="col-sm-8">  
                                            <input type="radio" name="super" id = "supery" value = "1"> Ya   </input>
                                            <input type="radio" name="super" id = "supern" value = "0" checked> Tidak</input>
                                          </div>
                                          
                                        </div>              
                                        <p id = "hidme" hidden>Password tidak sama</p>
                                        <?php 
                                            if (isset($_GET['error'])){
                                                echo '<label style = "text-align:center;">User sudah ada</label> </br></br>';
                                            }
                                        ?>
                                        <div class="col-sm-12 center"> 
                                           <button type="input" class="btn btn-primary" style="width: 50%">Submit</button>
                                           <a href="listadmin.php"><button type="button" class="btn btn-danger" style="width: 45%">Cancel</button></a>
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
const pass1 = document.getElementById("password")
const pass2 = document.getElementById("password2")
const hidme = document.getElementById("hidme")
function validateform(){
    if(pass1.value != pass2.value){
        hidme.hidden = false
        return false
    }
    return true
}

</script>
