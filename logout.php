<?php 
if (ISSET($_GET['destroy'])){
	session_start();
	session_destroy();
	header('location:index.php');
}
?>