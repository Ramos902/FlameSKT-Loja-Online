<?php
//Conexao
require "Assets/conexao.php";

//Session Login
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="style_sobre.css" rel="stylesheet">
        <link rel="icon" href="img\site\icon.png">
        <link rel="stylesheet" href="fullsite.css">
        <link rel="stylesheet" href="header_footer.css">
        <title>FlameSKT</title>
    </head>
    <body>
        
    <?php
    require "Assets/header.php";
    require "Assets/categoria.php";
    ?>
        <main>
            <div id="div-conteudo">
                <span><h1>Sobre Nossa Loja</h1></span>
                <span class="textos">
                    Somos uma loja que preza o bem estar e satistafação do cliente com produtos
                    de qualidade e otimas ofertas dentro do mercado Brasileiro no ramo de Skatistas
                    com materias de primeira linha para que você possa se divertir sem se preocupar.
                </span>
                
                <div id="divTextosFlex">
                    <div class="divTextos">
                        <h2>Missao</h2>
                        <span class="textos">
                            Nos empenhamos que Skatistas de todo o Brasil tenham a melhor qualidade para que
                            sua sessão não seja atrapalhada, promovendo a melhor experiencia
                        </span>
                    </div>
                    <div class="divTextos">
                        <h2>Valores</h2>
                        <span class="textos">
                            Preservamos nosso comprometimento com o cliente e trazendo o melhor do mercado 
                            da atualidade com nossa constante inovação e qualidade de nossos produtos feito
                            em prol da diversidade para qualquer tipo de usuario
                        </span>
                    </div>
                    <div class="divTextos">
                        <h2>Visao</h2>
                        <span class="textos">
                            Ser a número um do mercado, conquistar espaço internacional por meio da 
                            inovação, ter sedes em todas as capitais do país. ser reconhecida mundialmente 
                            como uma empresa pioneira em seu setor estando sempre à frente das demais
                        </span>
                    </div>
                </div>
                <h2>Metas</h1>
                    
                <span class="lista">> Adquirir novos e melhores clientes</span><br>
                <span class="lista">> Aumentar o faturamento</span><br>
                <span class="lista">> Aumentar a produtividade</span><br>
                <span class="lista">> Reduzir custos</span>
                    
            </div>
        </main>

        <footer>
            <div id="logo">
                <a href="index.html">
                    <img src=".\img\site\LogoSemFundo2.png" height="85px" width="240px" alt="LogoArabella">
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