<?php
    require_once '../model/venda.php';
    require './model/conexao.php';
    $objVenda = new Venda();
    
    if(isset($_POST['idSessao'])){
        $cliente = $_POST['cpfCliente']; 
        $funcionario = $_SESSION['idFuncionario']; 
        $sessao = $_POST['idSessao']; 
        $data = $_POST['dataAtual'];        
        $qtdIngrInt = $_POST['qtdInteiro']; 
        $qtdIngrMeia = $_POST['qtdMeia']; 

        if($objVenda->cadastrarVenda($cliente, $funcionario, $sessao, $data, $qtdIngrInt, $qtdIngrMeia)){
            $objVenda->redirect('../sessao.php');
        }
    }

    // if(isset($_POST['editarSessao'])){
    //     $id = $_POST['editarSessao'];
    //     $filme = $_POST['filme'];
    //     $sala = $_POST['sala'];
    //     $data = $_POST['data'];        
    //     $horario = $_POST['horario'];
    //     if($objSessao->editarSessao($filme,$sala, $data, $horario, $id)){
    //         $objSessao->redirect('../acesso-adm.php');
    //     }
    // }


    // if(isset($_POST['deletarSessao'])){
    //     $idSessao = $_POST['deletarSessao'];
    //     if($objSessao->deletarSessao($idSessao)){
    //         $objSessao->redirect('../acesso-adm.php');
    //     }
    // }
    

?>