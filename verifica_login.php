<?php 

	if(!isset($_SESSION)) session_start();
	
	if(empty($_SESSION['idPessoa'])) header("Location:../index.php");

 ?>