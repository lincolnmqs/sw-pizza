<?php
	include_once '../conexao.php';

	session_start();
	
	$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$preco  = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
	$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_SPECIAL_CHARS);
	
	$querySelect = $link->query('SELECT nome FROM tb_pizza');
	
	$array_nomes = array();

	while($nomes = $querySelect->fetch_assoc()){
		$nomes_existentes = $nomes['nome'];
		array_push($array_nomes, $nomes_existentes);
	}
	
	
	if(in_array($nome, $array_nomes)){
		$_SESSION['msg'] = "<p class='center red-text'>" . 'Esta pizza ja esta cadastrada no sistema!' . "</p>";
		header('Location:../');
	}
	else {
		$queryInsert = $link->query("INSERT INTO tb_pizza VALUES(default ,'$nome','$preco')");
		
		$pizza = $link->query('SELECT max(idPizza) FROM tb_pizza');
		$idpizza = $pizza->fetch_assoc();
		$idp = $idpizza;
		
		$querySelect = $link->query('SELECT * FROM tb_ingredientes');
		
		while ($registro = $querySelect->fetch_assoc()) {
			$id          = $registro['idIngredientes'];
				
			
			foreach ($quantidade AS $qtd){
				if($quantidade>0){
					$queryInsert = $link->query("INSERT INTO tb_receita VALUES('$idp','$id','$quantidade')");
				}
			}
		
		}

		$affected_rows = mysqli_affected_rows($link);

		if($affected_rows > 0) $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
		else $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Cadastrar!</p>';
	}
	
	
	//header('Location:index.php');
	//print_r ($quantidade);
	

	echo '<br /><br /><a href="../index.php">Voltar</a>';