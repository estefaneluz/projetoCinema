<?php
    require_once '../model/preco.php';
    $objPreco = new Preco();

     /*CADASTRAR SALA*/   
     if(isset($_POST['cadastrarPrecos'])){//seta
        $nome = $_POST['nomePreco'];
        $valor = $_POST['valor'];

        if($objPreco->cadastrarPreco($nome,$valor)){
            $objPreco->redirect('../acesso-adm.php#container-precos');
        }
    }

    if(isset($_POST['editarPreco'])){
        $id =$_POST['editarPreco'];
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        if ($objPreco->editarPreco($nome,$valor, $id)){
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