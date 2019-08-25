<?php
	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_pizza');

	while($registro = $querySelect->fetch_assoc()){
		$id         = $registro['idPizza'];
		$nome       = $registro['nome'];
		$preco      = $registro['preco'];
		

		echo "<tr>";
		echo "
        <td>$nome</td>
        <td>$preco</td>
        <td><a href='editar.php?id=$id'><i class='material-icons'>edit</i></a></td>
		<td><a href='delete.php?id=$id'><i class='material-icons'>delete</i></a></td>";
		echo "</tr>";
	}



