
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
    </style>

</head>

<body background="../assets/bg/indexbackground.jpg"  style="font-size: 15px" >
 <div class="wrapper" > 
  <div id="formContent">
   <div class="row vertical-align">
    <div class="col-sm-6" >
             <video id="player" controls autoplay width="90%" ></video>
          <canvas id="canvas" class="col-sm-12" hidden=""></canvas>
       
              <!-- <img src = "{{tamu.image.url}}" width=100% height=56%></img> -->
      
      <br>
      <br>
      <div class="row">
      	<div class="table-responsive col-sm-12">
		  <table class="table ">
		    <thead>
		      <tr >
		        <th class="w-25">Tanggal</th>
		        <th class="w-25">Bertemu dengan</th>
		        <th class="w-50">Keperluan</th>
		      </tr>
		    </thead>
		    <tbody>
		    
		      <tr >
		        <td>{{item.tanggal_keluar}}</td>
		        <td>{{item.bertemu_dengan}}</td>
		        <td>{{item.alasan_kedatangan }}</td>
		      </tr>
		    
		    </tbody>
		  </table>
		</div>
      </div>
      
    </div>
    <div class="col-sm-6 v-divider">
      
          <form method = "POST" action = {%url 'bukutamu:signin'%} class = "text-left"  onsubmit="validateForm()">
       
        <!--     <form method = "POST" action = {%url 'bukutamu:signout'%} class = "text-left">
         -->
  			<input type="hidden" name="image_location" id="image_location" value="/images/bleh.jpg" 
  			   ><br>
	        <div class="form-group row"><!-- UID -->
	          <label class="control-label col-sm-3" for="UID">UID:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value =   > 
	          </div>
	          <div class="col-sm-3">
	            <select class="form-control inputsm" name="TID" id="TID" placeholder="Tipe id"  value =   >
	            	<option selected disabled>Pilih</option>
	            	<option>KTP</option>
	            	<option >Kartu Pegawai</option>
	            	<option >SIM</option>
	            </select>
	          </div>
	        </div>

	        <div class="form-group row"> <!-- nama -->
	          <label class="control-label col-sm-3" for="Nama">Nama:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama"    required  value =   >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- no HP -->
	          <label class="control-label col-sm-3" for="NoHP">Nomor HP:</label>
	          <div class="col-sm-9">  
	            <input type="number" class="form-control inputsm" name="NoHP" id="NoHP" placeholder="08xxxxxxxxxx" autocomplete="off" required   value =     >
	          </div>
	        </div>
	        <div class="form-group row"><!-- Jenis kelamin -->
	          <label class="control-label col-sm-3" for="kelamin">Jenis Kelamin:</label>
	          <div class="col-sm-9">  
	            <select class="form-control inputsm" name="Kelamin" id="Kelamin" placeholder="L/P"  value =     >
	            	<option>Laki laki</option>
				    <option {%if kelamin%}selected>Perempuan</option>
	            </select>
	          </div>
	        </div>
	        <div class="form-group row"> <!-- Institusi  -->
	          <label class="control-label col-sm-3" for="Institusi">Institusi:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Institusi" id="Institusi" placeholder="Institusi" required  value =     >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- SUhu badan -->
	          <label class="control-label col-sm-3" for="SuhuBadan">Suhu Badan:</label>
	          <div class="col-sm-9">  
	            <input type="number" step="any" class="form-control inputsm" name="Suhu" id="Suhu" placeholder="xx,x" required value =   >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Bertemu dengan:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Bertemu" id="Bertemu"
	            placeholder="Bapak/Ibu" required value =    >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Departemen:</label>
	          <div class="col-sm-9">  
	            <select type="text" class="form-control inputsm" name="departemen" id="departemen" required    
	            >
	            	<option selected disabled>Pilih</option>
	            	<option>departemen a</option>
	            	<option>departemen b</option>
	        	</select>
	          </div>
	        </div>
	        <div class="form-group row"> <!-- Keperluan -->
	          <label class="control-label col-sm-3" for="Keperluan">Keperluan:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Keperluan" id="Keperluan" placeholder="Untuk" required value =    >
	          </div>
	        </div>
	        <div class="form-group row ">
	          <label class="control-label col-sm-5" for="Luka">Terdapat Luka terbuka:</label>
	      	<!-- </div>
	      	<div class="form-group row"> -->
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id="Luka1"  checked=true          value = "1"> Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id ="Luka2"    checked=true  id = Luka value="0"> Tidak
	        	</label>
	        </div>
	        <div class="form-group row">
	          <label class="control-label col-sm-5" for="sakit"> Sakit dalam 3 hari terakhir:</label>
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="sakit" id="sakit_radio_y"  checked=true      onchange="sakit_aktive()"> Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="sakit" id="sakit_radio_n" value = "Tidak" checked=true     onchange="sakit_aktive()"> Tidak
	        	</label>

	        </div>
	        <div class="form-group row " >
	        <label class="control-label col-sm-3" for="sakit"> Jenis sakit :</label>
	          <div class="col-sm-9">  
	          	
	            <input type="text" class="form-control input-sm " name="Sakit" id="Sakit"  placeholder="Sehat"    required value =   >
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
	  			
	  			<!-- <div class="col-sm-6"> 
	  				<input id="cancel " type="submit" name="submit" id = "submit" class="col-sm-11 center btn" value = "logout">
	  			</div>
	  			 -->
	  			
  			</div>
  		</form>
    </div>
  </div>
  </div>
</div>


<script>
  
 //  const player = document.getElementById('player');
 //  const canvas = document.getElementById('canvas');
 //  const context = canvas.getContext('2d');
 //  const image = document.getElementById('Image')
 //  const radio_sakit = document.getElementById('sakit_radio_y')
 //  const radio_sakitn = document.getElementById('sakit_radio_n')
 //  const sakit = document.getElementById('Sakit')
 //  const lukay = document.getElementById('Luka1')
 //  const lukan = document.getElementById('Luka2')
 //  var sakit_flag = false
 //  const nama = document.getElementById("Nama")
 //  const hp = document.getElementById("NoHP")
 //  const inst = document.getElementById("Institusi")
 //  const suhu_badan = document.getElementById("Suhu")
 //  const bertemu = document.getElementById("Bertemu")
 //  const keperluan = document.getElementById("Keperluan")
 //  const submit = document.getElementById("submit")
 //  const flag = {{flag_auth}}
 //  const departemen = document.getElementById("departemen")

 //  if (!flag){
 //  	suhu_badan. = true
 //  	bertemu. = true
 //  	keperluan. = true
 //  	radio_sakit. = true
 //  	radio_sakitn. = true
 //  	submit. = true
 //  	lukay. = true
 //  	lukan. = true
 //  	departemen. = true
 //  	alert("anda telah melakukan pelanggaran lebih dari 3 kali")
 //  }

 //  const constraints = {
 //    video: true,
 //  };
 //  function cameracapture (){
 //  	// Draw the video frame to the canvas.
 //    handler = document.getElementById('image_location')
 //    handler = player
 //    context.drawImage(player, 0, 0, canvas.width, canvas.height);
 //     //get image
 //      var Pic = document.getElementById("canvas").toDataURL();
 //      Pic = Pic.replace(/^data:image\/(png|jpg);base64,/, "");
 //      image.value = Pic
 //  }

 //  function validateForm(){
 //  	if (sakit_flag == true){
 //  		sakit.value = "";
 //  	}
 //  	cameracapture();
 //  }

 //  function sakit_aktive(){
	// sakit_flag = !sakit_flag
	// sakit. = sakit_flag
	// sakit.required = !sakit_flag
 //  }


 //  // Attach the video stream to the video element and autoplay.
 //  navigator.mediaDevices.getUserMedia(constraints)
 //    .then((stream) => {
 //      player.srcObject = stream;
 //    });
 //  sakit_aktive()
</script>

</body>