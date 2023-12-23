<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="recuperarSenha.css" rel="stylesheet">
    <link rel="icon" href="img\site\icon.png">
    <link href="fullsite.css" rel="stylesheet">
    <link href="header_footer.css" rel="stylesheet">
    <title>FlameSKT</title>
</head>
<body>
    <header id="menu-principal">
        <div id="logo">
            <a href="index.php">
                <img src=".\img\site\LogoSemFundo2.png" height="85px" width="240px" alt="LogoArabella">
            </a>
        </div>
    </header>
    <main>
        <div id="divCadastro">
            <div id="divLogin">
                <h1>Login</h1>
                    <div class="divForm">
                        <form action="" method="POST" class="formClass">
                            <div class="inputBox">
                                <input type="text" id="email" name="email" required>
                                <span>E-mail</span>
                            </div>
                            <div class="inputBox">                               
                                <input type="password" name="senha" id="password1" required>
                                <span>Nova Senha</span>
                            </div>
                            <div class="inputBox">                               
                                <input type="password" name="senhaConfirm" id="password2" required>
                                <span>Validar Nova Senha</span>
                            </div>
                            <div class="errorPhp">
                                <?php
                                if(isset($_POST['submitLogin'])){
                                    if (strlen($_POST['senha']) > 255 || strlen($_POST['senhaConfirm']) > 255) {
                                        echo("<p>Algum campo excede o Limite de Caracteres Permitidos!</p>");
                                    }else{
                                        if($_POST['senha'] == $_POST['senhaConfirm']){
                                            $email = $_POST['email'];
                                            $senha = $_POST['senha'];
                                            $verificadorEmail = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email';");
                                            $linhasEmail = mysqli_num_rows($verificadorEmail);
                                            if($linhasEmail == 1){
                                                $updateSenha = mysqli_query($conexao, "UPDATE usuario SET senha = '$senha' WHERE email = '$email';");
                                                if($updateSenha){
                                                    echo("<p>Senha Alterada com Sucesso</p>");
                                                }
                                            }else{
                                                echo("<p>Conta não Encontrada</p>");
                                            }
                                        }else{
                                            echo("<p>Senhas não Coincidem</p>");
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <input type="hidden" name="submitLogin" value="1">
                            <input type="submit" class="buttonSubmit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div id="logo">
            <a href="index.html">
                <img src=".\img\site\LogoSemFundo2.png" height="85px" width="240px" alt="LogoArabella">
            </a>
        </div>
    </footer>
</body>
</html>