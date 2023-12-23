<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();

//Verificação login
if(isset($_SESSION['logado'])){
    $id = $_SESSION['id_usuario'];
}else{
    header('Location: registro_login.php');
}

//Adicionar Produto
if(isset($_POST['adicionarCarrinho'])){
    $idProduto = $_POST['adicionarCarrinho'];
    $verificador = "SELECT * FROM pedido WHERE idProduto = $idProduto AND idUsuario = $id";
    $execVerificador = mysqli_query($conexao, $verificador);
    if(mysqli_num_rows($execVerificador) > 0){
        $updatePedido = "UPDATE pedido SET qtdProduto = qtdProduto + 1 WHERE idProduto = $idProduto AND idUsuario = $id";
        $execUpdatePedido = mysqli_query($conexao, $updatePedido);
    }else{
        $insertPedido = "INSERT INTO pedido (idUsuario, idProduto, qtdProduto) VALUES ('$id', '$idProduto', '1')";
        $execInsertPedido = mysqli_query($conexao, $insertPedido);
    }
    header('Location: carrinho.php');
    exit;
}else{}

//Select Pedido
$selectPedido = "SELECT pedido.idUsuario, pedido.idProduto, produto.titulo, produto.img, produto.preco, pedido.qtdProduto, produto.qtdEstoque
FROM pedido
INNER JOIN produto ON pedido.idProduto = produto.idProduto
WHERE pedido.idUsuario = $id;";
$execSelectPedido = mysqli_query($conexao, $selectPedido);
$dadosPedidos = array();
while ($dadosPedido = mysqli_fetch_assoc($execSelectPedido)) {
    $dadosPedidos[] = $dadosPedido;
}

//Verificação de Exclusão
if(isset($_GET['idExc'])){
    $delete = "DELETE FROM pedido WHERE idProduto = '$_GET[idExc]' AND idUsuario = $id";
    $execDelete = mysqli_query($conexao, $delete);
    header('Location: carrinho.php');
}else{}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="style_carrinho.css" rel="stylesheet">
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
            <div id="divCarrinho">
                <div id="h1Carrinho"><h1>Meu Carrinho</h1></div>
                <div id="divEsqDir">
                    <div id="divEsquerda">
                    <?php   
                    foreach($dadosPedidos as $dadosPedido):?>
                    <form action="compra.php" method="post">
                            <div class="divProdutos">
                                <div class="produto-nome">
                                    <div class="imagemProd"><img src="<?=$dadosPedido['img']?>" width="80px" height="80px"></div>
                                    <div class="nomeQtd">
                                        <span class="nomeProd"><?=$dadosPedido['titulo']?></span>
                                        <input type="number" class="numeroqtd" name="numeroqtd" value="<?=$dadosPedido['qtdProduto']?>" min="1" max="<?=$dadosPedido['qtdEstoque']?>">
                                    </div>
                                </div>
                                <a class="remover-produto" href="carrinho.php?idExc=<?=$dadosPedido['idProduto']?>">
                                    <label class="botaoExcluir" for="inputExc">
                                        <img src="./img/site/BotaoExcluir.png" width="35px" height="35px">
                                    </label>
                                </a>
                                <div class="produto-preco">
                                    <span>R$<?= number_format((float)$dadosPedido['preco'], 2, ',', '') ?></span>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div class="divDireita">
                            <div id="divResumoPedido">
                                <h2 id="resumoPedidoh2">Resumo do Pedido</h2>
                            </div>
                            <div id="divValores">
                            <?php
                                $total = 0;
                                foreach($dadosPedidos as $dadosPedido){
                                    $preco = floatval($dadosPedido['preco']);
                                    $quantidade = intval($dadosPedido['qtdProduto']);
                                    $subtotal = $preco * $quantidade;
                                    $total += $subtotal;
                                }           
                            ?>
                                <span id="subtotalValores" class="valores" name="subtotal"><span>Subtotal</span><span>R$<?=number_format((float)$total, 2, ',', '')?></span></span>
                            </div>
                            <div id="divValorTotal">
                                <span id="valorTotal" class="valores"><span>Total</span><span>R$<?=number_format((float)$total, 2, ',', '')?></span></span>
                            </div>
                            <div id="divBotaoContinuar">
                                <input type="hidden" name="idProdutoHidden" value="<?=$dadosPedido['idProduto']?>">
                                <input type="submit" id="botaoContinuar" value="Continuar Compra"> 
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </main>
<?php
require "Assets/footer.php";
?>
    </body>
</html>
<?php
    
?>