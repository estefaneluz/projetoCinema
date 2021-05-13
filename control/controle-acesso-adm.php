<?php
    //Pega as informações e envia para a camada modelo
    require_once '../model/acesso-funcionario.php';
    $objFuncionario = new Funcionario();
    if(isset($_POST['email'])){ //isset verifica se no html tem algum tag com o atributo: email
        $email = $_POST['email']; //Para pegar valor do input e usar no php: $_GET/POST['ATRIBUTO']
        $senha = $_POST['password'];
        //echo $login;exit;
        if($objFuncionario->validacao($email,$senha)){//Verificar se o valor da função é vdd
            $objFuncionario->redirect('../acesso-adm.php'); //Se sim permite acesso a page acesso admnistrativo
        }else{
            $objFuncionario->redirect('../index.html');//Senão retorna pra page inicial
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