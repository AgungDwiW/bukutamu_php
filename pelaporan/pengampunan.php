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
                            Form pelaporan                            
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto; text-align: left;" method="post" onsubmit="return validateform()" action="submit_pelaporan.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;" id = "dynform">
                                        
                                        <h4>Data Penanggung Jawab</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama Penanggung Jawab:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama_pelapor" id = "nama_pelapor" class = "form-control inputsm" required placeholder="Nama Pelapor"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">UID Penanggung Jawab:</label>
                                          <div class="col-sm-7">  
                                            <input type="text" required class="form-control inputsm" name="uid_pelapor" id="uid_pelapor" placeholder="UID Pelapor" value =   > 
                                          </div>
                                          <div class="col-sm-3" style="padding-bottom:1rem;">
                                            <select class="form-control inputsm" name="tid_pelapor" id="tid_pelapor" placeholder="Tipe id" >
                                                <option>KTP</option>
                                                <option selected>Kartu Pegawai</option>
                                                <option >SIM</option>
                                            </select>
                                          </div>
                                        </div>  
                                        
                                        <hr style="display: block;" size="5">
                                        <h4>Data Pelaku</h4>
                                        <br>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">UID :</label>
                                          <div class="col-sm-7">  
                                            <input type="text" class="form-control inputsm" required name="uid_pelaku" id="uid_pelaku"  placeholder="UID Pelaku" value =   > 
                                          </div>
                                          <div class="col-sm-3">
                                            <select class="form-control inputsm" name="tid_pelaku" id="tid_pelaku" placeholder="Tipe id" disabled  value = {{tamu.tipeid}}>
                                                <option>KTP</option>
                                                <option >Kartu Pegawai</option>
                                                <option >SIM</option>
                                            </select>
                                              
                                          </div>
                                        <label id = "hidme" hidden="">Data tamu tidak ditemukan </label>

                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama Pelapor:</label>
                                            <div class="col-sm-10">
                                                <input type = "text" name="nama_pelaku" onchange="get_tamu()"  class = "form-control inputsm" id= "nama" placeholder="Nama Pelanggar" name="nama_pelaku" readonly>
                                                	</div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Institusi:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="Institusi_pelaku" id = "institusi" readonly class = "form-control inputsm" placeholder="Institusi Pelanggar"></div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">No. Handphone:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="hp_pelaku" readonly  id = "no_hp" class = "form-control inputsm" placeholder="No. Handphone pelanggar"></div>
                                        </div>

                                         <div class="table-responsive col-sm-12" style="overflow-y: scroll; max-height:500px;  ">
                                            <table id="table2" class="table table-bordered table-hover"
                                                                  style="font-size:10pt; text-align:center; vertical-align:middle;" >
                                                <thead>
                                                <tr >
                                                  <th >No</th>
                                                  <th style="min-width:5%;">Tanggal Pelanggaran</th>
                                                  <th style="min-width:8%;">12 Basic</th>
                                                  <th style="min-width:7%;">Sub Kategori</th>
                                                  <th style="min-width:5%;">+/-</th>
                                                  <th style="min-width:10%; max-width: 15%">Action Plan </th>
                                                  
                                                  <th style="min-width:15%; max-width: 25%">Keterangan</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                 <?php
                                              $sql = "SELECT * FROM pelaporan where pelanggar = ".$uid;
                                              $no = 1;
                                              $result = mysqli_query($conn, $sql);

                                              while($row = mysqli_fetch_assoc($result)) {
                                              ?>
                                               <tr>
                                                   <td style="vertical-align:middle;"><?php echo $no;$no+=1; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['tanggal_pelanggaran']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['tipe_12']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['subkategori']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['positif']?'+':'-';?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['ap']; ?></td>
                                                  
                                                  <td style="vertical-align:middle;"><?php echo $row['keterangan']; ?></td>
                                              </tr>
                                              <?php
                                            }
                                            ?>
                                            
                                              </tbody>
                                            </table>
                                          </div>
                                        
                                        
                                        <div class="col-sm-12 center"> 
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                             <br> 
                                             <br>
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
const tanggal = document.getElementById("tgl_langgar")
const nama = document.getElementById("nama")
const institusi = document.getElementById("institusi")
const no_hp = document.getElementById("no_hp")
const uid = document.getElementById("uid_pelaku")
const tid = document.getElementById("tid_pelaku")
const tipe12 = document.getElementById('aktivitas_12')
const sub = document.getElementById('Subketegori')
const hide = document.getElementById('hid')
const table = document.getElementById('table').getElementsByTagName('tbody')[0];
const positif = document.getElementById('positivity')
const ap1 = document.getElementById('AP1')
const ap2 = document.getElementById('AP2')
const ap1_lab = document.getElementById('AP1_lab')
const ap2_lab = document.getElementById('AP2_lab')
const ket = document.getElementById('keterangan')
const area = document.getElementById('area')
var valid = false
var no = 1;
function addinput(value){
    $(' <div class="form-group row dyn" style="padding-bottom:1rem;"><label class="control-label col-sm-2"   for="Action plan 2">Action plan '+no+':</label><div class="col-sm-10 "><input type="text" disabled   class = "form-control inputsm "  value = '+value+'></div></div>').insertBefore($('#before')[0]); //add input box
}

function addinput2(){
    $(' <div class="form-group row dyn" style="padding-bottom:1rem;"><label class="control-label col-sm-2"   for="Action plan 2">Action plan '+no+':</label><div class="col-sm-10 "><input type="text" id = "ap" required name = "ap" class = "form-control inputsm " placeholder="Action Plan"></div></div>').insertBefore($('#before')[0]); //add input box
}

function del (){
    a = document.getElementsByClassName('dyn');
    console.log(a.length)
    len  = a.length
    for (x=0; x<len;x++){
        console.log(x)
        b = a[0];
        // console.log(b);
        b.parentElement.removeChild(b);
    }
}

function activate(){
    tipe12.disabled = false
    sub.disabled = false
    positif.disabled = false

    ket.disabled = false
    tanggal.disabled = false
    area.disabled = false
}

function deactivate(){
    tipe12.disabled = true
    sub.disabled = true
    positif.disabled = true

    ket.disabled = true   
    tanggal.disabled = true
    area.disabled = true
}

function validateform(){
    var str_12 = tipe12.options[tipe12.selectedIndex].text
    var str_sub = sub.options[sub.selectedIndex].text
    if (str_12== "Pilih"  || str_sub== "Pilih"){
        return false
    }
    return valid
    
}

uid.addEventListener("keyup", 
    function (event) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            cur = JSON.parse(this.responseText)
            
            valid = true
            get_tamu(cur);

        }
        if (this.readyState == 4 &&this.status == 500) {
            deactivate();
            valid = false
            alert("data tamu tak dapat ditemukan")
        }
        };
        event.preventDefault();
        if (event.which == 13 || event.keyCode == 13) {
           console.log("get_tamu?uid=" + uid.value)
            xhttp.open("GET", "ajax/get_tamu.php?uid=" + uid.value, true);
            xhttp.send();
            return false;
    }
    });
function get_tamu(cur){
    // console.log(cur)
    if (cur['error']){
        document.getElementById('hidme').hidden = false;
        deactivate()
        return false;
        valid = 0;
        
    }
    cur = cur[0];
    activate()
    document.getElementById('hidme').hidden = true;
    institusi.value = cur['perusahaan']
    nama.value = cur['nama']
    no_hp.value = cur['hp']
    if (!cur['saved']){
        nama.value = "Deleted"
        no_hp.value = "Deleted"
        tid.value = "Deleted"
    }
    if (cur['tid'] == "KTP"){
        tid.options[0].selected = true
        // console.log(tid.options[0].selected)
    }
    else{
        tid.options[2].selected = false
    }
    kedatangan  = cur['kedatangan']
    for (key in kedatangan){
        var option = document.createElement("option");
        option.text = kedatangan[key]
        option.value = key
        tanggal.add(option)
    }

};

function get_pelanggaran(){
    
    if (!((uid.value != "") && (tipe12.options[tipe12.selectedIndex].text != "Pilih" && sub.options[sub.selectedIndex].text!="Pilih"))){
        
        return false
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);
        // cur = this.responseText;
        // console.log("a");
        cur = JSON.parse(this.responseText)
        console.log(cur);
        pelanggaran(cur);
    }};
    var str_12 = tipe12.options[tipe12.selectedIndex].text
    var str_sub = sub.options[sub.selectedIndex].text
    str_12 = str_12.replace(/ /g, "+");
    str_sub = str_sub.replace(/ /g, "+");
    query = "ajax/get_pelanggaran.php?uid=" +uid.value+"&akt="+str_12+"&sub="+ str_sub
    console.log(query)
    xhttp.open("GET","ajax/get_pelanggaran.php?uid=" +uid.value+"&akt="+str_12+"&sub="+ str_sub, true);
    xhttp.send();
}
var flag = 0
function pelanggaran(json){
    count = table.childElementCount
        
    for (a = 0; a<count; a++){
        
        table.deleteRow(0)
    }
    no = 1;
    hide.hidden = true;
    del();
    len = json.length;
    for (z = 0; z<len;z++){
        addinput(json[z]['ap']);    
        no+=1;
        // console.log(content[a])
        row = table.insertRow(0)
        cell1 = row.insertCell(0)
        cell2 = row.insertCell(1)
        cell3 = row.insertCell(2)
        hide.hidden = false;
        cell1.innerHTML = json[z].tanggal
        cell2.innerHTML = json[z].area
        cell3.innerHTML = json[z].departemen
    }
    addinput2();
}


$('form input').on('keypress', function(e) {
    return e.which !== 13;
});


</script>