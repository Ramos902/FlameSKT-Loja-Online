<?php 
require "Assets/conexao.php";

session_start();
//Registrar Usuario
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="style_registro_login.css" rel="stylesheet">
        <link rel="icon" href="img\site\icon.png">
        <link rel="stylesheet" href="./fullsite.css">
        <link rel="stylesheet" href="./header_footer.css">
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
                                <input type="password" name="senha" id="password" required>
                                <span>Senha</span>
                            </div>
                            <a href="./recuperarSenha.php">Esqueci Minha Senha</a>
                            <div class="errorPhp">
                                <?php
                                    if(isset($_POST['submitLogin'])){
                                        if (strlen($_POST['email']) > 255 || strlen($_POST['senha']) > 255) {
                                            echo("<p>Algum campo excede o Limite de Caracteres Permitidos!</p>");
                                        }else{
                                            $email = $_POST['email'];
                                            $senha = $_POST['senha'];
                                            $verificadorEmail = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email';");
                                            $linhasEmail = mysqli_num_rows($verificadorEmail);
                                            if($linhasEmail == 1){
                                                $verificarConta = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");
                                                if(mysqli_num_rows($verificarConta) == 1){
                                                    if($email == "admin"){
                                                        $_SESSION['adm'] = true;
                                                    }
                                                    $_SESSION['logado'] = true;
                                                    $dadosConta = mysqli_fetch_assoc($verificadorEmail);
                                                    $_SESSION['id_usuario'] = $dadosConta['idUsuario'];
                                                    header('Location:./index.php');
                                                    exit();
                                                }else{
                                                    echo("<p>Senha Errada</p>");
                                                }
                                            }else{
                                                echo("<p>Conta não Encontrada</p>");
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
                <div id="divRegistro">
                    <h1>Registre-se</h1>
                    <div class="divForm" id="divFormRegistro">
                        <form action="./registro_login.php" method="POST" class="formClass">
                            <div class="inputBox">                               
                                <input type="text" id="email" name="emailReg" required>
                                <span>E-mail</span>
                            </div>
                            <div class="inputBox">                               
                                <input type="password" name="senha" id="password1" required>
                                <span>Senha</span>
                            </div>
                            <div class="inputBox">                               
                                <input type="password" name="senhaConfirm" id="password2" required>
                                <span>Validar Senha</span>
                            </div>
                            <div class="inputBox">                              
                                <input type="text" name="nome" id="nome" required>
                                <span>Nome</span>
                            </div>
                            <div class="inputBox">                               
                                <input type="date" name="dtNascimento" id="nasc">
                                <span>Nascimento</span>
                            </div>
                            <div class="inputBox" id="inputSexo">
                                <input type="radio" name="sexo" value="F" id="fem"><label for="fem" id="fem">Feminino</label>
                                <input type="radio" name="sexo" value="M" id="masc"><label for="masc" id="masc">Masculino</label>
                                <span>Sexo</span>
                            </div>
                            <div class="inputBox">
                                <input type="number" name="telefone" id="telefone" required>
                                <span>Telefone</span>
                            </div>
                            <div class="errorPhp">
                                <?php
                                    if(isset($_POST['submitRegistro'])){
                                        if (strlen($_POST['emailReg']) > 255 || strlen($_POST['senha']) > 255 || strlen($_POST['senhaConfirm']) > 255 || strlen($_POST['nome']) > 255 || strlen($_POST['telefone']) > 20) {
                                            echo("<p>Algum campo excede o Limite de Caracteres Permitidos!</p>");
                                        }else{
                                            $email = $_POST['emailReg'];
                                            $verificadorEmail = mysqli_query($conexao, "SELECT COUNT(*) as total FROM usuario WHERE email = '$email';");
                                            $linhasEmail = mysqli_fetch_assoc($verificadorEmail);
                                            if($linhasEmail['total'] == 0){
                                                if($_POST['senha'] == $_POST['senhaConfirm'] && strlen($_POST['senha']) >= 8 && strlen($_POST['senhaConfirm']) >= 8){
                                                    $senha = $_POST['senha'];
                                                    $nome = $_POST['nome'];
                                                    $dtNasc = $_POST['dtNascimento'];
                                                    $sexo = $_POST['sexo'];
                                                    $telefone = preg_replace('/[^0-9]/', '', $_POST['telefone']);
                                                    
                                                    $insert = "INSERT INTO usuario(email, senha, nome, dataNasc, sexo, telefone) VALUES ('$email','$senha','$nome','$dtNasc','$sexo','$telefone');";    
                                                    $resultado = mysqli_query($conexao, $insert);
                                                        if($resultado){
                                                            echo("<p>Conta criada com Sucesso</p>");
                                                        }else{
                                                            echo("<p>Ocorreu um Erro na Criação da Conta</p>");
                                                        }   
                                                    }else{
                                                        echo("<p>Senhas não Coincidem ou não Atinge minimo de 8 Caracteres</p>");
                                                    }
                                                }else{
                                                echo("<p>Esse email já existe</p>");
                                            }
                                        }
                                    }
                                ?>
                            </div>
                                <input type="hidden" name="submitRegistro" value="1">
                                <input type="submit" class="buttonSubmit" value="Enviar">
                        </form>
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