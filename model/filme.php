<?php
     require_once 'conexao.php';

     class Filme{
         private $conn;
         public function __construct()
         {
             $dataBase = new dataBase();
             $db = $dataBase->dbConnection();
             $this-> conn = $db;
         }
         //EXIBIÇÃO DOS DADOS DO BD
         public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt; 
        }  
        /*CADASTRAR FILME*/
        public function cadastrarFilme($nome,$estreia,$ultimoDia,$duracao,$classIndicativa,$genero){
            try{
                $sql= "INSERT INTO filme(nome, estreia, ultimoDia, duracao, classIndicativa, genero)
                VALUES (:nome, :estreia, :ultimoDia, :duracao, :classIndicativa, :genero)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":estreia",$estreia);                
                $stmt->bindParam(":ultimoDia",$ultimoDia);
                $stmt->bindParam(":duracao",$duracao);
                $stmt->bindParam(":classIndicativa",$classIndicativa);                
                $stmt->bindParam(":genero",$genero);

                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }
        public function redirect($url){
            header("Location: $url"); //header redireciona os links da pagina
        }
     }



?>