<?php
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");
	
include_once '../includes/header.inc.php';
include_once '../includes/menu.inc.php';
include_once '../conexao.php';

?>

<div class="row container">
<form action="create.php" method="POST" class="col s12">
		<fieldset class="formulario col s12" style="background-color: white">

			<h5 class="light center" style="margin-bottom: 20px">Ingredientes</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php
				echo $_SESSION ['msg'];
				unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s6">
				<input type="text"
					name="nome" id="nome" maxlength="50" required autofocus /> 
				<label for="nome">Nome</label>
			</div>
			
			<div class="input-field col s6">
				<input type="number" name="preco" id="preco" value="0.0" step="0.01" required autofocus /> 
					<label for="preco">Preço por Unidade</label>
			</div>
			
			<div class="input-field col s5">
				<select name="unidade" id="unidade">
					<option value="" disabled selected>Selecione</option>
			     	<?php
			     	      $querySelect = $link->query('SELECT * FROM tb_unidade');
			     	      
						  while($registro = $querySelect->fetch_assoc()){
						      $id         = $registro['idUnidade'];
						      $sigla      = $registro['sigla'];
					?>
						      
						     <option value='<?php echo $id; ?>'><?php echo $sigla; ?></option>";
					<?php
						  }
					?>
			    </select> 
			    <label>Medida</label>
			</div>
			
			<div class="input-field col s1" style="margin-left: -15px; margin-top: 20px"> 
			    <a class="btn-floating btn-small waves-effect waves-light green" 
			    href="../unidade"><i class="material-icons">add</i></a>
			</div>
			
			<div class="input-field col s12" style="text-align: center">
				<input type="submit" value="Cadastrar" class="btn blue" style="margin-right: 5px">
				<input type="reset" value="Limpar" class="btn red" style="margin-left: 5px">
			</div>
			
		</fieldset>
	</form>
</div>

<div class="row container" style="margin-top: 2%">
	<div class="col s12"
		style="background-color: white; border: 1px solid #fff; margin-top: 50px; border-radius: 10px;">
		<h5 class="light center">Lista de Ingredientes</h5>
		<hr />

		<?php if(isset($_SESSION['msg'])):?>
		<?php
			echo $_SESSION ['msg'];
			session_unset ();
			?>
		<?php endif;?>

		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Preço por Qtde</th>
					<th>Unidade</th>
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