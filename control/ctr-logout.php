<?php
    session_start();
    unset($_SESSION['idFuncionario']);
    header("Location: ../index.php");
?>