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
                            Form reset 
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto; text-align: left;" enctype="multipart/form-data" onsubmit="return validateform()" method="POST" action="submit_pengampunan.php"  >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;" id = "dynform">
                                        
                                        <h4>Data Petugas</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama Petugas:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama_pelapor" id = "nama_pelapor" class = "form-control inputsm" required placeholder="Nama Petugas" readonly=""></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">UID Petugas:</label>
                                          <div class="col-sm-7">  
                                            <input type="text" required class="form-control inputsm" name="uid_pelapor" id="uid_pelapor" placeholder="NIK" value =   > 
                                            <input type="text" required class="form-control inputsm" name="id_kary" id="id_kary" hidden> 
                                          </div>
                                          <div class="col-sm-3" style="padding-bottom:1rem;">
                                            <select class="form-control inputsm" name="tid_pelapor" id="tid_pelapor" placeholder="Tipe id" >
                                                <option>NIK</option>
                                           
                                            </select>


                                          </div>
                                          <label id = "hidme2" hidden="">Data karyawan tidak ditemukan </label>
                                        </div>  
                                        
                                        <hr style="display: block;" size="5">
                                        <h4>Data Pelanggar</h4>
                                        <br>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">UID :</label>
                                          <div class="col-sm-7">  
                                            <input type="text" class="form-control inputsm" required name="uid_pelaku" id="uid_pelaku"  placeholder="UID Pelaku" > 
                                          </div>
                                          <div class="col-sm-3">
                                            <input type="text" class="form-control inputsm" name="tid_pelaku" id="tid_pelaku" placeholder="Tipe id" disabled  >
                                            <input type="text" required class="form-control inputsm" name="id_tamu" id="id_tamu" hidden> 
                                              
                                          </div>
                                        <label id = "hidme" hidden="">Data tamu tidak ditemukan </label>

                                        </div>  
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama Pelanggar:</label>
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
                                         <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama"> pelanggaran :</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="hp_pelaku" readonly  id = "counter" class = "form-control inputsm" placeholder="Counter pelanggaran"></div>
                                        </div>
                                         <div class="table-responsive col-sm-12 form-group row" style="overflow-y: scroll; max-height:500px;  " id = "hid" hidden="">
                                            <label class="control-label col-sm-12" for ="table" >Riwayat pelanggaran:</label>
                                            <table id="table" class="table table-bordered table-hover"
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
                                            
                                              </tbody>
                                            </table>
                                          </div>
                                         <div class="form-group row" style="padding-bottom:1rem;">
                                           <video id="player" controls autoplay width="800px" height="600px" style="  display: block; margin-left: auto; margin-right: auto; width: 50%;"></video>
                                       <canvas id="canvas" class="col-sm-12" hidden="" width="800px" height="600px" ></canvas>
                                        </div>
                                        <input type="hidden" id = "Image" name = "Image" >
                                        <div style="left: 50%;"> 
                                            
                                             <br> 
                                             <br>
                                            <button type="button" class="btn btn-primary" style="width: 40%" onclick="cameracapture()"> Ambil Gambar</button><input type="submit" name="submit" id = "submit" class="btn btn-primary" value="Ajukan" style="width: 50%">
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
const nama = document.getElementById("nama")
const institusi = document.getElementById("institusi")
const no_hp = document.getElementById("no_hp")
const uid = document.getElementById("uid_pelaku")
const tid = document.getElementById("tid_pelaku")
const sub = document.getElementById('Subketegori')
const hide = document.getElementById('hid')
const counter = document.getElementById('counter')
const table = document.getElementById('table').getElementsByTagName('tbody')[0];
const uid_pel = document.getElementById('uid_pelapor');
const nama_pelapor = document.getElementById('nama_pelapor');
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


function validateform(){
  
    if(!player.paused && flag_camera){
        alert("belum mengambil foto");
        return false;
    }
    // cameracapture();
    return valid;
    
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
        
           console.log("get_tamu?uid=" + uid.value)
            xhttp.open("GET", "ajax/get_tamu2.php?uid=" + uid.value, true);
            xhttp.send();
            return false;
    
    });
function get_tamu(cur){
    // console.log(cur)
    if (cur['error']){
        document.getElementById('hidme').hidden = false;
        hide.hidden = true;
        return false;
        valid = 0;
        
    }
    cur = cur[0];
    hide.hidden = false;
    document.getElementById('hidme').hidden = true;
    institusi.value = cur['kategori']
    nama.value = cur['nama']
    no_hp.value = cur['hp']
    counter.value = cur['counter']
    document.getElementById('id_tamu').value = cur['id'];  
    tid.value = cur['tid'];
   
    get_pelanggaran()
};

function get_pelanggaran(){
    
    
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
    query = "ajax/get_pelanggaran2.php?uid=" +uid.value
    console.log(query)
    xhttp.open("GET","ajax/get_pelanggaran2.php?uid="+uid.value, true);
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
        row = table.insertRow(z)
        cell1 = row.insertCell(0)
        cell2 = row.insertCell(1)
        cell3 = row.insertCell(2)
        cell4 = row.insertCell(3)
        cell5 = row.insertCell(4)
        cell6 = row.insertCell(5)
        cell7 = row.insertCell(6)
        hide.hidden = false;
        cell1.innerHTML = z+1
        cell2.innerHTML = json[z].tanggal
        cell3.innerHTML = json[z].t12
        cell4.innerHTML = json[z].sub
        cell5.innerHTML = json[z].positif==1?"+":"-";
        cell6.innerHTML = json[z].ap
        cell7.innerHTML = json[z].keterangan
    }
    addinput2();
}


$('form input').on('keypress', function(e) {
    return e.which !== 13;
});
flag_camera = 1;
// CAMERA
const constraints = {
       video: true,
     };
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });

const player = document.getElementById('player');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const image = document.getElementById('Image');
function cameracapture (){
    // Draw the video frame to the canvas.
    flag_camera = !flag_camera;
   handler = document.getElementById("image_location")
   handler = player
   context.drawImage(player, 0, 0, canvas.width, canvas.height);
    //get image
     var Pic = document.getElementById("canvas").toDataURL();
     Pic = Pic.replace(/^data:image\/(png|jpg);base64,/, "");
     image.value = Pic
     if (!player.paused)
        player.pause();
    else
        player.play();
}


uid_pel.addEventListener("keyup", 
    function (event) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            cur = JSON.parse(this.responseText)
            
            valid = true
            get_kary(cur);

        }
        };
        event.preventDefault();
        
           console.log("ajax/get_karyawan.php?uid=" + uid_pel.value)
            xhttp.open("GET", "ajax/get_karyawan.php?uid=" + uid_pel.value, true);
            xhttp.send();
            return false;

    });
function get_kary(cur){
    // console.log(cur)
    if (cur['error']){
        document.getElementById('hidme2').hidden = false;
        // deactivate()
        nama_pelapor.value = "";
        valid = 0;
        return false;
    }
    else   {
        document.getElementById('hidme2').hidden = true;
        nama_pelapor.value = cur['nama'];
        document.getElementById('id_kary').value = cur['id'];
    }

};


</script>