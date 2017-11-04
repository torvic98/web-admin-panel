<?php
	session_start();
	if ($_SESSION['logged_in'] !== TRUE) {
	   header("Location: ./login.php");
	   exit();
	}
?>