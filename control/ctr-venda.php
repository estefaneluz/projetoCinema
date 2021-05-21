<?php
    require_once '../model/venda.php';
    $objVenda = new Venda();
    
    if(isset($_POST['idSessao'])){
        $cliente = $_POST['cpfCliente']; 
        $sessao = $_POST['idSessao']; 
        $data = $_POST['dataAtual'];        
        $qtdInt = $_POST['qtdInteiro']; 
        $qtdMeia = $_POST['qtdMeia']; 

        if($objVenda->cadastrarVenda($cliente, $sessao, $data, $qtdInt, $qtdMeia)){
            $objVenda->redirect('../sessao.html');
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