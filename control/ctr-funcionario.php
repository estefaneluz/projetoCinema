<?php

    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();
    if(isset($_POST['email'])){ 
        $email = $_POST['email']; 
        $senha = $_POST['password'];

        if($objFuncionario->validacao($email,$senha)){
            if(isset($_SESSION['idFuncionario'])==true){
                //header("Location: ../acesso-adm.php");
                $objFuncionario->redirect('../acesso-adm.php'); 
            } else {
                // header("Location: ../index.html");
                $objFuncionario->redirect('../index.html');
            }
        }else{
            // header("Location: ../index.html");
            $objFuncionario->redirect('../index.html');
        }
    }
    
    /*CADASTRAR FUNCIONARIO*/   
    if(isset($_POST['cadastrarFuncionario'])){//seta
        $nome = $_POST['nomeFuncionario'];
        $cpf = $_POST['cpfFuncionario'];
        $email = $_POST['emailFuncionario'];
        $senha = $_POST['senhaFuncionario'];
        if($objFuncionario->cadastrarFuncionario($nome, $cpf, $email,$senha)){
            $objFuncionario->redirect('../acesso-adm.php');
        }
    }
    /*EDITAR FUNCIONARIO*/ 
    if(isset($_POST['editar'])){
        $id = $_POST['editar'];
        $nome = $_POST['txtNome'];
        $cpf = $_POST['txtCpf'];
        $email = $_POST['txtEmail'];
        $senha = $_POST['txtSenha'];

        if($objFuncionario->editarFuncionario($nome,$cpf,$email,$senha,$id)){
            $objFuncionario->redirect('../acesso-adm.php');
        }
    } 

    /*DELETAR FUNCIONÁRIO*/ 
    if(isset($_POST['deletarFuncionario'])){
        $id = $_POST['deletarFuncionario'];
        if($objFuncionario->deletarFuncionario($id)){
            $objFuncionario->redirect('../acesso-adm.php');
        }
    }
?>