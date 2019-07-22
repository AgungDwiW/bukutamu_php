<?php include("template.php") ;
 require "../db/db_con.php"; 
 $tz_object = new DateTimeZone('Asia/Jakarta');
$datetime = new DateTime();
$datetime->setTimezone($tz_object);
$now_date = $datetime->format('Y\-m\-d');
$now_date_old = $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

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
                            List peresetan          
                        </div>
                        <div class="card-body">
                                <!-- Grid -->

                            <div class="col-sm-12" style="overflow-x: scroll">
                                   <div class="form-group row"><!-- UID -->
                                          Range data:
                                          <div class="col-sm-2">  
                                            <input type="date" name="start" id = "start" class="form-control form-control-sm " onchange= "get_data()" value="<?php echo $now_date_old ?>">
                                          </div> - 
                                          <div class="col-sm-2">
                                            <input type="date" name="end" id = "end" class="form-control form-control-sm " onchange= "get_data()" value=<?php echo '"'.$now_date.'"' ?>>
                                          </div>
                                        </div>  
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">NIK</th>
                                        <th style="min-width:5%;">Nama petugas</th>
                                        <th style="min-width:5%;">UID pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Nama Pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Tanggal peresetan</th>
                                        <th style="min-width:5%; max-width: 10%">MOU</th>
                                        
                                    </tr>

                                </thead>
                                <tbody>
                               

                                </tbody>
                               
                            </table>
                            </div>
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
              url: "ajax/get_pengampunan_list.php", 
              type : 'POST',
              data : {start:start.value,end:end.value},
              success: function(result){

              add_data(result);
            }});

          }
        }

      function add_data(json){
        console.log(json);  
        try {
          json = JSON.parse(json);
          console.log(json);  
        }
        catch(err) {
          t.clear().draw();
         return false;
        }

         t.clear().draw();
          counter = 1;
          for (x=0;x<json.length; x++){
           t.row.add( [
            counter,
            json[x]['nik'],
            json[x]['nama_karyawan'],
            json[x]['uid_tamu'],
            json[x]['nama_tamu'],
            json[x]['tanggal_pengampunan'],
            
            '<td> <a href="'+json[x]['mou']+'" class="nav-link" target="_blank" style="color: DodgerBlue;"><i class="fa fa-pencil-square-o"></i> <span class="nav-link-text" >MOU</span></a></td>'
            
        ] ).draw( false );
 
        counter++;}
      }
    </script>
   