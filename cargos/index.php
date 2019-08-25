<?php 
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");
	
	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';
?>

<!-- Formulário de Cadastro -->
<div class="row container">
	<form action="create.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center">Cadastro de Cargos</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="tipo_cargo" id="tipo_cargo" maxlength="30" required autofocus />
				<label for="tipo_cargo">Nome do Cargo</label>
			</div>

			<div class="input-field col s12">
				<input type="submit" value="Cadastrar" class="btn blue">
				<input type="reset" value="Limpar" class="btn red">
			</div>
		</fieldset>
	</form>

	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
		<h5 class="light center">Lista de Cargos</h5>
		<hr />

		<table>
			<thead>
				<tr>
					<th>Tipo do Cargo</th>
				</tr>
			</thead>
			<tbody>
				<?php include_once 'read.php';?>
			</tbody>
		</table>
	</div>
</div>

<br>

<?php include_once '../includes/footer.inc.php'; ?>