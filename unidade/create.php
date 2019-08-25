<?php
	include_once '../conexao.php';

	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");
	
	$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$sigla  = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);

	$querySelect = $link->query('SELECT nome_uni FROM tb_unidade');

	$array_nomes = array();

	while($nomes = $querySelect->fetch_assoc()){
		$nomes_existentes = $nomes['nome_uni'];
		array_push($array_nomes, $nomes_existentes);
	}

	if(in_array($nome, $array_nomes)){
		$_SESSION['msg'] = "<p class='center red-text'>" . 'Esta unidade ja esta cadastrada no sistema!' . "</p>";
		header('Location:../');
	}
	else {
		$queryInsert = $link->query("INSERT INTO tb_unidade VALUES(default ,'$nome','$sigla')");

		$affected_rows = mysqli_affected_rows($link);

		if($affected_rows > 0) $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
		else $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Cadastrar!</p>';
	}

	header('Location:index.php');

	

	echo '<br /><br /><a href="../index.php">Voltar</a>';