<?php
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	if($_SESSION['cargo'] != 'Administrador') header("Location:../vendas");
	
include_once '../includes/header.inc.php';
include_once '../includes/menu.inc.php';
include_once '../conexao.php';
?>

<!-- Formulário de Cadastro -->
<div class="row container col s12">
	<form action="create.php" method="POST" class="col s12">
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
				<input type="text" name="nome" id="nome" maxlength="45" required autofocus />
				<label for="nome">Pizza</label>
			</div>
			
			<div class="input-field col s12">
				<i class="material-icons prefix"> build</i>
				<input type="text" name="preco" id="preco" value="30.00" required autofocus />
				<label for="preco">Preco</label>
			</div>

					
		
		
			<div class="col s12" style="margin-top: 10px; text-align: center">
				<div class=" col s6"><h5 class="light center">Ingredientes da Pizza</h5></div>
				<div class="col s6" style="margin-top: 20px"><a class="btn-floating btn-small waves-effect waves-light green" 
			    href="../ingrediente"><i class="material-icons">add</i></a></div>
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
                    $querySelect = $link->query('SELECT * FROM tb_ingredientes 
                    inner join tb_unidade on tb_unidade.idUnidade = tb_ingredientes.unidade');
                            
                        while($registro = $querySelect->fetch_assoc()){
                            $id         = $registro['idIngredientes'];
                            $nome       = $registro['nome_ing'];
                            $unidade      = $registro['nome_uni'];
                            
                            echo "<div class='col s12'>";
                                
                                echo "<div class='col s8'><input type='text' name='nome' id='nome' 
                                value='$nome' disabled required autofocus /></div>";
                                
                                echo "<div class='col s4' style='margin-bottom: 10px'><input type='number' name='quantidade' id='quantidade' 
                                value='0' required autofocus />
                                <label for='quantidade'>Qtd. em $unidade</label></div>";
                            
                            echo "</div>";
                        }
                 ?>
                
    		<div>
    		
    		
			<div class="input-field col s12" style="margin-top: 60px; text-align: center">
				<input type="submit" value="Cadastrar" class="btn blue" style="margin-right: 5px">
				<input type="reset" value="Limpar" class="btn red" style="margin-left: 5px">
			</div>
		</fieldset>
	</form>
</div>

<div class="row container" style="margin-top: 2%">
	<div class="col s12" style="background-color: white;border: 1px solid #fff; margin-top: 50px; border-radius: 10px;">
		<h5 class="light center">Lista de Pizzas</h5>
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
					<th>Nome</th>
					<th>Preço</th>
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