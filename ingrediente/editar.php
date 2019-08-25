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

		$querySelect = $link->query("SELECT * FROM tb_ingredientes WHERE idIngredientes = '$id'");

		while($registro = $querySelect->fetch_assoc()){
		    $id         = $registro['idIngredientes'];
		    $nome       = $registro['nome_ing'];
		    $preco      = $registro['preco_ing'];
		    $idunidade  = $registro['unidade'];
		}

	?>

	<div class="row container">
	<form action="update.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center" style="margin-bottom: 20px">Ingredientes</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php
				echo $_SESSION ['msg'];
				unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<div class="input-field col s6">
				<input type="text" name="nome" id="nome" value="<?= $nome;?>" maxlength="45" required autofocus /> 
				<label for="nome">Nome</label>
			</div>
			
			<div class="input-field col s6"><input type="number"
					name="preco" id="preco" value="<?= $preco;?>" step="0.01" maxlength="50" required autofocus /> <label
					for="preco">Preco por unidade</label>
			</div>
			
			<div class="input-field col s12">
			    <select name="unidade">
				    <?php 

				    $querySelect2 = $link->query("SELECT * FROM tb_unidade");

		     		while($registro2 = $querySelect2->fetch_assoc()){

						if($registro2['idUnidade'] == $idunidade){ 

						 ?>

							<option value="<?php echo $registro2['idUnidade']; ?>" selected><?php echo $registro2['sigla']; ?></option>
			     			
						<?php 

						}

						else { 

						 ?>

			     			<option value="<?php echo $registro2['idUnidade']; ?>"><?php echo $registro2['sigla']; ?></option>
			     				
			     	<?php 

			     		}
			     	} 

			     	 ?>
				    </select>
				    <label>Unidade</label>
				</div>
			
			<div class="input-field col s12" style="text-align: center">
				<input type="submit" value="Atualizar" class="btn green" style="margin-right: 5px"> 
				<a href="index.php" class="btn red" style="margin-left: 5px">Cancelar</a>
			</div>
			
		</fieldset>
	</form>
</div>

<br><br>

<?php include_once '../includes/footer.inc.php'; ?>