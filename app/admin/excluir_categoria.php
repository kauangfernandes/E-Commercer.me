<?php
    if($_GET){
        require_once "../models/conexao.class.php";
        require_once "../models/categoria.class.php";

        if(!is_null($_GET["id_categoria"] OR $_GET["id_categoria"]) != 0){
            $categoria = new Categoria(id_categoria:$_GET["id_categoria"]);
            $categoria->excluir_categoria();
            header("Location:categorias.php");
        }

        if(is_null($_GET["id_categoria"] OR $_GET["id_categoria"]) == 0){
            header("Location:categorias.php");
        }

    }else{
        header("Location:categorias.php");
    }
?>