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
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_daftar.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        <h4>Data Pelapor</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">ID:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="id" id = "id" class = "form-control inputsm" required placeholder="ID"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">Password:</label>
                                          <div class="col-sm-10">  
                                            <input type="password" required class="form-control inputsm" name="password" id="password" placeholder="Password"> 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">Masukkan kembali password:</label>
                                          <div class="col-sm-10">  
                                            <input type="password" required class="form-control inputsm" name="password2" id="password2" placeholder="Password"  > 
                                          </div>
                                          
                                        </div>  
                                                                 
                                        <p id = "hidme" hidden>Password tidak sama</p>

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
