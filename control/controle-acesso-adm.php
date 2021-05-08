<?php
    //Pega as informações e envia para a camada modelo
    require_once '../model/acesso-funcionario.php';
    $funcionario = new Funcionario();
    if(isset($_POST['email'])){ //isset verifica se no html tem algum tag com o atributo: email
        $email = $_POST['email']; //Para pegar valor do input e usar no php: $_GET/POST['ATRIBUTO']
        $senha = $_POST['password'];
        //echo $login;exit;
        if($funcionario->validacao($email,$senha)){//Verificar se o valor da função é vdd
            $funcionario->redirect('../acesso-adm.php'); //Se sim permite acesso a page acesso admnistrativo
        }else{
            $funcionario->redirect('../index.html');//Senão retorna pra page inicial
        }
    
    
    }if(isset($_POST['cadastrarFuncionario'])){//seta
        $nome = $_POST['nomeFuncionario'];
        $cpf = $_POST['cpfFuncionario'];
        $email = $_POST['emailFuncionario'];
        $senha = $_POST['senhaFuncionario'];
        if($funcionario->cadastrarFuncionario($nome, $cpf, $email,$senha)){
            $funcionario->redirect('../acesso-adm.php');
        }
    }

?>