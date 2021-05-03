<?php /*iniciando o codigo php p/ criar a conexão*/

    class dataBase  {/*classe de bd p/ conectar como banco*/
        private $userName="root";//login do banco padrão
        private $senha ="";
       
       //private: só a classe dataBase vai ver
        public $conexao; // variável p/manipular a conexao
        //public: todo mundo tem acesso
        public function ConexaoBancoDeDados(){
            $this->conexao = null; // inicia o valor de conexão como nulo
            try{//tenta executar oq tem dentro      //dbname seta o BD a ser utilizado  //permite a concexao como login do banco
                $this->conexao=new PDO('mysql:host=localhost; dbname=Cinemail', $this->userName, $this->senha);//drive utilizado:mysql, host> onde vai estar o banco/ localhost: a maquina local onde ta o banco
                /*vai tentar tratar o erro por meio de atribuicao de atributo*/
                $this->conexao-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//tipo de tratamento do erro
            }catch(PDOException $excecao){// variavel que vai tratar a excecao do erro
                //PDO é uma biblioteca com varios recursos p/ manipular o BD 
                //e o PDOEXCEPTION - classe generica p/tratar erros
                echo $excecao->getMessage();//echo exibe na tela, aq querO q ele exiba por meio de getMessage a msg de erro q foi gerada
            }
            return $this->conexao;// se der certo a concexão ele a retona
        }
    }   


?>