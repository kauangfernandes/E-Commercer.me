<?php
    require_once "../models/conexao.class.php";
    require_once "../models/status_categoria.class.php";
    require_once "../models/categoria.class.php";
    require_once "../components/session.php";
    
    $db_query_status_categoria = new StatusCategoria();
    $query_status_categoria = $db_query_status_categoria->query_listar_todos_status_categoria();

    $msg_erro = array("","");

    if(!isset($_SESSION)){
        $_SESSION["id_usuario"] = 0;
        $_SESSION["id_tipo_usuario"] = 0;
    }

    if($_SESSION["id_tipo_usuario"] == 1){
        
        if($_POST){
            if(empty($_POST["descritivo"])){
                
                $msg_erro[0] = "<p class='text-danger'>Preencha o descritivo da categoria.</p>";
        
                if(empty($_POST["id_status_categoria"]) OR $_POST["id_status_categoria"] == 0) {
                    $msg_erro[1] = "<p class='text-danger'>Selecione um status para a categoria.</p>";
                }
        
                }else if(empty($_POST["id_status_categoria"]) OR $_POST["id_status_categoria"] == 0) {

                    $msg_erro[1] = "<p class='text-danger'>Selecione um status para a categoria</p>";

                }else if(!empty($_POST["descritivo"]) AND (!empty($_POST["id_status_categoria"]) OR $_POST["id_status_categoria"] != 0)){

                    $msg_erro[0] = "";
                    $msg_erro[1] = "";

                    $status_categoria = new StatusCategoria(id_status_categoria:$_POST["id_status_categoria"]);

                    $categoria = new Categoria(0, $_POST["descritivo"], $status_categoria);

                    $categoria->inserir_categoria();
        
                    header("Location:categorias.php");
                }else{
                    header("Location:cadastro_categoria.php");
                }

        }

    }else{
        header("Location:../view/login.php");
    }    
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

    <!--Icones Free - Font Awesome
    <script src="https://kit.fontawesome.com/86237f5308.js" crossorigin="anonymous"></script>
    -->

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

    <div class="container container-fluid vh-100">
        <div class="row card h-100 justify-content-center align-items-center">
            <div class="d-flex justify-content-center w-50">
                <h1 class="h1 display-6">Cadastro Categoria</h1>
            </div>
            <div class="w-50">
                <form action="#" method="post" class="d-flex flex-column p-4">
                    <label for="descritivo">
                        <legend class="input-group-text">Descritivo:</legend>
                        <input type="text" name="descritivo" id="descritivo" class="form-control" min="5" max="80">
                    </label>
                    <div>
                        <?php
                            echo $msg_erro[0];
                        ?>
                    </div>

                    <label for="">
                        <legend class="input-group-text">Status Categoria:</legend>
                        <select class="form-select" aria-label="Default select example" name="id_status_categoria">
                            <option selected value="0">Selecione um status para categoria.</option>
                            <?php
                                if(is_array($query_status_categoria)){
                                    foreach ($query_status_categoria as $status) {
                                        echo "<option value='{$status->id_status_categoria}'>{$status->status_categoria}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </label>

                    <div>
                        <?php
                            echo $msg_erro[1];
                        ?>
                    </div>


                    <input type="submit" value="Cadastrar" class="btn btn-primary">
                </form>
            </div>
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