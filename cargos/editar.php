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

		$querySelect = $link->query("SELECT * FROM tb_cargo WHERE idCargo = '$id'");

		while($registro = $querySelect->fetch_assoc()){
			$id          = $registro['idCargo'];
			$tipo_cargo  = $registro['tipo_cargo'];
		}

	?>

	<!-- Formulário de Cadastro -->
	<div class="row container">
		<form action="update.php" method="post" class="col s12">
			<fieldset class="formulario" style="background-color: white">

				<h5 class="light center">Edição de Cargos</h5>

				<div class="input-field col s12">
					<i class="material-icons prefix"> build</i>
					<input type="text" name="tipo_cargo" id="tipo_cargo" value="<?= $tipo_cargo;?>" maxlength="30" required autofocus />
					<label for="tipo_cargo">Nome do Cargo</label>
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