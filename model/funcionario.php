<?php
    require_once 'conexao.php';

    class Funcionario{
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
        
        //Validação do acesso do Funcionario
        public function validacao($email,$senha){
            try{
                $sql = "SELECT * FROM funcionario WHERE email = :email AND senha = :senha";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":email",$email);
                $stmt->bindParam(":senha",$senha);
                $stmt->execute();
                if($stmt->rowCount()>0){ 
                    $dado = $stmt->fetch();
                    $_SESSION['idFuncionario'] = $dado['id'];
                    return true; 
                } else{
                    return false;
                }  

              
            }catch(PDOException $e){
                echo "ERROR: ".$e->getMessage();//" . " concatena
            }finally{
                $this->conn = null;
            }
        }
        /*CADASTRAR FUNCIONARIO*/
        public function cadastrarFuncionario($nome,$cpf,$email,$senha){
            try{
                $sql= "INSERT INTO funcionario(nome, cpf, email, senha)
                VALUES (:nome, :cpf, :email, :senha)";
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":cpf",$cpf);
                $stmt->bindParam(":email",$email);
                $stmt->bindParam(":senha",$senha);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }
        /*EDITAR FUNCIONÁRIO*/
        public function editarFuncionario($nome,$cpf,$email,$senha,$id){
            try{
                $sql = "UPDATE funcionario
                SET 
                    nome = :nome,
                    cpf = :cpf,
                    email = :email,
                    senha = :senha
                    WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":nome",$nome);
                $stmt-> bindParam(":cpf",$cpf);
                $stmt-> bindParam(":email",$email);
                $stmt-> bindParam(":senha",$senha);
                $stmt-> bindParam(":id",$id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo ("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }
         /*DELETAR FUNCIONÁRIO*/
         public function deletarFuncionario($id){
            try{
                $sql = "DELETE FROM funcionario WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt-> bindParam(":id",$id);
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