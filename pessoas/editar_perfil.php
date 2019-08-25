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

		if($_SESSION['idPessoa'] != $_SESSION['id']) header("Location:../vendas");

		$querySelect = $link->query("SELECT * FROM tb_pessoa WHERE idPessoa = '$id'");
		$querySelect2 = $link->query("SELECT * FROM tb_cargo");

		while($registro = $querySelect->fetch_assoc()){
			$id         = $registro['idPessoa'];
			$nome       = $registro['nome'];
			$cpf        = $registro['cpf'];
			$telefone   = $registro['telefone'];
			$senha      = $registro['senha'];
			$bairro     = $registro['bairro'];
			$rua        = $registro['rua'];
			$numero     = $registro['numero'];
			$idCarg     = $registro['cargo'];
		}

	?>

	<!-- Formulário de Cadastro -->
	<div class="row container">
		<form action="update.php" method="post" class="col s12">
			<fieldset class="formulario" style="background-color: white">

				<h5 class="light center">Edição do perfil: <?php echo $nome ?></h5>

				<div class="input-field col s12">
					<i class="material-icons prefix"> person</i>
					<input type="text" name="nome" id="nome" value="<?= $nome;?>" maxlength="50" required autofocus />
					<label for="nome">Nome</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix"> credit_card</i>
					<input type="text" name="cpf" id="cpf" value="<?= $cpf;?>" maxlength="14" required autofocus />
					<label for="nome">CPF</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix"> local_phone</i>
					<input type="text" name="telefone" id="telefone" value="<?= $telefone;?>" maxlength="16" required autofocus />
					<label for="telefone">Telefone</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix"> vpn_key</i>
					<input type="password" name="senha" id="senha" value="<?= $senha;?>" maxlength="15" required autofocus />
					<label for="senha">Senha</label>
				</div> 

				<div class="input-field col s12">
					<i class="material-icons prefix"> place</i>
					<input type="text" name="bairro" id="bairro" value="<?= $bairro;?>" maxlength="45" required autofocus />
					<label for="endereco">Bairro</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix"> place</i>
					<input type="text" name="rua" id="rua" value="<?= $rua;?>" maxlength="80" required autofocus />
					<label for="rua">Rua</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix"> place</i>
					<input type="text" name="numero" id="numero" value="<?= $numero;?>" maxlength="5" required autofocus />
					<label for="numero">Número</label>
				</div>

				<div class="input-field col s12">
			<i class="material-icons prefix"> build</i>
		    <select name="idCarg">
			    <?php 

	     		while($registro2 = $querySelect2->fetch_assoc()){

					if($registro2['idCargo'] == $idCarg){ 

					 ?>

						<option value="<?php echo $registro2['idCargo']; ?>" selected><?php echo $registro2['tipo_cargo']; ?></option>
		     			
					<?php 

					}

					else { 

					 ?>

		     			<option value="<?php echo $registro2['idCargo']; ?>"><?php echo $registro2['tipo_cargo']; ?></option>
		     				
		     	<?php 

		     		}
		     	} 

		     	 ?>
			    </select>
			    <label>Cargo</label>
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