<?php
    $conexao = mysqli_connect('localhost','root','','flameskt');
    if($conexao == false){
        echo(mysqli_connect_error());
    }
?>