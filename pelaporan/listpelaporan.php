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
                            List Pelaporan             
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
                                        <th style="min-width:5%; max-width: 10%">Nama Pelapor</th>
                                        <th style="min-width:5%;">Tanggal Pelanggaran</th>
                                        <th style="min-width:5%;">UID Pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Nama Pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Departemen</th>
                                        <th style="min-width:5%; max-width: 10%">Area</th>
                                        <th style="min-width:8%;">12 Basic</th>
                                        <th style="min-width:7%;">Sub Kategori</th>
                                        <th style="min-width:5%;">+/-</th>
                                        <th style="min-width:5%; max-width: 15%">Action Plan </th>
                                        
                                        <th style="min-width:5%; max-width: 15%">Keterangan</th>
                                    	<th style="min-width:5%; max-width: 15%">delete</th>
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
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan tombol hapus untuk mengkonfirmasi penghapusan!</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" id = "link" href="auth/logout.php">hapus</a>
                    </div>
                </div>
            </div>
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
              url: "ajax/get_pelanggaran_list.php", 
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
          console.log(json);  
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
            json[x]['nama_pelapor'],
            json[x]['tanggal_pelanggaran'],
            json[x]['uid'],
            json[x]['pelanggar'],
            json[x]['departemen'],
            json[x]['area'],
            json[x]['tipe_12'],
            json[x]['subkategori'],
            parseInt(json[x]['positif'])?"+":"-",
            json[x]['ap'],
            json[x]['keterangan'],
            '<td style="vertical-align:middle;">                                            <a href="" class="nav-link" onclick="document.getElementById(\'link\').href =  \'hapuspelaporan.php?id='+json[x]['id']+'\'" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal2" ><i class="fa fa-fw fa-trash"></i><span class="nav-link-text" >Hapus</span></a></td>'
            
        ] ).draw( false );
 
        counter++;
      }
    </script>
   