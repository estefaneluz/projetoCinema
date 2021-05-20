<?php
    require_once '../model/filme.php';
    $objFilme = new Filme();
    
    /*CADASTRAR FILME*/

    if(isset($_POST['cadastrarFilme'])){
        $nome = $_POST['nome'];
        $genero = $_POST ['genero'];
        $classIndicativa = $_POST['classIndicativa'];
        $duracao = $_POST['duracao'];
        $estreia = $_POST['estreia'];
        $ultimoDia = $_POST['ultimoDia'];      
        if($objFilme->cadastrarFilme($nome,$genero,$classIndicativa,$duracao,$estreia,$ultimoDia)){
            $objFilme->redirect('../acesso-adm.php#cadastro-filmes');
        }
    }
    /*EDITAR FILMES*/
    if(isset($_POST['editarFilme'])){
        $id = $_POST['editarFilme'];
        $nome = $_POST['nome'];
        $genero= $_POST['genero'];
        $classIndicativa =$_POST['classIndicativa'];
        $duracao = $_POST['duracao'];
        $estreia=$_POST['estreia'];
        $ultimoDia = $_POST['ultimoDia'];
        if($objFilme->editarFilme($nome,$genero,$classIndicativa,$duracao,$estreia,$ultimoDia,$id)){
            $objFilme->redirect('../acesso-adm.php#cadastro-filmes');
        }
    }
    if(isset($_POST['deletarFilme'])){
        $idFilme = $_POST['deletarFilme'];
        if($objFilme->deletarFilme($idFilme)){
            $objFilme->redirect('../acesso-adm.php#cadastro-filmes');
        }
    }




?>