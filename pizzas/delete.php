<?php
session_start();
include_once '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$queryDelete = $link->query("DELETE FROM tb_pizza WHERE idPizza='$id'");

if(mysqli_affected_rows($link) > 0){
    $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: green;">Remoção realizada com sucesso!</p>';
    header("Location:index.php");
}
else{
    $_SESSION['msg'] = '<p class="center white-text" style="padding: 5px; background: #F44336;">Erro!</p>';
    header("Location:index.php");
}