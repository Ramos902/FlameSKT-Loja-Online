<?php
require "./Assets/conexao.php";
  
//Session Login
session_start();

if($_SESSION['adm'] == false){
    header('Location: index.php');
}else{}

//Alterar Stts Produto
if(isset($_POST['submitStts']) && $_POST['submitStts'] == "a"){
    $idProduto = $_POST['idProdutoStts'];
    $updateStts = "UPDATE produto SET status = 'inativo' WHERE idProduto = '$idProduto'";
    $execUpdateStts = mysqli_query($conexao, $updateStts);
    header('Location: dashboard.php');
}elseif(isset($_POST['submitStts']) && $_POST['submitStts'] == "i"){
    $idProduto = $_POST['idProdutoStts'];
    $updateStts = "UPDATE produto SET status = 'ativo' WHERE idProduto = '$idProduto'";
    $execUpdateStts = mysqli_query($conexao, $updateStts);
    header('Location: dashboard.php');
}else{};

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="style_dashboard.css" rel="stylesheet">
        <link rel="icon" href="img\site\icon.png">
        <link rel="stylesheet" href="./fullsite.css">
        <link rel="stylesheet" href="./header_footer.css">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>FlameSKT</title>
    </head>
    <body>
        
<?php
require "Assets/header.php";
?>
        <main>
            <div id="div-conteudo">
                <span><h1>Painel de Controle de Produtos</h1></span>
                <div>
                    <div id="divFlex">
                        <div id="divEsq">
                            <h2>Serviços</h2>
                            <div class="linksEsq"><a href="./criar_produto.php">> Criar Produto</a></div>
                            <div class="linksEsq"><a href="./index.php">> Visualizar Produtos</a></div>
                        </div>
                        <div id="divDir">
                            <span><h2>Gerenciar Produtos</h2></span>
                            <?php
                                $select = "Select * from produto";
                                $comandoDadosProduto = mysqli_query($conexao, $select) or die(mysqli_error($conexao));
                                while ($Produtos = mysqli_fetch_assoc($comandoDadosProduto)) : 
                                ?>
                                <div class="divProdutos">
                                    <div class="divNumProd">
                                        <span><?=$Produtos['idProduto']?></span>
                                    </div>
                                    <div class="produto-nome">
                                        <div class="imagemProd"><img src="./<?=$Produtos['img']?>" width="80px" height="80px"></div>
                                        <div class="nomeQtd">
                                            <span class="nomeProd"><a href="produto.php?id=<?=$Produtos['idProduto']?>"><?=$Produtos['titulo']?></a></span>
                                            <div>
                                                <span class="spanQtdEst">Quantidade em Estoque: <?=$Produtos['qtdEstoque'];
                                                if($Produtos['status'] == "ativo"){echo("<span style='color:green;'>Ativo</span>");}else{echo("<span style='color:red;'>Inativo</span>");}?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="produto-preco">
                                        <span>R$<?= number_format((float)$Produtos['preco'], 2, ',', '') ?></span>
                                    </div>
                                    <div class="remover-produto">
                                        <a class="botaoEditar" href="./editarProduto.php?id=<?=$Produtos['idProduto']?>" name="botaoExcluir">
                                            <span>Editar</span>
                                        </a>
                                    </div>
                                    <div class="remover-produto">
                                        <form action="dashboard.php" method="POST">
                                            <input type="hidden" name="idProdutoStts" value="<?=$Produtos['idProduto']?>">
                                            <input type="hidden" name="submitStts" value="<?php if($Produtos['status'] == "ativo"){echo("a");}else{echo("i");}?>">
                                            <input class="botaoStts" type="submit" value="<?php if($Produtos['status'] == "ativo"){echo("Desativar");}else{echo("Ativar");}?>">
                                        </form>
                                    </div>
                                    <div class="remover-produto">
                                        <a class="botaoEditar" href="./excluirProduto.php?id=<?=$Produtos['idProduto']?>" name="botaoExcluir">
                                            <span>Excluir</span>
                                        </a>
                                    </div>
                                    </div>
                                <?php endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>

<?php
require "Assets/footer.php";
?>
    </body>
</html>