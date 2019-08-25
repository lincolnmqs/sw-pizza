<?php
	include_once '../conexao.php';

	session_start();
	
	$tipo_cargo  = filter_input(INPUT_POST, 'tipo_cargo', FILTER_SANITIZE_SPECIAL_CHARS);

	$querySelect = $link->query('SELECT tipo_cargo FROM tb_cargo');

	$array_cargos = array();

	while($cargos = $querySelect->fetch_assoc()){
		$cargos_existentes = $cargos['tipo_cargo'];
		array_push($array_cargos, $cargos_existentes);
	}

	if(in_array($tipo_cargo, $array_cargos)){
		$_SESSION['msg'] = '<p class="center red-text">Já existe um cargo cadastrado com esse nome: ' . $tipo_cargo .'</p>';
		header('Location:../');
	}
	else {
		$queryInsert = $link->query('INSERT INTO tb_cargo VALUES(default , "' . $tipo_cargo . '")');

		$affected_rows = mysqli_affected_rows($link);

		if($affected_rows > 0) $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
		else $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Cadastrar!</p>';
	}

	header('Location:index.php');

	/*$dados = $_POST['dados'];
	$null  = false;

	foreach ($dados as $value) {
		if(empty($value)){
			$null = true;
			break;
		}
	}

	$sql = 'INSERT INTO cliente VALUES( "","' .
		$dados['nome'] . '", "' .
		$dados['email'] . '", "' .
		$dados['telefone'] . '")'
	;
	echo $sql;

	if(mysqli_query($link, $sql) === TRUE) echo '<br />Ok';
	else echo '<br />erro';*/

	echo '<br /><br /><a href="../index.php">Voltar</a>';