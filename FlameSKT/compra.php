<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();

//Verificação login
if($_SESSION['logado']){
    $id = $_SESSION['id_usuario'];
}else{
    header('Location: registro_login.php');
}

//Alter Registro
if(isset($_POST['numeroqtd']) && isset($_POST['idProdutoHidden'])){
    $qtdProduto = $_POST['numeroqtd'];
    $idProduto = $_POST['idProdutoHidden'];
    $updatePedido = "UPDATE pedido SET qtdProduto = $qtdProduto WHERE idProduto = $idProduto AND idUsuario = $id";
    $execUpdatePedido = mysqli_query($conexao, $updatePedido);
    header('Location: compra.php');
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

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="style_compra.css" rel="stylesheet">
        <link rel="icon" href="img\site\icon.png">
        <link rel="stylesheet" href="fullsite.css">
        <link rel="stylesheet" href="header_footer.css">
        <title>FlameSKT</title>
    </head>
    <body>
<?php
    require "Assets/header.php";
?>
        <main>
            <div id="divCarrinho">
                <div id="h1Carrinho"><h1>Finalizar Pedido</h1></div>
                <div id="divEsqDir">
                    <div id="divEsquerda">
                    <?php   
                        foreach($dadosPedidos as $dadosPedido):?>
                        <div class="divProdutos">
                            <div class="produto-nome">
                                <div class="imagemProd"><img src="<?=$dadosPedido['img']?>" width="80px" height="80px"></div>
                                <div class="nomeQtd">
                                    <span class="nomeProd"><?=$dadosPedido['titulo']?></span>
                                    <span class="numeroqtd" name="numeroqtd"><?=$dadosPedido['qtdProduto']?> Uni</span>
                                </div>
                            </div>
                            <div class="produto-preco">
                                <span>R$<?= number_format((float)$dadosPedido['preco'], 2, ',', '') ?></span>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="divDireita">
                        <div id="divResumoPedido">
                            <h2 class="h2Titulos">Resumo do Pedido</h2>
                        </div>
                        <div id="divEntrega">
                            <h2 class="h2Titulos">Local de Entrega</h2>
                            <form method="get" action="compra.php?" id="formEndereco">
                                <div class="itensEndereco">
                                    <label class="labels" for="cep">CEP :</label>
                                    <input id="cep" name="cep" type="number" placeholder="00000-000">
                                </div>
                                <div class="itensEndereco">
                                    <label class="labels" for="endereco">Endereço :</label>
                                    <input id="endereco" type="text" name="" placeholder="Ex: Rua Major, Centro">
                                </div>
                                <div class="itensEndereco">
                                    <label class="labels" for="number">Numero :</label>
                                    <input id="number" type="number" name="" size="3">
                                </div>
                                <div class="divBotaoConcluido">
                                    <input type="submit" class="botaoConcluido" value="Salvar">
                                    
                                </div>
                                <?php 
                                    require "calcularFrete.php";
                                    ?>
                            </form>
                        </div>
                        <div id="divMetodoPagamento">
                            <h2 class="h2Titulos">Pagamento</h2>
                            <form>
                                <div>
                                    <input type="radio" name="metodoPagamento" id="debito">
                                    <label for="debito">Cartão de Debito</label>
                                </div>
                                <div>
                                    <input type="radio" name="metodoPagamento" id="credito">
                                    <label for="credito">Cartão de Credito</label>
                                    
                                </div>
                                <div>
                                    <input type="radio" name="metodoPagamento" id="boleto">
                                    <label for="boleto">Boleto</label> 
                                </div>
                            </form>
                        </div>
                        <div id="divValores">
                            <?php
                                $total = 0;
                                $totalcFrete = 0;
                                foreach($dadosPedidos as $dadosPedido){
                                    $preco = floatval($dadosPedido['preco']);
                                    $quantidade = intval($dadosPedido['qtdProduto']);
                                    $subtotal = $preco * $quantidade;
                                    $total += $subtotal;
                                    $totalcFrete = (float)$frete->Valor + $total;
                                }           
                            ?>
                            <span id="subtotalValores" class="valores" name="subtotal"><span>Subtotal</span><span>R$<?=number_format((float)$total, 2, ',', '')?></span></span>
                            <span id="freteValores" class="valores" name="frete"><span>Frete</span> <span>R$<?=number_format((float)$frete->Valor, 2, ',', '')?></span></span>
                            <span id="descontoValores" class="valores" name="frete"><span>Descontos</span> <span>R$00,00</span></span>
                        </div>
                        <div id="divValorTotal">
                            <span id="valorTotal" class="valores"><span>Total</span><span>R$<?=number_format((float)$totalcFrete, 2, ',', '')?></span></span>
                        </div>
                        <div id="divBotaoContinuar">
                            <a href="./index.php"><span id="botaoContinuar">Finalizar Compra</span></a>
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