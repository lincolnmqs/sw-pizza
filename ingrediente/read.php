<?php
include_once '../conexao.php';

$querySelect = $link->query('SELECT * FROM tb_ingredientes 
inner join tb_unidade on tb_unidade.idUnidade = tb_ingredientes.unidade');


while ($registro = $querySelect->fetch_assoc()) {
    $id          = $registro['idIngredientes'];
    $nome        = $registro['nome_ing'];
    $preco       = $registro['preco_ing'];
    $sigla       = $registro['sigla'];
    
    
    echo "<tr>";
    echo "
    <td>$nome</td>
    <td>$preco</td>
    <td>$sigla</td>
	<td><a href='editar.php?id=$id'><i class='material-icons'>edit</i></a></td>
	<td><a href='delete.php?id=$id'><i class='material-icons'>delete</i></a></td>";
    echo "</tr>";
}



