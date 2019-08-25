<?php
	if(!isset
		ION)) session_start();

	include_once '../conexao.php';

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	$querySelect = $link->query("SELECT * FROM tb_vendaitem");

	while($registro = $querySelect->fetch_assoc()){
		$idVendas   = $registro['idVendas'];

		if($idVendas == $id) $queryDelete = $link->query("DELETE FROM tb_vendaitem WHERE idVendas = '$id'");
	}

	$queryDelete = $link->query("DELETE FROM tb_vendas WHERE idVendas = '$id'");

	if(mysqli_affected_rows($link) > 0){
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Remoção realizada com sucesso!</p>';
		header("Location: index.php");
	}
	else{
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
		header("Location: index.php");
	}