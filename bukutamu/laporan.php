
<head>
    <link href="../assets/bootstrap/css/bootstrap.min.css"  rel="stylesheet" id="bootstrap-css">
    <script src="../assets/js/jquery.js" ></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js" ></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/form.css"  rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <!------ Include the above in your HEAD tag ---------->
    <title>Buku tamu</title>
    <style type="text/css">
      body {
        background-size: cover;
      }
      .formgroup {
        margin-top: 10px;
      }
    </style>

</head>

<body background="../assets/bg/indexbackground.jpg" style="font-size: 15px" >
 <div class="wrapper" > 
  <div id="formContent">
   <div class="row vertical-align">
    <div class="col-sm-6" >
      	<div class="form-group row"><!-- UID -->
	          <label class="control-label col-sm-3" for="UID">UID:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value =  > 
	          </div>
	          <div class="col-sm-3">
	            <select class="form-control inputsm" name="TID" id="TID" placeholder="Tipe id"  value =  >
	            	<option>KTP</option>
	            	<option {%if tipid%}selected{%endif%}>Kartu Pegawai</option>
	            	<option {%if tipid%}selected{%endif%}>SIM</option>
	            </select>
	          </div>
	        </div>

	        <div class="form-group row"> <!-- nama -->
	          <label class="control-label col-sm-3" for="Nama">Nama:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama"  value =   >
	          </div>
	        </div>
	        <div class="form-group row"><!-- Jenis kelamin -->
	          <label class="control-label col-sm-3" for="kelamin">Positif Atau Negatif Action:</label>
	          <div class="col-sm-9">  
	            <select class="form-control inputsm" name="Kelamin" id="Kelamin" placeholder="L/P" value = >
	            	<option selected>Negatif</option>
				    <option >Positif</option>
	            </select>
	          </div>
	        </div>
          <div class="form-group row"> <!-- Keperluan -->
            <label class="control-label col-sm-3" for="Keperluan">Action plan 1:</label>
            <div class="col-sm-9">  
              <input type="text" class="form-control inputsm" name="Keperluan" id="Keperluan" placeholder="Plant 1" required value =  >
            </div>
          </div>
          <div class="form-group row"> <!-- Keperluan -->
            <label class="control-label col-sm-3" for="Keperluan">Action plan 2:</label>
            <div class="col-sm-9">  
              <input type="text" class="form-control inputsm" name="Keperluan" id="Keperluan" placeholder="Plan 2" required value =  >
            </div>
          </div>
          <div class="form-group row"> <!-- Keperluan -->
            <label class="control-label col-sm-3" for="Keperluan">Keterangan:</label>
            <div class="col-sm-9">  
              <input type="text" class="form-control inputsm" name="Keperluan" id="Keperluan" placeholder="Keterangan" required value = >
            </div>
          </div>
    </div>
    <div class="col-sm-6 v-divider">
       
        <form method = "POST" action = {%url 'bukutamu:signin'%} class = "text-left"  onsubmit="validateForm()">
        
  			<input type="hidden" name="image_location" id="image_location" value="/images/bleh.jpg" 
  			 {%if not flag%} readonly {%endif%}><br>
	        <div class="form-group row"><!-- UID -->
	          <label class="control-label col-sm-3" for="UID">UID:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value =   > 
	          </div>
	          <div class="col-sm-3">
	            <select class="form-control inputsm" name="TID" id="TID" placeholder="Tipe id"  value = >
	            	<option>KTP</option>
	            	<option {%if tipid%}selected{%endif%}>Kartu Pegawai</option>
	            	<option {%if tipid%}selected{%endif%}>SIM</option>
	            </select>
	          </div>
	        </div>

	        <div class="form-group row"> <!-- nama -->
	          <label class="control-label col-sm-3" for="Nama">Nama:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama"  value =   >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- no HP -->
	          <label class="control-label col-sm-3" for="NoHP">Nomor HP:</label>
	          <div class="col-sm-9">  
	            <input type="number" class="form-control inputsm" name="NoHP" id="NoHP" placeholder="08xxxxxxxxxx" autocomplete="off" required  value = >
	          </div>
	        </div>
	        <div class="form-group row"><!-- Jenis kelamin -->
	          <label class="control-label col-sm-3" for="kelamin">Jenis Kelamin:</label>
	          <div class="col-sm-9">  
	            <select class="form-control inputsm" name="Kelamin" id="Kelamin" placeholder="L/P"  value = >
	            	<option selected disabled> Pilih</option>
                <option>Laki laki</option>
				        <option {%if kelamin%}selected{%endif%}>Perempuan</option>
	            </select>
	          </div>
	        </div>
	        <div class="form-group row"> <!-- Institusi  -->
	          <label class="control-label col-sm-3" for="Institusi">Institusi:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Institusi" id="Institusi" placeholder="Institusi" required  value =>
	          </div>
	        </div>

	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Aktivitas 12 basix:</label>
	          <div class="col-sm-9">  
	            <select type="text" class="form-control inputsm" name="departemen" id="departemen" required 
	            >
	            	<option selected disabled>Pilih</option>
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
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="">Sub kategori:</label>
	          <div class="col-sm-9">  
	            <select type="text" class="form-control inputsm" name="departemen" id="departemen" required 
	            >
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

	        <div class="form-group row"  >
  		    	<input type="hidden" id = "Image" name = "Image">
  				<div class="col-sm-6"> 
		  			<a href={%url 'bukutamu:index'%}><input type="button" name="cancel" id = "cancel" class="col-sm-11 center" value="cancel"></a>
	  			</div>
  				<div class="col-sm-6"> 
		  			<input type="submit" name="submit" id = "submit" class="col-sm-11 btn">
	  			</div>
	  	
	  			
  			</div>
  		</form>
    </div>
  </div>
  </div>
</div>

<!-- {%if flag%}
<script>
  
  const player = document.getElementById('player');
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');
  const image = document.getElementById('Image')
  const radio_sakit = document.getElementById('sakit_radio_y')
  const radio_sakitn = document.getElementById('sakit_radio_n')
  const sakit = document.getElementById('Sakit')
  const lukay = document.getElementById('Luka1')
  const lukan = document.getElementById('Luka2')
  var sakit_flag = false
  const nama = document.getElementById("Nama")
  const hp = document.getElementById("NoHP")
  const inst = document.getElementById("Institusi")
  const suhu_badan = document.getElementById("Suhu")
  const bertemu = document.getElementById("Bertemu")
  const keperluan = document.getElementById("Keperluan")
  const submit = document.getElementById("submit")
  const flag = {{flag_auth}}
  const departemen = document.getElementById("departemen")

  if (!flag){
  	suhu_badan.disabled = true
  	bertemu.disabled = true
  	keperluan.disabled = true
  	radio_sakit.disabled = true
  	radio_sakitn.disabled = true
  	submit.disabled = true
  	lukay.disabled = true
  	lukan.disabled = true
  	departemen.disabled = true
  	alert("anda telah melakukan pelanggaran lebih dari 3 kali")
  }

  const constraints = {
    video: true,
  };
  function cameracapture (){
  	// Draw the video frame to the canvas.
    handler = document.getElementById('image_location')
    handler = player
    context.drawImage(player, 0, 0, canvas.width, canvas.height);
     //get image
      var Pic = document.getElementById("canvas").toDataURL();
      Pic = Pic.replace(/^data:image\/(png|jpg);base64,/, "");
      image.value = Pic
  }

  function validateForm(){
  	if (sakit_flag == true){
  		sakit.value = "";
  	}
  	cameracapture();
  }

  function sakit_aktive(){
	sakit_flag = !sakit_flag
	sakit.readOnly = sakit_flag
	sakit.required = !sakit_flag
  }


  // Attach the video stream to the video element and autoplay.
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });
  sakit_aktive()
</script>
{%endif%} -->
</body>