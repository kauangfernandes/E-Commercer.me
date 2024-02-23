<?php
    if($_GET){
        require_once "../models/conexao.class.php";
        require_once "../models/produto.class.php";
        require_once "../components/session.php";

        if(!is_null($_GET["id_produto"] AND $_GET["id_produto"]) != 0 AND $_SESSION["id_tipo_usuario"] == 1){
            $pruduto = new Produto(id_produto:$_GET["id_produto"]);
            try {
                $pruduto->query_excluir_produto();
            } catch (PDOException $erro) {
                echo "Erro na conexãor: {$erro->getCode()}<br>Mensagem: {$erro->getMessage()}";
                header("Location:categorias.php");
            }
        }

        if(is_null($_GET["id_produto"] OR $_GET["id_produto"]) == 0){
            header("Location:produtos.php");
        }

    }else{
       header("Location:produtos.php");
    }
?>