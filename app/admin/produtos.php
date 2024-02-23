<?php 
    require_once "../components/session.php";
    
    if($_SESSION["id_tipo_usuario"] != 1){
        header("Location:../view/login.php");
        die();
    }

    require_once "../models/conexao.class.php";
    require_once "../models/produto.class.php";
    require_once "../models/fornecedor.class.php";


    $db_query_produtos = new Produto();
    $query_produtos = $db_query_produtos->query_listar_todos_produtos();

    $db_query_fornecedores_produtos = new Fornecedor();
    $query_fornecedores_produtos = $db_query_fornecedores_produtos->query_listar_todos_fornecedores_produtos();
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

    <!--Icones Free - Font Awesome-->
    <script src="https://kit.fontawesome.com/86237f5308.js" crossorigin="anonymous"></script>
    

    <!--Configurações JS-->
    <script src="../view/js/index.js" defer></script>
    <!--<script type="module" src="./js/module.js"></script>-->

    <!--Configurações CSS-->
    <link rel="stylesheet" type="text/css" href="../view/css/style.css">

    <style>
        .img_produto{
            width: 100px !important;
        }
    </style>

    <!--Configurações Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>

</head>
<body id="web-site" class="" onresize="screenSize()" onload="screenSize()">
    <?php require_once "../components/header.php"; ?>

    <div class="container vh-100">
        <div class="row py-4">
            <table class="table table-striped table-bordered">
                <thead class="">
                    <tr class="">
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">#</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">#</th>
                        <th scope="col">StatusProduto</th>
                        <th scope="col">Fornecedor(es)</th>
                        <th scope="col" class="d-flex justify-content-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        if(is_array($query_produtos)){
                            foreach ($query_produtos as $produto) {
                                echo "<tr>";
                                    echo "
                                        <td>{$produto->id_produto}</td>
                                        <td>{$produto->nome}</td>
                                        <td>{$produto->id_categoria}</td>
                                        <td>{$produto->descritivo}</td>
                                        <td>{$produto->descricao}</td>
                                        <td>{$produto->preco}</td>
                                        <td>{$produto->estoque}</td>
                                        <td>
                                            <img class='img_produto' src='../produtos/{$produto->imagem}'>
                                        </td>
                                        <td>{$produto->id_status_produto}</td>
                                        <td>{$produto->status_produto}</td>
                                        
                                        <td class='p-0'>";

                                        if(is_array($query_fornecedores_produtos)){
                                            echo "<ol class='list-group p-0 bg-none'>";
                                            foreach ($query_fornecedores_produtos as $fornecedores_produtos) {
                                                if($produto->id_produto == $fornecedores_produtos->id_produto){
                                                    echo "<li class='list-group-item'>".$fornecedores_produtos->razao_social."</li>";
                                                }
                                                
                                            }
                                            echo "</ol>";
                                        }


                                    echo
                                        "</td>

                                        <td class='d-flex h-100 flex-column justify-content-around'>
                                            <a class='btn bg-warning p-1 mb-1' href='alterar_produto.php?id_produto={$produto->id_produto}'>Alterar</a>
                                            <a class='btn btn-danger p-1 mb-1' href='excluir_produto.php?id_produto={$produto->id_produto}'>Excluir</a>
                                        </td>
                                    ";
                                    echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <a href="cadastro_produto.php" class="btn btn-primary w-25">Criar Nova Produto</a>
        </div>
    </div>

    <!--
    <div class="container">
        <div class="row">
            <div class="col-4">Colum 1</div>
            <div class="col-4">Colum 2</div>
            <div class="col-4">Colum 3</div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-3">
            <div class="col">Colum 1</div>
            <div class="col">Colum 2</div>
            <div class="col">Colum 3</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 4</div>
            <div class="col">Colum 5</div>
            <div class="col">Colum 6</div>
            <div class="col">Colum 7</div>
            <div class="col">Colum 8</div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-4">
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

    

    <footer class="bg-dark py-4">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="fs-6 text-light">E-Commercer</h4>
                </div>

                <div class="col-md-2">
                    <h4 class="fs-6 text-light">Título</h4>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 1</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 2</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 3</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 4</a></li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h4 class="fs-6 text-light">Título</h4>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 1</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 2</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 3</a></li>
                        <li class="nav-item"><a class="nav-link link-light" href="">Link 4</a></li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h4 class="fs-6 text-light">Título</h4>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="">Link 1</a></li>
                        <li class="nav-item"><a class="nav-link link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="">Link 2</a></li>
                        <li class="nav-item"><a class="nav-link link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="">Link 3</a></li>
                        <li class="nav-item"><a class="nav-link link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="">Link 4</a></li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h4 class="d-flex  fs-6 justify-content-center text-light">Redes Sociais</h4>
                    <ul class="navbar-nav flex-row justify-content-center">
                        <li class="nav-item px-1"><a class="nav-link link-light" href=""><i class="fa-brands fa-instagram fs-5"></i></a></li>
                        <li class="nav-item px-1"><a class="nav-link link-light" href=""><i class="fa-brands fa-linkedin-in fs-5"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    -->

</body> 
</html>