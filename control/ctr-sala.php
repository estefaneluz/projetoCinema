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
    /*EDITAR CLIENTE*/
    // if(isset($_POST['editarSala'])){
    //     $id =$_POST['editarSala'];
    //     $nome = $_POST['nomeSala'];
    //     $cpf = $_POST['cpfSala'];
    //     $idade = $_POST['idadeSala'];
    //     $dataNascimento = $_POST['dataNascimento'];
    //     if ($objSala->editarSala($nome,$cpf,$idade,$dataNascimento,$id)){
    //         $objSala->redirect('../acesso-adm.php#cadastro-salas');
    //     }
    // }
    // /*DELETAR CLIENTE*/
    // if(isset($_POST['deletarSala'])){
    //     $idSala = $_POST['deletarSala'];
    //     if($objSala->deletarSala($idSala)){
    //         $objSala->redirect('../acesso-adm.php#cadastro-salas');
    //     }
    // }


?>