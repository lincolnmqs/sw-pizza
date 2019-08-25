<?php
	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_unidade');

	while($registro = $querySelect->fetch_assoc()){
		$nome       = $registro['nome_uni'];
		$sigla      = $registro['sigla'];
		

		echo "<tr>";
		echo "
        <td>$nome</td>
        <td>$sigla</td>
        <td><a href='editar.php?id=$id'><i class='material-icons'>edit</i></a></td>
		<td><a href='delete.php?id=$id'><i class='material-icons'>delete</i></a></td>";
		echo "</tr>";
	}



