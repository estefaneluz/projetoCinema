<?php
    require_once 'conexao.php';

    class Cliente{
        private $conn;
        public function __construct() 
        {   
            $dataBase = new dataBase();
            $db = $dataBase->dbConnection();
            $this-> conn = $db;
        }
        //EXIBIÇÃO DOS DADOS DO BD
        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);//Abre a conexao com o BD e prepara para ser usado
            return $stmt; //Retorna a preparacao pra exceutar no banco
        }
         /*CADASTRAR CLIENTE*/
         public function cadastrarCliente($nome,$cpf,$idade,$dataNascimento){
            try{
                $sql= "INSERT INTO cliente(nome, cpf, idade, dataNascimento)
                VALUES (:nome, :cpf, :idade, :dataNascimento)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":cpf",$cpf);
                $stmt->bindParam(":idade",$idade);                
                $stmt->bindParam(":dataNascimento",$dataNascimento);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        /*EDITAR CLIENTE*/
        public function editarCliente($nome,$cpf,$idade,$dataNascimento,$id){
            try{
                $sql = "UPDATE cliente
                SET 
                    nome = :nome,
                    cpf = :cpf,
                    idade = :idade,
                    dataNascimento = :dataNascimento
                    WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt-> bindParam(":nome",$nome);
                    $stmt-> bindParam(":cpf",$cpf);
                    $stmt-> bindParam(":idade",$idade);
                    $stmt-> bindParam(":dataNascimento",$dataNascimento);
                    $stmt-> bindParam(":id",$id);
                    $stmt->execute();
             
                    return $stmt;
         }catch(PDOException $e){
             echo ("Error: ".$e->getMessage());
         }finally{
             $this->conn = null;
         }
    }
        public function deletarCliente($idCliente){
            try{
                $sql = "DELETE FROM cliente WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$idCliente);
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