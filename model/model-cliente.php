<?php
    require_once 'conexao.php';//Importa as funcionalidades de um arquivo em outro

    class Cliente{
        private $conexao;
        public function __construct() //Criando o construtor da classe funcionario
        {   

            $dataBase = new dataBase();//Criando instancia de dataBase da conexao.php
            $db = $dataBase->ConexaoBancoDeDados();//Criação de variável para receber a função ConexaoBancoDedados q está dentro de conexao.php
            $this-> conexao = $db;//conexao vai receber a função ConexaoBandoDeDados que foi armazenada dentro de $db
        }
        //EXIBIÇÃO DOS DADOS DO BD
        public function acessarBancoDedados($meuBanco){
            $estado = $this->conexao->prepare($meuBanco);//Abre a conexao com o BD e prepara para ser usado
            return $estado; //Retorna a preparacao pra exceutar no banco
        }
         /*CADASTRAR CLIENTE*/
         public function cadastrarCliente($nome,$cpf,$idade,$dataNascimento){
            try{
                $sql= "INSERT INTO cliente(nome, cpf, idade, dataNascimento)
                VALUES (:nome, :cpf, :idade, :dataNascimento)";
                $estado=$this->conexao->prepare($sql);
                $estado->bindParam(":nome",$nome);
                $estado->bindParam(":cpf",$cpf);
                $estado->bindParam(":idade",$idade);                
                $estado->bindParam(":dataNascimento",$dataNascimento);
                $estado->execute();
                return $estado;
            }catch(PDOException $excecao){
                echo("Error: ".$excecao->getMessage());
            }finally{
                $this->conexao = null;
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
                    dataNascimento = :dataNascimento;
                    WHERE id = :id";
                    $estado = $this->conexao->prepare($sql);
                    $estado-> bindParam(":nome",$nome);
                    $estado-> bindParam(":cpf",$cpf);
                    $estado-> bindParam(":idade",$idade);
                    $estado-> bindParam(":dataNascimento",$dataNascimento);
                    $estado-> bindParam(":id",$id);
                    $estado->execute();
             
                    return $estado;
         }catch(PDOException $excecao){
             echo ("Error: ".$excecao->getMessage());
         }finally{
             $this->conexao = null;
         }
    }
        public function deletarCliente($idCliente){
            try{
                $sql = "DELETE FROM cliente WHERE id = :id";
                $estado = $this->conexao->prepare($sql);
                $estado-> bindParam(":id",$idCliente);
                $estado->execute();
                return $estado;   
            }catch(PDOException $excecao){
                echo("Erro: ".$excecao->getMessage());
            }finally{
                $this->conexao=null;
            }
        }
        public function redirect($url){
            header("Location: $url"); //header redireciona os links da pagina
        }

    }

?>