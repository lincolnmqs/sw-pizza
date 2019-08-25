<?php
	include_once '../conexao.php';

	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';

	$de       = filter_input(INPUT_POST, 'de', FILTER_SANITIZE_SPECIAL_CHARS);
	$ate      = filter_input(INPUT_POST, 'ate', FILTER_SANITIZE_SPECIAL_CHARS);
	$idPessoa = filter_input(INPUT_POST, 'idPessoa', FILTER_SANITIZE_NUMBER_INT);

	list($de_ano, $de_mes, $de_dia) = preg_split('/-|\//', $de);
	list($ate_ano, $ate_mes, $ate_dia) = preg_split('/-|\//', $ate);

	$nome = $link->query('SELECT nome FROM tb_pessoa WHERE idPessoa = "'. $idPessoa .'"');
	$nome = $nome->fetch_assoc();
	$nome = $nome['nome'];

 ?>
<br><br><br><br><br>
 <div class="row container">

 	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
 		<h5 class="light center">Vendedor: <b><?php echo $nome; ?></b></h5>
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
					<th>Cliente</th>
					<th>Pizza</th>
					<th>Quantidade</th>
					<th>Data</th>
				</tr>
			</thead>

<?php

	$totalFinal = $contador = 0;

	$querySelect  = $link->query('SELECT * FROM tb_vendaitem INNER JOIN tb_vendas ON tb_vendas.idVendas = tb_vendaitem.idVendas INNER JOIN tb_pessoa ON tb_pessoa.idPessoa = tb_vendas.pessoa WHERE tb_vendas.pessoa =  "' . $idPessoa . '" AND tb_vendas.data >= "' . $de .'" AND tb_vendas.data <= "' . $ate .'"');

	while($registro = $querySelect->fetch_assoc()){

		$idPizza    = $registro['idPizza'];
		$idCliente  = $registro['cliente'];
		$data       = $registro['data'];
		$horario    = $registro['horario'];
		$qtde       = $registro['quantidade'];
		$valor      = $registro['precoTotal'];

		$totalFinal += $registro['PrecoVenda'] * $registro['quantidade'];
		$contador   += $registro['quantidade'];

		$cliente = $link->query('SELECT nome FROM tb_cliente WHERE idCliente = "'. $idCliente .'"');
		$cliente = $cliente->fetch_assoc();
		$cliente = $cliente['nome'];

		$pizza = $link->query('SELECT nome FROM tb_pizza WHERE idPizza = "'. $idPizza .'"');
		$pizza = $pizza->fetch_assoc();
		$pizza = $pizza['nome'];

		list($ano, $mes, $dia) = preg_split('/-|\//', $data);
		
 ?>
			<tbody>
				<?php 
					echo '<tr>';
					echo '<td>' . $cliente . '</td>' . '<td>' . $pizza . '</td>' . '<td>' . $qtde . '</td>' . '<td>' . $dia . '/' . $mes . '/' . $ano . '</td>';
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

 		<h5 class="light center">Valores Totais das Minhas Vendas</h5>
 		<hr />

 		<?php  

			echo 'Valor: <b>R$ ' . $totalFinal . '</b> <br>Quantidade: <b>' . $contador . '</b>';

 		?>

 	</div>
</div>

<br><br><br><br><br>

<?php include_once '../includes/footer.inc.php'; ?>