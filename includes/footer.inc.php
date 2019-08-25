<footer class="page-footer red">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">SW Pizza</h5>
				<p class="grey-text text-lighten-4">Sistema Web Pizza</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2019 SW Pizza
			<a class="grey-text text-lighten-4 right" href="http://labsoft.muz.ifsuldeminas.edu.br/" target="_blank" rel="noopener">Hospedado pelo Labsoft</a>
		</div>
	</div>
</footer>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="../materialize/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../materialize/js/jquery.mask.js"></script>

<?php 

	$queryCalabresa = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 1');
	$valorCalabresa = $queryCalabresa->fetch_assoc();
	$valorCalabresa = $valorCalabresa['preco'];

	$queryCatupiry = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 2');
	$valorCatupiry = $queryCatupiry->fetch_assoc();
	$valorCatupiry = $valorCatupiry['preco'];

	$queryPortuguesa = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 3');
	$valorPortuguesa = $queryPortuguesa->fetch_assoc();
	$valorPortuguesa = $valorPortuguesa['preco'];

	$queryTradicional = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 4');
	$valorTradicional = $queryTradicional->fetch_assoc();
	$valorTradicional = $valorTradicional['preco'];

	$queryPepperoni = $link->query('SELECT preco FROM tb_pizza WHERE idPizza = 5');
	$valorPepperoni = $queryPepperoni->fetch_assoc();
	$valorPepperoni = $valorPepperoni['preco'];

 ?>

<!-- Inicializando o Jquer -->
<script type="text/javascript">
	$(document).ready(function(){
		$('select').formSelect();
		$("#cpf").mask('000.000.000-00');
		$('.dropdown-trigger').dropdown();
		$('.modal').modal();
	});	

	var calabresa = '<?php echo $valorCalabresa ?>';
	var catupiry = '<?php echo $valorCatupiry ?>';
	var portuguesa = '<?php echo $valorPortuguesa ?>';
	var tradicional = '<?php echo $valorTradicional ?>';
	var pepperoni = '<?php echo $valorPepperoni ?>';

	function valorTotal(){
		$('#valorTotal').val(parseInt($('#qtdeTradicional').val(), 10) * tradicional + parseInt($('#qtdePepperoni').val(), 10) * pepperoni + parseInt($('#qtdePortuguesa').val(), 10) * portuguesa + parseInt($('#qtdeCatupiri').val(), 10) * catupiry + parseInt($('#qtdeCalabresa').val(), 10) * calabresa);
	}

	function maisCalabresa(){
		$('#qtdeCalabresa').val(parseInt($('#qtdeCalabresa').val(),10) +1);
		valorTotal();
	}

	function menosCalabresa(){
		if($('#qtdeCalabresa').val() > 0) $('#qtdeCalabresa').val(parseInt($('#qtdeCalabresa').val(),10) -1);
		valorTotal();
	}

	function maisCatupiri(){
		$('#qtdeCatupiri').val(parseInt($('#qtdeCatupiri').val(),10) +1);
		valorTotal();
	}
	
	function menosCatupiri(){
		if($('#qtdeCatupiri').val() > 0) $('#qtdeCatupiri').val(parseInt($('#qtdeCatupiri').val(),10) -1);
		valorTotal();
	}

	function maisPortuguesa(){
		$('#qtdePortuguesa').val(parseInt($('#qtdePortuguesa').val(),10) +1);
		valorTotal();
	}
	
	function menosPortuguesa(){
		if($('#qtdePortuguesa').val() > 0) $('#qtdePortuguesa').val(parseInt($('#qtdePortuguesa').val(),10) -1);
		valorTotal();
	}

	function maisTradicional(){
		$('#qtdeTradicional').val(parseInt($('#qtdeTradicional').val(),10) +1);
		valorTotal();
	}
	
	function menosTradicional(){
		if($('#qtdeTradicional').val() > 0) $('#qtdeTradicional').val(parseInt($('#qtdeTradicional').val(),10) -1);
		valorTotal();
	}

	function maisPepperoni(){
		$('#qtdePepperoni').val(parseInt($('#qtdePepperoni').val(),10) +1);
		valorTotal();
	}
	
	function menosPepperoni(){
		if($('#qtdePepperoni').val() > 0) $('#qtdePepperoni').val(parseInt($('#qtdePepperoni').val(),10) -1);
		valorTotal();
	}
	
</script>
</body>
</html>