<?php
	if(!isset($_SESSION)) session_start();

	$querySelect  = $link->query('SELECT * FROM tb_pessoa ORDER BY idPessoa DESC');

	while($registro = $querySelect->fetch_assoc()){
		$id         = $registro['idPessoa'];
		$nome       = $registro['nome'];
		$cpf        = $registro['cpf'];
		$bairro     = $registro['bairro'];
		$rua        = $registro['rua'];
		$numero     = $registro['numero'];
		$telefone   = $registro['telefone'];
		$senha      = $registro['senha'];
		$idCargo    = $registro['cargo'];

		$queryCargo = $link->query('SELECT * FROM tb_cargo WHERE idCargo = "'. $idCargo .'"');
		$tipo_cargo = $queryCargo->fetch_assoc();
		$tipo_cargo = $tipo_cargo['tipo_cargo'];

		echo '<tr>';
		echo '<td>' . $nome . '</td>' . '<td>' . $tipo_cargo . '</td>';
		echo '<td>
				<a href="editar.php?id=' . $id . '"><i class="material-icons">edit</i></a>
			</td>
			<td>
				<a href="delete.php?id=' . $id . '"><i class="material-icons">delete</i></a>
			</td>';
		echo '</tr>';
	}



