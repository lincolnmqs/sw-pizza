<?php
	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_cargo ORDER BY tipo_cargo DESC');

	while($registro = $querySelect->fetch_assoc()){
		$id          = $registro['idCargo'];
		$tipo_cargo  = $registro['tipo_cargo'];

		echo '<tr>';
		echo '<td>' . $tipo_cargo . '</td>';
		echo '<td>
				<a href="editar.php?id=' . $id . '"><i class="material-icons">edit</i></a>
			</td>
			<td>
				<a href="delete.php?id=' . $id . '"><i class="material-icons">delete</i></a>
			</td>';
		echo '</tr>';
	}



