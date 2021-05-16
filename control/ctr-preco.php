<?php
    require_once '../model/preco.php';
    $objPreco = new Preco();

     /*CADASTRAR SALA*/   
     if(isset($_POST['cadastrarPrecos'])){//seta
        $nome = $_POST['nomePreco'];
        $valor = $_POST['valor'];
        $meia = $_POST['meia'];

        if($objPreco->cadastrarPreco($nome,$valor, $meia)){
            $objPreco->redirect('../acesso-adm.php#container-precos');
        }
    }

    if(isset($_POST['editarPreco'])){
        $id =$_POST['editarPreco'];
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $meia = $_POST['meia'];
        if ($objPreco->editarPreco($nome,$valor,$meia, $id)){
            $objPreco->redirect('../acesso-adm.php#container-precos');
        }
    }

    if(isset($_POST['deletarPreco'])){
        $idPreco = $_POST['deletarPreco'];
        if($objPreco->deletarPreco($idPreco)){
            $objPreco->redirect('../acesso-adm.php#container-precos');
        }
    }

?>