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
                                        
                                        <h4>Data Pelapor</h4>
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Nama Pelapor:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama_pelapor" id = "nama_pelapor" class = "form-control inputsm" required placeholder="Nama Pelapor"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-2" for="UID">UID Pelapor:</label>
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
                                        <h4>Data Yang dilaporkan</h4>
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
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="Tanggalpelanggaran">Tanggal Pelanggaran:</label>
                                            <div class="col-sm-10">
                                                <select name="tgl_langgar" required disabled class = "form-control inputsm" id = "tgl_langgar">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="Tanggalpelanggaran">Area</label>
                                            <div class="col-sm-10">
                                                <select name="area" disabled class = "form-control inputsm" id = "area" >
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr style="display: block;" size="5">
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2"  for="nama">Tipe Aktivitas di 12 Basic:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control inputsm" onchange="get_pelanggaran()" name="aktivitas_12" id="aktivitas_12" placeholder="Tipe id" disabled >
                                                <option>Pilih</option>
                                                <option >Work at Height</option>
                                                <option >Chemical Product</option>
                                                <option >Confined Space</option>
                                                <option >Hazardous Gases</option>
                                                <option >Fire evacuation</option>
                                                <option >Equipment safety</option>
                                                <option >Forklifts</option>
                                                <option >Racks Pallets</option>
                                                <option >Truck loading unloading</option>
                                                <option >Work permits</option>
                                                <option >Hazardous energy</option>
                                                <option >Not related 12 basic</option>

                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Sub Kategori:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control inputsm" disabled onchange="get_pelanggaran()" name="Subkategori" id="Subketegori"   value = {{tamu.tipeid}}>
                                                <option selected disabled>Pilih</option>
                                                <optgroup label="Reaksi Orang">
                                                    <option >A1 Menyesuaikan APD</option>
                                                    <option >A2 Merubah Posisi</option>
                                                    <option >A3 Membenahi pekerjaan</option>
                                                    <option >A4 Menghentikan pekerjaan</option>
                                                    <option >A5 Memasang LOTO atau grounding</option>
                                                </optgroup>
                                                <optgroup label="Posisi Kerja & Ergonomi">
                                                    <option >B1 Membentur</option>
                                                    <option >B2 Terpukul</option>
                                                    <option >B3 Terjepit</option>
                                                    <option >B4 Terjatuh</option>
                                                    <option >B5 Kontak dengan suhu ekstrim</option>
                                                    <option >B6 Kontak dengan arus listrik</option>
                                                    <option >B7 Menghirup bahan kimia</option>
                                                    <option >B8 Bahan Kimia Terserap kulit</option>
                                                    <option >B9 Bahan Kimia tertelan</option>
                                                    <option >B10 Posisi Tubuh</option>
                                                    <option >B11 Jenis dan jumlah gerakan</option>
                                                    <option >B12 Mengankat beban</option>
                                                </optgroup>
                                                <optgroup label="APD">
                                                    <option >C1 Mata dan wajah</option>
                                                    <option >C2 Telinga</option>
                                                    <option >C3 Kepala</option>
                                                    <option >C4 Tangan dan lengan</option>
                                                    <option >C5 Kaki dan Tungkai</option>
                                                    <option >C6 Sistem pernafasan</option>
                                                    <option >C7 Dada dan badan</option>
                                                    <option >C8 Pakaian yang sesuai</option>
                                                </optgroup>
                                                <optgroup label="Perkakas dan Perlengkapan">
                                                    <option >D1 Sesuai dengan jenis pekerjaan</option>
                                                    <option >D2 Digunakan dengan benar</option>
                                                    <option >D3 Dalam kondisi aman</option>
                                                    <option >D4 Desain area kerja</option>
                                                    <option >D5 Perkakas denga pegangannya</option>
                                                    <option >D6 Getaran</option>
                                                    <option >D7 Suhu</option>
                                                    <option >D8 Pencahayaan</option>
                                                    <option >D9 Kebisingan</option>
                                                </optgroup>
                                                <optgroup label="Perkakas dan Perlengkapan">
                                                    <option >D1 Sesuai dengan jenis pekerjaan</option>
                                                    <option >D2 Digunakan dengan benar</option>
                                                    <option >D3 Dalam kondisi aman</option>
                                                    <option >D4 Desain area kerja</option>
                                                    <option >D5 Perkakas denga pegangannya</option>
                                                    <option >D6 Getaran</option>
                                                    <option >D7 Suhu</option>
                                                    <option >D8 Pencahayaan</option>
                                                    <option >D9 Kebisingan</option>
                                                </optgroup>
                                                <optgroup label="Housekeeping dan Prosedur">
                                                    <option >E1 Prosedur tidak memadai</option>
                                                    <option >E2 Prosedur tidak dipahami</option>
                                                    <option >E3 Prosedur Todak dipatuhi</option>
                                                    <option >E4 Menjalankan izin kerja</option>
                                                    <option >E5 Isu housekeeping</option>

                                                </optgroup>

                                                </select>

                                            </div>
                                        </div>   
                                        <div id = "hid" hidden>
                                        <label>Pelanggaran sebelumnya:</label>
                                        <table id="table" class="table table-bordered table-hover"
                                                        style="font-size:10pt; text-align:center; vertical-align:middle;">
                                                        <thead>
                                                            <th style="min-width:25%;">Tanggal</th>
                                                    <th style="min-width:5%;">Area</th>
                                                    <th style="min-width:70%;">Departemen penanggung jawab</th>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                </tfoot>
                                                </table>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="nama">Positif/Negatif</label>
                                            <div class="col-sm-10">
                                                <select class="form-control inputsm" disabled name="positivity" id="positivity" placeholder="Tipe id"  value = {{tamu.tipeid}}>
                                                <option selected value="0">Negatif</option>
                                                <option value="1">Positif</option>

                                            </select>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group row" id = "before" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-2" for="Action plan 2">Keterangan:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="keterangan" disabled id = "keterangan"  class = "form-control inputsm" placeholder="Keterangan"></div>
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