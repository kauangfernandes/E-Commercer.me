<?php
    require_once "../models/conexao.class.php";
    require_once "../models/status_categoria.class.php";
    require_once "../models/categoria.class.php";

    $categoria = new Categoria();
    $tb_categoria = $categoria->query_listar_todas_categorias();

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
        require_once "../components/session.php";
        require_once "../components/header.php";
    ?>
    <div class="container vh-100">
        <div class="row py-4">
            <table class="table table-striped table-bordered">
                <thead class="">
                    <tr class="">
                        <th scope="col">#</th>
                        <th scope="col">Descritivo</th>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="d-flex justify-content-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        if(is_array($tb_categoria)){
                            foreach ($tb_categoria as $categoria) {
                                echo "<tr>";
                                    echo "
                                        <td>{$categoria->id_categoria}</td>
                                        <td>{$categoria->descritivo}</td>
                                        <td>{$categoria->id_status_categoria}</td>
                                        <td>{$categoria->status_categoria}</td>
                                        <td class='d-flex flex-row justify-content-around'>
                                            <a class='btn btn-primary p-1' href='alterar_categoria.php?id_categoria={$categoria->id_categoria}'>Alterar</a>
                                            <a class='btn btn-danger p-1' href='excluir_categoria.php?id_categoria={$categoria->id_categoria}'>Excluir</a>
                                    ";
                                        /*
                                        if($categoria->STATUS == "ativo" or $categoria->STATUS == "Ativo"){
                                            echo "<a class='btn btn-warning p-1' href='alterar_status_categoria.php?id_categoria={$categoria->id_categoria}&status=Inativo'>Inativar</a>";
                                        }else if($categoria->STATUS == "Inativo" or $categoria->STATUS == "Inativo"){
                                            echo "<a class='btn btn-secondary p-1' href='alterar_status_categoria.php?id_categoria={$categoria->id_categoria}&status=Ativo'>Ativar</a>  ";
                                        }else {
                                            echo "<p>Erro</p>";
                                        }*/
                                        

                                    echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <a href="cadastro_categoria.php" class="btn btn-primary w-25">Criar Nova Categoria</a>
        </div>
    </div>

    
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
</body> 
</html>