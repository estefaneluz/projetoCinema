<?php
    require_once '../model/filme.php';
    $objFilme = new Filme();
    
    /*CADASTRAR FILME*/

    if(isset($_POST['cadastrarFilme'])){//seta
        $nome = $_POST['nome'];
        $estreia = $_POST['estreia'];
        $ultimoDia = $_POST['ultimoDia'];        
        $duracao = $_POST['duracao'];
        $classIndicativa = $_POST['classIndicativa'];
        $genero = $_POST ['genero'];
        if($objFilme->cadastrarFilme($nome,$estreia,$ultimoDia,$duracao,$classIndicativa,$genero)){
            $objFilme->redirect('../acesso-adm.php');
        }
    }
    /*EDITAR FILMES*/
    if(isset($_POST['editarFilme'])){//seta
        $id = $_POST['editarFilme'];
        $nome = $_POST['nomeFilme'];
        $estreia = $_POST['estreiaFilme'];
        $ultimoDia = $_POST['ultimoDia'];        
        $duracao = $_POST['duracao'];
        $classIndicativa = $_POST['classIndicativa'];
        $genero = $_POST ['genero'];
        if($objFilme->editarFilme($nome,$estreia,$ultimoDia,$duracao,$classIndicativa,$genero,$id)){
            $objFilme->redirect('../acesso-adm.php');
        }
    }
    if(isset($_POST['deletarFilme'])){
        $idFilme = $_POST['deletarFilme'];
        if($objFilme->deletarFilme($idFilme)){
            $objFilme->redirect('../acesso-adm.php');
        }
    }




?>