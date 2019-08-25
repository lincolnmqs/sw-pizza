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

		$querySelect = $link->query("SELECT * FROM tb_pizza WHERE idPizza = '$id'");

		while($registro = $querySelect->fetch_assoc()){
		    $id         = $registro['idPizza'];
		    $nome       = $registro['nome'];
		    $preco      = $registro['preco'];
		}

	?>

	<!-- Formulário de Cadastro -->
<div class="row container">
	<form action="update.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center" style="margin-bottom: 10px">Cadastro de Pizzas</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					session_unset();
				?>
			<?php endif; ?>

			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="nome" id="nome" value="<?= $nome ?>" maxlength="45" required autofocus />
				<label for="nome">Pizza</label>
			</div>
			
			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="preco" id="preco" value="<?= $preco ?>" required autofocus />
				<label for="preco">Preco</label>
			</div>

					
		
		
			<div class="col s12" style="margin-top: 10px">
				<h5 class="light center">Ingredientes da Pizza</h5>
			</div>
			

			<!-- <div class="input-field col s12">
                <select multiple>
                      <option value="" disabled selected>Selecione</option>
                      <?php 
                            $querySelect = $link->query('SELECT * FROM tb_ingredientes');
                            
                            while($registro = $querySelect->fetch_assoc()){
                                $id         = $registro['idIngredientes'];
                                $nome       = $registro['nome'];
                                echo "<option value='$id'>$nome</option>";
                            }
                      ?>
                </select>
                <label>Escolha os ingredientes</label>
  			</div>  -->
			
	
			<div class="col s12" style="margin-top: 10px">
                
            	<?php
                    $querySelect = $link->query('SELECT * FROM tb_ingredientes');
                            
                        while($registro = $querySelect->fetch_assoc()){
                            $id         = $registro['idIngredientes'];
                            $nome       = $registro['nome_ing'];
                            
                            echo "<label class='col s6' style='margin-top: 20px'>";
                                echo "<input type='checkbox' />
                                <span value='$id'>$nome</span>";    
                            echo "</label>";
                        }
                 ?>
                
    		<div>
    		
    		
			<div class="input-field col s12" style="margin-top: 60px; text-align: center">
				<input type="submit" value="Atualizar" class="btn green" style="margin-right: 5px">
				<a href="index.php" class="btn red" style="margin-left: 5px">Cancelar</a>
		</fieldset>
	</form>
</div>

<br>

<?php include_once '../includes/footer.inc.php'; ?>