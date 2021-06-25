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
        public function cadastrarFilme($nome,$genero,$classIndicativa,$duracao,$estreia,$ultimoDia){
            try{
                $sql= "INSERT INTO filme(nome, genero, classIndicativa, duracao, estreia, ultimoDia)
                VALUES (:nome, :genero,:classIndicativa, :duracao, :estreia, :ultimoDia )";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":genero",$genero);
                $stmt->bindParam(":classIndicativa",$classIndicativa);  
                $stmt->bindParam(":duracao",$duracao);
                $stmt->bindParam(":estreia",$estreia);                
                $stmt->bindParam(":ultimoDia",$ultimoDia);
                                             
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }
        /*EDITAR FILME*/
        public function editarFilme($nome,$genero,$classIndicativa,$duracao,$estreia,$ultimoDia,$id){
            try{
                $sql= "UPDATE filme
                SET
                    nome = :nome,
                    genero = :genero,
                    classIndicativa = :classIndicativa,
                    duracao = :duracao,
                    estreia = :estreia,
                    ultimoDia = :ultimoDia
                    WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(":nome",$nome);
                    $stmt->bindParam(":genero",$genero);
                    $stmt->bindParam(":classIndicativa",$classIndicativa);
                    $stmt->bindParam(":duracao",$duracao);
                    $stmt->bindParam(":estreia",$estreia);
                    $stmt->bindParam(":ultimoDia",$ultimoDia);
                    $stmt->bindParam(":id",$id);
                    $stmt->execute();
                    return $stmt;
            }catch(PDOException $e){
                    echo("Error: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }
        /*DELETAR FILME*/
        public function deletarFilme($idFilme){
            try{
                $sql = "DELETE FROM filme WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$idFilme);
                $stmt->execute();
                return $stmt;   
            }catch(PDOException $e){
                echo("Erro: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }
        public function converterData($data){
            $dataConvertida= date('d/m/Y',strtotime($data));
            return $dataConvertida;
        }
        public function redirect($url){
            header("Location: $url"); //header redireciona os links da pagina
        }
     }



?>