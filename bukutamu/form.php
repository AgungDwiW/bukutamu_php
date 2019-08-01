<?php 
	require "../db/db_con.php";
	

	$uid = $_POST["UID"];
	
    /* =====================
	loading settings
    ========================*/
	$max_temp = 0;
	$tipe = "";
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
	
	$no_tamu = -101;
	$flag_sign = 0; // wether tamu is signed in
	$flag_tamu = 0; // wether tamu is exist in db
	$flag_card = 0; // wether login using card
	$blocked = 0;
	$nama = "";
	$tid = "";
	$hp = "";
	$kelamin = "";
	$perusahaan = "";
	$image = "";
	$keperluan = "";
	$suhu = "";
	$luka = "";
	$no_pol = "";
	$sakit = "";
	$bertemu = "";
	$count = 1;
	$image = 'media/noimage.jpg';
	$ind = "0";
	$tgl = "";
	/* =====================
	Searching in kartu_tamu wether it's already taken
	if taken, then flag _sign is true
    ========================*/
	$sql = "select id_tamu from kartu_tamu where uid = '".$uid."'";
	$result = mysqli_query($conn, $sql);
	if ($result){
		while($row = mysqli_fetch_assoc($result)) {
			if ($row['id_tamu']){
				$id = $row['id_tamu'];
				$flag_card = 1;
			}
		/* =====================
		uid is using kartu_tamu's uid but not registered to any tamu's data
		thus error and redirect to index.php
	    ========================*/
			if(!isset($id))
			header('Location: ../index.php');	
		}
			
	}
	/* =====================
	if tamu is signed in ($flag_sign is true) id_tamu is id from id_tamu
    ========================*/
    if ($flag_card){
    	$id_tamu = $id;
    	$sql = "SELECT * FROM tamu where id = ". $id_tamu;
		$result_tamu = mysqli_query($conn, $sql);
		
		$a = '-'.$max_ind.' day';
		$b = strtotime($a);
		$ind_limit = date("Y-m-d", $b);
		$ind_limit = DateTime::createFromFormat('Y-m-d', $ind_limit);
		if (!$result_tamu){
			header('Location: index.php');
		}
		if (mysqli_num_rows($result_tamu) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result_tamu)) {
		    	$flag_tamu = 1;  //tamu is exist id db
		    	$nama = $row['nama_tamu'];
		    	$hp = $row['nohp'];
		    	$kelamin = $row['jenis_kelamin'];
		    	$flag_sign = $row ['signed_in'];
		    	$image = $row['image'];
		    	$blocked = $row['blok'];
		    	$tipe= $row['tipe'];
		    	$tgl = $row['tanggal_lahir'];
		    	$ymd = DateTime::createFromFormat('Y-m-d', $row['terakhir_ind']);
		    	// var_dump($ymd);
		    	$ind = $ymd<$ind_limit?"0":"1";
		    }
	    }
    }
    
    else{
    	/* =====================
		if tamu is not signed in ($flag_sign is true) id_tamu is from uid tables
	    ========================*/
    	$uid = $_POST['UID'];
    	$sql = "SELECT id_tamu, tipeid FROM uid_tamu where uid = '". $uid."'";
		$result_tamu = mysqli_query($conn, $sql);
		if ($result_tamu && mysqli_num_rows($result_tamu) > 0) {
		    while($row = mysqli_fetch_assoc($result_tamu)) {
		    	$id_tamu = $row['id_tamu'];
		    	$tid = $row['tipeid'];
		    }
		}
		if (isset($id_tamu)){
			$sql = "SELECT * FROM tamu where id = ". $id_tamu;
			$result_tamu = mysqli_query($conn, $sql);
			$a = '-'.$max_ind.' day';
			$b = strtotime($a);
			$ind_limit = date("Y-m-d", $b);
			$ind_limit = DateTime::createFromFormat('Y-m-d', $ind_limit);
			if (!$result_tamu){
				header('Location: index.php');
			}
			if (mysqli_num_rows($result_tamu) > 0) {
			    while($row = mysqli_fetch_assoc($result_tamu)) {
			    	$flag_tamu = 1; //tamu is exist id db
			    	$nama = $row['nama_tamu'];
			    	$hp = $row['nohp'];
			    	$kelamin = $row['jenis_kelamin'];
			    	$flag_sign = $row ['signed_in'];
			    	$image = $row['image'];
			    	$tipe= $row['tipe'];
			    	$blocked = $row['blok'];
			    	$tgl = $row['tanggal_lahir'];
			    	$ymd = DateTime::createFromFormat('Y-m-d', $row['terakhir_ind']);
			    	// var_dump($ymd);
			    	$ind = $ymd<$ind_limit?"0":"1";
			    	$id_tamu = $row['id'];
		    	}
		    }	
		    $sql = "SELECT count(*) as count FROM uid_tamu where id_tamu = ".$id_tamu;
			$result_tamu = mysqli_query($conn, $sql);
			if ($result_tamu){
				while($row = mysqli_fetch_assoc($result_tamu)) {
					$count = $row['count'];
		    	}
			}

		}
    }
    if (isset($id_tamu)){
		$sql = "SELECT * FROM kedatangan where signedout = false and id_tamu = ".$id_tamu;
		$result_tamu = mysqli_query($conn, $sql);
		if ($result_tamu){
		while($row = mysqli_fetch_assoc($result_tamu)) {
			$id_ked = $row['id'];
			$keperluan = $row['keperluan'];
			$suhu = $row['suhu_badan'];
			$luka = $row['luka'];
			$sakit = $row['sakit'];
			$bertemu = $row['bertemu'];
			$no_pol = $row['no_pol'];
			$departemen = $row['departemen'];
			$no_tamu = $row['id_keplek'];

		}}

		if ($no_tamu == ""){
			session_start();
			$_SESSION['id']	 = $id_ked;
			$_SESSION['flag'] = $suhu>$max_temp || $luka || $sakit;
			$_SESSION['id_tamu']	 = $id_tamu;
			header('Location: kartu.php');
    }}
    $image = $image."?".time()
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

<body style="background:url(../assets/bg/indexbackground.jpg)  fixed center no-repeat;" id = "body">
 <div class="wrapper" > 
  <div id="formContent" style="top: 0px ;	width: 95% ;">
  	<form method = "POST" action = <?php
          	if ($flag_sign) echo "logout.php?next=../index.php";
        	else echo "submit.php ";
           
           ?>

           class =  onsubmit="return validateForm()">
   <div class="row vertical-align" >
    <div class="col-sm-6" style="top: 0px">
    	 
			

    	<?php  
    		if ($flag_tamu){

    			echo "<img src = ".$image."?1 width=100% id  = 'image' </img>";
    			echo '<video id="player" width="60%"  controls autoplay hidden></video>
          <canvas id="canvas"  hidden height="300px" width="400px"></canvas>';
    		}
    		else if ($flag_sign){
    			echo "<img src = ".$image."?1 width=100%id  = 'image'></img>";
    		}
    		else{
    			echo "<img src = ".$image."?1 width=60% id  = 'image' hidden></img>";

    			echo '<video id="player" autoplay width="60%" controls ></video>
          <canvas id="canvas" class="col-sm-12" hidden="" height="300px" width="400px" ></canvas>';
    		}
    	?>
    	<br>
    
  			<?php if (!$flag_sign){ ?>
  					<input type="button" name="cancel" id = "capture" class="col-sm-8 btn" value="Mengambil Foto" onclick="cameracapture()">
			<?php }
			?>

         <div class="form-group row "><!-- UID -->
		          <label class="control-label col-sm-3" for="UID">Lama Kegiatan:</label>
			          
			          <div class="col-sm-<?php echo $flag_sign?6:4;?>">
			            <input type="date" class="form-control inputsm" name="msk" min=0 id="Tgl"  autocomplete="off" required <?php echo $tgl?"readonly":""; ?>  value = <?php echo $tgl; ?>    >
			          </div>
			          <div class="col-sm-<?php echo $flag_sign?6:4;?>">
			            <input type="date" class="form-control inputsm" name="msk" min=0 id="Tgl"  autocomplete="off" required <?php echo $tgl?"readonly":""; ?>  value = <?php echo $tgl; ?>    >
			          </div>
			          
		    </div>
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
    <div class="col-sm-6 v-divider text-left">
      
          
        <!--     <form method = "POST" action = {%url 'bukutamu:signout'%} class = "text-left">
         -->
  			<div id="buildyourform">
	    	
		    
	    
	        <div class="form-group row text-left"><!-- UID -->
		          <label class="control-label col-sm-3" for="UID">UID Utama:</label>
			          
			          <div class="col-sm-<?php echo $flag_sign?6:4;?>">
			            <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value =  "<?php echo $uid;?>" readonly > 
			          </div>
			          <div class="col-sm-<?php echo $flag_sign?3:2;?>"">
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
			       <?php if (!$flag_sign) {?>
		          <div class="col-sm-3">
		         	<button type="button" value="+" class="col-sm-5 btn btn-primary"  id="add">+</button> 
		         	<button type="button" value="-" class="col-sm-5 btn btn-danger"  id="removed">-</button></div> 
		         <?php } ?>
		    </div>
	        </div>   
	        <div class="form-group row"> <!-- nama -->
	          <label class="control-label col-sm-3" for="Nama">Nama:</label>
	          <div class="col-sm-6">  
	            <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama Tamu" style="text-transform:uppercase"   required  value =  "<?php echo $nama;  ?>" >
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
	            <input type="number" class="form-control inputsm" name="NoHP" min=0 id="NoHP" placeholder="08xxxxxxxxxx" autocomplete="off" required   value = <?php echo $hp; ?>    >
	          </div>
	        </div>
	        <div class="form-group row"> <!-- no HP -->
	          <label class="control-label col-sm-3" for="NoHP">Tanggal lahir:</label>
	          <div class="col-sm-9">  
	            <input type="date" class="form-control inputsm" name="Tgl" min=0 id="Tgl"  autocomplete="off" required <?php echo $tgl?"readonly":""; ?>  value = <?php echo $tgl; ?>    >
	          </div>
	        </div>
	        
	        <div class="form-group row"> <!-- SUhu badan -->
	        <label class="control-label col-sm-3" for="tipe">Kategori :</label>
              <div class="col-sm-9">  
                 <select type="text" class="form-control inputsm" name="tipe" id="tipe" required  onchange="set_sub()" 
                >
                    
                    <?php  
                        $sql = "SELECT * FROM tipe_tamu";   
                    $result_dep = mysqli_query($conn, $sql);
                    $parent = -1;
                    if (mysqli_num_rows($result_dep) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result_dep)) {
                    	if ($row['id'] == $tipe && $row['parent']){
                    		$parent = $row['parent'];
                    	}
                   }}
                    $sql = "SELECT * FROM tipe_tamu";   
                    $result_dep = mysqli_query($conn, $sql);
                    
                    
                    $child = array();
                    $tipes = array();
                    if (mysqli_num_rows($result_dep) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result_dep)) {

                        	$tipes[$row['id']] = $row['tipe'];
                        	if ($row['parent']){
                        		if (!isset($child[$row['parent']])){
                        		 $child[$row['parent']]= array();
                        		 array_push($child[$row['parent']], $row['id']);
                        		}

                        		else {
                        			array_push($child[$row['parent']], $row['id']);	
                        		}

                        	}
                        	else{
                        		
                        		if ($row['id'] == $tipe || $parent == $row['id'])
                            echo "<option name= 'tipe' value=".$row['id']." selected >".$row['tipe']."</option>";
                        		else{
                        			echo "<option name= 'tipe' value=".$row['id']."  >".$row['tipe']."</option>";
                        		}
                        	}
                        }
                    }

                    ?>
                </select>

              </div></div>
	        <div class="form-group row" hidden id = "hidden_sub"> <!-- Institusi  -->
	          <label class="control-label col-sm-3" for="subtip"></label>
	          <div class="col-sm-9">  
	            <select type="text" class="form-control inputsm" name="subtip" id="subtip" placeholder="Institusi" required  disabled >
	            </select>
	          </div>
	        </div>
	        
	        
	        <div class="form-group row"> <!-- SUhu badan -->
	          <label class="control-label col-sm-3" for="nopol">No polisi:</label>
	          <div class="col-sm-9">  
	            <input type="text" step="any" class="form-control inputsm" name="nopol" id="nopol" placeholder="Nomor polisi kendaraan" style="text-transform:uppercase" required value = <?php echo $no_pol?>  >
	          </div>
	        </div>
			
	        
	        <div class="form-group row"> <!-- SUhu badan -->
	          <label class="control-label col-sm-3" for="SuhuBadan">Suhu Badan:</label>
	          <div class="col-sm-9">  
	            <input type="number" step="any" class="form-control inputsm" name="Suhu" id="Suhu" placeholder="xx.x" required value = <?php echo $suhu?>  >
	          </div>
	        </div>
			
			
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Bertemu:</label>
	          <div class="col-sm-9">  
	            <input type="text" class="form-control inputsm" style="text-transform:uppercase" name="Bertemu" id="Bertemu"
	            placeholder="Bapak/Ibu" autocomplete="off" required value =  "<?php echo  $bertemu ?>" >
	          </div>
	        </div>
			
	        <div class="form-group row"> <!-- BErtemu dengan -->
	          <label class="control-label col-sm-3" for="Bertemu">Departemen:</label>
	          <div class="col-sm-9">  
	            <select type="text"  class="form-control inputsm" name="departemen" id="departemen" required    
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
	            <input type="text" class="form-control inputsm" style="text-transform:uppercase" name="Keperluan" id="Keperluan" placeholder="Untuk" required value = "<?php echo  $keperluan ?>"   >
	          </div>
	        </div>
	        <div class="form-group row ">
	          <label class="control-label col-sm-5" for="Luka">Terdapat Luka terbuka:</label>
	      	<!-- </div>
	      	<div class="form-group row"> -->
	          	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id="Luka1"       onchange="luka_aktive()"     value = "1"> Ya
	        	</label>
	        	<label class="radio-inline col-sm-2">
	            <input type="radio"  name="Luka" id ="Luka2"  onchange="luka_aktive()"  <?php echo !$luka?"checked":""; ?>  value="0"> Tidak
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
	          	
	            <input type="text" class="form-control input-sm " name="Sakit" id="Sakit" autocomplete="off" style="text-transform:uppercase" placeholder="Sehat"  readonly required   >
	          </div>
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
	  				
			  			<input type="button" name="cancel" id = "cancel"  value="Kembali" onclick="location.href = '../index.php';">

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
			                
			                <h3 class="modal-title w-100" id="myModalLabel">Peringatan</h4>
			            </div>
			            <!--Body-->
			            <div class="modal-body">
			             	INDIKATOR MENYATAKAN ANDA KURANG SEHAT.<br>
			             	ANDA DILARANG UNTUK MEMASUKI AREA PRODUKSI.<br>
			             	APAKAH ANDA YAKIN MEMASUKI AREA PABRIK?.
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
		</div></div>
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
	 const type = "<?php echo $tipe ?>";
	 const child_json = JSON.parse('<?php echo json_encode($child) ?>');
	 const tipe_json = JSON.parse('<?php echo json_encode($tipes) ?>');
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
     const tid = document.getElementById("TID")
     const tipe_tamu = document.getElementById("tipe");
     const sub_tamu = document.getElementById('subtip');
     var flag_camera = false;
     var acc_temp = false;

     if (!flag_tamu)
     	flag_camera = true;
     if(flag_tamu || flag_sign){
     	tid.disabled = true;
     	nama.readOnly = true;
     	hp.readOnly = true;
     	kelamin.disabled = true;
     	tipe_tamu.disabled = true;
     	sub_tamu.disabled = true;

     	// departemen.readOnly = true;
     }
     if (flag_sign){
     	 sakit_val = "<?php echo "$sakit";?>";
     	luka_val = "<?php echo $luka?"true":"false";?>";
     	luka_val=="true"?luka_val=true:luka_val=false;
     	sakit_radio_y.checked = sakit_val==""?false:true;
     	sakit.value = sakit_val;
     	lukay.checked = luka_val
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
     	document.getElementById('nopol').disabled=true;
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
		 sakit.readOnly = sakit_flag
		 sakit.required = !sakit_flag
		 if(!sakit_flag)
		 	change_indikator();
     }
     function luka_aktive(){
     	luka_flag = !luka_flag
     	if (luka_flag)
     		change_indikator();
     }

     function change_indikator(){
     	console.log(luka_flag)
     	console.log(!sakit_flag)
     	console.log(!temp_flag)
     	if (luka_flag || !sakit_flag || temp_flag){
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
    		
    	}
    }
	function set_sub(){
		if (tipe_tamu.value in child_json){
			child = child_json[tipe_tamu.value];
			for (x=0; x<child.length; x++){				
				var option = document.createElement("option");
				if (child[x] == type)
					option.selected=true;
				option.text = tipe_json[child[x]];
				option.value = child[x];
				sub_tamu.add(option);
			}
			hidden_sub.hidden = false;
			sub_tamu.disabled = false;
		}
		else{
			sub_tamu.innerHTML = "";
			hidden_sub.hidden = true;	
			sub_tamu.disabled = true;
		}
		if(flag_sign||flag_tamu){
			sub_tamu.disabled = true;
		}
	}
	set_sub();

     $(document).ready(function() {
     	 var counter = <?php echo $count ?>;
    $("#add").click(function() {
    	if(counter>3){
            alert("Hanya tiga identitas yang diperbolehkan setiap tamu!.");
            return false;
    } 
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
         var fieldWrapper = $("<div class=\"form-group row text-left\" id =\"UID" + counter +"\"/>");
        var fName = $("<div class=\"col-sm-6\">  <input type=\"text\" class=\"form-control inputsm\" placeholder=\"UID"+counter+"\" id = uid"+counter+" name = uid"+counter+"> </div>");
        var fType = $("<div class=\"col-sm-3\"><select class=\"form-control inputsm\"  placeholder=\"Tipe id\"required id = tid"+counter+" name = tid"+counter+"><option value=\"KTP\"" + ">KTP</option><option value=\"Kartu Pegawai\"" + ">Kartu Pegawai</option><option value=\"SIM\"" +">SIM</option></select></div>"); 
        var removeButton = $("<label class=\"control-label col-sm-3\" for=\"UID\">UID Tambahan:</label>);")
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(removeButton);
        fieldWrapper.append(fName);
        fieldWrapper.append(fType);
        counter++;
        $("#buildyourform").append(fieldWrapper);
    });
    /**/
	   $("#removed").click(function () {
	    if(counter==1){
	          alert("satu identitas minimal untuk setiap tamu");
	          return false;
	       }   

	    counter--;

	        $("#UID" + counter).remove();

	     });
});

     
   

</script>
 <?php include("footer.php") ; ?>
</body>
