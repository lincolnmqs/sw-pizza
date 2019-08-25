<?php
include_once '../conexao.php';

session_start();

$nome        = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$preco       = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
$idUnidade   = filter_input(INPUT_POST, 'idUnidade', FILTER_SANITIZE_NUMBER_INT);

$querySelect = $link->query('SELECT * FROM tb_ingredientes');

$array_nomes = array();

while($nomes = $querySelect->fetch_assoc()){
    $nomes_existentes = $nomes['nome'];
    array_push($array_nomes, $nomes_existentes);
}

if(in_array($nome, $array_nomes)){
    $_SESSION['msg'] = "<p class='center red-text'>" . 'Esta unidade ja esta cadastrada no sistema!' . "</p>";
    header('Location:../');
}
else{
	$queryInsert = $link->query('INSERT INTO tb_ingredientes VALUES(default , "' . $nome . '", "' . $preco . '", "' . $idUnidade . '")');
	$affected_rows = mysqli_affected_rows($link);
	
	if($affected_rows > 0) $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Cadastro realizado com sucesso!</p>';
	else $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro ao Cadastrar!</p>';

}

header('Location:index.php');


echo '<br /><br /><a href="../index.php">Voltar</a>';