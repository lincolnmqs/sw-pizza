<?php
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");

	include_once '../conexao.php';

	$id = $_SESSION['id'];

	$nome        = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$preco       = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
	$idunidade   = filter_input(INPUT_POST, 'unidade', FILTER_SANITIZE_NUMBER_INT);

	$queryUpdate = $link->query("UPDATE tb_ingredientes SET nome_ing = '" . $nome . "', preco_ing = '" . $preco ."', unidade = '" . $idunidade . "' WHERE idIngredientes = '" . $id . "'");

	if(mysqli_affected_rows($link) > 0){
	    $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Atualização realizada com sucesso!</p>';
	    header("Location:index.php");
	}
	else{
	    $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
	    header("Location:index.php");
	}