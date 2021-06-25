<?php
    require_once '../model/venda.php';
    $objVenda = new Venda();

    /* EDITAR VENDA: */
    if(isset($_GET['idVenda'])){
        $id = $_GET['idVenda'];
        $sessao = $_GET['idSessao'];
        $qtdInt = $_GET['qtdInteiro'];
        $qtdMeia = $_GET['qtdMeia'];
        $data = $_GET['dataAtual'];   
        $cliente = $_GET['idCliente']; 
        
        if($objVenda->editarVenda($sessao, $qtdInt, $qtdMeia, $data, $id)){
            $objVenda->redirect("../sessao.php?sessao=$sessao&qtdInt=$qtdInt&qtdMeia=$qtdMeia&cliente=$cliente");
        } else {
            $objVenda->redirect('../vender.php');
        }
    }
    
    /* CADASTRAR VENDA: */
    if(isset($_GET['idSessao'])){
        $cliente = $_GET['cpfCliente']; 
        $sessao = $_GET['idSessao']; 
        $data = $_GET['dataAtual'];        
        $qtdInt = $_GET['qtdInteiro']; 
        $qtdMeia = $_GET['qtdMeia']; 

        if($objVenda->cadastrarVenda($cliente, $sessao, $data, $qtdInt, $qtdMeia)){
            $idCliente = $objVenda->getIdCliente($cliente);
            $objVenda->redirect("../sessao.php?sessao=$sessao&qtdInt=$qtdInt&qtdMeia=$qtdMeia&cliente=$idCliente");
        } else {
            $objVenda->redirect('../vender.php');
        }
    }

?>