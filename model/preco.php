<?php
    require_once 'conexao.php';

    class Preco{
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

        public function cadastrarPreco($nome, $valor){
            try{
                $meia = $valor/2;
                $sql= "INSERT INTO ingresso (nome, valor, meia)
                VALUES (:nome, :valor, :meia)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":valor",$valor);
                $stmt->bindParam(":meia",$meia);

                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        public function editarPreco($nome, $valor, $id){
            try{
                $meia = $valor/2;
                $sql = "UPDATE ingresso
                SET 
                    nome = :nome,
                    valor = :valor,
                    meia = :meia
                    WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt-> bindParam(":nome",$nome);
                    $stmt-> bindParam(":valor",$valor);
                    $stmt-> bindParam(":meia",$meia);
                    $stmt-> bindParam(":id",$id);
                    $stmt->execute();
             
                    return $stmt;
            } catch(PDOException $e) {
             echo ("Error: ".$e->getMessage());
            } finally {
             $this->conn = null;
            }
        }

        public function deletarPreco($idPreco){
            try{
                $sql = "DELETE FROM ingresso WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$idPreco);
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