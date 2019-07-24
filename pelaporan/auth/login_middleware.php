<?php 
require "auth/check.php";
// echo check_login();
if (!check_login()){
	// echo 0;
	header('Location: index.php?status=2');
}
?>
