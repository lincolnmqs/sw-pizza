<?php
	include_once '../conexao.php';

	$querySelect  = $link->query('SELECT * FROM tb_vendas');

	while($registro = $querySelect->fetch_assoc()){
		$id         = $registro['idVendas'];
		$data       = $registro['data'];
		$horario    = $registro['horario'];
		$entrega    = $registro['entrega'];
		$precoTotal = $registro['precoTotal'];
		$pessoa     = $registro['pessoa'];
		$cliente    = $registro['cliente'];

		$nome = $link->query('SELECT nome FROM tb_cliente WHERE idCliente = "'. $cliente .'"');
		$nome = $nome->fetch_assoc();
		$nome = $nome['nome'];

		echo '<tr>';
		echo '<td>' . $nome . '</td>' . '<td>R$ ' . $precoTotal . '</td>' . '<td>' . $data . '</td>' . '<td>' . $horario . '</td>';
		echo '<td>
				<a href="delete.php?id=' . $id . '"><i class="material-icons">delete</i></a>
			</td>';
		echo '</tr>';
	}



