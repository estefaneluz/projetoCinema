<?php
    require_once '../model/sala.php';
    $objSala = new Sala();

     /*CADASTRAR SALA*/   
     if(isset($_POST['cadastrarSala'])){//seta
        $nome = $_POST['nomeSala'];
        $qtdAssentos = $_POST['qtdAssentos'];
        if($objSala->cadastrarSala($nome,$qtdAssentos)){
            $objSala->redirect('../acesso-adm.php');
        }
    }

    if(isset($_POST['editarSala'])){
        $id =$_POST['editarSala'];
        $nome = $_POST['txtNome'];
        $qtdAssentos = $_POST['txtQtdAssentos'];
        if ($objSala->editarSala($nome,$qtdAssentos,$id)){
            $objSala->redirect('../acesso-adm.php#cadastro-salas');
        }
    }

    if(isset($_POST['deletarSala'])){
        $idSala = $_POST['deletarSala'];
        if($objSala->deletarSala($idSala)){
            $objSala->redirect('../acesso-adm.php#cadastro-salas');
        }
    }

?>