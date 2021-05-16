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

    // if(isset($_POST['editarSala'])){
    //     $id =$_POST['editarSala'];
    //     $nome = $_POST['txtNome'];
    //     $qtdAssentos = $_POST['txtQtdAssentos'];
    //     if ($objSala->editarSala($nome,$qtdAssentos,$id)){
    //         $objSala->redirect('../acesso-adm.php#cadastro-salas');
    //     }
    // }

    if(isset($_POST['deletarPreco'])){
        $idPreco = $_POST['deletarPreco'];
        if($objPreco->deletarPreco($idPreco)){
            $objPreco->redirect('../acesso-adm.php#container-precos');
        }
    }

?>