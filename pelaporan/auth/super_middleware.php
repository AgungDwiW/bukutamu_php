<?php 
require "auth/check.php";
// echo check_login();
// echo check_super();
if (!check_super()){
	// echo 0;
	header('Location: dashboard.php');
}
?>
