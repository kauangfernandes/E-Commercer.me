<?php
    require_once "../models/conexao.class.php";
    require_once "../models/categoria.class.php";
    require_once "../models/produto.class.php";
    require_once "../models/fornecedor.class.php";
    require_once "../models/status_produto.class.php";
    require_once "../components/session.php";

    if(!isset($_SESSION) OR $_SESSION["id_tipo_usuario"] == 2){
      header("Location:../view/login.php");
      die();
    }

    if(isset($_POST['id_categoria_produto'])){
      $db_query_categoria = new Categoria($_POST["id_categoria_produto"]);
      $categoria = $db_query_categoria->query_listar_uma_categoria();
    }

    if(isset($_POST['id_status_produto'])){
      $db_query_status_produto = new StatusProduto($_POST['id_status_produto']);
      $status_produto = $db_query_status_produto->query_listar_um_status_produto();
    }

    $msg_erro = array("","","","","","","","");

    if($_POST){
      $erro = false;

      if(empty($_POST["nome_produto"])){
        $erro = true;
        $msg_erro[0] = "<p class='text-danger'>Preencha o nome</p>";
      }

      if(empty($_POST["id_categoria_produto"]) OR $_POST["id_categoria_produto"] == 0){
        $erro = true;
        $msg_erro[1] = "<p class='text-danger'>Selecione uma categoria para o produto</p>";
      }

      if(empty($_POST["id_status_produto"]) OR $_POST["id_status_produto"] == 0){
        $erro = true;
        $msg_erro[2] = "<p class='text-danger'>Selecione um status para o produto.</p>";
      }

      if($_FILES["imagem_produto"]["name"] == ""){
        $erro = true;
        $msg_erro[3] = "<p class='text-danger'>Selecione uma imagem para o produto.</p>";
      }

      if(empty($_POST["descricao_produto"])){
        $erro = true;
        $msg_erro[4] = "<p class='text-danger'>Escolha uma imagem para o produto.</p>";
      }

      if(empty($_POST["preco_produto"])){
        $erro = true;
        $msg_erro[5] = "<p class='text-danger'>Digite um valor para o produto.</p>";
      }

      if(empty($_POST["estoque_produto"])){
        $erro = true;
        $msg_erro[6] = "<p class='text-danger'>Digite um estoque para o produto</p>";
      }

      if(!isset($_POST["fornecedor"])){
        $erro = true;
        $msg_erro[7] = "<p class='text-danger'>Escolha pelo menos um fornecedor</p>";
      }

      if(!$erro){
        $categoria_novo_produto = new Categoria($_POST['id_categoria_produto']);
        $status_novo_produto = new StatusProduto($_POST['id_status_produto']);

        $produto = new Produto(nome:$_POST['nome_produto'], descricao:$_POST['descricao_produto'], preco:$_POST['preco_produto'], estoque:$_POST['estoque_produto'], imagem:$_FILES["imagem_produto"]["name"], status:$status_novo_produto, categoria:$categoria_novo_produto);
        
        foreach($_POST["fornecedor"] as $fornecedores){
          $fornecedor = new Fornecedor($fornecedores);
          $produto->setFornecedor($fornecedor);
        }
        
        $produto->query_inserir_produto();
        header("Location:produtos.php");
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
    <title>Cadastro Produto - E Commercer</title> <!--TITULOO DA PAGINA-->
    <meta name="descripition" content=""><!--Descrição do site/página-->
    <meta name="author" content=""><!--Criador da Página-->

    <!--Configurações Bootstrap e Font Awesome-->
    <?php require_once "../components/bs5_fw.php"; ?>

    <!--Configurações JS-->
    <script src="./js/index.js" defer></script>
    <!--<script type="module" src="./js/module.js"></script>-->

    <!--Configurações CSS-->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body id="web-site" class="" onresize="screenSize()" onload="screenSize()">
    
    <?php require_once "../components/header.php";?>

    <div class="container">
        <div class="row">
            <form class="card  py-5" action="" method="post" enctype="multipart/form-data">

                <div class="input-group mb-3">
                  <div class="row">
                    <img src="" id="img">
                  </div>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Nome:</span>
                  <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" name="nome_produto" value="<?php echo isset($_POST['nome_produto'])?$_POST['nome_produto']:''?>">
                </div>

                <div>
                  <?php
                    echo $msg_erro[0];
                  ?>
                </div>

                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01" value="">Categoria:</label>
                    <select class="form-select" id="inputGroupSelect01" name="id_categoria_produto">

                      <?php
                          $db_query_categorias = new Categoria();
                          $query_categorias = $db_query_categorias->query_listar_categorias_ativas();

                          if(isset($_POST["id_categoria_produto"]) && $_POST["id_categoria_produto"] != 0){
                              echo "<option selected value='$categoria->id_categoria'>$categoria->descritivo</option>";
                          }else{
                            echo "<option selected value='0'>Selecione uma categoria</option>";
                          }

                          if(is_array($query_categorias)){
                              foreach ($query_categorias as $categoria) {
                                echo "<option value='{$categoria->id_categoria}'>{$categoria->descritivo}</option>";
                              }
                          }
                      ?>

                    </select>
                </div>

                <div>
                  <?php
                    echo $msg_erro[1];
                  ?>
                </div>

                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Status do produto:</label>
                    <select class="form-select" id="inputGroupSelect01" name="id_status_produto">
                      
                        <?php

                          if(isset($_POST['id_status_produto']) && $_POST['id_status_produto'] != 0){
                            echo "<option selected value='$status_produto->id_status_produto'>$status_produto->status_produto</option>";
                          }else{
                            echo "<option selected value='0'>Selecione uma status</option>";
                          }

                          $db_query_status_produtos = new StatusProduto();
                          $query_status = $db_query_status_produtos->query_listar_todos_status_produto();

                          if(is_array($query_status)){
                              foreach ($query_status as $status) {
                                echo "<option value='{$status->id_status_produto}'>{$status->status_produto}</option>";
                              }
                          }
                        ?>
                    </select>
                </div>

                <div>
                  <?php
                    echo $msg_erro[2];
                  ?>
                </div>

                <div class="mb-3">
                  <label for="formFileSm" class="form-label">Escolha uma imagem do produto:</label>
                  <!--
                  <input class="form-control form-control-sm" id="formFileSm" type="file" accept=".jpg , .png" onchange="mostrar(this)" name="imagem_produto" value="<?php echo isset($_FILES["imagem_produto"]["name"])?$_FILES["imagem_produto"]["name"]:''?>">
                  -->
                  <input class="form-control form-control-sm" id="formFileSm" type="file" accept=".jpg , .png, .jfif" onchange="mostrar(this)" name="imagem_produto" value="">
                
                </div>

                <div>
                  <?php
                    echo $msg_erro[3];
                  ?>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text">Decrição do produto</span>
                  <textarea class="form-control" aria-label="Decrição do produto" name="descricao_produto" value=""></textarea>
                </div>

                <div>
                  <?php
                    echo $msg_erro[4];
                  ?>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text">R$</span>
                  <span class="input-group-text">00,00</span>
                  <input type="number" class="form-control" aria-label="" name="preco_produto" step="0.01" min="0" max="9999" value="<?php echo isset($_POST['preco_produto'])?$_POST['preco_produto']:''?>">
                </div>

                <div>
                  <?php
                    echo $msg_erro[5];
                  ?>
                </div>

                <div class="input-group mb-3">
                  <label class="input-group-text">Estoque:</label>
                  <input type="number" class="form-control" aria-label="" min="1" max="" name="estoque_produto" value="<?php echo isset($_POST['estoque_produto'])?$_POST['estoque_produto']:''?>">
                </div>

                <div>
                  <?php
                    echo $msg_erro[6];
                  ?>
                </div>

                <?php
                  $db_query_fornecedores = new Fornecedor();
                  $query_fornecedores = $db_query_fornecedores->query_listar_todos_fornecedores_ativos();

                  if(is_array($query_fornecedores) AND count($query_fornecedores) > 0){
                    foreach ($query_fornecedores as $fornecedor) {
                      echo  "<div class='form-check'>
                              <input class='form-check-input' name='fornecedor[]' type='checkbox' value='{$fornecedor->id_fornecedor}' id='{$fornecedor->id_fornecedor}'>
                              <label class='form-check-label' for='{$fornecedor->id_fornecedor}'>
                                {$fornecedor->razao_social}
                              </label>
                            </div>";
                    }
                  }
                ?>

                <div>
                  <?php
                    echo $msg_erro[7];
                  ?>
                </div>
                
  
                <div class="col-12">
                  <div class="row justify-content-center">
                    <button class="btn btn-primary col-12 col-md-6" type="submit">Cadastrar Produto</button>
                  </div>
                </div>

            </form>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

            <script>
              function mostrar(img){
                if(img.files  && img.files[0]){
                  var reader = new FileReader();
                  reader.onload = function(e){
                    $('#img')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
                  };
                  reader.readAsDataURL(img.files[0]);
                }
              }
            </script>

        </div>
    </div>

    <!--
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