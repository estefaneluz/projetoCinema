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
                $ingrVendidos = $this->getIngrVendidos($sessao);
                $ingrVendidos+= $qtdIngrInt + $qtdIngrMeia;

                if($ingrVendidos<=$qtdAssentos){
                    $cliente = $this->getIdCliente($cliente);
                    $valorTotal = $this->calcularTotal($sessao, $qtdIngrInt, $qtdIngrMeia);
                    $funcionario = $_SESSION['idFuncionario']; 
                    $id_sessao = $sessao;
                    $sql= 'INSERT INTO venda(id_cliente, id_func, id_sessao, data, qtdIngrInt, qtdIngrMeia, valorTotal)
                    VALUES (:id_cliente, :id_func, :id_sessao, :data, :qtdIngrInt, :qtdIngrMeia, :valorTotal)';
                    
                    $stmt=$this->conn->prepare($sql);
                    $stmt->bindParam(":id_cliente",$cliente);
                    $stmt->bindParam(":id_func",$funcionario);   
                    $stmt->bindParam(":id_sessao",$sessao);                             
                    $stmt->bindParam(":data",$data);
                    $stmt->bindParam(":qtdIngrInt",$qtdIngrInt);
                    $stmt->bindParam(":qtdIngrMeia",$qtdIngrMeia); 
                    $stmt->bindParam(":valorTotal",$valorTotal);                
                    $stmt->execute();

                    if($ingrVendidos==$qtdAssentos){$this->mudarStatus($sessao);}
                    $this->updateIngrVendidos($id_sessao, $ingrVendidos);
                    
                    return $stmt;
                }
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }

        }

        public function editarVenda($sessao, $qtdInt, $qtdMeia, $data, $id){
            try{
                
                $funcionario = $_SESSION['idFuncionario']; 
                $valorTotal = $this->calcularTotal($sessao, $qtdInt, $qtdMeia);
                $qtdAssentos = $this->getQtdAssentos($sessao);
                $ingrVendidos = $this->getIngrVendidos($sessao);
                $ingrAntigos = $this->getQtdIngressos($id);
                $ingrVendidos -= $ingrAntigos; 
                $ingrVendidos += $qtdInt + $qtdMeia;
                
                if($ingrVendidos<=$qtdAssentos){
                $sql = "UPDATE venda
                SET 
                    qtdIngrInt = :qtdIngrInt,
                    qtdIngrMeia = :qtdIngrMeia,
                    data = :data,
                    valorTotal = :valorTotal,
                    id_func = :id_func
                    WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt-> bindParam(":qtdIngrInt",$qtdInt);
                    $stmt-> bindParam(":qtdIngrMeia",$qtdMeia);
                    $stmt-> bindParam(":data",$data);
                    $stmt-> bindParam(":id_func",$funcionario);
                    $stmt-> bindParam(":valorTotal",$valorTotal);
                    $stmt-> bindParam(":id",$id);
                    $stmt->execute();

                    if($ingrVendidos==$qtdAssentos){$this->mudarStatus($sessao);}
                    $this->updateIngrVendidos($sessao, $ingrVendidos);
             
                    return $stmt;
                }
         }catch(PDOException $e){
             echo ("Error: ".$e->getMessage());
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

        public function getIngrVendidos($sessao){
            $sql = "SELECT ingressosVendidos FROM sessao WHERE id = $sessao";
            $stmt = $this->runQuery($sql);
            $stmt->execute();
            $ingrVendidos = $stmt->fetch(PDO::FETCH_ASSOC);
            $ingrVendidos = $ingrVendidos['ingressosVendidos'];
            return $ingrVendidos;
        }

        public function getQtdIngressos($venda){
            $sql = "SELECT qtdIngrInt, qtdIngrMeia FROM venda WHERE id = $venda";
            $stmt = $this->runQuery($sql);
            $stmt->execute();
            $qtdIngr = $stmt->fetch(PDO::FETCH_ASSOC);
            return $qtdIngr['qtdIngrInt']+$qtdIngr['qtdIngrMeia'];
        }

        function getIdCliente($cpf){
            $sqlCliente = "SELECT id FROM cliente WHERE cpf = $cpf";
            $obj = new Venda();
            $stmtCliente = $obj->runQuery($sqlCliente);
            $stmtCliente->execute();
            $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
            return $cliente['id'];
        }

        public function updateIngrVendidos($sessao, $ingrVendidos){
            try{
                $sql = "UPDATE sessao SET ingressosVendidos=$ingrVendidos WHERE id =:id";
                $obj = new Venda();
                $stmt= $obj->conn->prepare($sql);
                $stmt->bindParam(":id",$sessao);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }
        
        // função mudar Status da sessão
        public function mudarStatus($sessao){
            try{
                $sqlStatus = "UPDATE sessao SET status ='ENCERRADA' WHERE id = $sessao";
                $stmt= $this->conn->prepare($sqlStatus);
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