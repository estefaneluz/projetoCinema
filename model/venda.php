<?php
     require_once 'conexao.php';

     class Venda {

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

        public function cadastrarVenda($cliente, $funcionario, $sessao, $data, $qtdIngressoInt, $qtdIngressoMeia){
            try{
                $sql= "INSERT INTO venda(id_cliente, id_funcionario, id_sessao, data, qtdIngressoInt, qtdIngressoMeia)
                VALUES (:id_cliente, :id_funcionario, :id_sessao, :data, :qtdIngressoInt, :qtdIngressoMeia)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":id_cliente",$cliente);
                $stmt->bindParam(":id_funcionario",$funcionario);   
                $stmt->bindParam(":id_sessao",$sessao);                             
                $stmt->bindParam(":data",$data);
                $stmt->bindParam(":qtdIngressoInt",$qtdIngressoInt);
                $stmt->bindParam(":qtdIngressoMeia",$qtdIngressoMeia);                
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        // public function editarSessao($filme,$sala, $data, $horario, $id){
        //     try{
        //         $sql = "UPDATE sessao
        //         SET 
        //             id_filme = :id_filme,
        //             id_sala = :id_sala,
        //             data = :data,
        //             horarioInicio = :horarioInicio
        //             WHERE id = :id";
        //             $stmt = $this->conn->prepare($sql);
        //             $stmt-> bindParam(":id_filme",$filme);
        //             $stmt-> bindParam(":id_sala",$sala);
        //             $stmt-> bindParam(":data",$data);
        //             $stmt-> bindParam(":horarioInicio",$horario);
        //             $stmt-> bindParam(":id",$id);
        //             $stmt->execute();
             
        //             return $stmt;
        //  }catch(PDOException $e){
        //      echo ("Error: ".$e->getMessage());
        //  }finally{
        //      $this->conn = null;
        //  } 
        // }

        // public function deletarSessao($idSessao){
        //     try{
        //         $sql = "DELETE FROM sessao WHERE id = :id";
        //         $stmt = $this->conn->prepare($sql);
        //         $stmt-> bindParam(":id",$idSessao);
        //         $stmt->execute();
        //         return $stmt;   
        //     }catch(PDOException $e){
        //         echo("Erro: ".$e->getMessage());
        //     }finally{
        //         $this->conn=null;
        //     }
        // }

         public function redirect($url){
             header("Location: $url"); //header redireciona os links da pagina
         }
    }

?>