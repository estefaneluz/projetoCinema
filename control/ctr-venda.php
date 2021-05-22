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
        } else {
            $objVenda->redirect('../vender.php');
        }
    }
?>