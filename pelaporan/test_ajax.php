<!DOCTYPE html>
<html>
<head>
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
  
  <title>
    
  </title>
</head>
<body>
  <input type="date" name="test" id= "start" name ="a" onchange="get_data()">
  <input type="date" name="test" id= "end" name ="a" onchange="get_data()">
  <select id = "shift" onchange="get_data()"> 
    <option value = 1>1</option>
    <option value = 2>2</option>
    <option value = 3>3</option>
  </select>
</body>

<script type="text/javascript">

const start = document.getElementById("start");
const end = document.getElementById("end");
const shift = document.getElementById("shift");


function get_data(){
  if (start.value && end.value)
  $.ajax({
    url: "ajax/test_ajax.php", 
    type : 'POST',
    data : {start:start.value, end:end.value, shift:shift.value},
    success: function(result){
      console.log(result);
      console.log(JSON.parse(result));
  }});
}

</script>
</html>

