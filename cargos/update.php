<?php
	if(!isset($_SESSION)) session_start();
	include_once '../conexao.php';

	$id = $_SESSION['id'];

	$tipo_cargo  = filter_input(INPUT_POST, 'tipo_cargo', FILTER_SANITIZE_SPECIAL_CHARS);

	$queryUpdate = $link->query("UPDATE tb_cargo SET tipo_cargo = '$tipo_cargo' WHERE idCargo = '$id'");

	if(mysqli_affected_rows($link) > 0){
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Atualização realizada com sucesso!</p>';
		header("Location:index.php");
	}
	else{
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
		header("Location:index.php");
	}
