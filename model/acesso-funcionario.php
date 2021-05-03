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
        //Validação do acesso do Funcionario
        public function validacao($email,$senha){
            try{
                $sql = "select * from funcionario where email = :email and senha = :senha";//:email - parametro q vai receber o valor digitado
                $estado =  $this->conexao->prepare($sql);//Simular as funções do CRUD
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

        public function redirect($url){
            header("Location: $url"); //header redireciona os links da pagina
        }
    }


?>