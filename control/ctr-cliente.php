<?php
    //Pega as informações e envia para a camada modelo
    require_once '../model/cliente.php';
    $objCliente = new Cliente();

     /*CADASTRAR CLIENTE*/   
     if(isset($_POST['cadastrarCliente'])){//seta
        $nome = $_POST['nomeCliente'];
        $cpf = $_POST['cpfCliente'];
        $idade = $_POST['idadeCliente'];        
        $dataNascimento = $_POST['dataNascimento'];
        if($objCliente->cadastrarCliente($nome,$cpf,$idade,$dataNascimento)){
            $objCliente->redirect('../acesso-adm.php');
        }
    }
    /*EDITAR CLIENTE*/
    if(isset($_POST['editarCliente'])){
        $id =$_POST['editarCliente'];
        $nome = $_POST['nomeCliente'];
        $cpf = $_POST['cpfCliente'];
        $idade = $_POST['idadeCliente'];
        $dataNascimento = $_POST['dataNascimento'];
        if ($objCliente->editarCliente($nome,$cpf,$idade,$dataNascimento,$id)){
            $objCliente->redirect('../acesso-adm.php');
        }
    }
    /*DELETAR CLIENTE*/
    if(isset($_POST['deletarCliente'])){
        $idCliente = $_POST['deletarCliente'];
        if($objCliente->deletarCliente($idCliente)){
            $objCliente->redirect('../acesso-adm.php');
        }
    }


?>