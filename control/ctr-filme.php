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




?>