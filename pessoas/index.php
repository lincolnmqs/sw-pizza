<?php 
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");

	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';

	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_cargo');
?>

<!-- Formulário de Cadastro -->
<div class="row container">
	<form action="create.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center">Cadastro de Pessoas</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> person</i>
				<input type="text" name="nome" id="nome" maxlength="50" required autofocus />
				<label for="nome">Nome</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> credit_card</i>
				<input type="text" name="cpf" id="cpf" maxlength="14" required autofocus />
				<label for="cpf">CPF</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> local_phone</i>
				<input type="text" name="telefone" id="telefone" maxlength="16" required autofocus />
				<label for="telefone">Telefone</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> vpn_key</i>
				<input type="text" name="senha" id="senha" maxlength="15" required autofocus />
				<label for="senha">Senha</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="bairro" id="bairro" maxlength="45" required autofocus />
				<label for="bairro">Bairro</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="rua" id="rua" maxlength="80" required autofocus />
				<label for="rua">Rua</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix"> place</i>
				<input type="text" name="numero" id="numero" maxlength="5" required autofocus />
				<label for="numero">Número</label>
			</div>

			<div class="input-field col s12">
			<i class="material-icons prefix"> build</i>
		    <select name="idCargo">
			     	<option value="" disabled selected>Selecione um cargo</option>
			     	<?php 
			     		while($registro = $querySelect->fetch_assoc()){
			     	 ?>

			     		<option value="<?php echo $registro['idCargo'] ?>"><?php echo $registro['tipo_cargo'] ?></option>
			     	 
			     	<?php 
			     		} 
			     	 ?>
			    </select>
			    <label>Cargo</label>
			</div>

			<div class="input-field col s12">
				<input type="submit" value="Cadastrar" class="btn blue">
				<input type="reset" value="Limpar" class="btn red">
			</div>
		</fieldset>
	</form>

	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 20px; border-radius: 10px;">
		<h5 class="light center">Lista de Pessoas</h5>
		<hr />

		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Cargo</th>
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