<?php include("template.php") ;
require "../db/db_con.php";
 $tz_object = new DateTimeZone('Asia/Jakarta');
$datetime = new DateTime();
$datetime->setTimezone($tz_object);
$now_date = $datetime->format('Y\-m\-d');
$now_date_old = $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

?>
?>
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
                           Bukutamu
                              
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            
                             <div class="form-group row"><!-- UID -->
                                          Range data:
                                         <div class="col-sm-2">  
                                            <input type="date" name="start" id = "start" class="form-control form-control-sm " onchange= "get_data()" value="<?php echo $now_date_old ?>">
                                          </div> - 
                                          <div class="col-sm-2">
                                            <input type="date" name="end" id = "end" class="form-control form-control-sm " onchange= "get_data()" value=<?php echo '"'.$now_date.'"' ?>>
                                          </div>
                                        </div>  
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center; vertical-align:middle;">
                                <thead>
                                    <tr>
                                      <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">UID</th>
                                        <th style="min-width:5%; max-width: 10%">Nama</th>
                                        <th style="min-width:5%; max-width: 10%">Tipe</th>
                                        <th style="min-width:30%;">Tanggal datang</th>
                                        <th style="min-width:30%;">Tanggal keluar</th>
                                        <th style="min-width:30%;">Durasi (Jam)</th>
                                        <th style="min-width:30%;">Bertemu dengan</th>
                                        <th style="min-width:30%;">Departemen</th>
                                        <th style="min-width:25%;">Keperluan</th>
                                        <th style="min-width:25%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                </tbody>
                               
                            </table>
                            <br>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
                    <!-- /.content -->
    </div>
  <?php include("footer.php") ; 

  $tz_object = new DateTimeZone('Asia/Jakarta');
$datetime = new DateTime();
$datetime->setTimezone($tz_object);
$now_date = $datetime->format('Y\-m\-d');
$now_date_old = $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

?>  

</body>

 <script>
        var temp = $("#start");
        const start = temp[0];
        var temp = $("#end");
        const end= temp[0];
        const t = $('#example1').DataTable({
                "searching": true,
            });

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
        $(document).ready(function() {
           get_data();
        } );
        
        function get_data(){
          if (start.value !="" && end.value!=""){

            $.ajax({
              url: "ajax/get_bukutamu_list.php", 
              type : 'POST',
              data : {start:start.value,end:end.value},
              success: function(result){

              add_data(result);
            }});

          }
        }

      function add_data(json){
        try {
          json = JSON.parse(json);
        }
        catch(err) {
          t.clear().draw();
         return false;
        }
       
         t.clear().draw();
          counter = 1;
          for (x=0;x<json.length; x++)
           t.row.add( [
            counter,
            json[x]['uid'],
            json[x]['tamu'],
            json[x]['tipe'],
            json[x]['tanggal_datang'],
            json[x]['tanggal_keluar'],
            Math.round(json[x]['durasi'] ),
            json[x]['bertemu'],
            json[x]['departemen'],
            json[x]['keperluan'],
            json[x]['status']
            
        ] ).draw( false );
 
        counter++;
      }
    </script>
   

