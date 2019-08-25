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
			<a style="font-weight: bold;">SW Pizza</a>
		</div>
	</div>
</nav>

<body style="background: #ccc;">

    <center>

      	<h5 class="indigo-text" style="color: #000!important;">Por favor, faça o login na sua conta</h5>
      	<div class="section"></div>

      	<?php if(isset($_SESSION['msg'])): ?>
			<?php 
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			?>
		<?php endif; ?>

      	<div class="container">
	        <div class="z-depth-1 white lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;border-radius: 10px;">

	          <form action="login.php" method="POST" class="col s12">
	            <h5 class="indigo-text" style="color: #000!important;">Login</h5> <br>

	            <div class='row'>
	              <div class='input-field col s12'>
	                <input class='validate' type='text' name='cpf' id='cpf' />
	                <label for='cpf'>Entre com seu CPF</label>
	              </div>
	            </div>

	            <div class='row'>
	              <div class='input-field col s12'>
	                <input class='validate' type='password' name='senha' id='senha' maxlength="15" />
	                <label for='senha'>Entre com sua senha</label>
	              </div>
	            </div>

	            <div class="input-field col s12">
					<input type="submit" value="ENTRAR" class="btn red">
				</div>
	          </form>
	        </div>
      	</div>
    </center>

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