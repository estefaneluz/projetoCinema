<?php
    require_once '../model/sessao.php';
    $objSessao = new Sessao();
    
    if(isset($_POST['cadastrarSessao'])){
        $filme = $_POST['filme'];
        $sala = $_POST['sala'];
        $ingresso = $_POST['ingresso'];
        $data = $_POST['data'];        
        $horarioInicio = $_POST['horarioInicio'];

        if($objSessao->cadastrarSessao($filme, $sala, $ingresso, $data, $horarioInicio)){
            $objSessao->redirect('../acesso-adm.php');
        }
    }

    if(isset($_POST['editarSessao'])){
        $id = $_POST['editarSessao'];
        $filme = $_POST['filme'];
        $sala = $_POST['sala'];
        $data = $_POST['data'];        
        $horario = $_POST['horario'];
        if($objSessao->editarSessao($filme,$sala, $data, $horario, $id)){
            $objSessao->redirect('../acesso-adm.php');
        }
    }


    if(isset($_POST['deletarSessao'])){
        $idSessao = $_POST['deletarSessao'];
        if($objSessao->deletarSessao($idSessao)){
            $objSessao->redirect('../acesso-adm.php');
        }
    }

?>