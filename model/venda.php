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

        public function cadastrarVenda($cliente, $sessao, $data, $qtdIngrInt, $qtdIngrMeia){
            try{
                $qtdAssentos = $this->getQtdAssentos($sessao);
                $ingressosVendidos = $this->getIngressosVendidos($sessao);
                $ingressosVendidos+= ($qtdIngrInt + $qtdIngrMeia);
                
                if($ingressosVendidos<=$qtdAssentos){
                    if($ingressosVendidos)
                    $sql= 'INSERT INTO venda(id_cliente, id_func, id_sessao, data, qtdIngrInt, qtdIngrMeia, valorTotal)
                    VALUES (:id_cliente, :id_func, :id_sessao, :data, :qtdIngrInt, :qtdIngrMeia, :valorTotal)';
                    
                    $cliente = $this->getNomeCliente($cliente);
                    $valorTotal = $this->calcularTotal($sessao, $qtdIngrInt, $qtdIngrMeia);

                    $funcionario = $_SESSION['idFuncionario']; 
                    $stmt=$this->conn->prepare($sql);
                    $stmt->bindParam(":id_cliente",$cliente);
                    $stmt->bindParam(":id_func",$funcionario);   
                    $stmt->bindParam(":id_sessao",$sessao);                             
                    $stmt->bindParam(":data",$data);
                    $stmt->bindParam(":qtdIngrInt",$qtdIngrInt);
                    $stmt->bindParam(":qtdIngrMeia",$qtdIngrMeia); 
                    $stmt->bindParam(":valorTotal",$valorTotal);                
                    $stmt->execute();
                    /*muda status da sessao na hora da compra
                    if($stmt->rowCount()>0){
                        $this->mudarStatus($sessao);
                        return $stmt;
                    }*/
                    return $stmt;
                }
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }

        }

        public function calcularTotal($sessao, $qtdIngrInt, $qtdIngrMeia){
            $sqlPreco = "SELECT id_ingresso FROM sessao WHERE id = $sessao";
            $stmtPreco = $this->runQuery($sqlPreco);
            $stmtPreco->execute();
            $preco = $stmtPreco->fetch(PDO::FETCH_ASSOC);
            $preco = $preco['id_ingresso'];
                    
            $sqlValor = "SELECT valor, meia FROM ingresso WHERE id = $preco";
            $stmtValor = $this->runQuery($sqlValor);
            $stmtValor->execute();
            $valor = $stmtValor->fetch(PDO::FETCH_ASSOC);
            $valorTotal = ($valor['valor']*$qtdIngrInt)+($valor['meia']*$qtdIngrMeia);
            return $valorTotal;
        }

        public function getQtdAssentos($sessao){
            $sql = "SELECT id_sala FROM sessao WHERE id = $sessao";
            $stmt = $this->runQuery($sql);
            $stmt->execute();
            $idSala = $stmt->fetch(PDO::FETCH_ASSOC);
            $idSala = $idSala['id_sala'];

            $sqlQtd = "SELECT qtdAssentos FROM sala WHERE id = $idSala";
            $stmtQtd = $this->runQuery($sqlQtd);
            $stmtQtd->execute();
            $qtdAssentos = $stmtQtd->fetch(PDO::FETCH_ASSOC);
            $qtdAssentos = $qtdAssentos['qtdAssentos'];
            return $qtdAssentos;
        }

        public function getIngressosVendidos($sessao){
            $sql = "SELECT ingressosVendidos FROM sessao WHERE id = $sessao";
            $stmt = $this->runQuery($sql);
            $stmt->execute();
            $ingressosVendidos = $stmt->fetch(PDO::FETCH_ASSOC);
            $ingressosVendidos = $ingressosVendidos['ingressosVendidos'];
            return $ingressosVendidos;
        }

        function getNomeCliente($cpf){
            $sqlCliente = "SELECT id FROM cliente WHERE cpf = $cpf";
            $stmtCliente = $this->runQuery($sqlCliente);
            $stmtCliente->execute();
            $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
            return $cliente['id'];
        }
        
        // função mudar Status da sessão
        public function mudarStatus($sessao){
            try{
                $sqlStatus = "UPDATE sessao SET status ='ENCERRADA' WHERE id =:id";
                $stmt= $this->conn->prepare($sqlStatus);
                $stmt->bindParam(":id",$sessao);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }

         public function redirect($url){
             header("Location: $url"); //header redireciona os links da pagina
         }
    }

?>