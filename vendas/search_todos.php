<?php
	include_once '../conexao.php';
	
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';

	$de  = filter_input(INPUT_POST, 'de', FILTER_SANITIZE_SPECIAL_CHARS);
	$ate = filter_input(INPUT_POST, 'ate', FILTER_SANITIZE_SPECIAL_CHARS);

	list($de_ano, $de_mes, $de_dia) = preg_split('/-|\//', $de);
	list($ate_ano, $ate_mes, $ate_dia) = preg_split('/-|\//', $ate);

 ?>
<br><br><br><br><br>
 <div class="row container">

 	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
			<h5 class="light center">Lista de Vendas de <b><?php echo $de_dia . '/' . $de_mes . '/' . $de_ano; ?></b> até <b><?php echo $ate_dia . '/' . $ate_mes . '/' . $ate_ano; ?></b></h5>
			<hr />

			<?php if(isset($_SESSION['msg'])):?>
			<?php 
				echo $_SESSION['msg'];
				session_unset();
			?>
			<?php endif;?>

			<table>
				<thead>
					<tr>
						<th>Vendedor</th>
						<th>Valor Total</th>
						<th>Quantidade</th>
						<th>Data</th>
					</tr>
				</thead>

<?php

	$totalFinal = 0;

	$querySelect  = $link->query('SELECT * FROM tb_vendas WHERE data >= "' . $de .'" AND data <= "' . $ate .'"');

	while($registro = $querySelect->fetch_assoc()){
		$id         = $registro['idVendas'];
		$data       = $registro['data'];
		$horario    = $registro['horario'];
		$entrega    = $registro['entrega'];
		$precoTotal = $registro['precoTotal'];
		$pessoa     = $registro['pessoa'];
		$cliente    = $registro['cliente'];

		$totalFinal += $precoTotal;

		$nome = $link->query('SELECT nome FROM tb_pessoa WHERE idPessoa = "'. $pessoa .'"');
		$nome = $nome->fetch_assoc();
		$nome = $nome['nome'];

		$queryQtde  = $link->query('SELECT SUM(tb_vendaitem.quantidade) FROM tb_vendas INNER JOIN tb_vendaitem ON tb_vendaitem.idVendas = tb_vendas.idVendas WHERE tb_vendas.idVendas = "' . $id .'"');
		$qtde = $queryQtde->fetch_assoc();
		$qtde = $qtde['SUM(tb_vendaitem.quantidade)'];

		list($ano, $mes, $dia) = preg_split('/-|\//', $data);


 ?>
				<tbody>
					<?php 
						echo '<tr>';
						echo '<td>' . $nome . '</td>' . '<td>R$ ' . $precoTotal . '</td>' . '<td>' . $qtde . '</td>' . '<td>' . $dia . '/' . $mes . '/' . $ano . '</td>';
						echo '</tr>';
					?>
				</tbody>
			

<?php 
	}
 ?>
		</table>
	</div>
</div>

<div class="row container">

 	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px; padding: 10px;">

 		<h5 class="light center">Valores Totais</h5>
 		<hr />

 		<?php  

 			$queryValores  = $link->query('SELECT SUM(tb_vendaitem.quantidade) FROM tb_vendaitem INNER JOIN tb_vendas ON tb_vendas.idVendas = tb_vendaitem.idVendas INNER JOIN tb_pessoa ON tb_pessoa.idPessoa = tb_vendas.pessoa WHERE tb_vendas.data > "' . $de .'" AND tb_vendas.data < "' . $ate .'"');
			$valores = $queryValores->fetch_assoc();
			$qtde  = $valores['SUM(tb_vendaitem.quantidade)'];

			echo 'Valor: <b>R$ ' . $totalFinal . '</b> <br>Quantidade: <b>' . $qtde . '</b>';

 		?>

 	</div>
</div>

<br><br><br><br><br>

<?php include_once '../includes/footer.inc.php'; ?>