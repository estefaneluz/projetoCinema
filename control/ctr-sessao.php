<?php
    require_once '../model/sessao.php';
    $objSessao = new Sessao();
    
    /*CADASTRAR SESSAO*/

    if(isset($_POST['cadastrarSessao'])){
        $filme = $_POST['filme'];
        $sala = $_POST['sala'];
        $data = $_POST['data'];        
        $horarioInicio = $_POST['horarioInicio'];
        $horarioFim = $_POST['horarioInicio'];

        if($objSessao->cadastrarSessao($filme, $sala, $data, $horarioInicio)){
            $objSessao->redirect('../acesso-adm.php');
        }
    }

    /*EDITAR FILMES*/
    // if(isset($_POST['editarFilme'])){//seta
    //     $id = $_POST['editarFilme'];
    //     $nome = $_POST['nomeFilme'];
    //     $estreia = $_POST['estreiaFilme'];
    //     $ultimoDia = $_POST['ultimoDia'];        
    //     $duracao = $_POST['duracao'];
    //     $classIndicativa = $_POST['classIndicativa'];
    //     $genero = $_POST ['genero'];
    //     if($objFilme->editarFilme($nome,$estreia,$ultimoDia,$duracao,$classIndicativa,$genero,$id)){
    //         $objFilme->redirect('../acesso-adm.php');
    //     }
    // }
    // if(isset($_POST['deletarFilme'])){
    //     $idFilme = $_POST['deletarFilme'];
    //     if($objFilme->deletarFilme($idFilme)){
    //         $objFilme->redirect('../acesso-adm.php');
    //     }
    // }




?>