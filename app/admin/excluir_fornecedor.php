<?php
    require_once "../components/session.php";
    if($_SESSION["id_tipo_usuario"] != 1){
        header("Location:../view/login.php");
        die();
    }

    if(!$_GET){
        header("Location:../admin/fornecedores.php");
        die();
    }

    if($_GET){
        require_once "../models/conexao.class.php";
        require_once "../models/telefone.class.php";
        require_once "../models/fornecedor.class.php";
    
        echo "<pre>";
            print_r($_GET);
        echo "</pre>";

        $db_query_fornecedores = new Fornecedor(id_fornecedor:$_GET["id_fornecedor"]);
        $query_fornecedores = $db_query_fornecedores->query_excluir_fornecedor();

        header("Location:../admin/fornecedores.php");
        die();

    }else{
        header("Location:../admin/fornecedores.php");
        die();
    }
?>