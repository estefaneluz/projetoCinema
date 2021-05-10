<?php
    require_once 'conexao.php';//Importa as funcionalidades de um arquivo em outro

    class Funcionario{
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
        
        //Validação do acesso do Funcionario
        public function validacao($email,$senha){
            try{
                $meuBanco = "SELECT * FROM funcionario WHERE email = :email AND senha = :senha";//:email - parametro q vai receber o valor digitado
                $estado =  $this->conexao->prepare($meuBanco);//Simular as funções do CRUD
                //Função prepare: prepara uma instrução SQL para ser executada no BD
                $estado->bindParam(":email",$email);//bindParam - Acrescenta os parametros
                $estado->bindParam(":senha",$senha);
                 // Sintaxe de bindParam("parametro q vai receber o valor", $valorQVaiSerPassado)
                $estado->execute();// Executa as ações do $sql,
                // $estado vai retornar o execute
                if($estado->rowCount()>0){ //rowCount vai pegar a qtd de linhas afetadas na execução
                    return true; //Se for maior q 0 significa q achou o funcionario no banco
                } else{
                    return false;
                }  

              
            }catch(PDOException $excecao){
                echo "ERROR: ".$excecao->getMessage();//" . " concatena
            }finally{//Sempre executa mesmo se der erro
                    //Fechar a conexão dps da validação é uma BOA PRÁTICA
                $this->conexao = null;
            }
        }
        /*CADASTRAR FUNCIONARIO*/
        public function cadastrarFuncionario($nome,$cpf,$email,$senha){
            try{
                $sql= "INSERT INTO funcionario(nome, cpf, email, senha)
                VALUES (:nome, :cpf, :email, :senha)";
                $estado=$this->conexao->prepare($sql);
                $estado->bindParam(":nome",$nome);
                $estado->bindParam(":cpf",$cpf);
                $estado->bindParam(":email",$email);
                $estado->bindParam(":senha",$senha);
                $estado->execute();
                return $estado;
            }catch(PDOException $excecao){
                echo("Error: ".$excecao->getMessage());
            }finally{
                $this->conexao = null;
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
                $estado = $this->conexao->prepare($sql);
                $estado-> bindParam(":nome",$nome);
                $estado-> bindParam(":cpf",$cpf);
                $estado-> bindParam(":email",$email);
                $estado-> bindParam(":senha",$senha);
                $estado-> bindParam(":id",$id);
                $estado->execute();
                
                return $estado;
            }catch(PDOException $excecao){
                echo ("Error: ".$excecao->getMessage());
            }finally{
                $this->conexao = null;
            }
        }
        public function redirect($url){
            header("Location: $url"); //header redireciona os links da pagina
        }
    }


?>