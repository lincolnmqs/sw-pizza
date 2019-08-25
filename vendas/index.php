<?php 
	if(!isset($_SESSION)) session_start();

	include_once '../verifica_login.php';

	include_once '../includes/header.inc.php';
	include_once '../includes/menu.inc.php';

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y/m/d');
	$hora = date('H:i:s');

	include_once '../conexao.php';

	$querySelect = $link->query('SELECT * FROM tb_cliente ORDER BY nome');
	$querySelect2 = $link->query('SELECT * FROM tb_pessoa ORDER BY nome');

	$pizza1 = $link->query('SELECT * FROM tb_pizza WHERE idPizza = 1');
	$pizza1 = $pizza1->fetch_assoc();
	$pizza1_nome = $pizza1['nome'];
	$pizza1_preco = $pizza1['preco'];

	$pizza2 = $link->query('SELECT * FROM tb_pizza WHERE idPizza = 2');
	$pizza2 = $pizza2->fetch_assoc();
	$pizza2_nome = $pizza2['nome'];
	$pizza2_preco = $pizza2['preco'];

	$pizza3 = $link->query('SELECT * FROM tb_pizza WHERE idPizza = 3');
	$pizza3 = $pizza3->fetch_assoc();
	$pizza3_nome = $pizza3['nome'];
	$pizza3_preco = $pizza3['preco'];

	$pizza4 = $link->query('SELECT * FROM tb_pizza WHERE idPizza = 4');
	$pizza4 = $pizza4->fetch_assoc();
	$pizza4_nome = $pizza4['nome'];
	$pizza4_preco = $pizza4['preco'];

	$pizza5 = $link->query('SELECT * FROM tb_pizza WHERE idPizza = 5');
	$pizza5 = $pizza5->fetch_assoc();
	$pizza5_nome = $pizza5['nome'];
	$pizza5_preco = $pizza5['preco'];

?>

<div class="row container">
	<form action="create.php" method="POST" class="col s12">
		<fieldset class="formulario" style="background-color: white">

			<h5 class="light center">Cadastro de Vendas</h5>

			<?php if(isset($_SESSION['msg'])): ?>
				<?php 
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			<?php endif; ?>

			<input type="HIDDEN" name="data" id="data" value="<?php echo $data; ?>">
			<input type="HIDDEN" name="hora" id="hora" value="<?php echo $hora; ?>">
			<input type="HIDDEN" name="idPessoa" id="idPessoa" value="<?php echo $_SESSION['idPessoa']; ?>">

			<div class="row">

				<div class="input-field col s10">
			    <select name="idCliente">
				     	<option value="" disabled selected>Selecione um cliente</option>
				     	<?php 
				     		while($registro = $querySelect->fetch_assoc()){
				     	 ?>

				     		<option value="<?php echo $registro['idCliente'] ?>"><?php echo $registro['nome'] ?></option>
				     	 
				     	<?php 
				     		} 
				     	 ?>
				    </select>
				    <label>Cliente</label>
				</div>

				<div class="input-field col s1">
					<a class="btn-floating btn-small waves-effect waves-light green" href="../cliente"><i class="material-icons">add</i></a>
				</div>

			</div>

			<div class="input-field col s12">
		    <select name="entrega">
			     	<option value="" disabled selected>Selecione uma opção</option>
			     	<option value="1">Minha residência</option>
			     	<option value="0">Retirada</option>
			    </select>
			    <label>Entrega</label>
			</div>

			<h5 class="light" style="color: #000; font-weight: bold;">Opções de Pizzas</h5>
			<br>

			<div class="row">

				<div class="input-field col s10">
					<input placeholder="calabresa" name="calabresa" id="qtdeCalabresa" type="number" value="0"class="validate">
					<label for="calabresa" style="font-size: 23px;color: #000;"><?php echo $pizza1_nome . ' - R$ ' . $pizza1_preco; ?></label>
				</div>

				<div class="input-field col s2">
					<a class="btn-floating btn-small waves-effect waves-light green" onclick="maisCalabresa();"><i class="material-icons">add</i></a>
					<a class="btn-floating btn-small waves-effect waves-light red" onclick="menosCalabresa();"><i class="material-icons">remove</i></a>
				</div>
			</div>
			<div class="row">

				<div class="input-field col s10">
					<input placeholder="catupiry" name="catupiry" id="qtdeCatupiri" value="0" type="number" class="validate">
					<label for="catupiry" style="font-size: 23px;color: #000;"><?php echo $pizza2_nome . ' - R$ ' . $pizza2_preco; ?></label>
				</div>

				<div class="input-field col s2">
					<a class="btn-floating btn-small waves-effect waves-light green" onclick="maisCatupiri();"><i class="material-icons">add</i></a>
					<a class="btn-floating btn-small waves-effect waves-light red" onclick="menosCatupiri();" onclick="valorTotal()"><i class="material-icons">remove</i></a>
				</div>
			</div>
			<div class="row">
						
				<div class="input-field col s10">
					<input placeholder="portuguesa" name="portuguesa" id="qtdePortuguesa" value="0" type="number" class="validate">
					<label for="portuguesa" style="font-size: 23px;color: #000;"><?php echo $pizza3_nome . ' - R$ ' . $pizza3_preco; ?></label>
				</div>

				<div class="input-field col s2">
					<a class="btn-floating btn-small waves-effect waves-light green" onclick="maisPortuguesa();"><i class="material-icons">add</i></a>
					<a class="btn-floating btn-small waves-effect waves-light red" onclick="menosPortuguesa();"><i class="material-icons">remove</i></a>
				</div>
			</div>
			<div class="row">

				<div class="input-field col s10">
					<input placeholder="tradicional" name="tradicional" id="qtdeTradicional" value="0" type="number" class="validate">
					<label for="tradicional" style="font-size: 23px;color: #000;"><?php echo $pizza4_nome . ' - R$ ' . $pizza4_preco; ?></label>
				</div>

				<div class="input-field col s2">
					<a class="btn-floating btn-small waves-effect waves-light green" onclick="maisTradicional();"><i class="material-icons">add</i></a>
					<a class="btn-floating btn-small waves-effect waves-light red" onclick="menosTradicional();"><i class="material-icons">remove</i></a>
				</div>
			</div>
			<div class="row">

				<div class="input-field col s10">
					<input placeholder="pepperoni" name="pepperoni" id="qtdePepperoni" value="0" type="number">
					<label for="pepperoni" style="font-size: 23px;color: #000;"><?php echo $pizza5_nome . ' - R$ ' . $pizza5_preco; ?></label>
				</div>

				<div class="input-field col s2">
					<a class="btn-floating btn-small waves-effect waves-light green" onclick="maisPepperoni();"><i class="material-icons">add</i></a>
					<a class="btn-floating btn-small waves-effect waves-light red" onclick="menosPepperoni();"><i class="material-icons">remove</i></a>
				</div>
			</div>

			<div class="input-field col s12">
				<input type="text" name="valorTotal" id="valorTotal" value="0" style="color: #000;" autofocus disabled />
				<label for="valorTotal" style="font-size: 23px;color: #000;font-weight: bold;">Valor Total (R$)</label>
			</div>

			<div class="input-field col s12">
				<input type="text" name="obs" id="obs" maxlength="100" autofocus />
				<label for="obs">Observação</label>
			</div>
							

			<div class="input-field col s12">
				<input type="submit" value="Finalizar Venda" class="btn blue">
				<input type="reset" value="Limpar" class="btn red">
			</div>



		</fieldset>
	</form>

	<?php $querySelect2 = $link->query('SELECT * FROM tb_pessoa ORDER BY nome'); ?>

	<center>

		<a class="waves-effect waves-light btn modal-trigger" href="#modal1" style="margin-top: 5%;">Listar Minhas Vendas</a>

		<div id="modal1" class="modal" style="height: 150%;">
	    	<div class="modal-content">

				<form action="search_vendedor.php" method="POST" class="col s12">
					<fieldset class="formulario" style="background-color: white">

						<h5 class="light center">Listar Minhas Vendas</h5>

						<div class="row">

							<input type="HIDDEN" name="idPessoa" id="idPessoa" value="<?php echo $_SESSION['idPessoa']; ?>">

							<div class="input-field col s6">
								<input type="date" name="de" id="de" required autofocus />
								<label for="de">Data Inicial</label>
							</div>

							<div class="input-field col s6">
								<input type="date" name="ate" id="ate" required autofocus />
								<label for="ate">Data Final</label>
							</div>
						</div>

						<div class="input-field col s12">
							<input type="submit" value="Buscar" class="btn blue">
							<input type="reset" value="Limpar" class="btn red">
						</div>

					</fieldset>
				</form>

				<div class="modal-footer">
			      	<a class="modal-close waves-effect waves-green btn-flat">Fechar</a>
			    </div>
			</div>
		</div>

		<a class="waves-effect waves-light btn modal-trigger" href="#modal2" style="margin-top: 5%;">Listar Vendas de Todos os Vendedores</a>

		<div id="modal2" class="modal" style="height: 150%;">
	    	<div class="modal-content">


				<form action="search_todos.php" method="POST" class="col s12">
					<fieldset class="formulario" style="background-color: white">

						<h5 class="light center">Listar Vendas de Todos os Vendedores</h5>

						<div class="row">

							<div class="input-field col s6">
								<input type="date" name="de" id="de" required autofocus />
								<label for="de">Data Inicial</label>
							</div>

							<div class="input-field col s6">
								<input type="date" name="ate" id="ate" required autofocus />
								<label for="ate">Data Final</label>
							</div>
						</div>

						<div class="input-field col s12">
							<input type="submit" value="Buscar" class="btn blue">
							<input type="reset" value="Limpar" class="btn red">
						</div>

					</fieldset>
				</form>

				<div class="modal-footer">
			      	<a class="modal-close waves-effect waves-green btn-flat">Fechar</a>
			    </div>
			</div>
		</div>

		<?php 

			if($_SESSION['cargo'] == 'Administrador'){

		 ?>

		<a class="waves-effect waves-light btn modal-trigger" href="#modal3" style="margin-top: 5%;">Gerar Relatório</a>

		<?php } ?>

		<div id="modal3" class="modal" style="height: 150%;">
	    	<div class="modal-content">


				<form action="../relatorio.php" method="POST" class="col s12">
					<fieldset class="formulario" style="background-color: white">

						<h5 class="light center">Gerar Relatório Completo</h5>

						<div class="row">

							<div class="input-field col s6">
								<input type="date" name="de" id="de" required autofocus />
								<label for="de">Data Inicial</label>
							</div>

							<div class="input-field col s6">
								<input type="date" name="ate" id="ate" required autofocus />
								<label for="ate">Data Final</label>
							</div>
						</div>

						<div class="input-field col s12">
							<input type="submit" value="Buscar" class="btn blue">
							<input type="reset" value="Limpar" class="btn red">
						</div>

					</fieldset>
				</form>

				<div class="modal-footer">
			      	<a class="modal-close waves-effect waves-green btn-flat">Fechar</a>
			    </div>
			</div>
		</div>

	</center>

</div>

<br>

<?php include_once '../includes/footer.inc.php'; ?>