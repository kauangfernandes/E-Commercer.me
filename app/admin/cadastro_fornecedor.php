<?php
    require_once "../components/session.php";
    if($_SESSION["id_tipo_usuario"] != 1){
        header("Location:../view/login.php");
        die();
    }

    require_once "../models/conexao.class.php";
    require_once "../models/telefone.class.php";
    require_once "../models/fornecedor.class.php";

    $msg_erro = array("","");

    if($_POST){
        $erro = false;


        if(empty($_POST["cnpj"])){
            $erro = true;
            $msg_erro[0] = "Preencha o campo CNPJ";
        }

        if(!empty($_POST["cnpj"])){
            $db_query_fornecedor_cnpj = new Fornecedor(id_fornecedor:0, cnpj:$_POST["cnpj"], razao_social:"", status_fornecedor:"");
            $query_fornecedor_cnpj = $db_query_fornecedor_cnpj->query_verificar_cnpj();

            if(is_array($query_fornecedor_cnpj) AND count($query_fornecedor_cnpj) > 0){
                $erro = true;
                $msg_erro[0] = "CNPJ ja cadastrado, acesse o painel para ver os dados do fornecedor";
            }

        }

        if(empty($_POST["razao_social"])){
            $erro = true;
            $msg_erro[1] = "Preencha o campo Razao Social";
        }

        if(!$erro){
            $msg_erro[0] = "";
            $msg_erro[1] = "";
            
            $db_query_fornecedor_cnpj = new Fornecedor(id_fornecedor:0, cnpj:$_POST["cnpj"], razao_social:$_POST["razao_social"], status_fornecedor:"1");
            $db_query_fornecedor_cnpj->query_inserir_fornecedor();
            header("Location:../admin/fornecedores.php");
            die();

        }
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


    <div class="container vh-100">
        <div class="row h-100 py-4 justify-content-center">
            <form action="#" method="post" class="w-100 w-md-50 card d-flex flex-column justify-content-center align-items-center">

                <div class="row col-sm-12 col-md-8">
                    <label for="cnpj" class="col-sm-12 col-form-label">CNPJ: XX.XXX.XXX/XXXX-XX</label>
                    <div class="col-sm-12">
                        <input type="text" name="cnpj" class="form-control" id="cnpj" value="<?php echo isset($_POST['cnpj'])?$_POST['cnpj']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[0]."</p>";?>
                    </div>

                    <label for="razao_social" class="col-sm-12 col-form-label">RAZAO SOCIAL:</label>
                    <div class="col-sm-12">
                        <input type="text" name="razao_social" class="form-control" id="razao_social" value="<?php echo isset($_POST['razao_social'])?$_POST['razao_social']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[1]."</p>";?>
                    </div>



                </div>

                <button type="submit" class="btn btn-primary col-md-2">Cadastrar fornecedor</button>
            </form>
        </div>
    </div>
</body> 
</html>