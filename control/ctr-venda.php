<?php
    require_once '../model/venda.php';
    $objVenda = new Venda();
    
    if(isset($_POST['cadastrarVenda'])){
        $cliente = $_POST['filme'];
        $funcionario = $_POST['sala'];
        $sessao = $_POST['ingresso'];
        $data = $_POST['data'];        
        $qtdIngressoInt = $_POST['horarioInicio'];
        $qtdIngressoMeia = $_POST['horarioInicio'];

        if($objVenda->cadastrarVenda($cliente, $funcionario, $sessao, $data, $qtdIngressoInt, $qtdIngressoMeia)){
            $objVenda->redirect('../vender.php');
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