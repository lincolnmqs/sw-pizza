<?php 

	if(!isset($_SESSION)) session_start();

	include_once 'conexao.php';

	if(empty($_POST['cpf']) || empty($_POST['senha'])) header("Location:index.php");

	$cpf   = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

	$pessoa = $link->query('SELECT * FROM tb_pessoa WHERE cpf = "' . $cpf .'" AND senha = md5("' . $senha .'")');
	$pessoa = $pessoa->fetch_assoc();
	$idPessoa = $pessoa['idPessoa'];
	$nome     = $pessoa['nome'];
	$idCargo  = $pessoa['cargo'];

	$cargo = $link->query('SELECT * FROM tb_cargo WHERE idCargo = "' . $idCargo .'"');
	$cargo = $cargo->fetch_assoc();
	$cargo = $cargo['tipo_cargo'];

	$affected_rows = mysqli_affected_rows($link);

	if($affected_rows > 0){
		$_SESSION['idPessoa'] = $idPessoa;
		$_SESSION['nome'] = $nome;
		$_SESSION['cargo'] = $cargo;

		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Login realizado com sucesso!</p>';
		header("Location:vendas");
	}
	else {
		$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Logar-se!</p>';
		header("Location:index.php");
	}

 ?>

