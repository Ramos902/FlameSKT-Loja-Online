<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();

//Select Produtos
$selectProduto = "Select * from produto";
$comandoDadosProduto = mysqli_query($conexao, $selectProduto) or die(mysqli_error($conexao));

//Search Box
if (isset($_GET['search'])) {
    $pesquisa = $_GET['search'];
    $selectProduto = "SELECT * FROM produto WHERE titulo LIKE '%$pesquisa%'";
    $comandoDadosProduto = mysqli_query($conexao, $selectProduto) or die(mysqli_error($conexao));
} else {
}

//Selecionar Categoria
if (isset($_GET['cat'])) {
    $categoria = $_GET['cat'];
    switch ($categoria) {
        case 'Skate':
            $comandoDadosProduto = mysqli_query($conexao, "SELECT * FROM produto WHERE categoria LIKE 'Skate'") or die(mysqli_error($conexao));
            break;
        case 'LongBoard':
            $comandoDadosProduto = mysqli_query($conexao, "SELECT * FROM produto WHERE categoria LIKE 'LongBoard'") or die(mysqli_error($conexao));
            break;
        case 'Tenis':
            $comandoDadosProduto = mysqli_query($conexao, "SELECT * FROM produto WHERE categoria LIKE 'Tenis'") or die(mysqli_error($conexao));
            break;
        case 'Roupas':
            $comandoDadosProduto = mysqli_query($conexao, "SELECT * FROM produto WHERE categoria LIKE 'Roupas'") or die(mysqli_error($conexao));
            break;
        case 'Acessorios':
            $comandoDadosProduto = mysqli_query($conexao, "SELECT * FROM produto WHERE categoria LIKE 'Acessorios'") or die(mysqli_error($conexao));
            break;
        default:
            break;
    }
} else {
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="img\site\icon.png">
    <link href="fullsite.css" rel="stylesheet">
    <link href="header_footer.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>FlameSKT</title>
</head>

<body>
    <?php
    require "Assets/header.php";
    require "Assets/categoria.php";
    ?>
    <main id="main">
        <div id="div-conteudo">
            <?php
            while ($Produtos = mysqli_fetch_assoc($comandoDadosProduto)) :
                if ($Produtos['status'] == "ativo") :
            ?>
                    <div class="div-produtos">
                        <a href="produto.php?id=<?= $Produtos['idProduto'] ?>" class="produtos-linha">
                            <div class="ImagemProduto">
                                <img src="<?= $Produtos['img'] ?>" width="200" height="auto" alt="ImagemProduto">
                            </div>
                            <div class="NomeProduto">
                                <p><?= $Produtos['titulo'] ?></p>
                            </div>
                            <div class="PrecoProduto">
                                <span class="preco">R$<?= number_format((float)$Produtos['preco'], 2, ',', '') ?><br></span>
                                <span class="precoX">Ou <?= $Produtos['qntVezes'] ?>x <?= number_format(((float)$Produtos['preco'] / (int)$Produtos['qntVezes']), 2, ',', '') ?><br></span>
                                <span class="frete">+Frete Grátis</span>
                            </div>
                        </a>
                    </div>
            <?php else : endif;
            endwhile;
            ?>
        </div>
    </main>
    <?php
    require "Assets/footer.php";
    ?>
</body>

</html>