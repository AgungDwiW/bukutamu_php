<!DOCTYPE html>
<html>
<head>
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
  
  <title>
    
  </title>
</head>
<body>
  <input type="text" name="test" id= "uid" name ="a" onchange="get_data()">
  <input type="date" name="test" id= "tgl" name ="a" onchange="get_data()">

  <input type="text" id = "uids" onchange="get_uid()">
</body>

<script type="text/javascript">

const nama = document.getElementById("uid");
const tgl = document.getElementById("tgl");
const uid = document.getElementById("uids");

function tot(){
  
}


function get_data(){
  if (nama.value.length >3 && tgl.value)
  $.ajax({
    url: "ajax/get_tamu_tgl_name.php", 
    type : 'POST',
    data : {nama:nama.value, tgl:tgl.value},
    success: function(result){
      console.log(result);
      console.log(JSON.parse(result));
  }});
}

function get_uid(){
  if (uid.value.length>1)
  $.ajax({
    url: "ajax/get_uid_suggest.php", 
    type : 'POST',
    data : {uid:uid.value},
    success: function(result){
      console.log(result);
      console.log(JSON.parse(result));
  }});
}
</script>
</html>

