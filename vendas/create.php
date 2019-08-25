<?php
	include_once '../conexao.php';

	if(!isset($_SESSION)) session_start();

	$valorPepperoni = $valorTradicional = $valorPortuguesa = $valorCalabresa = $valorCatupiry = $total = 0;
	
	$data        = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
	$hora        = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_SPECIAL_CHARS);
	$idPessoa    = filter_input(INPUT_POST, 'idPessoa', FILTER_SANITIZE_NUMBER_INT);
	$idCliente   = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_NUMBER_INT);
	$entrega     = filter_input(INPUT_POST, 'entrega', FILTER_SANITIZE_NUMBER_INT);
	$calabresa   = filter_input(INPUT_POST, 'calabresa', FILTER_SANITIZE_NUMBER_INT);
	$catupiry    = filter_input(INPUT_POST, 'catupiry', FILTER_SANITIZE_NUMBER_INT);
	$portuguesa  = filter_input(INPUT_POST, 'portuguesa', FILTER_SANITIZE_NUMBER_INT);
	$tradicional = filter_input(INPUT_POST, 'tradicional', FILTER_SANITIZE_NUMBER_INT);
	$pepperoni   = filter_input(INPUT_POST, 'pepperoni', FILTER_SANITIZE_NUMBER_INT);
	$obs         = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_SPECIAL_CHARS);

	$total = $pepperoni + $tradicional + $portuguesa + $calabresa + $calabresa;

	if($total > 0){
		$queryInsert = $link->query('INSERT INTO tb_vendas VALUES(default, "'. $data .'", "' . $hora . '", "' . $entrega . '", "' . $total . '", "' . $obs . '", "' . $idPessoa . '", "' . $idCliente . '")');

		$affected_rows = mysqli_affected_rows($link);

		$ultimo_id = $link->query('SELECT idVendas FROM tb_vendas ORDER BY idVendas DESC LIMIT 1');
		$ultimo_id = $ultimo_id->fetch_assoc();
		$ultimo_id = $ultimo_id['idVendas'];
		
		if($calabresa > 0){
			$queryCalabresa = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 1');
			$valorCalabresa = $queryCalabresa->fetch_assoc();
			$valorCalabresa = $valorCalabresa['preco'];

			$queryInsert = $link->query('INSERT INTO tb_vendaitem VALUES("' . $ultimo_id . '", 1, "' . $calabresa . '", "' . $valorCalabresa . '")');
			$affected_rows = mysqli_affected_rows($link);
		}

		if($catupiry > 0){
			$queryCatupiry = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 2');
			$valorCatupiry = $queryCatupiry->fetch_assoc();
			$valorCatupiry = $valorCatupiry['preco'];

			$queryInsert = $link->query('INSERT INTO tb_vendaitem VALUES("' . $ultimo_id . '", 2, "' . $catupiry . '", "' . $valorCatupiry . '")');
			$affected_rows = mysqli_affected_rows($link);
		}

		if($portuguesa > 0){
			$queryPortuguesa = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 3');
			$valorPortuguesa = $queryPortuguesa->fetch_assoc();
			$valorPortuguesa = $valorPortuguesa['preco'];

			$queryInsert = $link->query('INSERT INTO tb_vendaitem VALUES("' . $ultimo_id . '", 3, "' . $portuguesa . '", "' . $valorPortuguesa . '")');
			$affected_rows = mysqli_affected_rows($link);
		}

		if($tradicional > 0){
			$queryTradicional = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 4');
			$valorTradicional = $queryTradicional->fetch_assoc();
			$valorTradicional = $valorTradicional['preco'];

			$queryInsert = $link->query('INSERT INTO tb_vendaitem VALUES("' . $ultimo_id . '", 4, "' . $tradicional . '", "' . $valorTradicional . '")');
			$affected_rows = mysqli_affected_rows($link);
		}

		if($pepperoni > 0){
			$queryPepperoni = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 5');
			$valorPepperoni = $queryPepperoni->fetch_assoc();
			$valorPepperoni = $valorPepperoni['preco'];

			$queryInsert = $link->query('INSERT INTO tb_vendaitem VALUES("' . $ultimo_id . '", 5, "' . $pepperoni . '", "' . $valorPepperoni . '")');
			$affected_rows = mysqli_affected_rows($link);
		}

		$total = ($valorPepperoni * $pepperoni) + ($valorTradicional * $tradicional) + ($valorPortuguesa * $portuguesa) + ($valorCalabresa * $calabresa) + ($valorCatupiry * $calabresa);

		$queryUpdate = $link->query('UPDATE tb_vendas SET data = "' . $data . '", horario = "' . $hora . '", entrega = "' . $entrega . '", precoTotal = "' . $total . '", observacao = "' . $obs . '", pessoa = "' . $idPessoa . '", cliente = "' . $idCliente . '" WHERE idVendas = "' . $ultimo_id . '"');
	}

	if($affected_rows > 0 && $total > 0) $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
	else $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Cadastrar!</p>';

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