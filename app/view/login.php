<?php
    require_once "../components/session.php";

    if($_SESSION["id_usuario"] != 0){
        header("Location:index.php");
        die();
    }

    $msg_erro = array ("", "");
    if($_POST){

        $erro = false;
        if(empty($_POST["email"])){
            $erro = true;
            $msg_erro[0] = "Preencha o campo email";
        }

        if(empty($_POST["senha"])){
            $erro = true;
            $msg_erro[1] = "Preencha o campo senha";
        }

        if(!$erro){
            require_once "../models/conexao.class.php";
            require_once "../models/usuario.class.php";

            $usuarios = new Usuario(email:$_POST["email"]);
            $usuario = $usuarios->login();

            if($usuario == null){
                $msg_erro[0] = "Usuario não cadastrado<br><a href=''>Criar conta</a>";
                $msg_erro[1] = "<div><a href=''>Não lembra a senha? Recuperar senha.</a><div>";
            }

            if($usuario != null AND ($_POST["email"] == $usuario->email)){

                if(password_verify($_POST["senha"], $usuario->senha)){
                    $msg_erro[0] = "";
                    $msg_erro[1] = "";

                    $_SESSION["id_usuario"] = $usuario->id_usuario;
                    $_SESSION["nome"] = $usuario->nome;
                    $_SESSION["email"] = $usuario->email;
                    $_SESSION["id_tipo_usuario"] = $usuario->id_tipo_usuario;

                    if($_SESSION["id_tipo_usuario"] != 0){
                        header("location:index.php");
                        die();
                    }
                
                }else{
                    $msg_erro[0] = "E-mail e/ou senha não comferem";
                }
            }

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

    <!--Configurações CSS-->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

    <!--Configurações JS-->
    <script src="./js/index.js" defer></script>

    <?php require_once "../components/bs5_fw.php"; ?>

    
</head>
<body id="web-site" class="" onresize="screenSize()" onload="screenSize(), modalAlert()">

    <?php
        require_once "../components/header.php";
    ?>

    <div class="container vh-100">
        <div class="row h-100 py-4 justify-content-center">
            <form action="#" method="post" class="w-100 w-md-50 card d-flex flex-column justify-content-center align-items-center">

                <div class="row col-sm-12 col-md-8">
                    <label for="email" class="col-sm-12 col-form-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[0]."</p>";?>
                    </div>

                </div>

                <div class="row col-sm-12 col-md-8">
                    <label for="senha" class="col-sm-12 col-form-label">Senha:</label>
                    <div class="col-sm-12">
                        <input type="password" name="senha" class="form-control" id="senha" value="<?php echo isset($_POST['senha'])?$_POST['senha']:''?>">
                    </div>

                    <div>
                        <?php echo "<p class='text-danger'>".$msg_erro[1]."</p>";?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary col-md-2 mb-2 btn-lg">Fazer Login</button>
                <a class="btn btn-primary col-md-2 mb-2 btn-lg fs-6" src="criar_conta.php">Criar Conta</a>
                
            </form>
        </div>
    </div>
</body> 
</html>