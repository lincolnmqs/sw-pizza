<?php 
	
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';
?>

<!-- Formulário de Cadastro -->
<div class="row container">
	<form action="create.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center">Cadastro de Clientes</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> person</i>
				<input type="text" name="nome" id="nome" maxlength="30" required autofocus />
				<label for="nome">Nome</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> local_phone</i>
				<input type="text" name="telefone" id="telefone" maxlength="30" autofocus />
				<label for="telefone">Telefone</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="bairro" id="bairro" maxlength="30" required autofocus />
				<label for="bairro">Bairro</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="rua" id="rua" maxlength="30" autofocus />
				<label for="rua">Rua</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="numero" id="numero" maxlength="30" autofocus />
				<label for="numero">Numero</label>
			</div>

			<div class="input-field col s12">
				<input type="submit" value="Cadastrar" class="btn blue">
				<input type="reset" value="Limpar" class="btn red">
			</div>

		</fieldset>
	</form>

	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
		<h5 class="light center">Lista de Clientes</h5>
		<hr />

		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Telefone</th>
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