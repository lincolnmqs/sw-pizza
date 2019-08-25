<?php 

	$idPessoa = $_SESSION['idPessoa'];

 ?>

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