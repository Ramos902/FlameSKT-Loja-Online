<?php
    require "./Assets/conexao.php";
    $id = $_GET['id'];
    $dadosProduto = mysqli_query($conexao, "Select * from produto WHERE idProduto=$id") or die(mysqli_error($conexao));
    $Produtos = mysqli_fetch_assoc($dadosProduto);

    if(isset($_POST['submit'])){
        //Alocação da imagem
        if($_FILES['imgFile']['error'] === 0){
            $destino = "./img/produtos/" . $_FILES['imgFile']['name'];
            $arquivo_tmp = $_FILES['imgFile']['tmp_name'];
            move_uploaded_file($arquivo_tmp, ("./img/produtos/" . $_FILES['imgFile']['name']));
        }else{
            $destino = $Produtos['img'];
        }
        
        //Insert Produto
        $titulo = mysqli_real_escape_string($conexao, $_POST['tituloProduto']);
        $preco = mysqli_real_escape_string($conexao, $_POST["precoProduto"]);
        $qntVezes = mysqli_real_escape_string($conexao, $_POST["qtzVezesProd"]);
        $descricao = mysqli_real_escape_string($conexao, $_POST["descProduto"]);
        $freteGratis = mysqli_real_escape_string($conexao, $_POST["freteProduto"]);
        $categoria = mysqli_real_escape_string($conexao, $_POST["categoriaProduto"]);
        $qtdEstoque = mysqli_real_escape_string($conexao, $_POST["qtdEstoqueProd"]);

        $result = mysqli_query($conexao,    "UPDATE produto 
                                            SET titulo='$titulo', preco='$preco', qntVezes='$qntVezes', descricao='$descricao', img='$destino', freteGratis='$freteGratis', categoria='$categoria', qtdEstoque='$qtdEstoque'
                                            WHERE idProduto=$id;");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header("Location:./dashboard.php");
            exit();
        }
    }else{}
?>

<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="style_criar_produto.css" rel="stylesheet">
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
                    <div id="boxEsquerda">
                        <span id="TituloVisual"><h2>Visualizar</h1></span>
                        <div class="links"><a href="../index.php">> Todos Produtos</a></div>
                        <div class="links"><a href="./dahsboard.html">> Painel de Controle</a></div>
                    </div>
                    <div id="boxDireitaEditar" class="boxDireita">
                        <div id="divEsq">   
                            <form action="editarProduto.php?id=<?=$Produtos['idProduto']?>" method="POST" enctype="multipart/form-data">
                                <div id="divInputs">
                                    <label for="tituloProd">Nome Produto : </label>
                                    <input id="tituloProd" type="text" name="tituloProduto" class="Inputs" value="<?=$Produtos['titulo']?>"><br>
                                
                                    <label for="precoProd">Preço : </label>
                                    <input id="precoProd" type="text" name="precoProduto" class="Inputs" value="<?= number_format((float)$Produtos['preco'], 2, '.', '') ?>"><br>
                                
                                    <label for="qtzVezesProd">Quantas Vezes : </label>
                                    <input id="qtzVezesProd" type="number" name="qtzVezesProd" class="Inputs" value="<?= $Produtos['qntVezes'] ?>"><br>
                                    
                                    <label for="qtdEstoqueProd">Quantidade em Estoque : </label>
                                    <input id="qtdEstoqueProd" type="number" name="qtdEstoqueProd" class="Inputs" value="<?= $Produtos['qtdEstoque'] ?>"><br>

                                    <div id="divTituloOpcoesFrete">
                                        <label for="freteProduto">Frete Grátis :</label><br>
                                    </div>
                                    <div id="divOpcoesFrete">
                                        <input id="simProd" type="radio" name="freteProduto" class="Inputs" value="s" <?php
                                        if($Produtos['freteGratis'] == 's'){
                                            echo('checked');
                                        }?>>
                                        <label for="simProd">Sim </label><br>
                                        
                                        <input id="naoProd" type="radio" name="freteProduto" class="Inputs" value="n" <?php
                                        if($Produtos['freteGratis'] == 'n'){
                                            echo('checked');
                                        }?>>
                                        <label for="naoProd">Não, a Calcular no Pagamento </label><br>
                                    </div><br>

                                    <label for="descProd">Descrição : </label>
                                    <input id="descProd" type="textarea" name="descProduto" class="Inputs" value="<?=$Produtos['descricao']?>"><br>
                                    
                                    <div id="divCategoria">
                                        <div id="divTituloCategoria">
                                            <label for="categoriaProduto">Categorias :</label><br>
                                        </div>
                                        <div id="divOpcoesCategoria">
                                            <input id="skateProd" type="radio" name="categoriaProduto" class="Inputs" value="Skate" <?php
                                                if($Produtos['categoria'] == 'Skate'){
                                                    echo('checked');
                                                }?>>
                                            <label for="skateProd">Skate </label><br>
                                            
                                            <input id="longProd" type="radio" name="categoriaProduto" class="Inputs" value="Longboard" <?php
                                                if($Produtos['categoria'] == 'Longboard'){
                                                    echo('checked');
                                                }?>>
                                            <label for="longProd">LongBoard </label><br>
                                        
                                            <input id="tenisProd" type="radio" name="categoriaProduto" class="Inputs" value="Tenis" <?php
                                                if($Produtos['categoria'] == 'Tenis'){
                                                    echo('checked');
                                                }?>>
                                            <label for="tenisProd">Tênis </label><br>
                                            
                                            <input id="roupaProd" type="radio" name="categoriaProduto" class="Inputs" value="Roupas" <?php
                                                if($Produtos['categoria'] == 'Roupas'){
                                                    echo('checked');
                                                }?>>
                                            <label for="roupaProd">Roupa </label><br>
                                            
                                            <input id="acessProd" type="radio" name="categoriaProduto" class="Inputs" value="Acessorios" <?php
                                                if($Produtos['categoria'] == 'Acessorios'){
                                                    echo('checked');
                                                }?>>
                                            <label for="acessProd">Acessorios </label>
                                        </div>
                                    </div>
                                    <div id="imagemProd">
                                        <label for="imagemProdInput">Suba a Imagem.png aqui!</label>
                                        <input id="imagemProdInput" type="file" name="imgFile">
                                    </div>
                                    <div id="divEnviar">
                                        <input type="submit" id="enviar" value="Salvar" name="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <h3 style="text-align:center">Imagem Atual</h3>
                            
                            <div id="ImagemProduto">
                                <img src="<?= $Produtos['img'] ?>" width="200" height="auto" alt="ImagemProduto"> 
                            </div>
                        </div>
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
                    <li><a class="textoAtalho" href="../sobre.html">Visão</a></li>
                    <li><a class="textoAtalho" href="../sobre.html">Valores</a></li>
                    <li><a class="textoAtalho" href="../sobre.html">Missão</a></li>
                    <li><a class="textoAtalho" href="../sobre.html">Metas</a></li>       
                </ul>
            </div>
        </footer>
    </body>
</html>