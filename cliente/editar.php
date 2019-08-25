<?php 
	
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';
	
	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';
?>

	<?php 
		include_once '../conexao.php'; 

		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$_SESSION['id'] = $id;

		$querySelect = $link->query("SELECT * FROM tb_cliente WHERE idCliente = '$id'");

		while($registro = $querySelect->fetch_assoc()){
			$id         = $registro['idCliente'];
			$nome       = $registro['nome'];
			$bairro     = $registro['bairro'];
			$rua        = $registro['rua'];
			$numero     = $registro['numero'];
			$telefone   = $registro['telefone'];
		}

	?>

	<!-- Formulário de Cadastro -->
	<div class="row container">
		<form action="update.php" method="post" class="col s12">
			<fieldset class="formulario" style="background-color: white">

				<h5 class="light center">Edição de Clientes</h5>

				<div class="input-field col s6">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="nome" id="nome" value="<?= $nome;?>" maxlength="30" required autofocus />
					<label for="nome">Nome</label>
				</div>

				<div class="input-field col s6">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="telefone" id="telefone" value="<?= $telefone;?>" maxlength="30" autofocus />
					<label for="telefone">Telefone</label>
				</div>

				<div class="input-field col s6">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="bairro" id="bairro" value="<?= $bairro;?>" maxlength="30" autofocus />
					<label for="bairro">Bairro</label>
				</div>

				<div class="input-field col s6">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="rua" id="rua" value="<?= $rua;?>" maxlength="30" autofocus />
					<label for="rua">Rua</label>
				</div>

				<div class="input-field col s6">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="numero" id="numero" value="<?= $numero;?>" maxlength="30" autofocus />
					<label for="numero">Numero</label>
				</div>

				<div class="input-field col s12">
					<input type="submit" value="Alterar" class="btn blue">
					<a href="index.php" class="btn red">Cancelar</a>
				</div>
			</fieldset>
		</form>
	</div>

<br>

<?php include_once '../includes/footer.inc.php'; ?>