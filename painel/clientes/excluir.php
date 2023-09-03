<?php 

    require_once("../../conexao.php");

    $id = $_POST['id'];

    /* QUERY - Excluir usuario */
    $query_con = $pdo->query("DELETE from clientes WHERE id = '$id'");

    echo 'Excluído com Sucesso!';

 ?>