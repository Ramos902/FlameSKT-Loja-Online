<?php
    require "./Assets/conexao.php";

    if(isset($_POST['submit'])){
        //Alocação da imagem
        $destino = "./img/produtos/" . $_FILES['imgFile']['name'];
        $arquivo_tmp = $_FILES['imgFile']['tmp_name'];
        move_uploaded_file($arquivo_tmp, ("./img/produtos/" . $_FILES['imgFile']['name']));

        //Insert Produto
        $titulo = $_POST['tituloProduto'];
        $preco = $_POST["precoProduto"];
        $qntVezes = $_POST["qtzVezesProd"];
        $descricao = $_POST["descProduto"];
        $freteGratis = $_POST["freteProduto"];
        $categoria = $_POST["categoriaProduto"];
        $qtdEstoque = $_POST["qtdEstoque"];

        $result = mysqli_query($conexao, "INSERT INTO produto(titulo, preco, qntVezes, descricao, img, freteGratis, categoria)
        VALUE ('$titulo','$preco','$qntVezes', '$descricao', '$destino', '$freteGratis','$categoria','$qtdEstoque')");

        //
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header("Location: criar_produto.php");
            exit();
        }
    }else{}
?>

<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="./style_criar_produto.css" rel="stylesheet">
        <link rel="icon" href="img\site\icon.png">
        <link rel="stylesheet" href="./fullsite.css">
        <link rel="stylesheet" href="./header_footer.css">
        <title>FlameSKT</title>
    </head>
    <body>
        <?php
            require "Assets/header.php";
        ?>

        <main>
            <div id="div-conteudo">
                <span><h1>Painel do novo Produto</h1></span>
                <div id="divFlex">   
                    <div id="boxEsquerda" >
                        <span id="TituloVisual"><h2>Visualizar</h1></span>
                        <div class="links"><a href="./index.php">> Todos Produtos</a></div>
                        <div class="links"><a href="./dashboard.php">> Painel de Controle</a></div>
                    </div>
                    <div class="boxDireita">   
                        <span id="TituloVisual"><h2>Criar novo Produto</h1></span>
                        <form action="criar_produto.php" method="POST" enctype="multipart/form-data">
                            <div id="divInputs">
                                <label for="tituloProd">Nome Produto : </label>
                                <input id="tituloProd" type="text" name="tituloProduto" class="Inputs"><br>
                            
                                <label for="precoProd">Preço : </label>
                                <input id="precoProd" type="text" name="precoProduto" class="Inputs"><br>
                             
                                <label for="qtzVezesProd">Quantas Vezes : </label>
                                <input id="qtzVezesProd" type="number" name="qtzVezesProd" class="Inputs"><br>
                                
                                <label for="qtdEstoque">Quantidade em Estoque : </label>
                                <input id="qtdEstoque" type="number" name="qtdEstoque" class="Inputs"><br>
                                
                                <div id="divTituloOpcoesFrete">
                                        <label for="freteProduto">Frete Grátis :</label><br>
                                </div>
                                <div id="divOpcoesFrete">
                                    <input id="simProd" type="radio" name="freteProduto" class="Inputs" value="s">
                                    <label for="simProd">Sim </label><br>
                                    
                                    <input id="naoProd" type="radio" name="freteProduto" class="Inputs" value="n">
                                    <label for="naoProd">Não, a Calcular no Pagamento </label><br>
                                </div><br>

                                <label for="descProd">Descrição : </label>
                                <input id="descProd" type="textarea" name="descProduto" class="Inputs"><br>
                                
                                <div id="divCategoria">
                                    <div id="divTituloCategoria">
                                        <label for="categoriaProduto">Categorias :</label><br>
                                    </div>
                                    <div id="divOpcoesCategoria">
                                        <input id="skateProd" type="radio" name="categoriaProduto" class="Inputs" value="Skate">
                                        <label for="skateProd">Skate </label><br>
                                        
                                        <input id="longProd" type="radio" name="categoriaProduto" class="Inputs" value="Longboard">
                                        <label for="longProd">LongBoard </label><br>
                                       
                                        <input id="tenisProd" type="radio" name="categoriaProduto" class="Inputs" value="Tenis">
                                        <label for="tenisProd">Tênis </label><br>
                                        
                                        <input id="roupaProd" type="radio" name="categoriaProduto" class="Inputs" value="Roupas">
                                        <label for="roupaProd">Roupa </label><br>
                                        
                                        <input id="acessProd" type="radio" name="categoriaProduto" class="Inputs" value="Acessorios">
                                        <label for="acessProd">Acessorios </label>
                                    </div>
                                </div>
                                <div id="imagemProd">
                                    <label for="imagemProdInput">Suba a Imagem.png aqui!</label>
                                    <input id="imagemProdInput" type="file" name="imgFile">
                                </div>
                                <div id="divEnviar">
                                    <input type="submit" id="enviar" value="Criar Produto" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div id="logo">
                <a href="../index.php">
                    <img src="..\img\site\LogoSemFundo2.png" height="85px" width="240px" alt="LogoArabella">
                </a>
            </div>
            <div id="atalhos">
                <ul class="lista-nao-ordenada">
                    <li class="textoTitulo">Redes Sociais</li>
                    <li><a class="textoAtalho" href="https://pt-br.facebook.com/" target="_blank">Facebook</a></li>
                    <li><a class="textoAtalho" href="https://www.instagram.com/" target="_blank">Instagram</a></li>
                    <li><a class="textoAtalho" href="https://www.youtube.com/" target="_blank">Youtube</a></li>      
                </ul>
                <ul class="lista-nao-ordenada">
                    <li class="textoTitulo">Politica de Empresa</li>
                    <li><a class="textoAtalho" href="./sobre.html">Visão</a></li>
                    <li><a class="textoAtalho" href="./sobre.html">Valores</a></li>
                    <li><a class="textoAtalho" href="./sobre.html">Missão</a></li>
                    <li><a class="textoAtalho" href="./sobre.html">Metas</a></li>       
                </ul>
            </div>
        </footer>
    </body>
</html>