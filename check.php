<?php  
function check_login(){
	
	require "db/db_con.php";
    if (isset($_COOKIE["key"])){
    	$sql = "SELECT * FROM session where session_key = '".$_COOKIE["key"]."'";
    	// echo $sql;
    	$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) ==0)
			return 0;
		else
        	return 1;
    }
    else return 0;
}
function check_super(){

	require "db/db_con.php";
	if (!check_login()) return 0;
	$sql = "SELECT is_super FROM session where session_key = '".$_COOKIE["key"]."'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$super = $row['is_super'];
	}
	return $super;
}
?>