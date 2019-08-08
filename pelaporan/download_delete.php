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
                            Unduh & Hapus Data
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_admin.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        <h4>Unduh data</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                        
                                          <label class="col-sm-3">Unduh data pelaporan:</label>
                                          <div class="col-sm-2">  
                                            <input type="date" name="startpel" id = "startpel" class="form-control form-control-sm ">
                                          </div> - 
                                          <div class="col-sm-2">
                                            <input type="date" name="endpel" id = "endpel" class="form-control form-control-sm " >
                                          </div>
                                          <div class="col-sm-2">  
                                            <select name="start" id = "shift1" class="form-control form-control-sm ">
                                              <option value = 4>Semua shift</option>
                                              <option value = 1>1 : 06:00 - 14:00</option>
                                              <option value = 2>2 : 14:00 - 22:00</option>
                                              <option value = 3>3 : 22:00 - 06:00</option>
                                              
                                            </select>
                                          </div> 
                                          <div class="col-sm-2"> 
                                            <button type="button" class="col-sm-12" onclick="exportpel()"> Unduh</button>
                                          </div>
                                        
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                        
                                          <label class="col-sm-3">Unduh data bukutamu:</label>
                                          <div class="col-sm-2">  
                                            <input type="date" name="startked" id = "startked" class="form-control form-control-sm ">
                                          </div> - 
                                          <div class="col-sm-2">
                                            <input type="date" name="endked" id = "endked" class="form-control form-control-sm " >
                                          </div>
                                           <div class="col-sm-2">  
                                            <select name="start" id = "shift2" class="form-control form-control-sm ">
                                              <option value = 4>Semua shift</option>
                                              <option value = 1>1 : 06:00 - 14:00</option>
                                              <option value = 2>2 : 14:00 - 22:00</option>
                                              <option value = 3>3 : 22:00 - 06:00</option>
                                              
                                            </select>
                                          </div> 
                                          <div class="col-sm-2"> 
                                            <button type="button" onclick="exportked()" class="col-sm-12"> Unduh</button>
                                          </div>
                                        
                                        </div>

                                        <hr style="display: block;" size="5">
                                        <h4>Hapus data</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">                                       
                                          <label class="col-sm-3">Hapus data pelaporan sebelum tanggal :</label>
                                          <div class="col-sm-6">  
                                            <input type="date" name="startpel" id = "peldel" class="form-control form-control-sm ">
                                          </div> 
                                         
                                          <div class="col-sm-2"> 
                                            <button type="button" class="col-sm-12" onclick="deletepel()"> Hapus</button>
                                          </div>
                                        
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">                                       
                                          <label class="col-sm-3">Hapus data bukutamu sebelum tanggal :</label>
                                          <div class="col-sm-6">  
                                            <input type="date" name="startpel" id = "keddel" class="form-control form-control-sm ">
                                          </div> 
                                         
                                          <div class="col-sm-2"> 
                                            <button type="button" class="col-sm-12" onclick="deleteked()"> Hapus</button>
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

    <?php include("footer.php") ; ?>
</body>
<script type="text/javascript">

const startked = document.getElementById('startked');
const startpel = document.getElementById('startpel');
const endked = document.getElementById('endked');
const endpel = document.getElementById('endpel');
const shift1 = document.getElementById('shift1');
const shift2 = document.getElementById('shift2');
 <?php
if (strnatcmp(phpversion(),'5.0.0') >= 0)
{
  ?>
    function exportked()
            {
                if (startked.value != "" && endked.value !="")
                {

                    var conf = confirm("Export data bukutamu ke excel?");
                    if(conf == true)
                    {
                        window.open("ajax/exportked.php?start='"+startked.value+"'&end='"+endked.value+"'&shift="+shift2.value, '_blank');
                    }    
                }
                
            }
    function exportpel()
            {
                if (startpel.value != "" && endpel.value !="")
                {

                    var conf = confirm("Export data bukutamu ke excel?");
                    if(conf == true)
                    {
                        window.open("ajax/exportpel.php?start='"+startpel.value+"'&end='"+endpel.value+"'&shift="+shift1.value, '_blank');
                    }    
                }
                
            }
  <?php
}
else
{
  ?>
    function exportked()
            {
                if (startked.value != "" && endked.value !="")
                {

                    var conf = confirm("Export data bukutamu ke excel?");
                    if(conf == true)
                    {
                        window.open("ajax/exportked_csv.php?start='"+startked.value+"'&end='"+endked.value+"'&shift="+shift2.value, '_blank');
                    }    
                }
                
            }
    function exportpel()
            {
                if (startpel.value != "" && endpel.value !="")
                {

                    var conf = confirm("Export data bukutamu ke excel?");
                    if(conf == true)
                    {
                        window.open("ajax/exportpel_csv.php?start='"+startpel.value+"'&end='"+endpel.value+"'&shift="+shift1.value, '_blank');
                    }    
                }
                
            }
  <?php
}

 ?>



function get_pelanggaran(){
    
    if (!((uid.value != "") && (tipe12.options[tipe12.selectedIndex].text != "Pilih" && sub.options[sub.selectedIndex].text!="Pilih"))){
        
        return false
    }
    
}
function deletepel(){
  var end = document.getElementById("peldel");
    var conf = confirm("Apakah anda yakin menghapus data pelanggaran?");
        if(conf == true){
            var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              alert("success");
          }};
          query = "ajax/del_pel.php?end='"+end.value+"'"
          xhttp.open("GET",query, true);
          xhttp.send();
    }    
}
function deleteked(){
  var end = document.getElementById("keddel");
    var conf = confirm("Apakah anda yakin menghapus data bukutamu?");
    if(conf == true){
               var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              alert("success");
          }};
          query = "ajax/del_ked.php?end='"+end.value+"'"
          xhttp.open("GET",query, true);
          xhttp.send();
    }    
}
                
            
</script>