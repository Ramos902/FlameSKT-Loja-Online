<?php
    require "Assets/conexao.php";
    $id = $_GET['id'];

    $comando = "delete from produto where idProduto=$id;";
    $resultado = mysqli_query($conexao, $comando);
  
    header("Location: ./dashboard.php");
    exit();
?>