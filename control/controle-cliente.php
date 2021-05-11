<?php
    //Pega as informações e envia para a camada modelo
    require_once '../model/model-cliente.php';
    $objCliente = new Cliente();

     /*CADASTRAR CLIENTE*/   
     if(isset($_POST['cadastrarCliente'])){//seta
        $nome = $_POST['nomeCliente'];
        $cpf = $_POST['cpfCliente'];
        $idade = $_POST['idadeCliente'];
        $sexo = $_POST['sexoCliente'];
        $dataNascimento = $_POST['dataNascimento'];
        if($objCliente->cadastrarCliente($nome,$cpf,$idade,$sexo, $dataNascimento)){
            $objCliente->redirect('../acesso-adm.php');
        }
    }


?>