<?php
	include_once '../conexao.php';

	if(!isset($_SESSION)) session_start();
	
	$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone  = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
	$bairro  = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
	$rua  = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
	$numero  = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);

	$querySelect = $link->query('SELECT telefone FROM tb_cliente');

	$array_telefones = array();

	while($telefones = $querySelect->fetch_assoc()){
		$telefones_existentes = $telefones['telefone'];
		array_push($array_telefones, $telefones_existentes);
	}

	if(in_array($telefone, $array_telefones)){
		$_SESSION['msg'] = "<p class='center red-text'>".'Este cliente ja esta cadastrado no sistema!' . "</p>";
		header('Location:../');
	}
	else{
		$queryInsert = $link->query("INSERT INTO tb_cliente VALUES(default,'$nome','$bairro','$rua','$numero','$telefone')");

		$affected_rows = mysqli_affected_rows($link);

		if($affected_rows > 0)
			$_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
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