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

			<h5 class="light center">Cadastro de Unidade</h5>
			<hr />

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="nome" id="nome" maxlength="45" required autofocus />
				<label for="nome">Unidade</label>
			</div>
			
			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="sigla" id="sigla" maxlength="2" required autofocus />
				<label for="sigla">Sigla</label>
			</div>

			<div class="input-field col s12" style="text-align: center">
				<input type="submit" value="Cadastrar" class="btn blue" style="margin-right: 5px">
				<input type="reset" value="Limpar" class="btn red" style="margin-left: 5px">
			</div>
		</fieldset>
	</form>
</div>

<div class="row container" style="margin-top: 2%">
	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 50px; border-radius: 10px;">
		<h5 class="light center">Lista de Unidades</h5>
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
					<th>Unidade</th>
					<th>Sigla</th>
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