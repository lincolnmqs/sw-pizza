<?php
	include_once 'conexao.php';

	if(!isset($_SESSION)) session_start();

	include_once 'verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");

	$de       = filter_input(INPUT_POST, 'de', FILTER_SANITIZE_SPECIAL_CHARS);
	$ate      = filter_input(INPUT_POST, 'ate', FILTER_SANITIZE_SPECIAL_CHARS);

	list($de_ano, $de_mes, $de_dia) = preg_split('/-|\//', $de);
	list($ate_ano, $ate_mes, $ate_dia) = preg_split('/-|\//', $ate);

	$nome_ing_ant = $sigla_ant = $nome_uni_ant = '';
	$qtde_soma = 0;
	$preco_ing_soma = $total = 0.0;

 ?>
 <!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>SW Pizza</title>
	<meta charset="utf-8">

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection"/>
	<link rel="stylesheet" href="materialize/css/style.css">

	<!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>

<nav class="red">
	<div class="nav-wrapper container">

		<div class="brand-logo light left">
			<a href="http://software.muz.ifsuldeminas.edu.br/pizza/vendas" style="font-weight: bold;">SW Pizza</a>
		</div>

  		<!-- Dropdown Trigger -->
	  	<a class="dropdown-trigger btn right" href="#" data-target="dropdown1" style="margin-top: 1.3%; background: #fff; color: #000; font-weight: bold;">MENU</a>

	  	<!-- Dropdown Structure -->
	  	<ul id='dropdown1' class='dropdown-content'>
	  		<?php 
	  			if($_SESSION['cargo'] == 'Administrador'){
	  		 ?>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/cargos">Cargos</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<?php
	    		}
	    	 ?>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/cliente">Clientes</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<?php
	  			if($_SESSION['cargo'] == 'Administrador'){
	  		 ?>
	  		 <li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/ingrediente">Ingrediente</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/pessoas">Pessoas</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/pizzas">Pizzas</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/unidade">Unidades</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<?php
	    		}
	  		 ?>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/vendas">Vendas</a></li>
	    	<li class="divider" tabindex="-1"></li>
	    	<li><a href="http://software.muz.ifsuldeminas.edu.br/pizza/pessoas/editar_perfil.php?id=<?php echo $idPessoa ?>">Perfil</a></li>
	    	<li><a href="../logout.php">Sair</a></li>
	  	</ul>

	</div>
</nav>
<br><br><br><br><br>
<body style="background-color: #ccc;">
 <div class="row container">

 	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
		<h5 class="light center">Relatório de <b><?php echo $de_dia . '/' . $de_mes . '/' . $de_ano; ?></b> até <b><?php echo $ate_dia . '/' . $ate_mes . '/' . $ate_ano; ?></b></h5>
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
					<th>Ingrediente</th>
					<th>Quantidade</th>
					<th>Unidade</th>
					<th>Preço</th>
				</tr>
			</thead>

<?php

	$querySelect  = $link->query('SELECT * FROM tb_unidade INNER JOIN tb_ingredientes ON tb_ingredientes.unidade = tb_unidade.idUnidade INNER JOIN tb_receita ON tb_receita.idIngredientes = tb_ingredientes.idIngredientes INNER JOIN tb_pizza ON tb_pizza.idPizza = tb_receita.idPizza INNER JOIN tb_vendaitem ON tb_vendaitem.idPizza = tb_pizza.idPizza INNER JOIN tb_vendas ON tb_vendas.idVendas = tb_vendaitem.idVendas WHERE tb_vendas.data >= "' . $de .'" AND tb_vendas.data <= "' . $ate .'" ORDER BY tb_ingredientes.nome_ing');

	while($registro = $querySelect->fetch_assoc()){

		$qtde_rec    = $registro['quantidade_rec'];
		$nome_uni    = $registro['nome_uni'];
		$sigla       = $registro['sigla'];
		$nome_ing    = $registro['nome_ing'];
		$preco_ing   = $registro['preco_ing'];

		if($nome_ing != $nome_ing_ant && $qtde_soma > 0){
		
 ?>
			<tbody>
				<?php 
					echo '<tr>';
					echo '<td>' . $nome_ing_ant . '</td>' . '<td>' . $qtde_soma . ' ' . $sigla_ant .'</td>' . '<td>' . $nome_uni_ant . '</td>' . '<td>' . 'R$ ' . $preco_ing_soma . '</td>';
					echo '</tr>';
				?>
			</tbody>
			

<?php 
			$total += $preco_ing_soma;
			$qtde_soma = 0;
			$preco_ing_soma = 0.0;
		}

		else {
			$qtde_soma += $qtde_rec;
			$preco_ing_soma += $preco_ing;
		}

		$nome_ing_ant = $nome_ing;
		$sigla_ant = $sigla;
		$nome_uni_ant = $nome_uni;
	}
 ?>
 			<tbody>
				<?php 
					echo '<tr>';
					echo '<td>' . $nome_ing_ant . '</td>' . '<td>' . $qtde_soma . ' ' . $sigla_ant .'</td>' . '<td>' . $nome_uni_ant . '</td>' . '<td>' . 'R$ ' . $preco_ing_soma . '</td>';
					echo '</tr>';

					$total += $preco_ing_soma;
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="row container">

 	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px; padding: 10px;">

 		<h5 class="light center">Valor Total a Comprar</h5>
 		<hr />

 		<?php  

			echo 'Valor Total: <b>R$ ' . $total . '</b>';

 		?>

 	</div>
</div>

<br><br><br><br><br>

<footer class="page-footer red">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">SW Pizza</h5>
				<p class="grey-text text-lighten-4">Sistema Web Pizza</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2019 SW Pizza
			<a class="grey-text text-lighten-4 right" href="http://labsoft.muz.ifsuldeminas.edu.br/">Hospedado pelo Labsoft</a>
		</div>
	</div>
</footer>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="materialize/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="materialize/js/jquery.mask.js"></script>

<!-- Inicializando o Jquer -->
<script type="text/javascript">
	$(document).ready(function(){
		$('select').formSelect();
		$("#cpf").mask('000.000.000-00');
		$('.dropdown-trigger').dropdown();
	});	
</script>
</body>
</html>