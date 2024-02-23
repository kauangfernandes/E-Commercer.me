<?php
    require_once "../models/conexao.class.php";
    require_once "../models/fornecedor.class.php";

    require_once "../components/session.php";
    if($_SESSION["id_tipo_usuario"] != 1){
        header("Location:../view/login.php");
        die();
    }

    $db_query_fornecedores = new Fornecedor();
    $query_fornecedores = $db_query_fornecedores->query_listar_todos_fornecedores();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Configurações Página-->
    <link rel="icon" type="image/x-icon" href="./midia/img/"> <!--FLIVE ICONE-->
    <title>Cadastro Categoria - E Commercer</title> <!--TITULOO DA PAGINA-->
    <meta name="descripition" content=""><!--Descrição do site/página-->
    <meta name="author" content=""><!--Criador da Página-->

    <!--Icones Free - Font Awesome    -->
    <script src="https://kit.fontawesome.com/86237f5308.js" crossorigin="anonymous"></script>


    <!--Configurações JS-->
    <script src="./js/index.js" defer></script>
    <!--<script type="module" src="./js/module.js"></script>-->

    <!--Configurações CSS-->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

    <!--Configurações Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>

</head>
<body id="web-site" class="" onresize="screenSize()" onload="screenSize()">
    <?php
        require_once "../components/header.php";
    ?>
    <div class="container vh-100">
        <div class="row py-4">
            <table class="table table-striped table-bordered">
                <thead class="">
                    <tr class="">
                        <th scope="col">#</th>
                        <th scope="col">Descritivo</th>
                        <th scope="col">Razao Social</th>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="d-flex justify-content-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        if(is_array($query_fornecedores)){
                            foreach ($query_fornecedores as $fornecedor) {
                                echo "<tr>";
                                    echo "
                                        <td>{$fornecedor->id_fornecedor}</td>
                                        <td>{$fornecedor->cnpj}</td>
                                        <td>{$fornecedor->razao_social}</td>
                                        <td>{$fornecedor->id_status_usuario}</td>
                                        <td>{$fornecedor->status_usuario}</td>
                                        <td class='d-flex flex-row justify-content-around'>
                                            <a class='btn btn-primary p-1' href='alterar_fornecedor.php?id_fornecedor={$fornecedor->id_fornecedor}'>Alterar</a>
                                            <a class='btn btn-danger p-1' href='excluir_fornecedor.php?id_fornecedor={$fornecedor->id_fornecedor}'>Excluir</a>
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
            <a href="cadastro_fornecedor.php" class="btn btn-primary w-25">Criar Nova Fornecedor</a>
        </div>
    </div>
</body> 
</html>