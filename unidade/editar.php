<?php 
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");
	
	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';
?>

	<?php 
		include_once '../conexao.php'; 

		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$_SESSION['id'] = $id;

		$querySelect = $link->query("SELECT * FROM tb_unidade WHERE idUnidade = '$id'");

		while($registro = $querySelect->fetch_assoc()){
		    $id         = $registro['idUnidade'];
		    $nome       = $registro['nome_uni'];
		    $sigla      = $registro['sigla'];
		}

	?>

	<!-- Formulário de Cadastro -->
<div class="row container">
	<form action="update.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center">Atualizar Unidade</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="nome" id="nome" value="<?= $nome;?>" maxlength="45" required autofocus />
				<label for="nome">Unidade</label>
			</div>
			
			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="sigla" id="sigla" value="<?= $sigla;?>" maxlength="2" required autofocus />
				<label for="sigla">Sigla</label>
			</div>

			<div class="input-field col s12" style="text-align: center">
				<input type="submit" value="Atualizar" class="btn green" style="margin-right: 5px">
				<a href="index.php" class="btn red" style="margin-left: 5px">Voltar</a>
			</div>
		</fieldset>
	</form>
</div>

<br>

<?php include_once '../includes/footer.inc.php'; ?>