<?php
	include_once '../conexao.php';

	if(!isset($_SESSION)) session_start();
	
	$nome      = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$cpf       = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone  = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
	$bairro    = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
	$rua       = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
	$numero    = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
	$senha     = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
	$idCargo   = filter_input(INPUT_POST, 'idCargo', FILTER_SANITIZE_NUMBER_INT);

	$querySelect = $link->query('SELECT * FROM tb_pessoa');

	$array_cpfs = array();

	while($cpfs = $querySelect->fetch_assoc()){
		$cpfs_existentes = $cpfs['cpf'];
		array_push($array_cpfs, $cpfs_existentes);
	}

	if(in_array($cpf, $array_cpfs)){
		$_SESSION['msg'] = '<p class="center red-text">Já existe um usuário cadastrado com esse CPF: ' . $cpf .'</p>';
		header('Location:../');
	}
	else {
		$queryInsert = $link->query('INSERT INTO tb_pessoa VALUES(default , "' . $nome . '", "' . $cpf . '", "' . $telefone . '", "' . md5($senha) . '", "' . $bairro . '", "' . $rua . '", "' . $numero . '", "' . $idCargo . '")');

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