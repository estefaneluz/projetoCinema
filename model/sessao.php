<?php
     require_once 'conexao.php';

     class Sessao {

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

        /*CADASTRAR SESSAO*/
        public function cadastrarSessao($filme, $sala, $data, $horarioInicio){
            try{
                $sql= "INSERT INTO sessao(id_filme, id_sala, data, horarioInicio, horarioFim)
                VALUES (:id_filme, :id_sala, :data, :horarioInicio, :horarioFim)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":id_filme",$filme);
                $stmt->bindParam(":id_sala",$sala);                
                $stmt->bindParam(":data",$data);
                $stmt->bindParam(":horarioInicio",$horarioInicio);
                $stmt->bindParam(":horarioFim",$horarioInicio);                
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        // public function editarFilme($nome,$estreia,$ultimoDia,$duracao,$classIndicativa,$genero,$id){
        //     try{
        //         $sql = "UPDATE filme
        //         SET 
        //             nome = :nome,
        //             estreia = :estreia,
        //             ultimoDia = :ultimoDia,
        //             duracao = :duracao,
        //             classIndicativa = :classIndicativa,
        //             genero = :genero
        //             WHERE id = :id";
        //             $stmt = $this->conn->prepare($sql);
        //             $stmt-> bindParam(":nome",$nome);
        //             $stmt-> bindParam(":estreia",$estreia);
        //             $stmt-> bindParam(":ultimoDia",$ultimoDia);
        //             $stmt-> bindParam(":duracao",$duracao);
        //             $stmt-> bindParam(":classIndicativa",$classIndicativa);
        //             $stmt-> bindParam(":genero",$genero);
        //             $stmt-> bindParam(":id",$id);
        //             $stmt->execute();
             
        //             return $stmt;
        //  }catch(PDOException $e){
        //      echo ("Error: ".$e->getMessage());
        //  }finally{
        //      $this->conn = null;
        //  } 
        // }

        /*DELETAR FILME*/
        public function deletarSessao($idSessao){
            try{
                $sql = "DELETE FROM sessao WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$idSessao);
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