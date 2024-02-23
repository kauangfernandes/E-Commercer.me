<?php
    require_once "../components/session.php";
    require_once "../models/conexao.class.php";
    require_once "../models/usuario.class.php";

    $msg_erro = array("","", "", "");

    if($_POST){

        $erro = false;
        if(empty($_POST["nome"])){
            $erro = true;
            $msg_erro[0] = "Preencha o campo nome";
        }

        if(empty($_POST["email"])){
            $erro = true;
            $msg_erro[1] = "Preencha o campo o email";
        }

        if(empty($_POST["confirme_email"])){
            $erro = true;
            $msg_erro[2] = "Preenchar a confirmacao de email";
        }

        if(empty($_POST["senha"])){
            $erro = true;
            $msg_erro[3] = "Preencha o campo senha";
        }

        if(!empty($_POST["email"]) && !empty($_POST["confirme_email"])){
            if($_POST["email"] != $_POST["confirme_email"]){
                $erro = true;
                $msg_erro[2] = "E-mails nao coferem";
            }
        }

        $db_query_verificacao_email = new Usuario (email:$_POST["email"]);
        $query_verificacao_email = $db_query_verificacao_email->verificar_email();
        
        if(is_array($query_verificacao_email) && count($query_verificacao_email) != 0){
            $erro = true;
            $msg_erro[1] = "E-mail ja cadastrador ";
        }

        if(!$erro){
            $usuario = new Usuario (id_usuario:0, nome:$_POST["nome"], email:$_POST["email"], senha:password_hash($_POST["senha"], PASSWORD_DEFAULT), id_tipo_usuario:2, id_status_usuario:1);
            $usuario->criar_conta();
            header("Location:login.php");
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
                    <label for="nome" class="col-sm-12 col-form-label">Nome:</label>
                    <div class="col-sm-12">
                        <input type="text" name="nome" class="form-control" id="nome" value="<?php echo isset($_POST['nome'])?$_POST['nome']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[0]."</p>";?>
                    </div>

                </div>

                <div class="row col-sm-12 col-md-8">
                    <label for="email" class="col-sm-12 col-form-label">Email:</label>
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[1]."</p>";?>
                    </div>

                    <label for="confirme_email" class="col-sm-12 col-form-label">Confirme Email:</label>
                    <div class="col-sm-12">
                        <input type="email" name="confirme_email" class="form-control" id="confirme_email" value="
                            <?php echo isset($_POST['confirme_email'])?$_POST['confirme_email']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[2]."</p>";?>
                    </div>
                </div>

                <div class="row col-sm-12 col-md-8">
                    <label for="senha" class="col-sm-12 col-form-label">Senha:</label>
                    <div class="col-sm-12">
                        <input type="password" name="senha" class="form-control" id="senha" value="<?php echo isset($_POST['senha'])?$_POST['senha']:''?>">
                    </div>
                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[3]."</p>";?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary col-md-2">Criar conta</button>
            </form>
        </div>
    </div>
</body> 
</html>