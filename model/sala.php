<?php
    require_once 'conexao.php';

    class Sala{
        private $conn;
        public function __construct() 
        {   
            $dataBase = new dataBase();
            $db = $dataBase->dbConnection();
            $this-> conn = $db;
        }

        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt; 
        }

        public function cadastrarSala($nome,$qtdAssentos){
            try{
                $sql= "INSERT INTO sala(nome, qtdAssentos)
                VALUES (:nome, :qtdAssentos)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":qtdAssentos",$qtdAssentos);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        public function editarSala($nome,$qtdAssentos,$id){
            try{
                $sql = "UPDATE sala
                SET 
                    nome = :nome,
                    qtdAssentos = :qtdAssentos
                    WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt-> bindParam(":nome",$nome);
                    $stmt-> bindParam(":qtdAssentos",$qtdAssentos);
                    $stmt-> bindParam(":id",$id);
                    $stmt->execute();
             
                    return $stmt;
            } catch(PDOException $e) {
             echo ("Error: ".$e->getMessage());
            } finally {
             $this->conn = null;
            }
        }

        public function deletarSala($idSala){
            try{
                $sql = "DELETE FROM sala WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$idSala);
                $stmt->execute();
                return $stmt;   
            }catch(PDOException $e){
                echo("Erro: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }

         public function redirect($url){
             header("Location: $url"); //header redireciona os links da pagina
         }

     }
?>