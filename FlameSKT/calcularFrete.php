<?php
    //Conexao
    require "Assets/conexao.php";

    
    //Calc Frete
    $cep_origem = "69400240";   
    $cep_destino = 0; 
    if(isset($_GET['cep'])){  
    $cep_destino = $_GET['cep']; 
    }
    //Dados Produto 
    $peso          = 2;
    $valor         = 100;
    $tipo_do_frete = '40010'; //Sedex: 40010 / Pac: 41106
    $altura        = 6;
    $largura       = 20;
    $comprimento   = 20;

    //Configuração
    $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
    $url .= "nCdEmpresa=";
    $url .= "&sDsSenha=";
    $url .= "&sCepOrigem=" . $cep_origem;
    $url .= "&sCepDestino=" . $cep_destino;
    $url .= "&nVlPeso=" . $peso;
    $url .= "&nVlLargura=" . $largura;
    $url .= "&nVlAltura=" . $altura;
    $url .= "&nCdFormato=1";
    $url .= "&nVlComprimento=" . $comprimento;
    $url .= "&sCdMaoProria=n";
    $url .= "&nVlValorDeclarado=" . $valor;
    $url .= "&sCdAvisoRecebimento=n";
    $url .= "&nCdServico=" . $tipo_do_frete;
    $url .= "&nVlDiametro=0";
    $url .= "&StrRetorno=xml";


    $xml = simplexml_load_file($url);

    $frete =  $xml->cServico;
    
    if(isset($_GET['cep'])){
    echo "<h2>Frete Sedex: R$ ".number_format((float)$frete->Valor, 2, ',', '')."<br />Prazo: ".$frete->PrazoEntrega." dias</h2>";
    }else{};

 ?>