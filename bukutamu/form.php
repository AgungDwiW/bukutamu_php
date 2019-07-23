<?php 
	require "../db/db_con.php";
	
	$uid = $_POST["UID"];
	

	$max_temp = 0;
    $sql = "SELECT value FROM setting where nama = 'max_temp' ";
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$max_temp = $row['value'];
    }
	$max_pel =0;
	 $sql = "SELECT value FROM setting where nama = 'max_pel' ";
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$max_pel = $row['value'];
    }
    $max_ind = 0;
    $sql = "SELECT value FROM setting where nama = 'max_ind' ";
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$max_ind = $row['value'];
    }
	// echo $flag_tamu;
	$no_tamu = -101;
	$flag_sign = 0;
	$nama = "";
	$tid = "";
	$hp = "";
	$kelamin = "";
	$flag_sign = "";
	$perusahaan = "";
	$image = "";
	$keperluan = "";
	$suhu = "";
	$luka = "";
	$sakit = "";
	$bertemu = "";
	$saved = true;
	$count = 0;
	$flag_avail = false;
	$image = 'media/noimage.jpg';
	$ind = "0";
	$sql = "SELECT * FROM tamu where uid = ". $_POST["UID"];
	$result_tamu = mysqli_query($conn, $sql);
	$flag_tamu = 1;
	$blocked = 0;
	$a = '-'.$max_ind.' day';
	
	$b = strtotime($a);
	
	$ind_limit = date("Y-m-d", $b);
	$ind_limit = DateTime::createFromFormat('Y-m-d', $ind_limit);
	// var_dump($ind_limit);
	
	
	// echo "<br>";
	if (!$result_tamu){
		header('Location: index.php');
	}
		if (mysqli_num_rows($result_tamu) ==0){
		$flag_tamu = 0;
	}
	if (mysqli_num_rows($result_tamu) > 0) {
		$flag_avail = true;
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result_tamu)) {
	    	$nama = $row['nama_tamu'];
	    	$tid = $row['tipeid'];
	    	$hp = $row['nohp'];
	    	$kelamin = $row['jenis_kelamin'];
	    	$flag_sign = $row ['signed_in'];
	    	$perusahaan = $row ['perusahaan'];
	    	$image = $row['image'];
	    	$flag_tamu = $row['saved'];
	    	$saved = $row['saved'];
	    	$blocked = $row['blok'];
	    	$ymd = DateTime::createFromFormat('Y-m-d', $row['terakhir_ind']);
	    	// var_dump($ymd);
	    	$ind = $ymd<$ind_limit?"0":"1";
	    	$id = $row['id'];
	    	
	    }
	    $sql = "SELECT * FROM kedatangan where signedout = false and id_tamu = ".$id;
		// echo $sql;
		// echo $perusahaan;
		$result_tamu = mysqli_query($conn, $sql);
		if ($result_tamu){
		while($row = mysqli_fetch_assoc($result_tamu)) {
			// var_dump($row);
			$id_ked = $row['id'];
	    	$keperluan = $row['keperluan'];
	    	$suhu = $row['suhu_badan'];
	    	$luka = $row['luka'];
	    	$sakit = $row['sakit'];
	    	$bertemu = $row['bertemu'];
	    	$departemen = $row['departemen'];
	    	$no_tamu = $row['id_keplek'];

	    }
	    if ($no_tamu == ""){
	    	header('Location: kartu.php?id='.$id_ked);
	    }
	}}

	else{

	}
		if (!$flag_tamu){
			if (!$flag_sign)
				$perusahaan = "";
	}
	if ($flag_sign == null){
		$flag_sign = 0;
	}
	
	// var_dump($tid);
 ?>
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

<body style="background:url(../assets/bg/indexbackground.jpg)  fixed center no-repeat; margin:0 auto; height:auto" >
 <div class="wrapper" > 
  <div id="formContent" style="top: 0px">
   <div class="row vertical-align" >
    <div class="col-sm-6" >

    	<?php  
    		if ($flag_tamu){

    			echo "<img src = ".$image."?1 width=60% height=40% id  = 'image' </img>";
    			echo '<video id="player" width="80%"  controls autoplay hidden></video>
          <canvas id="canvas"  hidden width="400px" height="300px"></canvas>';
    		}
    		else if ($flag_sign){
    			echo "<img src = ".$image."?1 width=80% id  = 'image'></img>";
    		}
    		else{
    			    			echo "<img src = ".$image."?1 width=80% id  = 'image' hidden></img>";

    			echo '<video id="player" autoplay width="80%" controls ></video>
          <canvas id="canvas" class="col-sm-12" hidden="" width="400px" height="300px" ></canvas>';
    		}
    	?>
    	<br>
    
  			<?php if (!$flag_sign){ ?>
  					<input type="button" name="cancel" id = "capture" class="col-sm-8 btn" value="Mengambil Foto" onclick="cameracapture()">
			<?php }
			?>
      
       <div class="form-group row"> <!-- no HP -->
	          <label class="control-label col-sm-3" for="ind">Status Induksi:</label>
	          <div class="col-sm-6">  
	          	<?php if($ind){?>
	            <input type="text" class="form-control inputsm" name="Ind" id="Ind" placeholder="" autocomplete="off" readonly   value = "Sudah Induksi"  style="background-color: #78be20"  >
	        	<?php }
	        	else {?>
	        	<input type="text" class="form-control inputsm" name="Ind" id="Ind" placeholder="" autocomplete="off" readonly   value = "Belum induksi"  style="background-color: red"  >
	        		<?php }?>
	          </div>
	        </div> 
	     
	        
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
		    	<?php 
		    	
	        		if (isset($id)){
		    		$sql = "SELECT * FROM kedatangan where id_tamu = ". $id." ORDER BY id DESC LIMIT 3";
		    		
		    		$result = mysqli_query($conn, $sql);
		    		if ($result && mysqli_num_rows($result) > 0) {
				    // output data of each row
				   
				    	
				
		    	 while($row = mysqli_fetch_assoc($result)) {
		    	 	$date = strtotime($row['tanggal_datang']);
		    	 	$date =  date('d-m-Y',$date);
		    	?>
		    	
				      <tr >
				        <td><?php echo  $date;?></td>
				        <td><?php echo  $row['bertemu'];?></td>
				        <td><?php echo  $row['keperluan'];?></td>
				      </tr>
				  <?php }?>
		<?php }}?>	    
		    </tbody>
		  </table>
		</div>
      </div>
      
    </div>
    <div class="col-sm-6 v-divider">
      
          <form method = "POST" action = <?php
          	if ($flag_sign) echo "logout.php?next=index.php";
        	else echo "submit.php ";
           
           ?>

           class = "text-left"  onsubmit="return validateForm()">
       
        <!--     <form method = "POST" action = {%url 'bukutamu:signout'%} class = "text-left">
         -->
  			<br>
	        <div class="form-group row"><!-- UID -->
	          <label class="control-label col-sm-3" for="UID">UID:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value =  "<?php echo $uid;?>" readonly > 
	          </div>
	          <div class="col-sm-3">
	            <select class="form-control inputsm" name="TID" id="TID" placeholder="Tipe id"    required>
	            	
	            	<option value="KTP"<?php 

	            		if ($tid == "KTP") {
	            			echo "selected";
	            		}
	            	 ?>>KTP</option>
	            	<option value="Kartu Pegawai"<?php 
	            		if ($tid == "Kartu Pegawai") {
	            			echo "selected";
	            		}
	            	 ?>
	            	>Kartu Pegawai</option>
	            	<option value="SIM" <?php 
	            		if ($tid == "SIM") {
	            			echo "selected";
	            		}
	            	 ?>>SIM</option>
	            </select>
	          </div>
	        </div>
	        
	        
	        
	        <div class="form-group row"> <!-- nama -->
	          <label class="control-label col-sm-3" for="Nama">Nama:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama"    required  value =  <?php echo $nama;  ?> >
	          </div>
	          <div class="col-sm-3">  
	            <select class="form-control inputsm" name="Kelamin" id="Kelamin" placeholder="L/P"   >
	            	<option value="L" >L</option>
				    <option value="P" <?php  
				    	if ($kelamin == "P"){
				    		echo "selected";
				    	}
				    ?>>P</option>
	            </select>
	        </div>
	        </div>
	        <div class="form-group row"> <!-- no HP -->
	          <label class="control-label col-sm-3" for="NoHP">Nomor HP:</label>
	          <div class="col-sm-9">  
	            <input type="number" class="form-control inputsm" name="NoHP" id="NoHP" placeholder="08xxxxxxxxxx" autocomplete="off" required   value = <?php echo $hp; ?>    >
	          </div>
	        </div>
	      
	        <div class="form-group row"> <!-- Institusi  -->
	          <label class="control-label col-sm-3" for="Institusi">Institusi:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Institusi" id="Institusi" placeholder="Institusi" required  value = <?php echo  $perusahaan ?>     >
	          </div>
	        </div>
	         <div class="form-group row"> <!-- SUhu badan -->
	        <label class="control-label col-sm-3" for="tipe">Kategori :</label>
              <div class="col-sm-9">  
                 <select type="text" class="form-control inputsm" name="tipe" id="tipe" required    
                >
                    
                    <?php  
                    $sql = "SELECT * FROM tipe_tamu";   
                    $result_dep = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result_dep) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result_dep)) {
                        
                            echo "<option name= 'tipe' value=".$row['id']." selected >".$row['tipe']."</option>";
                        
                        }
                    }
                    ?>
                </select>

              </div></div>
	        
	        <div class="form-group row"> <!-- SUhu badan -->
	          <label class="control-label col-sm-3" for="SuhuBadan">Suhu Badan:</label>
	          <div class="col-sm-9">  
	            <input type="number" step="any" class="form-control inputsm" name="Suhu" id="Suhu" placeholder="xx,x" required value = <?php echo $suhu?>  >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Bertemu dengan:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Bertemu" id="Bertemu"
	            placeholder="Bapak/Ibu" autocomplete="off" value =  <?php echo  $bertemu ?> >
	          </div>
	        </div>
			
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Departemen:</label>
	          <div class="col-sm-9">  
	            <select type="text" class="form-control inputsm" name="departemen" id="departemen" required    
	            >
	            	
	            	<?php  
	            	$sql = "SELECT * FROM departemen order by nama_departemen";	
	            	$result_dep = mysqli_query($conn, $sql);
	            	if (mysqli_num_rows($result_dep) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result_dep)) {
					    	if ($row['id'] == $departemen)
					    	{
					    	echo "<option name= 'departemen' value=".$row['id']." selected >".$row['nama_departemen']."</option>";	
					    	}
					    	else{
					    	echo "<option name= 'departemen' value=".$row['id']." >".$row['nama_departemen']."</option>";
					    }
					    }
					}
	            	?>
	        	</select>
	          </div>
	        </div>
	        <div class="form-group row"> <!-- Keperluan -->
	          <label class="control-label col-sm-3" for="Keperluan">Keperluan:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" name="Keperluan" id="Keperluan" placeholder="Untuk" required value = <?php echo  $keperluan ?>   >
	          </div>
	        </div>
	        <div class="form-group row ">
	          <label class="control-label col-sm-5" for="Luka">Terdapat Luka terbuka:</label>
	      	<!-- </div>
	      	<div class="form-group row"> -->
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id="Luka1"  checked=true     onchange="luka_aktive()"     value = "1"> Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id ="Luka2"  onchange="luka_aktive()"  checked=true  value="0"> Tidak
	        	</label>
	        </div>
	        <div class="form-group row">
	          <label class="control-label col-sm-5" for="sakit"> Sakit dalam 3 hari terakhir:</label>
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="sakit" id="sakit_radio_y"  checked=true value="1" onchange="sakit_aktive()"> Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="sakit" id="sakit_radio_n" value = "0" checked=true     onchange="sakit_aktive()"> Tidak
	        	</label>

	        </div>
	        <div class="form-group row " >
	        <label class="control-label col-sm-3" for="sakit"> Jenis sakit :</label>
	          <div class="col-sm-9">  
	          	
	            <input type="text" class="form-control input-sm " name="Sakit" id="Sakit" autocomplete="off" placeholder="Sehat"  readonly required   >
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="control-label col-sm-5" for="sakit"> Simpan data diri 	:</label>
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="save" id="save_radio_y" value="1" checked > Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="save" id="save_radio_n" value = "0"  <?php if(!$saved)echo "checked"	;?>> Tidak
	        	</label>
	        </div>
	        <div class="form-group row"  >
  			<input type="hidden" id = "Image" name = "Image" >
  			
  			<div class="" style="display: inline-grid; text-align: center; grid-column-start: 1; grid-column-end: 3;">
            
          	 
  			<?php  
  				if (!$flag_sign){
  			?>
  				<div class="grid-item col-sm 6">
		  			<input type="submit" name="submit" id = "submit"  value="Masuk">
	  			</div>

	  		<?php
	  			}
	  			else{
	  			?>
	  			<div class="grid-item">
	  				<input  type="submit" name="submit" id = "submit" class="col-sm-11 center btn" value ="Keluar" >
	  			</div>
	  			 <?php
	  			}
	  		?>
  			</div>
	  			<div class="grid-item col-sm-6">
	  				
			  			<input type="button" name="cancel" id = "cancel"  value="Kembali" onclick="location.href = 'index.php';">

	  			</div>
  			</div>
  			<!-- Button trigger modal -->

			<!-- Modal -->
			<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog" role="document">
			        <!--Content-->
			        <div class="modal-content">
			            <!--Header-->
			            <div class="modal-header center">
			                
			                <h4 class="modal-title w-100" id="myModalLabel">Peringatan</h4>
			            </div>
			            <!--Body-->
			            <div class="modal-body">
			                Indikator menyatakan anda kurang sehat, Apakah Anda yakin akan Mengunjungi/Memasuki Area pabrik?.
			            </div>
			            <!--Footer-->
			            <div class="modal-footer">
			            	 <a class="btn btn-primary" id = "link" href="index.php">Tutup</a>
			                
			                <button type="button" class="btn btn-danger" data-dismiss="modal">Yakin</button>
			            </div>
			        </div>
			        <!--/.Content-->
			    </div>
			</div>
			<!-- Modal -->

  		</form>
    </div>
  </div>
  </div>
</div>


<script>
	<?php  if (!$flag_sign){
		echo "const player = document.getElementById('player');
     const canvas = document.getElementById('canvas');
     const context = canvas.getContext('2d');
     const image = document.getElementById('Image');";
	}
	?>  
	 <?php 
	 echo "const max_temp = $max_temp; "; 
	 echo "const max_pel  = $max_pel;";
	 echo "const max_ind = $max_ind;";
	 ?>
	 const acc_color = '#78be20'
	 const rej_color = 'red'
	 const indikator = document.getElementById('indikator')
     const radio_sakit = document.getElementById('sakit_radio_y')
     const radio_sakitn = document.getElementById('sakit_radio_n')
     const sakit = document.getElementById('Sakit')
     const lukay = document.getElementById('Luka1')
     const lukan = document.getElementById('Luka2')
     var sakit_flag = true
     var luka_flag = false
     var temp_flag = false
     const nama = document.getElementById("Nama")
     const hp = document.getElementById("NoHP")
     const inst = document.getElementById("Institusi")
     const suhu_badan = document.getElementById("Suhu")
     const bertemu = document.getElementById("Bertemu")
     const keperluan = document.getElementById("Keperluan")
     const submit = document.getElementById("submit")
     const flag = false
     const flag_tamu = <?php echo $flag_tamu; ?>;
     const flag_sign = <?php echo $flag_sign; ?>;
     const departemen = document.getElementById("departemen")
     const kelamin =  document.getElementById("Kelamin")
     const institusi = document.getElementById("Institusi")
     const tid = document.getElementById("TID")
     const tipe_tamu = document.getElementById("tipe")
     
     var flag_camera = false;
     var acc_temp = false;

     if (!flag_tamu)
     	flag_camera = true;
     if(flag_tamu || flag_sign){
     	tid.disabled = true;
     	nama.readOnly = true;
     	hp.readOnly = true;
     	kelamin.disabled = true;
     	institusi.readOnly = true;
     	// departemen.readOnly = true;
     }
     if (flag_sign){
     	 sakit_val = "<?php echo "$sakit";?>";
     	luka_val = "<?php echo "$luka";?>";
     	sakit_radio_y.checked = sakit_val==""?false:true;
     	sakit.value = sakit_val;
     	lukay.checked = luka_val
     	institusi.readOnly= true	
     	suhu_badan.readOnly = true
     	bertemu.readOnly = true
     	keperluan.readOnly = true
     	radio_sakit.disabled = true
     	radio_sakitn.disabled = true
     	// submit.readOnly = true
     	lukay.disabled = true
     	lukan.disabled = true
     	departemen.disabled = true	
     	acc_temp = true;
     	document.getElementById('tipe').disabled=true;
     	
     }
     <?php
    
	if ($blocked){
	?>
			// echo $row['count'];
     // if (!flag){

     	suhu_badan.readOnly = true
     	bertemu.readOnly = true
     	keperluan.readOnly = true
     	radio_sakit.disabled = true
     	radio_sakitn.disabled = true
     	submit.readOnly = true
     	submit.disabled = true
     	lukay.disabled = true
     	lukan.disabled = true
     	departemen.disabled = true
     	document.getElementById('tipe').disabled=true;
     	
     	document.getElementById("capture").disabled = true
     	alert("anda telah diblok untuk masuk kedalam pabrik")
     <?php }?>
     // }
     <?php  if (!$flag_sign){?>
     	const constraints = {
       video: true,
     };

     function cameracapture (){
     	// Draw the video frame to the canvas.
     	console.log(flag_camera);
     	if (flag_camera){
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
   		else{
   			flag_camera = true;
   			document.getElementById("image").hidden = true;
   			player.hidden = false;
   		}

     }

     function validateForm(){
     	if (sakit_flag == true){
     		sakit.value = "";
     	}
     	tid.disabled = false
     	kelamin.disabled = false;
     	if(!player.paused && flag_camera){
     		alert("belum mengambil foto");
     		return false;
     	}
     	// cameracapture();
     }
     // Attach the video stream to the video element and autoplay.
  // Attach the video stream to the video element and autoplay.
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });
     
     <?php ;
     
 	}
 	?>
     function sakit_aktive(){
		 sakit_flag = !sakit_flag
		 sakit.readOnly = !sakit_flag
		 sakit.required = sakit_flag
		 change_indikator();
     }
     function luka_aktive(){
     	luka_flag = !luka_flag
     	change_indikator();
     }

     function change_indikator(){
     	if (luka_flag || sakit_flag || temp_flag){
     		
     		$('#modal1').modal('show');
     	}
     }


    suhu_badan.oninput = function () {
    	if (this.value > max_temp)
    	{
    		$("#Suhu").addClass('is-invalid')
			// or
			temp_flag = true;
			change_indikator();
    	}
    	else{
    		$("#Suhu").removeClass('is-invalid')
    		temp_flag = false
    		change_indikator();
    	}
    }
	
 	
     sakit_aktive()
</script>
 <?php include("footer.php") ; ?>
</body>