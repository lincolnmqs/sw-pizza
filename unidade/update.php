<?php
	session_start();
	include_once '../conexao.php';

	$id = $_SESSION['id'];

	$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$sigla  = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$queryUpdate = $link->query("UPDATE tb_unidade SET nome_uni = '$nome', sigla = '$sigla' WHERE idUnidade = '$id'");

	if(mysqli_affected_rows($link) > 0){
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Atualização realizada com sucesso!</p>';
		header("Location:index.php");
	}
	else{
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
		header("Location:index.php");
	}
