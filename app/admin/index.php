<?php
    require_once "../components/session.php";

    require_once "../models/conexao.class.php";
    require_once "../models/produto.class.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Configurações Página-->
    <link rel="icon" type="image/x-icon" href="./midia/img/"> <!--FLIVE ICONE-->
    <title>Cadastro Produto - E Commercer</title> <!--TITULOO DA PAGINA-->
    <meta name="descripition" content=""><!--Descrição do site/página-->
    <meta name="author" content=""><!--Criador da Página-->

    <?php require_once "../components/bs5_fw.php"?>

    <!--Configurações CSS-->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

    <!--Configurações JS-->
    <script src="../view/js/index.js" defer></script>
    
</head>
<body id="web-site" class="" onresize="screenSize()" onload="screenSize()">
    
    <?php 
        require_once "../components/header.php"; 
    ?>


    <?php /*

        echo "<div class='container'>";
            echo "<div class='row g-2 g-lg-4 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 py-4'>";
                if(is_array($query_produtos)){
                    foreach ($query_produtos as $produto) {
                        echo"
                        <div class='col'>

                            <div class='card p-4 w-100 h-100 justify-content-between'>
                                <div class='titulo_produto py-1'>
                                    <h2 class='fs-4'>{$produto->nome}</h2>
                                </div>

                                <div class='imagem_produto py-2 d-flex justify-content-center align-items-center'>
                                    <img class='img_produto' src='../produtos/{$produto->imagem}' alt='' srcset=''>
                                </div>
                    
                                <div class='informacoes_produto'>
                                    <div class='descricao mb-1'>{$produto->descricao}</div>
                                    <div class='categoria mb-1'>{$produto->descritivo}</div>
                                    <div class='preco mb-1'>R$ ".number_format($produto->preco, 2, ',', '.')."</div>
                                </div>

                                <div class='row gy-2 py-2'>
                                    <button class='btn btn-success' type='submit'>Comprar agora</button>
                                    <button class='btn btn-primary' type='submit'>Adicionar ao carrinho</button>
                                </div>
                            
                            </div>

                        </div>";
                            
                        }

                }
            echo "</div>";
        echo "</div>";
        */
    ?>



    <?php
        /*
        echo "<div class='container'>";
            echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-4 gy-5 gx-5 py-4'>";
                if(is_array($query_produtos)){
                    foreach ($query_produtos as $produto) {
                        echo" 
                            <div class='col card py-2'>
                                <div class='titulo_produto py-1'>
                                    <h2 class='fs-4'>{$produto->nome}</h2>
                                </div>

                                <div class='imagem_produto py-2 d-flex justify-content-center align-items-center'>
                                    <img class='img_produto' src='../produtos/{$produto->imagem}' alt='' srcset=''>
                                </div>
                    
                                <div class='informacoes_produto'>
                                    <div class='descricao mb-1'>{$produto->descricao}</div>
                                    <div class='categoria mb-1'>{$produto->descritivo}</div>
                                    <div class='preco mb-1'>{$produto->preco}</div>
                                </div>
                                <div class='row gy-2 py-2'>
                                    <button class='btn btn-primary' type='submit'>Adicionar ao carrinho</button>
                                    <button class='btn btn-success' type='submit'>Comprar agora</button>
                            </div>";
                        }
                }
            echo "</div>";
        echo "</div>";
        */
    ?>

    <!--
    <div class="container">
        <div class="row">
            <div class="col-4">Colum 4</div>
            <div class="col-4">Colum 4</div>
            <div class="col-4">Colum 4</div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-3">
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            <div class="col">Colum 1</div>
            <div class="col">Colum 2</div>
            <div class="col">Colum 3</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 5</div>
            <div class="col">Colum 6</div>
            <div class="col">Colum 7</div>
            <div class="col">Colum 8</div>
        </div>
    </div>
    -->
</body> 
</html>