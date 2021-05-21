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
                $sql= 'INSERT INTO venda(id_cliente, id_func, id_sessao, data, qtdIngrInt, qtdIngrMeia, valorTotal)
                VALUES (:id_cliente, :id_func, :id_sessao, :data, :qtdIngrInt, :qtdIngrMeia, :valorTotal)';

                //pegando o id do cliente
                $sqlCliente = "SELECT id FROM cliente WHERE cpf = $cliente";
                $obj = new Venda();
                $stmtCliente = $obj->runQuery($sqlCliente);
                $stmtCliente->execute();
                $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

                //pegando o preço para calcular o total 
                $sqlPreco = "SELECT id_ingresso FROM sessao WHERE id = $sessao";
                $stmtPreco = $obj->runQuery($sqlPreco);
                $stmtPreco->execute();
                $preco = $stmtPreco->fetch(PDO::FETCH_ASSOC);
                $preco = $preco['id_ingresso'];
                
                //calculando total
                $sqlValor = "SELECT valor, meia FROM ingresso WHERE id = $preco";
                $stmtValor = $obj->runQuery($sqlValor);
                $stmtValor->execute();
                $valor = $stmtValor->fetch(PDO::FETCH_ASSOC);
                $valorTotal = ($valor['valor']*$qtdIngrInt)+($valor['meia']*$qtdIngrMeia);

                $funcionario = $_SESSION['idFuncionario']; 
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam(":id_cliente",$cliente['id']);
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
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn = null;
            }

        }/* função mudar Status da sessão
        public function mudarStatus($sessao){
            try{
                $sqlStatus = "UPDATE sessao SET status ='Vendido' WHERE id =:id";
                $stmt= $this->conn->prepare($sqlStatus);
                $stmt->bindParam(":id",$sessao);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error: ".$e->getMessage());
            }finally{
                $this->conn=null;
            }
        }*/
        // public function editarSessao($filme,$sala, $data, $horario, $id){
        //     try{
        //         $sql = "UPDATE sessao
        //         SET 
        //             id_filme = :id_filme,
        //             id_sala = :id_sala,
        //             data = :data,
        //             horarioInicio = :horarioInicio
        //             WHERE id = :id";
        //             $stmt = $this->conn->prepare($sql);
        //             $stmt-> bindParam(":id_filme",$filme);
        //             $stmt-> bindParam(":id_sala",$sala);
        //             $stmt-> bindParam(":data",$data);
        //             $stmt-> bindParam(":horarioInicio",$horario);
        //             $stmt-> bindParam(":id",$id);
        //             $stmt->execute();
             
        //             return $stmt;
        //  }catch(PDOException $e){
        //      echo ("Error: ".$e->getMessage());
        //  }finally{
        //      $this->conn = null;
        //  } 
        // }

        // public function deletarSessao($idSessao){
        //     try{
        //         $sql = "DELETE FROM sessao WHERE id = :id";
        //         $stmt = $this->conn->prepare($sql);
        //         $stmt-> bindParam(":id",$idSessao);
        //         $stmt->execute();
        //         return $stmt;   
        //     }catch(PDOException $e){
        //         echo("Erro: ".$e->getMessage());
        //     }finally{
        //         $this->conn=null;
        //     }
        // }

         public function redirect($url){
             header("Location: $url"); //header redireciona os links da pagina
         }
    }

?>