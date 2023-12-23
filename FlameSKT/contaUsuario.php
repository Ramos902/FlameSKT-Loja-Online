<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();

//Dados Conta
$select = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[id_usuario]';";
$execSelect = mysqli_query($conexao, $select);
$dadosConta = mysqli_fetch_assoc($execSelect);

//Sair da Conta
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_unset();
    session_destroy();
    header('Location: index.php');
}

if(isset($_GET['apagar'])){
    $id = $_SESSION['id_usuario'];
    $execDelete = mysqli_query($conexao, "DELETE FROM usuario WHERE idUsuario = $id");
    session_unset();
    session_destroy();
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="img\site\icon.png">
    <link href="fullsite.css" rel="stylesheet">
    <link href="header_footer.css" rel="stylesheet">
    <link rel="stylesheet" href="style_conta_usuario.css">
    <title>FlameSKT</title>
</head>

<body>
    <?php
    require "Assets/header.php";
    ?>
    <main>
        <div id="divConteudo">
            <div id="divInfo">
                <h1>Nome: <?=$dadosConta['nome']?></h1>
                <p>Email: <?=$dadosConta['email']?></p>
                
            </div>
            <div>
                <div id="divExit">
                    <form action="" method="POST">
                        <input type="submit" value="Sair Da Conta">
                    </form>
                    <form action="" method="POST">
                        <a href="contaUsuario.php?apagar=<?=$_SESSION['id_usuario']?>" type="submit">Apagar Conta</a>
                    </form>
                </div>
                <?php if($dadosConta['email'] =="admin"):?>
                <div>
                    <div id="divPainelControl">
                        <h2>Painel de Controle de ADM</h2>
                        <span><a href="./dashboard.php" class="buttonSubmit">Acessar</a></span>
                    </div>
                </div>
                <?php else: endif;?>
            </div>
        </div>

    </main>

    <?php
    require "Assets/footer.php";
    ?>
</body>
</html>