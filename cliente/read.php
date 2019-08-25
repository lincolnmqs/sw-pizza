<?php
	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_cliente');

	while($registro = $querySelect->fetch_assoc()){
		$id         = $registro['idCliente'];
		$nome       = $registro['nome'];
		$bairro     = $registro['bairro'];
		$rua        = $registro['rua'];
		$numero     = $registro['numero'];
		$telefone   = $registro['telefone'];

		echo "<tr>";

		echo "<td>$nome</td>
		<td>$telefone</td>
		<td><a href='editar.php?id=$id'><i class='material-icons'>edit</i></a></td>
		<td><a href='delete.php?id=$id'><i class='material-icons'>delete</i></a></td>";
		echo "</tr>";
	}
