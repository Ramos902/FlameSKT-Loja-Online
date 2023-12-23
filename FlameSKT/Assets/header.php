<header id="menu-principal">
    <div id="logo">
        <a href="index.php">
            <img src=".\img\site\LogoSemFundo2.png" height="85px" width="240px" alt="LogoArabella">
        </a>
    </div>
    <div id="DivPesquisa">
        <label for="BarraPesquisa"></label>
        <form action="index.php?src=<?php if(isset($_GET['search'])){echo($_GET['search']);}else{}?>" method="get">
            <input type="text" id="Pesquisa" name="search" placeholder="Pesquise em Todo o Site">
        </form>
    </div>
    <div id="BoxDireita">
        <div class="DivItensDireita" id="carrinho">
            <a href="./carrinho.php">
                <div class="divImgMenuDireita">
                    <img class="imgMenuDireita" src=".\img\site\Carrinho.png" alt="Carrinho">
                </div>
                <span id="textoCarrinho">Carrinho</span>
            </a>
        </div>
        <?php if(isset($_SESSION['logado'])):?>
            <div class="DivItensDireita" id="minhaAcc">
                <?php
                    //Select Usuario
                    $selectUsuario = "SELECT idUsuario FROM usuario where idUsuario = '$_SESSION[id_usuario]';";
                    $execSelectUsuario = mysqli_query($conexao, $selectUsuario);
                    $dadosUsuario = mysqli_fetch_assoc($execSelectUsuario);
                ?>
                <a href="./contaUsuario.php?">
                    <div class="divImgMenuDireita">
                        <img class="imgMenuDireita" src=".\img\site\Usuario.png" alt="Insta">
                    </div>
                    <span id="textoUsuario">Minha Conta</span>
                </a>
            </div>
        <?php else:?>
            <div class="DivItensDireita" id="usuario">
                <a href="./registro_login.php">
                    <div class="divImgMenuDireita">
                        <img class="imgMenuDireita" src=".\img\site\Usuario.png" alt="Insta">
                    </div>
                    <span id="textoUsuario">Faça seu Login<br> ou Cadastre-se</span>
                </a>
            </div>    
        <?php endif;?>
    </div>
</header>