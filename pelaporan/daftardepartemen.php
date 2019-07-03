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
                            Daftar Departemen
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_departemen.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-4" for="nama">Nama departemen:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama" id = "nama" class = "form-control inputsm" required placeholder="Nama departemen"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Penanggung jawab:</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="tanggung" id="tanggung" placeholder="Penanggung jawab"> 
                                          </div>
                                          
                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Email penanggung jawab :</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="email" id="email" placeholder="Email"  > 
                                          </div>
                                          
                                        </div>  

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
