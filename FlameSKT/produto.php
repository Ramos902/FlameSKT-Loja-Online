<?php
    require "Assets/conexao.php";

    //Session Login
    session_start();

    if(isset($_SESSION['logado'])){
        $idLogin = $_SESSION['id_usuario'];
    }else{}
    
    $id = $_GET["id"];
    $select = "Select * from produto where idProduto = $id";
    $DadosProduto = mysqli_query($conexao, $select) or die (mysqli_error($conexao));
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="styleProdutos.css" rel="stylesheet">
        <link rel="icon" href="..\img\site\icon.png">
        <link rel="stylesheet" href="fullsite.css">
        <link rel="stylesheet" href="header_footer.css">
        <title>FlameSKT</title>
    </head>
    <body>
        <?php
            require "Assets/header.php";
            require "Assets/categoria.php";
        ?>

        <div id="divMain">
            <?php
            while($Produto = mysqli_fetch_assoc($DadosProduto)) : ?> 
            <div id="divProduto">
                <div id="divProduto-1">
                    <div id="divImagem">
                        <img src="<?=$Produto['img']?>" width="400px">
                    </div>
                    <div id="divDescricao">
                        <div id="divTitulo">
                            <span id="nome"><?=$Produto['titulo']?><br></span>
                            <img src=".\img\site\avaliacao.png" width="200px">
                        </div>
                        <div id="divPreco">
                            <span id="preco">R$<?=number_format((float)$Produto['preco'], 2,',','')?><br></span>
                            <span id="precoX">Ou <?=$Produto['qntVezes']?>x <?=number_format(((float)$Produto['preco'] / (int)$Produto['qntVezes']), 2,',','')?><br></span>
                        </div>
                        <div id="divCompra">                        
                            <div class="compra">
                                <form action="<?php if(isset($_SESSION['logado'])){echo("./carrinho.php");}else{echo("./registro_login.php");}?>" method="post">
                                <input type="submit" class="compraLink" value="Comprar">
                                <input type="hidden" name="adicionarCarrinho" value="<?=$Produto['idProduto']?>">    
                            </div>                                            
                            <div class="compra">
                                <form action="<?php if(isset($_SESSION['logado'])){echo("./carrinho.php");}else{echo("./registro_login.php");}?>" method="post">
                                    <input type="submit"  value="Adicionar ao Carrinho" class="compraLink">
                                    <input type="hidden" name="adicionarCarrinho" value="<?=$Produto['idProduto']?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divProduto-2">
                    <h2 class="tituloDesc">Descrição</h2>
                    <span><?=$Produto['descricao']?></span>
                </div>
            </div>
            <?php endwhile;
            ?>  
        </div>
        <?php
            require "Assets/footer.php";
        ?>
    </body>
</html>