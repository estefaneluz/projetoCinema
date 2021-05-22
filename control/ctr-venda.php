<?php
    require_once '../model/venda.php';
    $objVenda = new Venda();
    
    if(isset($_GET['idSessao'])){
        $cliente = $_GET['cpfCliente']; 
        $sessao = $_GET['idSessao']; 
        $data = $_GET['dataAtual'];        
        $qtdInt = $_GET['qtdInteiro']; 
        $qtdMeia = $_GET['qtdMeia']; 

        if($objVenda->cadastrarVenda($cliente, $sessao, $data, $qtdInt, $qtdMeia)){
            $nomeCliente = $objVenda->getIdCliente($cliente);
            $objVenda->redirect("../sessao.php?sessao=$sessao&qtdInt=$qtdInt&qtdMeia=$qtdMeia&cliente=$nomeCliente");
        } else {
            $objVenda->redirect('../vender.php');
        }
    }
?>