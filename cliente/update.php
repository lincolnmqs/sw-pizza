<?php
	
	if(!isset($_SESSION)) session_start();
	include_once '../conexao.php';

	$id = $_SESSION['id'];

	$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone  = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
	$bairro  = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
	$rua  = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
	$numero  = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);


	$queryUpdate = $link->query("UPDATE tb_cliente SET nome = '$nome', bairro = '$bairro', rua = '$rua', numero = '$numero', telefone = '$telefone' WHERE idCliente = '$id'");

	if(mysqli_affected_rows($link) > 0){
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Atualização realizada com sucesso!</p>';
		header("Location:index.php");
	}
	else{
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
		header("Location:index.php");
	}
